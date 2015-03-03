<?php 
class Aboutremax extends Controller{
	function __construct(){
		parent::__construct();
		// Initialize Page Variables
		$this->view->title = "About Remax";
		// Initialize JavaScript
		$this->view->js = array(			
			'aboutremax/js/default.js'
		);	
		// Initialize CSS
		$this->view->css = array(						
			'aboutremax/css/default.css'
		);			
	}
	
	function index(){
		// Render Page
		$this->view->render('aboutremax/index');			
	}	
}
?>