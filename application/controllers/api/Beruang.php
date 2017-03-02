<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */

Class Beruang extends REST_Controller {

	public function __construct()
	{
		//Construc parent class
		parent::__construct();

		// Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        
		$this->methods['beruang_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['beruang_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['beruang_delete']['limit'] = 50; // 50 requests per hour per user/key

	}

	public function beruangs_get()

	{
		$beruangs = [
			['id' => 1, 'name' => 'Polar', 'email' => 'polar@example.com', 'fact' => 'Loves coding'],
            ['id' => 2, 'name' => 'Grizzlies', 'email' => 'Grizzlies@example.com', 'fact' => 'Developed on CodeIgniter'],
            ['id' => 3, 'name' => 'Honey', 'email' => 'honey@example.com', 'fact' => 'Lives in the USA', ['hobbies' => ['honey', 'cycling']]],

		];

		$id = $this->get('id');

		// if the id parameter doesn't exist return all the beruangs
		
		if ($id === NULL)
		{
            // Check if the beruangs data store contains users (in case the database result returns NULL)
            if ($beruangs)
            {
            	// set the response and exit
            	$this->response($beruangs, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
            	// Set the response and exit
            	$this->response([
            		'status' => FALSE,
            		'error' => 'No beruangs were found'
            		], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
		}

		// find and return a single record for a particular beruang.
		
		$id = (int) $id;

		// validate the id.
		if ($id <= 0)
		{
			//invalid id, set the response and exit.
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
		}

		// get the user from the array, using th id as key for retrieval.
		//  usually a model is to be used for this.
		
		$beruang = NULL;

		if (!empty($beruangs))
		{
			foreach ($beruangs as $key => $value)
			{
				if (isset($value['id']) && $value['id'] === $id)
				{
					$beruang = $value;
				}
			}
		}

		if (!empty($beruang))
		{
			$this->set_response($beruang, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			$this->set_response([
				'status' => FALSE,
				'error'  => 'Beruang could not be found'
				], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}


	}



}