<?php

require APPPATH.'libraries/REST_Controller.php';

class Process extends REST_Controller {

	public function __construct(){

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: *');
    	header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
		header('Accept: application/json');
		header('Content-Type: application/json');

	    parent::__construct();
	    //load database
	    $this->load->database();
	    $this->load->model("api/app_model");
	    $this->load->library(array("form_validation"));
	    $this->load->helper("security");

	}

	public function index_post() {

		// default variable
		$response = [];
		$http_codes = REST_Controller::HTTP_OK;

		// call post body
		$data = json_decode(file_get_contents("php://input"));

		if (empty($data->referral_code)) {

			// empty field
			// $http_codes = REST_Controller::HTTP_NOT_FOUND;

	    	$response["status"] = 0;
	    	$response["message"] = "All fields are needed";
	    	$response["data"] = null;

		} else {

			// call query in model
			$owner = $this->app_model->get_code_owner($data->referral_code);

			if (empty($owner)) {

				// undefined referral code
				// $http_codes = REST_Controller::HTTP_NOT_FOUND;

		    	$response["status"] = 0;
		    	$response["message"] = "Code not found";
		    	$response["data"] = $owner;

			} else {

				// found referral code
				$response["status"] = 1;
		    	$response["message"] = "Code owner detail is found";
		    	$response["data"] = $owner;				

			}

		}

		// api response
		$this->response($response, $http_codes);

	}

}