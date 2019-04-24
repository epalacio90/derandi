<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/22/19
 * Time: 6:24 PM
 */

class Warehouse extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        // Force SSL
        //$this->force_ssl();

        // Form and URL helpers always loaded (just for convenience)
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('warehouse_model');
        parse_str($_SERVER['QUERY_STRING'], $_GET);
        $this->is_logged_in();
    }


    /**
     * Show all the warehouses
     *
     */
    public function index(){
        if($this->require_min_level(6)) {
            $data['title'] = 'Almacenes';
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Nombre', 'required|is_unique[users.email]');
            if ($this->form_validation->run()) {
                $warehouse['name'] = $this->input->post('name');
                $this->warehouse_model->addWarehouse($warehouse);
                redirect('warehouse');
            } else {
                $data['warehouse'] = $this->warehouse_model->getAllWarehouse();
                $this->load->view('templates/dashboard/header', $data);
                $this->load->view('warehouse/index');
                $this->load->view('templates/dashboard/footer', $data);
            }
        }
    }

}