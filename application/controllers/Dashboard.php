<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Dashboard extends REST_Controller {

	function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('M_master');
    }

    function data_timebooking_get() {

    	$trx_date = $this->get('trx_date');
    	$trx_field_no = $this->get('trx_field_no');
        $data = $this->M_master->getDataView('date_booking', $trx_date, 'field_no', $trx_field_no, 'v_dsb_timebooking');
        $this->response($data, 200);

    }

}
?>