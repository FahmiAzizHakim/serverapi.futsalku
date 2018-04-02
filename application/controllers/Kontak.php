<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('M_master');
    }

    // function index_get() {
    //     $table = $this->get('table');
    //     if ($table != '') {
    //         $data = $this->db->get($table)->result();
    //     }
    //     $this->response($data, 200);
    // }
 
    function data_field_get() {
        if($this->get('company_code') == null){
            $this->response('Parameter company_code not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $company_code = $this->get('company_code');
        $data = $this->M_master->getDataWhere('company_code', $company_code, 'MST_ADMFIELDS');
        $this->response($data, 200);
    }

    function data_members_get() {
        if($this->get('company_code') == null){
            $this->response('Parameter company_code not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $company_code = $this->get('company_code');
        $data = $this->M_master->getDataWhere('company_code', $company_code, 'MST_ADMMEMBERS');
        $this->response($data, 200);
    }

    function data_users_get() {
        if($this->get('company_code') == null){
            $this->response('Parameter company_code not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $company_code = $this->get('company_code');
        $data = $this->M_master->getDataWhere('company_code', $company_code, 'MST_ADMUSER');
        $this->response($data, 200);
    }

    function code_bycategory_get() {
        if($this->get('code_category') == null){
            $this->response('Parameter code_category not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $code_category = $this->get('code_category');
        $data = $this->M_master->getCodebyCategory($code_category);
        $this->response($data, 200);
    }

    //Masukan function selanjutnya disini
}
?>