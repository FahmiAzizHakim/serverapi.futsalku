<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        // $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $table = $this->get('table');
         if ($table != '') {
             $data = $this->db->get($table)->result();
         }
        $this->response($data, 200);
    }


    //Masukan function selanjutnya disini
}
?>