<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require_once APPPATH . '/libraries/REST_Controller.php';


class Mahasiswa extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Mahasiswa_model');

	}

	//get all mahasiswa
	public function index_get()
	{

		$data = $this->Mahasiswa_model->data_mahasiswa();

		if (!is_null($data)) {
			$this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			$this->set_response([
				'status' => 'FALSE',
				'message'=> 'data mahasiswa kosong gan!'
			], REST_Controller::HTTP_NOT_FOUND);
		}

	}

	public function find_get()
	{



	}

	public function 




}