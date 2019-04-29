<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/22/19
 * Time: 6:22 PM
 */

class Product extends MY_Controller{

    public function __construct()
    {
        parent::__construct();

        // Force SSL
        //$this->force_ssl();

        // Form and URL helpers always loaded (just for convenience)
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('dashboard_model');
        $this->load->model('product_model');
        parse_str($_SERVER['QUERY_STRING'], $_GET);
        $this->is_logged_in();
    }

    public function index(){
        if($this->require_min_level(6)) {
            $this->load->library('pagination');
            $config = array();
            $config["base_url"] = site_url('product') ;
            $search = $this->input->post('sku').$this->input->post('name').$this->input->post('description').'';
            if(isset($_GET['warehouse'])) {
                $config["total_rows"] = $this->product_model->countTotalProducts($_GET['warehouse']);
            }else if($search!=''){
                $config["total_rows"] = $this->product_model->countTotalProducts(false, $search);
            }else{
                $config["total_rows"] = $this->product_model->countTotalProducts();
            }

            $config["per_page"] = 25;
            $config["uri_segment"] = 2;

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            $data["links"] = $this->pagination->create_links();

            if(isset($_GET['warehouse'])) {
                $data["product"] = $this->product_model->getProducts( $config["per_page"],  $page, $_GET['warehouse'] );
            }else if($search != ''){
                $data["product"] = $this->product_model->getProducts( $config["per_page"],  $page, false, $search );
            }else{
                $data["product"] = $this->product_model->getProducts( $config["per_page"],  $page );
            }

            $data['user'] = $this->dashboard_model->getUsers(1,0,$this->auth_username);


            $this->load->view('templates/dashboard/header');
            $this->load->view('product/index',$data);
            $this->load->view('templates/dashboard/footer');
        }
    }

