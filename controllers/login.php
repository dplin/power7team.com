<?php
class Login extends Controller{
	function __construct(){
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		$access = Session::get('access');
		
		if ($logged == true) {			
			if ($access == 0){			
				header('location: ' . URL .  'admin');
			}
			exit;
		}
		
		// Initialize Page Variables
		$this->view->title = "Login";	
		// Initialize JavaScript
		$this->view->js = array(						
			'login/js/jquery.color.min.js',	
			'login/js/jquery.validate.min.js',	
			'login/js/additional-methods.min.js',		
			'login/js/jquery-impromptu.js',
			'login/js/default.js'
		);				
		// Initialize CSS
		$this->view->css = array(			
			'login/css/themes/base.css',			
			'login/css/pure-min.css',					
			'login/css/default.css'
		);			
	}	
	function index(){
		// Render Page											
		$this->view->render('login/index');	
	}	
	function login(){		
		echo $this->model->login();
	}	
	function register(){		
		echo $this->model->register();		
	}	
	function pwdrecovery(){
		echo $this->model->pwdrecovery();		
	}
	function checkEmail(){
		echo $this->model->checkEmail();
	}
	function checkPassword(){
		echo $this->model->checkPassword();
	}
	function captcha(){		
		Session::init();		
		if ($_SESSION['answer'] == $_POST['answer'] )
					echo 'true';
			else
					echo 'false';
	}	
}
?>