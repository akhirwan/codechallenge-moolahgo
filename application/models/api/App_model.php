<?php

class App_model extends CI_Model {

	public function __construct(){
	    parent::__construct();
	    $this->load->database();
	}

	public function post_code_owner($data = []) {

		return $this->db->insert("tbl_referralcode", $data);

	}

	public function get_code_owner($code) {

		$this->db->select("*");
	    $this->db->from("tbl_referralcode");
	    $this->db->where('referralcode', $code);
	    $query = $this->db->get();

	    return $query->row();

	}
	
	public function put_code_owner($where = [], $data = []){
		$this->db->where($where);
		$this->db->update("tbl_referralcode", $data);
	}

	public function get_code() {

		$code = $this->generate_code();

	    // check if code exist
	    $check = $this->exist_code($result);

	    if ($check == TRUE) {

	    	$code = $this->generate_code();

	    	return $code;

	    } else {

	    	return $code;

	    }

	}

	public function generate_code() {

		// get code with generate random string

		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // uppercase & alphanumeric
	    $result = '';
	    for ($i = 0; $i < 6; $i++)
	        $result .= $characters[mt_rand(0, 35)];

	    return $result;

	}

	public function exist_code($code) {

		$this->db->select("referralcode");
	    $this->db->from("tbl_referralcode");
	    $this->db->where('referralcode', $code);
	    $query = $this->db->get();

	    if (empty($query->row())) {

	    	return FALSE;

	    } else {

			return TRUE;

	    }

	}

}