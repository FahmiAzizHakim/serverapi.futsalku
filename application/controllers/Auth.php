<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('M_auth');
    }

    function check_user_post() {
     $username = $this->post('username');
     $password = $this->post('password');

    $cek = $this->M_auth->cek_user($username, $password)->num_rows();
    $get = $this->M_auth->cek_user($username, $password)->result();

    if($cek < 1 || $cek == ""){
    	$return = Array("status" => "failed", "error" => "Username or Password incorect");
    }else{
    	$return = Array("status" => "success", "error" => "", "data" => $get);
    }
    $this->response($return, 200);

    }


}