<?php 
class Aboutontario extends Controller{
	function __construct(){
		parent::__construct();
		// Initialize Page Variables
		$this->view->title = "About Ontario";
		// Initialize CSS
		$this->view->css = array(						
			'aboutontario/css/default.css'
		);			
	}
	
	function index(){
		// Render Page
		$this->view->render('aboutontario/index');			
	}	
}
?>