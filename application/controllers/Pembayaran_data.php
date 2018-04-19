<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Pembayaran_data extends REST_Controller {

	function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('M_master');
    }

    public function data_mbooking_post($param_no)
    {
        if($param_no == null){
            $this->response('Parameter param_no not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $param_no = $param_no;
        $data = $this->M_master->getDataWhere2('trx_no', $param_no, 'TRX_FIELDBOOKING');
       	return $data;
    }

    function data_dbooking_post($param_no)
    {
       if($param_no == null){
            $this->response('Parameter param_no not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $param_no = $param_no;
        $data = $this->M_master->getDataWhere('trx_no', $param_no, 'TRX_FIELDBOOKINGDTL');
        return $data;         
    }

    function insert_data_post()
    {
       	if($this->post('param_no') == null){
         $this->response('Parameter param_no not found', REST_Controller::HTTP_NOT_FOUND);
   	     }
   	    $param_no = $this->post('param_no');
   	    $fin_no = $this->post('fin_no');
   	    $user_name = $this->post('user_name');
   	   	$get_dmbooking = $this->data_mbooking_post($param_no);
   	   	$param_master = array("fin_no" => $fin_no,
                    "fin_trxno" => $param_no,
                    "fin_trxtype" => 'TYPPYB',
                    "fin_qty" => $get_dmbooking['trx_of_hours'],
                    "fin_price" => $get_dmbooking['trx_grandtotal_price'],
                    "activestatus" => 'ATSAC',
                    "company_code" => $get_dmbooking['company_code'],
                    "created_date" => date('d/m/Y'),
                    "created_by" => $user_name,
                    "lastupd_date" => date('d/m/Y'),
                    "lastupd_by" => $user_name,
                    "lastupd_process" => "insert");
        // print_r($param_master);
       	$process_m = $this->M_master->save('FIN_HISTORY',$param_master);

        $get_ddbooking = $this->data_dbooking_post($param_no);
        $get_ddbooking = json_decode( json_encode($get_ddbooking), true);
         // print_r($get_ddbooking);die;
        for ($i=0; $i < $get_dmbooking["trx_of_hours"]; $i++) {
        $ii = $i+1;
        $ins_detail = array("fin_no" => $fin_no,
                    "fin_no_dtl" => $fin_no.'-'.$ii,
                    "fin_qty_dtl" => $get_ddbooking[$i]['trx_hours_detail'],
                    "fin_price_dtl" => $get_ddbooking[$i]['trx_hours_price'],
                    "activestatus" => 'ATSAC',
                    "company_code" => $get_ddbooking[$i]['company_code'],
                    "created_date" => date('d/m/Y'),
                    "created_by" => $user_name,
                    "lastupd_date" => date('d/m/Y'),
                    "lastupd_by" => $user_name,
                    "lastupd_process" => "insert");
        // print_r($ins_detail);
        $process_d = $this->M_master->save('FIN_HISTORYDTL',$ins_detail);
        }
   	   	if ($process_m == true) {
           $return = array("status" => "success", "error" => 0);
       	}else{
            $return = array("status" => "error", "error" => 0);
       	}
   	   	$this->response($return, 200);    
    }

}
?>