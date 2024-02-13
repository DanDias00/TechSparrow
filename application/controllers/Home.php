<?php
class Home extends CI_Controller{


public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
       
}
    public function view($page = 'home')
{
        if ( ! file_exists(APPPATH.'views/'.$page.'.php'))
        {
                
                show_404();
        }

        $this->load->view('templates/header');
        $this->load->view($page);
        $this->load->view('templates/footer');
}


}
?>