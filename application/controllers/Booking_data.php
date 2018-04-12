<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Booking_data extends REST_Controller {

	function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('M_master');
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

    function data_field_get() {
        if($this->get('company_code') == null){
            $this->response('Parameter company_code not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $company_code = $this->get('company_code');
        $data = $this->M_master->getDataWhere('company_code', $company_code, 'MST_ADMFIELDS');
        $this->response($data, 200);
    }

    function trx_insert_post(){
       $param_master = array("trx_no" => $this->post("trx_no"),
                    "trx_name" => $this->post("trx_name"),
                    "trx_date" => date('d/m/Y'),
                    "trx_id_player" => $this->post("trx_id_player"),
                    "trx_name" => $this->post("trx_name"),
                    "trx_phone_number" => $this->post("trx_phone_number"),
                    "trx_email" => $this->post("trx_email"),
                    "trx_field_no" => $this->post("trx_field_no"),
                    "trx_messages_hour" => $this->post("trx_messages_hour"),
                    "trx_of_hours" => $this->post("trx_of_hours"),
                    "trx_booking_price" => $this->post("trx_booking_price"),
                    "trx_grandtotal_price" => $this->post("trx_grandtotal_price"),
                    "activestatus" => $this->post("activestatus"),
                    "company_code" => $this->post("company_code"),
                    "created_date" => date('d/m/Y'),
                    "created_by" => $this->post("created_by"),
                    "lastupd_date" => date('d/m/Y'),
                    "lastupd_by" => $this->post("created_by"),
                    "lastupd_process" => "insert");
       $process_m = $this->M_master->save('TRX_FIELDBOOKING',$param_master);

       for ($i=1; $i <= $param_master["trx_of_hours"]; $i++) { 
        $param_detail = array("trx_no" => $this->post("trx_no"),
                    "trx_no_detail" => $this->post("trx_no")."-".$i,
                    "trx_hours_detail" => "1",
                    "trx_hours_price" => $this->post("trx_grandtotal_price")/$this->post("trx_of_hours"),
                    "activestatus" => $this->post("activestatus"),
                    "company_code" => $this->post("company_code"),
                    "created_date" => date('d/m/Y'),
                    "created_by" => $this->post("created_by"),
                    "lastupd_date" => date('d/m/Y'),
                    "lastupd_by" => $this->post("created_by"),
                    "lastupd_process" => "insert");
        $process_d = $this->M_master->save('TRX_FIELDBOOKINGDTL',$param_detail); 
       }
   

       if ($process_m == true && $process_d == true ) {
           $return = array("status" => "success", "error" => 0);
       }else{
            $return = array("status" => "error", "error" => 0);
       }
        $this->response($return, 200);
    }

    function data_booking_get() {
        if($this->get('company_code') == null){
            $this->response('Parameter company_code not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $company_code = $this->get('company_code');
        $data = $this->M_master->getDataWhere('company_code', $company_code, 'TRX_FIELDBOOKING');
        $this->response($data, 200);
    }

    function trx_void_post(){
       $param = array("activestatus" => 'ATSNA',
                    "lastupd_date" => date('d/m/Y'),
                    "lastupd_by" => $this->post("user_name"),
                    "lastupd_process" => "void");
       $param_trx = $this->post("param_no");
       $where = "trx_no";

       $process_m = $this->M_master->update($where, $param_trx ,$param, 'TRX_FIELDBOOKING');
       $process_d = $this->M_master->update($where, $param_trx ,$param, 'TRX_FIELDBOOKINGDTL');
       if ($process_m == true && $process_d == true) {
           $return = array("status" => "success", "error" => 0);
       }else{
            $return = array("status" => "error", "error" => 0);
       }
        $this->response($return, 200);
    }

    function single_booking_get() {
        if($this->get('data') == null){
            $this->response('Parameter company_code not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $data_param = $this->get('data');
        $data = $this->M_master->getDataWhere2('trx_no', $data_param, 'TRX_FIELDBOOKING');
        $this->response($data, 200);
    }

    function trx_update_post(){
       $param_master = array("trx_no" => $this->post("trx_no"),
                    "trx_name" => $this->post("trx_name"),
                    "trx_date" => date('d/m/Y'),
                    "trx_id_player" => $this->post("trx_id_player"),
                    "trx_name" => $this->post("trx_name"),
                    "trx_phone_number" => $this->post("trx_phone_number"),
                    "trx_email" => $this->post("trx_email"),
                    "trx_field_no" => $this->post("trx_field_no"),
                    "trx_messages_hour" => $this->post("trx_messages_hour"),
                    "trx_of_hours" => $this->post("trx_of_hours"),
                    "trx_booking_price" => $this->post("trx_booking_price"),
                    "trx_grandtotal_price" => $this->post("trx_grandtotal_price"),
                    "activestatus" => $this->post("activestatus"),
                    "company_code" => $this->post("company_code"),
                    "created_date" => date('d/m/Y'),
                    "created_by" => $this->post("created_by"),
                    "lastupd_date" => date('d/m/Y'),
                    "lastupd_by" => $this->post("created_by"),
                    "lastupd_process" => "insert");

       $process_del_m = $this->M_master->del($param_master["trx_no"],'trx_no','TRX_FIELDBOOKING');
       $process_del_d = $this->M_master->del($param_master["trx_no"],'trx_no','TRX_FIELDBOOKINGDTL');
       $process_m = $this->M_master->save('TRX_FIELDBOOKING',$param_master);

       for ($i=1; $i <= $param_master["trx_of_hours"]; $i++) { 
        $param_detail = array("trx_no" => $this->post("trx_no"),
                    "trx_no_detail" => $this->post("trx_no")."-".$i,
                    "trx_hours_detail" => "1",
                    "trx_hours_price" => $this->post("trx_grandtotal_price")/$this->post("trx_of_hours"),
                    "activestatus" => $this->post("activestatus"),
                    "company_code" => $this->post("company_code"),
                    "created_date" => date('d/m/Y'),
                    "created_by" => $this->post("created_by"),
                    "lastupd_date" => date('d/m/Y'),
                    "lastupd_by" => $this->post("created_by"),
                    "lastupd_process" => "insert");
        $process_d = $this->M_master->save('TRX_FIELDBOOKINGDTL',$param_detail); 
       }
   

       if ($process_m == true && $process_d == true ) {
           $return = array("status" => "success", "error" => 0);
       }else{
            $return = array("status" => "error", "error" => 0);
       }
        $this->response($return, 200);
    }
 

}
?>