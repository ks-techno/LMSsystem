<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Enroll extends Admin_Controller {
/*
| -----------------------------------------------------
| PRODUCT NAME: 	INILABS SCHOOL MANAGEMENT SYSTEM
| -----------------------------------------------------
| AUTHOR:			INILABS TEAM
| -----------------------------------------------------
| EMAIL:			info@inilabs.net
| -----------------------------------------------------
| COPYRIGHT:		RESERVED BY INILABS IT
| -----------------------------------------------------
| WEBSITE:			http://inilabs.net
| -----------------------------------------------------
*/
	public function index(){
		// echo 'Enroll me';
		// exit();
		$this->data["subview"] = "enroll/index";
        $this->load->view('_layout_main', $this->data);
	}	
}