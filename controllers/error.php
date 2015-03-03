<?php
class Error extends Controller{
	function __construct(){
		parent::__construct();
	}

	function index(){
		// Initialize Page Variables
		$this->view->title = "You have an error";		
		// Render Page
		$this->view->render('error/index');
	}	
}
?>