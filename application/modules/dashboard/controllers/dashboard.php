<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class dashboard extends MY_Controller {	

	function __construct() {

		parent::__construct();		
	}

	public function index() {
		
		$this->load->view('dashboard_template');
	}
	public function footer() {
		
		$this->load->view('footer_v');
	}

	public function dashboard_view(){
		$this->load->view("dashboard_v");
	}

	public function dashboard_item(){

		$this->load->view("dashboard_item_v");
	}

	public function dashboard_item_singular(){

		$this->load->view("dashboard_item_singular_v");
	}

	public function dashboard_summary(){

		$this->load->view("dashboard_summary_v");
	}

	public function testing_trends(){
		echo "testing Trends";
	}
	public function devices(){
		echo "devices";
	}
	public function map(){
		echo "map";
	}
	public function fcdrr_reporting(){
		echo "fcdrr";
	}
}
