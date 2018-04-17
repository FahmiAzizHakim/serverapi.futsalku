<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Master_data extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('M_master');
    }

     function index_get() {
         $table = $this->get('table');
         if ($table != '') {
             $data = $this->db->get($table)->result();
         }
         $this->response($data, 200);
     }
 
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

    function single_field_get(){
        $company_code = $this->get('company_code');
        $id = $this->get('id');
       if($company_code == null){
            $this->response('Parameter company_code not found', REST_Controller::HTTP_NOT_FOUND);
        }
        if($id == null){
            $this->response('Parameter id not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $data = $this->M_master->single_data_get($company_code, "field_id", $id, 'MST_ADMFIELDS');
        $this->response($data, 200);         
    }

    function single_user_get(){
        $company_code = $this->get('company_code');
        $id = $this->get('id');
       if($company_code == null){
            $this->response('Parameter company_code not found', REST_Controller::HTTP_NOT_FOUND);
        }
        if($id == null){
            $this->response('Parameter id not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $data = $this->M_master->single_data_get($company_code, "user_id", $id, 'MST_ADMUSER');
        $this->response($data, 200);         
    }

    function single_goods_get(){
        $company_code = $this->get('company_code');
        $id = $this->get('id');
       if($company_code == null){
            $this->response('Parameter company_code not found', REST_Controller::HTTP_NOT_FOUND);
        }
        if($id == null){
            $this->response('Parameter id not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $data = $this->M_master->single_data_get($company_code, "store_goods_id", $id, 'MST_ADMSTOREGOODS');
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
    }    //Masukan function selanjutnya disini

    function field_insert_user_post(){
       $param = array("user_code" => $this->post("field_code"),
                    "user_name" => $this->post("field_name"),
                    "user_password" => md5(substr(sha1($this->post("field_password") . 'reds'),1,20)),
                    "user_group" => $this->post("field_role"),
                    "company_code" => $this->post("company_code"),
                    "activestatus" => $this->post("activestatus"),
                    "created_date" => date('d/m/Y'),
                    "created_by" => $this->post("created_by"),
                    "lastupd_date" => date('d/m/Y'),
                    "lastupd_by" => $this->post("created_by"),
                    "lastupd_process" => "insert");

       $process = $this->M_master->save('MST_ADMUSER',$param);

       if ($process == true) {
           $return = array("status" => "success", "error" => 0);
       }else{
            $return = array("status" => "error", "error" => 0);
       }
        $this->response($return, 200);
    }

    function field_update_user_post(){
       $param = array("user_password" => md5(substr(sha1($this->post("field_password") . 'reds'),1,20)),
                    "user_group" => $this->post("field_role"),
                    "company_code" => $this->post("company_code"),
                    "activestatus" => $this->post("activestatus"),
                    "lastupd_date" => date('d/m/Y'),
                    "lastupd_by" => $this->post("lastupd_by"),
                    "lastupd_process" => "update");
       $user_id = $this->post("user_id");
       $where = "user_id";

       $process = $this->M_master->update($where, $user_id ,$param, 'MST_ADMUSER');

       if ($process == true) {
           $return = array("status" => "success", "error" => 0);
       }else{
            $return = array("status" => "error", "error" => 0);
       }
        $this->response($return, 200);
    }

    function field_insert_goods_post(){
       $param = array("store_goods_code" => $this->post("field_code"),
                    "store_goods_name" => $this->post("field_name"),
                    "store_goods_type" => $this->post("field_type"),
                    "store_goods_desc" => $this->post("field_desc"),
                    "company_code" => $this->post("company_code"),
                    "store_goods_price" => $this->post("field_price"),
                    "activestatus" => $this->post("activestatus"),
                    "created_date" => date('d/m/Y'),
                    "created_by" => $this->post("created_by"),
                    "lastupd_date" => date('d/m/Y'),
                    "lastupd_by" => $this->post("created_by"),
                    "lastupd_process" => "insert");

       $process = $this->M_master->save('MST_ADMSTOREGOODS',$param);

       if ($process == true) {
           $return = array("status" => "success", "error" => 0);
       }else{
            $return = array("status" => "error", "error" => 0);
       }
        $this->response($return, 200);
    }

    function field_update_goods_post(){
       $param = array("store_goods_code" => $this->post("field_code"),
                    "store_goods_name" => $this->post("field_name"),
                    "store_goods_type" => $this->post("field_type"),
                    "store_goods_desc" => $this->post("field_desc"),
                    "company_code" => $this->post("company_code"),
                    "store_goods_price" => $this->post("field_price"),
                    "activestatus" => $this->post("activestatus"),
                    "created_date" => date('d/m/Y'),
                    "created_by" => $this->post("created_by"),
                    "lastupd_date" => date('d/m/Y'),
                    "lastupd_by" => $this->post("lastupd_by"),
                    "lastupd_process" => "update");
       $store_goods_id = $this->post("store_goods_id");
       $where = "store_goods_id";

       $process = $this->M_master->update($where, $store_goods_id ,$param, 'MST_ADMSTOREGOODS');

       if ($process == true) {
           $return = array("status" => "success", "error" => 0);
       }else{
            $return = array("status" => "error", "error" => 0);
       }
        $this->response($return, 200);
    }

    function field_update_maindata_post(){
        $param = $this->post("futsal_id");
        $data = array("company_code" => $this->post("company_code"),
                    "company_name" => $this->post("futsal_name"),
                    "company_owner" => $this->post("futsal_owner"),
                    "company_districtcode" => $this->post("futsal_place"),
                    "company_address" => $this->post("futsal_address"),
                    "company_email" => $this->post("futsal_email"),
                    "company_phone1" => $this->post("futsal_phone1"),
                    "company_phone2" => $this->post("futsal_phone2"),
                    "company_open_hour" => $this->post("company_open_hour"),
                    "company_close_hour" => $this->post("company_close_hour"),
                    "lastupd_date" => date('d/m/Y'),
                    "lastupd_by" => $this->post("created_by"),
                    "lastupd_process" => "update");

       $process = $this->M_master->update('company_id', $param , $data, 'MST_ADMCOMPANY');

       if ($process == true) {
           $return = array("status" => "success", "error" => 0);
       }else{
            $return = array("status" => "error", "error" => 0);
       }
        $this->response($return, 200); 
    }

    function field_update_post(){
       $param = array("field_name" => $this->post("field_name"),
                    "field_room" => $this->post("field_room"),
                    "field_type" => $this->post("field_type"),
                    "field_ball" => $this->post("field_ball"),
                    "field_book_price" => $this->post("field_book_price"),
                    "activestatus" => $this->post("activestatus"),
                    "lastupd_date" => date('d/m/Y'),
                    "lastupd_by" => $this->post("created_by"),
                    "lastupd_process" => "update");
       $user_id = $this->post("field_no");
       $where = "field_id";

       $process = $this->M_master->update($where, $user_id ,$param, 'MST_ADMFIELDS');

       if ($process == true) {
           $return = array("status" => "success", "error" => 0);
       }else{
            $return = array("status" => "error", "error" => 0);
       }
        $this->response($return, 200);
    }
    
}
?>