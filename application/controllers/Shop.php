<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/24/19
 * Time: 8:36 PM
 */

require  APPPATH . 'libraries/vendor/autoload.php';

use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

class Shop extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();


        $this->load->library('braintree-php-3.40.0/lib/Braintree');

        parse_str($_SERVER['QUERY_STRING'], $_GET);
        $this->load->model('shop_model');
        $this->load->model('product_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->config->load('paypal');
    }


    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    public static function environment()
    {

        $clientId = getenv("CLIENT_ID") ?: 'AbAkF67LN5G5bdxr_n6cD3hLrdESTd4IDIuPcnQzVrZyoYVcQcwpW1neEjkQfrfZo89Fy33uMJtcmy9V';
        $clientSecret = getenv("CLIENT_SECRET") ?: "ED55i8ud5Frq3lOGI2XDn9QA1ritPlnpOM4hPc2CVO2eiF3wBWciqCQ1HZke4vSKYMtJtfcshhpT93Ue";
        return new SandboxEnvironment($clientId, $clientSecret);
    }

    public function getOrder($orderId)
    {

        // 3. Call PayPal to get the transaction details
        $client = PayPalClient::client();
        $response = $client->execute(new OrdersGetRequest($orderId));
        /**
         *Enable the following line to print complete response as JSON.
         */
        //print json_encode($response->result);
        print "Status Code: {$response->statusCode}\n";
        print "Status: {$response->result->status}\n";
        print "Order ID: {$response->result->id}\n";
        print "Intent: {$response->result->intent}\n";
        print "Links:\n";
        foreach ($response->result->links as $link) {
            print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
        }
        // 4. Save the transaction in your database. Implement logic to save transaction to your database for future reference.
        print "Gross Amount: {$response->result->purchase_units[0]->amount->currency_code} {$response->result->purchase_units[0]->amount->value}\n";

        // To print the whole response body, uncomment the following line
        // echo json_encode($response->result, JSON_PRETTY_PRINT);
    }

    public function index()
    {
        $data['title'] = 'Tienda';
        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = site_url('shop');
        if (isset($_GET['search'])) {
            if(isset($_GET['brand'])) {
                $config["total_rows"] = $this->shop_model->productCount($_GET['search'], $_GET['brand'])[0]->total;
            }else{
                $config["total_rows"] = $this->shop_model->productCount($_GET['search'])[0]->total;
            }
        } else {
            if(isset($_GET['brand'])) {
                $config["total_rows"] = $this->shop_model->productCount(false, $_GET['brand'])[0]->total;
            }else{
                $config["total_rows"] = $this->shop_model->productCount()[0]->total;
            }

        }

        $data['total'] = $config["total_rows"];

        $config["per_page"] = 20;
        $config["uri_segment"] = 2;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $data["links"] = $this->pagination->create_links();

        if (isset($_GET['search'])) {
            if(isset($_GET['brand'])){
                $data["product"] = $this->shop_model->getProductList($config["per_page"], $page, $_GET['search'], $_GET['brand']);
            }else{
                $data["product"] = $this->shop_model->getProductList($config["per_page"], $page, $_GET['search']);
            }

        } else {
            if(isset($_GET['brand'])){
                $data["product"] = $this->shop_model->getProductList($config["per_page"], $page, false,$_GET['brand'] );
            }else{
                $data["product"] = $this->shop_model->getProductList($config["per_page"], $page);
            }

        }
        $data['brand'] = $this->product_model->getBrand();
        $this->load->view('templates/public/header', $data);
        $this->load->view('shop/index', $data);
        $this->load->view('templates/public/footer', $data);
    }

    public function product()
    {
        $data['product'] = $this->shop_model->getProduct($_GET['productVariation']);
        $data['productVariation'] = $this->shop_model->getProductVariants($_GET['product']);
        $this->load->view('templates/public/header', $data);
        $this->load->view('shop/product', $data);
        $this->load->view('templates/public/footer', $data);
    }

    public function addToCart()
    {
        $this->load->library('cart');
        $data = array(
            'id' => $_GET['productVariant'],
            'qty' => $_GET['quantity'],
            'price' => $_GET['price'],
            'name' => $_GET['name'],
            'options' => array('path' => $_GET['path'])
        );
        $this->cart->insert($data);
    }

    public function cart()
    {
        $this->load->library('cart');
        $data['title'] = 'Carrito';
        $this->load->view('templates/public/header', $data);
        $this->load->view('shop/cart', $data);
        $this->load->view('templates/public/footer', $data);
    }

    public function removeFromCart()
    {
        $this->load->library('cart');
        $data = array(
            'rowid' => $_GET['rowid'],
            'qty' => 0
        );
        $this->cart->update($data);
        redirect('shop/cart');
    }

    public function braintreeTest()
    {
        $data['title'] = 'Test';
        $this->config->load('brainthree');
        $gateway = new Braintree_Gateway([
            'environment' => $this->config->item('environment'),
            'merchantId' => $this->config->item('merchantId'),
            'publicKey' => $this->config->item('publicKey'),
            'privateKey' => $this->config->item('privateKey')
        ]);


        if (isset($_POST['payment_method_nonce'])) {
            $result = $gateway->transaction()->sale([
                'amount' => '10.00',
                'paymentMethodNonce' => $this->input->post('payment_method_nonce'),
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);
            print_r($result);
        } else {
            $data['clientToken'] = $clientToken = $gateway->clientToken()->generate();
            $this->load->view('templates/public/header', $data);
            $this->load->view('shop/braintreeTest', $data);
            $this->load->view('templates/public/footer', $data);

        }

    }

    public function payPal()
    {
        $data['title'] = 'Test';
        $this->load->view('templates/public/header', $data);
        $this->load->view('shop/paypal', $data);
        $this->load->view('templates/public/footer', $data);
    }

    public function confirmation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('paypal_email', 'paypal_email', 'required');
        if ($this->form_validation->run()) {
            $data['paypal_mail'] = $this->input->post('paypal_email');
            if (isset($this->auth_level) && $this->auth_level >= 1) {
                $data['username'] = $this->auth_username;
            } else {
                $data['username'] = $this->input->post('paypal_email');
            }
            $data['auth'] = $this->input->post('auth');
            $data['city'] = $this->input->post('city');
            $data['shippingAddress1'] = $this->input->post('address1');
            $data['shippingAddress2'] = $this->input->post('address2');
            $data['zip'] = $this->input->post('zip');
            $data['name'] = $this->input->post('name');
            $data['total_amount'] = $this->input->post('total_amount');
            $id = $this->shop_model->addTransaction($data);
            $this->load->library('cart');
            foreach ($this->cart->contents() AS $item) {
                $data1['product_variant'] = $item['id'];
                $data1['quantity'] = $item['qty'];
                $data1['price'] = $item['price'];
                $data1['transaction_id'] = $id;
                $id = $this->shop_model->addTransactionDetail($data1);
            }
            $this->load->view('templates/public/header', $data);
            $this->load->view('shop/confirmation', $data);
            $this->load->view('templates/public/footer', $data);
        }else{
            show_404();
        }


    }
}