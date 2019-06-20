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
        parse_str($_SERVER['QUERY_STRING'], $_GET);
    }

    public function index(){
        $data['container'] = false;
        $data['title']='Inicio';
        $data['product'] = $this->shop_model->getProductList(30);
        $this->load->view('templates/public/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/public/footer', $data);
    }

    public function about(){
        $data['title']='Acerca';
        $this->load->view('templates/public/header', $data);
        $this->load->view('home/about', $data);
        $this->load->view('templates/public/footer', $data);
    }

    public function privacy(){
        $data['title']='Aviso de privacidad - términos y condiciones';
        $this->load->view('templates/public/header', $data);
        $this->load->view('home/privacy', $data);
        $this->load->view('templates/public/footer', $data);
    }

    public function contact(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', 'Teléfono', 'required');
        $this->form_validation->set_rules('name', 'Nombre', 'required');
        $data['title'] = 'Recuperar Contraseña';
        if( $this->form_validation->run() ){
            //$pass = $this->get_random_password();
            //$user['passwd'] = $this->authentication->hash_passwd($pass);
            //if($this->home_model->updateUser($this->input->post('email'), $user)){
                $this->load->library('email');

                $this->email->from('no_reply@d-erandi.com.mx', 'Admon D-erandi');
                $this->email->to('ricardo@d-erandi.com.mx');
                //$this->email->to('edparey@gmail.com');


                $this->email->subject('Nueva solicitud de información');
                $this->email->message('La persona <b>' . $this->input->post('name') . ' '. $this->input->post('last_name') . '</b> Está solicitando información para venta mayoreo o distribuidor. Los datos de contacto son: <br>
                Email: '. $this->input->post('email').
                    ' <br>Teléfono: '. $this->input->post('phone').
                    ' <br>Dirección: '. $this->input->post('address')


                );

                $this->email->send();

            redirect('home/contact?message=success');

        }else{
            $this->load->view('templates/public/header', $data);
            $this->load->view('home/contact', $data);
            $this->load->view('templates/public/footer', $data);
        }
    }



}