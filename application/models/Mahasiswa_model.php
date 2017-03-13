<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Mahasiswa_model extends CI_Model
{

	public function data_mahasiswa()
	{
		$query = $this->db->get('mahasiswa');
		return $query->result_array();
	}


}