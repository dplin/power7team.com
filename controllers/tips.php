<?php 
class Tips extends Controller{
	function __construct(){
		parent::__construct();
		// Initialize Page Variables
		$this->view->title = "Tips";
		// Initialize CSS
		$this->view->css = array(						
			'tips/css/default.css'
		);			
	}
	
	function index(){
		// Render Page
		$this->view->render('tips/index');			
	}	
}
?>