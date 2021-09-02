<?php

require APPPATH.'libraries/REST_Controller.php';

class Owner extends REST_Controller {

	public function __construct(){

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: *');
    	header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
		header('Accept: application/json');
		header('Content-Type: application/json; charset=utf-8');

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

		$name = isset($data->name) ? $data->name : "";
	    $email = isset($data->email) ? $data->email : "";
	    $phone = isset($data->phone) ? $data->phone : "";

	    if(empty($name) && empty($email) && empty($phone)) {

	    	// we have some empty field

	    	$http_codes = REST_Controller::HTTP_NOT_FOUND;

	    	$response["status"] = 0;
	    	$response["message"] = "All fields are needed";
	    	$response["referralcode"] = "";

	    } else {

		    // parameters insert
		    $code = $this->app_model->generate_code(); // get code with generate random string
		    $owner = [
			    "name" 	 		=> $name,
		        "email"  		=> $email,
		        "phone" 		=> $phone,
		        "referralcode" 	=> $code,
		        "status" 		=> 1,
		        "created_at" 	=> date('Y-m-d H:i:s'),
		    ];

			if($this->app_model->post_code_owner($owner)){

				// insert is successed
				$response["status"] = 1;
		    	$response["message"] = "New referral code has been created";
		    	$response["referralcode"] = $code;

			}else{

				// insert is failed
				$http_codes = REST_Controller::HTTP_INTERNAL_SERVER_ERROR;

				$response["status"] = 0;
		    	$response["message"] = "Failed to create new owner code";
		    	$response["referralcode"] = "";

			}

	    }


		// api response
	    $this->response($response, $http_codes);

	}

}