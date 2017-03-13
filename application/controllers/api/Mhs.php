<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require_once APPPATH . '/libraries/REST_Controller.php';


class Mhs extends REST_Controller
{

	/*public function __construct($config = 'rest')
	{
		parent::__construct($config);
	}*/


	public function __construct()
	{
		parent::__construct();
	}

	//show data mahasiswa
	public function index_get()
	{
		
		$nim = $this->get('nim');
		if ($nim = '') {
			$mahasiswa = $this->db-get('mahasiswa')->result();
		} else {
			$this->db->where('nim', $nim);
			$mahasiswa = $this->db->get('mahasiswa')->result(); 
		}

		$this->response($mahasiswa, 200);

	}

	public function index_post()
	{

		$data = array(
			'nim'		 => $this->post('nim'),
			'nama'		 => $this->post('nama'),
			'id_jurusan' => $this->post('id_jurusan'),
			'alamat'	 => $this->post('alamat')
		);

		$insert = $this->db->insert('mahasiswa', $data);

		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'failed', 502));
		}
	}

	public function index_update()
	{

		$nim = $this->put('nim');

		$data = array(
			'nim'		 => $this->put('nim'),
			'nama'		 => $this->put('nama'),
			'id_jurusan' => $this->put('id_jurusan'),
			'alamat'	 => $this->put('alamat')
		);

		$this->db->where('nim', $nim);
		$update = $this->db->update('mahasiswa', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'failed', 502 ));
		}

	}

	public function index_delete()
	{
		$nim = $this->delete('nim');
		$this->db->where('nim', $nim);
		$delete = $this->db->delete('mahasiswa');
		if ($delete){
			$this->response(array('status' => 'success', 201));
		} else {
			$this->response(array('status' => 'failed', 502));
		}

	}


}