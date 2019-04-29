<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/17/19
 * Time: 4:50 PM
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Force SSL
        //$this->force_ssl();

        // Form and URL helpers always loaded (just for convenience)

        $this->load->model('shop_model');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index(){
        $data['container'] = false;
        $data['title']='Inicio';
        $data['product'] = $this->shop_model->getProductList(10);
        $this->load->view('templates/public/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/public/footer', $data);
    }



}