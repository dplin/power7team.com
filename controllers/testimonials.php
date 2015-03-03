<?php 
class Testimonials extends Controller{
	function __construct(){
		parent::__construct();
		// Initialize Page Variables
		$this->view->title = "Testimonials";
		// Initialize CSS
		$this->view->css = array(						
			'testimonials/css/default.css'
		);			
	}
	
	function index(){
		// Render Page
		$this->view->render('testimonials/index');			
	}	
}
?>