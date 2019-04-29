<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/24/19
 * Time: 8:36 PM
 */

class Shop extends MY_Controller{

    public function __construct()
    {
        parent::__construct();


        $this->load->library('braintree-php-3.40.0/lib/Braintree');
        parse_str($_SERVER['QUERY_STRING'], $_GET);
        $this->load->model('shop_model');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index(){
        $data['title'] = 'Tienda';
        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = site_url('shop') ;
        if(isset($_GET['search'])) {

            $config["total_rows"] = $this->shop_model->productCount($_GET['search'])[0]->total;
        }else {
            $config["total_rows"] = $this->shop_model->productCount()[0]->total;
        }

        $data['total']= $config["total_rows"];

        $config["per_page"] = 20;
        $config["uri_segment"] = 2;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $data["links"] = $this->pagination->create_links();

        if(isset($_GET['search'])) {
            $data["product"] = $this->shop_model->getProductList( $config["per_page"],  $page, $_GET['search'] );
        }else{
            $data["product"] = $this->shop_model->getProductList( $config["per_page"],  $page );
        }
        $this->load->view('templates/public/header', $data);
        $this->load->view('shop/index', $data);
        $this->load->view('templates/public/footer', $data);
    }

    public function product(){
        $data['product'] = $this->shop_model->getProduct($_GET['productVariation']);
        $data['productVariation']=$this->shop_model->getProductVariants($_GET['product']);
        $this->load->view('templates/public/header', $data);
        $this->load->view('shop/product', $data);
        $this->load->view('templates/public/footer', $data);
    }

    public function addToCart(){
        $this->load->library('cart');
        $data = array(
            'id' => $_GET['productVariant'],
            'qty' => $_GET['quantity'],
            'price' => $_GET['price'],
            'name' => $_GET['name'],
            'options' => array('path'=>$_GET['path'])
        );
        $this->cart->insert($data);
    }

    public function cart(){
        $this->load->library('cart');
        $data['title'] = 'Carrito';
        $this->load->view('templates/public/header', $data);
        $this->load->view('shop/cart', $data);
        $this->load->view('templates/public/footer', $data);
    }

    public function removeFromCart(){
        $this->load->library('cart');
        $data= array(
            'rowid' => $_GET['rowid'],
            'qty' => 0
        );
        $this->cart->update($data);
        redirect('shop/cart');
    }

    public function braintreeTest(){
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
        }else{
            $data['clientToken'] =$clientToken = $gateway->clientToken()->generate();
            $this->load->view('templates/public/header', $data);
            $this->load->view('shop/braintreeTest', $data);
            $this->load->view('templates/public/footer', $data);

        }

    }


}