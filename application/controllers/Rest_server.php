<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';


class Rest_server extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
        $this->load->helper('url');

        $this->load->view('rest_server');
    }
}
