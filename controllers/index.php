<?php 
class Index extends Controller{
	function __construct(){
		parent::__construct();
		// Initialize Page Variables
		$this->view->title = "Welcome to Power7Team";		
		// Initialize JavaScript
		$this->view->js = array(			
			'index/js/jquery.bxslider.min.js',
			'index/js/default.js'
		);		
		// Initialize CSS
		$this->view->css = array(
			'index/css/jquery.bxslider.css',			
			'index/css/default.css'			
		);				
	}
	
	function index(){
		// Get data
		$this->view->listings = $this->model->getRecords("listings");
		$this->view->condos = $this->model->getRecords("condos");		
		
		// Render Page
		$this->view->render('index/index');			
	}
	
	function details(){
		$this->view->render('index/index');			
	}
}
?>