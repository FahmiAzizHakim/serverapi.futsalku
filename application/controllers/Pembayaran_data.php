<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Pembayaran_data extends REST_Controller {

	function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('M_master');
    }

    public function data_mbooking_post()
    {
        if($this->post('param_no') == null){
            $this->response('Parameter param_no not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $param_no = $this->post('param_no');
        $data = $this->M_master->getDataWhere2('trx_no', $param_no, 'TRX_FIELDBOOKING');
        $this->response($data, 200);         
    }

    function data_dbooking_post()
    {
       if($this->post('param_no') == null){
            $this->response('Parameter param_no not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $param_no = $this->post('param_no');
        $data = $this->M_master->getDataWhere('trx_no', $param_no, 'TRX_FIELDBOOKINGDTL');
        $this->response($data, 200);         
    }

    // function insert_data_post()
    // {
    //    if($this->post('param_no') == null){
    //         $this->response('Parameter param_no not found', REST_Controller::HTTP_NOT_FOUND);
    //     }
    //     $param_no = $this->post('param_no');
    //     $data = $this->M_master->getDataWhere('trx_no', $param_no, 'TRX_FIELDBOOKINGDTL');
    //     $this->response($data, 200);         
    // }

}
?>