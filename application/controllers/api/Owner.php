<?php

require APPPATH.'libraries/REST_Controller.php';

class Owner extends REST_Controller {

	public function __construct(){

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
	    $mobile = isset($data->mobile) ? $data->mobile : "";

	    if(empty($name) && empty($email) && empty($mobile)) {

	    	// we have some empty field

	    	$http_codes = REST_Controller::HTTP_NOT_FOUND;

	    	$response["status"] = 0;
	    	$response["message"] = "All fields are needed";

	    }

	    // parameters insert
	    $owner = [
		    "name" 	 		=> $name,
	        "email"  		=> $email,
	        "mobile" 		=> $mobile,
	        "referralcode" 	=> $this->app_model->generate_code(), // get code with generate random string
	        "status" 		=> 1,
	        "created_at" 	=> date('Y-m-d H:i:s'),
	    ];

		if($this->app_model->post_code_owner($owner)){

			// insert is successed
			$response["status"] = 1;
	    	$response["message"] = "New owner code has been created";

		}else{

			// insert is failed
			$http_codes = REST_Controller::HTTP_INTERNAL_SERVER_ERROR;

			$response["status"] = 0;
	    	$response["message"] = "Failed to create new owner code";

		}

		// api response
	    $this->response($response, $http_codes);

	}

}