<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/21/19
 * Time: 6:52 PM
 */

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Force SSL
        //$this->force_ssl();

        // Form and URL helpers always loaded (just for convenience)
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('dashboard_model');
        $this->load->model('warehouse_model');
        parse_str($_SERVER['QUERY_STRING'], $_GET);
        $this->is_logged_in();
    }

    public function index(){
        if($this->require_min_level(1)) {
            $this->load->library('pagination');
            $config = array();
            $config["base_url"] = site_url('dashboard') ;
            if($this->auth_level == 9){
                $config["total_rows"] = $this->dashboard_model->getTransactionCount();
            }else{

                $config["total_rows"] = $this->dashboard_model->getTransactionCount($this->auth_username)[0]['count(id)'];

            }


            $config["per_page"] = 10;
            $config["uri_segment"] = 2;

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            $data["links"] = $this->pagination->create_links();

            if($this->auth_level == 9){
                $data['transactions'] = $this->dashboard_model->getAllTransactions($config["per_page"], $page);
            }else{

                $data['transactions'] = $this->dashboard_model->getAllTransactions($config["per_page"], $page, $this->auth_username);
            }


            $this->load->view('templates/dashboard/header');
            $this->load->view('dashboard/index',$data);
            $this->load->view('templates/dashboard/footer');
        }
    }

    public function login(){



        $data['title']='Iniciar sesión';
        if(!$this->require_min_level(1)) {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post')
                $this->require_min_level(1);

            $this->setup_login_form();
            if (isset($this->session->user_created)){
                $data['created'] = true;
            }
            $data['title'] = 'Login';

            $this->load->view('templates/public/header', $data);
            $this->load->view('dashboard/login', $data);
            $this->load->view('templates/public/footer', $data);
        }else{
            redirect( 'dashboard');
        }

    }

    public function changePass(){ //TODO: agregar validación en back de que pass y pass1 sean iguales
        $data['title']='Cambiar contraseña';
        if($this->require_min_level(1)) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('pass1', 'Password', 'required');
            if( $this->form_validation->run() ){
                $user['passwd'] = $this->authentication->hash_passwd($this->input->post('pass'));
                if($this->dashboard_model->updateUser($this->input->post('email'), $user)){
                    redirect('dashboard?message=passChanged');
                }else{

                }
            }else{
                $this->load->view('templates/dashboard/header', $data);
                $this->load->view('dashboard/changePass', $data);
                $this->load->view('templates/dashboard/footer', $data);
            }
        }
    }

    public function logout(){
        if($this->require_min_level(1)) {
            $this->authentication->logout();

            // Set redirect protocol
            $redirect_protocol = USE_SSL ? 'https' : NULL;


            redirect(site_url());
        }

    }

    public function create_public_user(){
        $data['title'] = 'Crear usuario';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
        $pass = $this->input->post('pass1');
        if( $this->form_validation->run() ){
            $user['name'] = $this->input->post('name');
            $user['last_name'] = $this->input->post('last_name');
            $user['username'] = $this->input->post('email');
            $user['passwd'] = $this->authentication->hash_passwd($pass);
            $user['auth_level'] = 1;
            $user['email']=$this->input->post('email');
            $user['user_id']    = $this->dashboard_model->get_unused_id();
            $user['created_at'] = date('Y-m-d H:i:s');
            $this->dashboard_model->create_user($user);

            redirect('dashboard/login');
        }else{
            $this->load->view('templates/public/header', $data);
            $this->load->view('dashboard/create_public_user', $data);
            $this->load->view('templates/public/footer', $data);
        }
    }



    public function recoverPass(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $data['title'] = 'Recuperar Contraseña';
        if( $this->form_validation->run() ){
            $pass = $this->get_random_password();
            $user['passwd'] = $this->authentication->hash_passwd($pass);
            if($this->dashboard_model->updateUser($this->input->post('email'), $user)){
                $this->load->library('email');

                $this->email->from('no_reply@d-erandi.com.mx', 'Admon D-erandi');
                $this->email->to($this->input->post('email'));


                $this->email->subject('Recuperación de contraseña');
                $this->email->message('Su nueva contraseña es: ' . $pass);

                $this->email->send();
            }
            redirect('dashboard/login?message=passRecovery');

        }else{
            $this->load->view('templates/public/header', $data);
            $this->load->view('dashboard/recoverPass', $data);
            $this->load->view('templates/public/footer', $data);
        }
    }

    function get_random_password($chars_min=8, $chars_max=10, $use_upper_case=true, $include_numbers=true, $include_special_chars=false){
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@\"#$%&[]{}?|";
        }

        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];
            $password .=  $current_letter;
        }

        return $password;
    }

    public function transaction(){
        if($this->require_min_level(1)) {
            $transaction = $_GET['transaction'];
            if($this->auth_level == 9){
                $data['transaction'] = $this->dashboard_model->getTransaction($transaction);
                $data['transaction_detail'] = $this->dashboard_model->getTransactionDetail($transaction);
                $data['warehouse']=$this->warehouse_model->getAllWarehouse();
            }else{
                $data['transaction'] = $this->dashboard_model->getTransaction($transaction, $this->auth_username);
                $data['transaction_detail'] = $this->dashboard_model->getTransactionDetail($transaction, $this->auth_username);
            }
            $this->load->view('templates/dashboard/header', $data);
            $this->load->view('dashboard/transaction', $data);
            $this->load->view('templates/dashboard/footer', $data);
        }
    }

    public function sendTransaction(){
        if($this->require_min_level(9)) {
            $data['warehouse_id'] = $this->input->post('warehouse');
            $data['sent'] = 1;
            $this->dashboard_model->updateTransaction($this->input->post('transaction_id'), $data);
            redirect('dashboard/transaction?transaction='.$this->input->post('transaction_id'));

        }
    }



}