    public function brand(){
        if($this->require_min_level(9)) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Nombre', 'required');
            if( $this->form_validation->run() ){
                if (!is_dir(FCPATH . 'assets/images/brand')) {
                    mkdir(FCPATH . 'assets/images/brand' );
                }
                $config['upload_path'] = FCPATH . 'assets/images/brand';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '11600000';
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload()) {
                    $error = array('error' => $this->upload->display_errors());
                    show_error($error, 500);
                } else {
                    $data['all'] = array('upload_data' => $this->upload->data());
                    $info = array('upload_data' => $this->upload->data());
                    $brand['path'] = $info['upload_data']['file_name'];
                    $brand['name'] = $this->input->post('name');
                    $brand['description'] = $this->input->post('description');
                    $this->product_model->addBrand($brand);
                    redirect('product/brand');
                }





            }else{
                $data['brand'] = $this->product_model->getBrand();
                $this->load->view('templates/dashboard/header');
                $this->load->view('product/brand',$data);
                $this->load->view('templates/dashboard/footer');
            }
        }
    }

    public function deleteBrand(){
        if($this->require_min_level(9)) {
            $this->product_model->deleteBrand($_GET['brand']);
            redirect('product/brand');
        }
    }

    public function addProduct(){
        if($this->require_min_level(9)) {
            $data['title'] = 'Agregar producto';
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Nombre', 'required');
            if( $this->form_validation->run() ){
                $product['sku'] = $this->input->post('sku');
                $product['name'] = $this->input->post('name');
                $product['min_price'] = $this->input->post('min_price');
                $product['public_price'] = $this->input->post('public_price');
                $product['brand'] = $this->input->post('brand');
                $product['description'] = $this->input->post('description');
                $product['discount'] = $this->input->post('discount');
                $product['selling'] = $this->input->post('selling');
                if($product['brand'] == 0){
                    redirect('product/addProduct?message=addProdFail');
                }
                $res= $this->product_model->addProduct($product);
                if(!$res){
                    redirect('product/addProduct?message=addProdFail');
                }else{
                    redirect('product/editProduct?product='.$res);
                }

            }else {
                $data['brand'] = $this->product_model->getBrand();
                $this->load->view('templates/dashboard/header', $data);
                $this->load->view('product/addProduct', $data);
                $this->load->view('templates/dashboard/footer');
            }
        }
    }

    public function editProduct(){
        if($this->require_min_level(9)) {
            $data['title'] = 'Agregar producto';
            $id=1;
            if(isset($_GET['product']))
                $id=$_GET['product'];
            else
                redirect('product');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Nombre', 'required');
            if( $this->form_validation->run() ){

                $product['sku'] = $this->input->post('sku');
                $product['name'] = $this->input->post('name');
                $product['min_price'] = $this->input->post('min_price');
                $product['public_price'] = $this->input->post('public_price');
                $product['brand'] = $this->input->post('brand');
                $product['description'] = $this->input->post('description');
                $product['discount'] = $this->input->post('discount');
                $product['selling'] = $this->input->post('selling');
                if($product['brand'] == 0){
                    redirect('product/addProduct?message=addProdFail');
                }
                $res = $this->product_model->editProduct($id, $product);
                if(!$res){
                    redirect('product/editProduct?message=editProdFail&product='.$_GET['product']);
                }else{
                    redirect('product?message=prodEditSuccess');
                }

            }else {
                $data['brand'] = $this->product_model->getBrand();
                $data['product'] = $this->product_model->getProduct($id, true);
                $data['brandSelected'] = $this->product_model->getBrand();
                $this->load->view('templates/dashboard/header', $data);
                $this->load->view('product/editProduct', $data);
                $this->load->view('templates/dashboard/footer');
            }
        }
    }

    public function detail(){
        if($this->require_min_level(6)) {
            if(isset($_GET['product']))
                $id=$_GET['product'];
            else
                redirect('product');
            $data['product'] = $this->product_model->getProduct($id);
            $data['brandSelected'] = $this->product_model->getBrand();
            $this->load->view('templates/dashboard/header', $data);
            $this->load->view('product/detail', $data);
            $this->load->view('templates/dashboard/footer');
        }
    }

    public function addProductVariation(){
        if($this->require_min_level(9)) {
            if(isset($_GET['product']))
                $id=$_GET['product'];
            else
                redirect('product');
            $product['name'] = $this->input->post('name');
            $product['product_id'] = $id;
            $this->product_model->addProductVariant($product);
            redirect('product/editProduct?product='.$id);
        }
    }

    public function productVariation(){
        if($this->require_min_level(9)) {
            if(isset($_GET['productVariation']))
                $id=$_GET['productVariation'];
            else
                redirect('product');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('hello', 'hello', 'required');
            if( $this->form_validation->run() ){

                if (!is_dir(FCPATH . 'assets/images/product')) {
                    mkdir(FCPATH . 'assets/images/product' );
                }
                $config['upload_path'] = FCPATH . 'assets/images/product';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '11600000';
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload()) {
                    $error = array('error' => $this->upload->display_errors());
                    show_error($error, 500);
                } else {
                    $data['all'] = array('upload_data' => $this->upload->data());
                    $info = array('upload_data' => $this->upload->data());
                    $picture['path'] = $info['upload_data']['file_name'];

                    $picture['product_variation_id'] = $id;
                    $this->product_model->addProductVariationPic($picture);
                    redirect('product/productVariation?productVariation='.$id.'&product='.$_GET['product']);
                }





            }else{
                $data['product'] = $this->product_model->getProductVariant($id);
                $this->load->view('templates/dashboard/header');
                $this->load->view('product/productVariation',$data);
                $this->load->view('templates/dashboard/footer');
            }

        }
    }

    public function deleteVariationPicture(){
        if($this->require_min_level(9)) {
            $this->product_model->deleteProductVariationPicture($_GET['productVariationPicture']);
            redirect('product/productVariation?productVariation='.$_GET['productVariation'].'&product='.$_GET['product']);
        }
    }

    public function manageStock(){
        if($this->require_min_level(9)) {
            $product_variant = false;
            $warehouse = false;
            if(isset($_GET['productVariation'])){
                $product_variant = $_GET['productVariation'];
            } if(isset($_GET['warehouse'])){
                $warehouse=$_GET['warehouse'];
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('quantity', 'quantity', 'required');
            if( $this->form_validation->run() ){
                $movement['description'] = $this->input->post('description');
                $movement['quantity'] = $this->input->post('quantity');
                $movement['product_variant_id'] = $product_variant;
                $movement['warehouse_id'] = $warehouse;
                if($this->product_model->addStockMovement($movement)){
                    redirect('product/detail?message=moveSuccess&product='.$_GET['product']);
                }else{
                    redirect('product/detail?message=moveFail&product='.$_GET['product']);
                }

            }else{
                $this->load->library('pagination');
                $config = array();
                $config["base_url"] = site_url('product/manageStock') ;

                $config["total_rows"] = $this->product_model->countMovementTotal($product_variant, $warehouse)[0]->total;


                $config["per_page"] = 25;
                $config["uri_segment"] = 2;

                $this->pagination->initialize($config);

                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

                $data["links"] = $this->pagination->create_links();
                $data['movement'] = $this->product_model->getStockMovement($product_variant, $warehouse, $config["per_page"], $page);
                $this->load->view('templates/dashboard/header');
                $this->load->view('product/manageStock',$data);
                $this->load->view('templates/dashboard/footer');
            }




        }
    }



}