<?php 
class Meetourteam extends Controller{
	function __construct(){
		parent::__construct();
		// Initialize Page Variables
		$this->view->title = "Meet Our Team";
		// Initialize CSS
		$this->view->css = array(						
			'meetourteam/css/default.css'
		);			
	}
	
	function index(){
		// Render Page
		$this->view->render('meetourteam/index');			
	}	
}
?>