<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Global_Api extends REST_Controller {

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

    function data_company_get(){
       if($this->get('company_code') == null){
            $this->response('Parameter company_code not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $company_code = $this->get('company_code');
        $data = $this->M_master->getDataWhere2('company_code', $company_code, 'mst_admcompany');
        $this->response($data, 200);         
    }

    function data_timebooking_get(){
       if($this->get('company_code') == null){
            $this->response('Parameter company_code not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $company_code = $this->get('company_code');
        $data = $this->M_master->getDataWhere('company_code', $company_code, 'mst_time');
        $this->response($data, 200);         
    }

    function data_district_get(){
       if($this->get('company_districtcode') == null){
            $this->response('Parameter company_districtcode not found', REST_Controller::HTTP_NOT_FOUND);
        }
        $company_districtcode = $this->get('company_districtcode');
        $data = $this->M_master->getDataWhere2('district_code', $company_districtcode, 'glb_geodistricts');
        $this->response($data, 200);         
    }

}
?>