<?php
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        // Your constructor code here
    }

    public function index_get() {
        $this->response([
            'status' => TRUE,
            'message' => 'This is a get method response'
        ], REST_Controller::HTTP_OK); // HTTP_OK is 200
    }
}
