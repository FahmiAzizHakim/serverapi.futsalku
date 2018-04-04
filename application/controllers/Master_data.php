<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Master_data extends REST_Controller {

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

    function data_goods_get(){
       if($this->get('company_code') == null){
            $this->response('Parameter company_code not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $company_code = $this->get('company_code');
        $data = $this->M_master->getDataWhere('company_code', $company_code, 'MST_ADMSTOREGOODS');
        $this->response($data, 200);         
    }

    function last_no_get()
    {
        $param = $this->get('data');
        $table = $this->get('table');
        $company_code = $this->get('company_code');
        $data = $this->M_master->getLastNo($param, $table, $company_code);
        $field_no = $data['data'];
        $this->response($data, 200);
    }

    function field_insert_post(){
       $param = array("field_name" => $this->post("field_name"),
                    "field_no" => $this->post("field_no"),
                    "field_room" => $this->post("field_room"),
                    "field_type" => $this->post("field_type"),
                    "field_ball" => $this->post("field_ball"),
                    "field_book_price" => $this->post("field_book_price"),
                    "activestatus" => $this->post("activestatus"),
                    "company_code" => $this->post("company_code"),
                    "created_date" => date('d/m/Y'),
                    "created_by" => $this->post("created_by"),
                    "lastupd_date" => date('d/m/Y'),
                    "lastupd_by" => $this->post("created_by"),
                    "lastupd_process" => "insert");

       $process = $this->M_master->save('MST_ADMFIELDS',$param);

       if ($process == true) {
           $return = array("status" => "success", "error" => 0);
       }else{
            $return = array("status" => "error", "error" => 0);
       }
        $this->response($return, 200);
    }

    //Masukan function selanjutnya disini
}
?>