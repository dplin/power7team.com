<?php
class Admin extends Controller{
	function __construct(){
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		$access = Session::get('access');
		if ($logged == false || ($logged == true && $access != 0)) {			
			header('location: ' . URL .  'login');
			exit;
		}
		// Initialize CSS
		$this->view->css = array(			
			'admin/css/pure-min.css',
			'admin/css/zebra.css',
			'admin/css/metallic.css',
			'admin/css/chosen.css',
			'admin/css/themes/base.css',					
			'admin/css/default.css'
		);
		
		// Initialize Page Variables
		$this->view->title = "Admin";		
	}
	function logout()
	{
		Session::destroy();
		header('location: ' . URL .  'login');
		exit;
	}
	/****************************  Page Rendering *****************************/
	function index(){
		$this->view->page = "";
		
		// Render Page	
		$this->view->render('admin/index');	
	}
	function listings($action=null){
		$file = 'views/admin/listings.php';		
		if (file_exists($file)){
			
			if (isset($action)){			
				if ($action == 'new'){
					// Set title
					$this->view->title = 'Admin - New Listing';
					// Set Flag
					$this->view->newListing = true;
				}elseif (ctype_digit($action)){
					// Load Listing Data
					$this->view->listing = $this->model->getListing($action);
					// Load Gallery Images
					$this->view->gallery = $this->model->getGallery($action, 'listings');
					// Set title
					$this->view->title = 'Admin - ' . $this->view->listing['address'];
					// Set ID
					$this->view->lid = $this->view->listing['lid'];
					// Load Listings
					$this->view->activeListings = $this->model->getListings('active');
					$this->view->archivedListings = $this->model->getListings('archived');					
				}else{
					// Load Error Page
					$this->view->title = "Error";
					$this->view->render('error/index');
				}
			}else{
				// Set title
				$this->view->title = 'Admin - Listings';
				// Load Listings
				$this->view->activeListings = $this->model->getListings('active');
				$this->view->archivedListings = $this->model->getListings('archived');
			}

			// Initialize JavaScript
			$this->view->js = array(				
				// Datepicker
				'admin/js/zebra_datepicker.js',	
				// Form Validation
				'admin/js/jquery.validate.min.js',	
				'admin/js/additional-methods.min.js',						
				// Color Animation
				'admin/js/jquery.color.min.js',
				// Stylized DropDownList
				'admin/js/chosen.jquery.min.js',
				// Tab Navigation
				'admin/js/jquery.hashchange.min.js',
				'admin/js/jquery.easytabs.min.js',				
				// Confirmation Dialog
				'admin/js/jquery-impromptu.js',
				// Canvas to Blob
				'admin/js/canvas-to-blob.min.js',
				// Default
				'admin/js/listings.js'
			);
			$this->view->render('admin/listings');
			
		}	
	}	
	function condos($action=null){
		$file = 'views/admin/condos.php';
		if (file_exists($file)){								

			if (isset($action)){			
				if ($action == 'new'){
					// Set title
					$this->view->title = 'Admin - New Condo';
					// Set Flag
					$this->view->newCondo = true;
				}elseif (ctype_digit($action)){
					// Load Condo Data
					$this->view->condo = $this->model->getCondo($action);					
					// Load Gallery Images
					$this->view->gallery = $this->model->getGallery($action, 'condos');
					// Load Condo/Builder Cover Image
					$this->view->cover_image = $this->model->getCoverImage($action);					
					// Load Floor Plan
					$this->view->floor_plan = $this->model->getFloorPlan($action);					
					// Set title
					$this->view->title = 'Admin - ' . $this->view->condo['condo_name'];
					// Set ID
					$this->view->cid = $this->view->condo['cid'];
					// Load Condos (DDL)
					$this->view->condos = $this->model->getCondos();					
				}else{
					// Load Error Page
					$this->view->title = "Error";
					$this->view->render('error/index');
				}
			}else{
				// Set title
				$this->view->title = 'Admin - Condos';
				// Load Condos (DDL)
				$this->view->condos = $this->model->getCondos();
			}		
			
			// Initialize JavaScript
			$this->view->js = array(				
				// Datepicker
				'admin/js/zebra_datepicker.js',	
				// Form Validation
				'admin/js/jquery.validate.min.js',	
				'admin/js/additional-methods.min.js',						
				// Color Animation
				'admin/js/jquery.color.min.js',
				// Stylized DropDownList
				'admin/js/chosen.jquery.min.js',
				// Tab Navigation
				'admin/js/jquery.hashchange.min.js',
				'admin/js/jquery.easytabs.min.js',				
				// Confirmation Dialog
				'admin/js/jquery-impromptu.js',
				// Canvas to Blob
				'admin/js/canvas-to-blob.min.js',
				// Default
				'admin/js/condos.js'				
			);					
			$this->view->render('admin/condos');
		}	
	}
	function account(){
		$file = 'views/admin/account.php';
		if (file_exists($file)){								
			$this->view->title = 'Admin - Account';		
			// Initialize JavaScript
			$this->view->js = array(
				// Form Validation
				'admin/js/jquery.validate.min.js',	
				'admin/js/additional-methods.min.js',						
				// Color Animation
				'admin/js/jquery.color.min.js',
				// Default
				'admin/js/account.js'				
			);					
			$this->view->render('admin/account');
		}	
	}	
	/***************************** jQuery Functions *************************/
	function deleteFloorPlan(){
		echo $this->model->deleteFloorPlan();
	}
	function deleteCoverImage(){
		echo $this->model->deleteCoverImage();
	}
	function saveYoutube(){
		echo $this->model->saveYoutube();
	}	
	function saveGallery(){
		echo $this->model->saveGallery();
	}
	function addImage(){
		echo $this->model->addImage();
	}
	function addListing(){
		echo $this->model->addListing();
	}
	function deleteListing(){
		echo $this->model->deleteListing();
	}
	function saveListing(){
		echo $this->model->saveListing();
	}
	function addCondo(){
		echo $this->model->addCondo();
	}
	function saveCondo(){
		echo $this->model->saveCondo();
	}
	function changePassword(){
		echo $this->model->changePassword();
	}
	function checkPassword(){
		echo $this->model->checkPassword();
	}	
	/**************************************** jQuery Upload **********************************************/
	function server($file=null){
		error_reporting(E_ALL | E_STRICT);

		$cwd = getcwd();		
		chdir($cwd.'/views/admin/server');
		require('UploadHandler.php');	
		chdir($cwd);		
		
		// Instantiate Upload Handler
		$upload_handler = new UploadHandler();
	}	
	/**************************************** Download Script **********************************************/
/*	function has_test($courses, $course_code, $test){
		$arr = explode(";", $courses);								
		for ($i=0;$i<count($arr);$i++){
			if (strpos($arr[$i], $course_code) !== false){
				if (strpos($arr[$i], $test) !== false){
					return true;
				}
			}
		}
		return false;
	}	
	function download($cid, $test){
		if (!isset($_SESSION['loggedIn']))
		{
			exit;
		}
		if ($_SESSION['access'] != 0){
			exit;
		}		

		if (isset($_POST['o']) == true && isset($_POST['source']) == true){
			// Download from Student Management
			
			$objs = json_decode($_POST['o'], true);

			// Initiate output stream
			$path = 'tmp/db_report.csv';			
			$data = fopen($path, 'w');
	
			// Build Header
			if ($_POST['source'] == 'accounts' || $_POST['source'] == 'newsletter' || $_POST['source'] == 'seminars' || $_POST['source'] == 'sc'){				
				$header = array("First Name","Last Name","Email","Course Subscriptions");
				fputcsv($data, $header);		
			}else{
				$header = array("First Name","Last Name","Email","Part 1","Part 2","Part 3","Note");
				if ($_POST['source'] == 'all_transactions'){
					$title = $objs[0]['course_code'].' - '.$objs[0]['Test'];
					fputcsv($data, array("ALL"));
					fputcsv($data, array());
					fputcsv($data, array($title));
					fputcsv($data, $header);				
				}else{					
					$title = $objs[0]['Test'];
					fputcsv($data, array($objs[0]['course_code']));
					fputcsv($data, array());
					fputcsv($data, array($title));
					fputcsv($data, $header);				
				}
			}
			
			// Write data
			foreach ($objs as $row) {
				if ($_POST['source'] == 'accounts' || $_POST['source'] == 'newsletter' || $_POST['source'] == 'seminars' || $_POST['source'] == 'sc'){				
					fputcsv($data, array($row['first_name'], $row['last_name'], $row['email'], $row['courses']));
				}else{
					if ($_POST['source'] == 'all_transactions'){
						if ($title != $row['course_code'].' - '.$row['Test']){
							$title = $row['course_code'].' - '.$row['Test'];
							fputcsv($data, array());						
							fputcsv($data, array($title));
							fputcsv($data, $header);
						}						
					}else{
						if ($title != $row['Test']){
							$title = $row['Test'];
							fputcsv($data, array());						
							fputcsv($data, array($title));
							fputcsv($data, $header);
						}																
					}
					fputcsv($data, array($row['first_name'], $row['last_name'], $row['email'], $row['Part1'], $row['Part2'], $row['Part3'], $row['Note']));
				}
			}				

			if(file_exists($path)){		
				header("Content-type: text/csv");
				header("Content-Disposition: attachment; filename=db_export_".time().".csv");
				header("Pragma: no-cache");
				header("Expires: 0");
				ob_clean();
				flush();
				readfile($path);
				exit;		
			}else{
				exit;
			}
		}else{
			// Download from Worksheet
			if (isset($cid) == true && isset($test) == true){
				$result = $this->model->getTransactions($this->model->getCourseCode($cid), $test);

				// Initiate output stream
				$path = 'tmp/db_report.csv';			
				$data = fopen($path, 'w');
				
				//  Build Header				
				$header = array("First Name","Last Name","Email","Part 1","Part 2","Part 3","Note","");

				// Write header
				fputcsv($data, array($result[0]['course_code']));
				fputcsv($data, array());
				fputcsv($data, $header);
				
				// Write data
				foreach ($result as $row) {					
					if ($this->has_test($row['courses'], $row['course_code'], $row['Test'])){
						$row['source'] = 'se';
					}else{
						$row['source'] = '';
					}
					fputcsv($data, array($row['first_name'],$row['last_name'],$row['email'],$row['Part1'],$row['Part2'],$row['Part3'],$row['Note'],$row['source']));		
				}		
				
				if(file_exists($path)){
					header("Content-type: text/csv");
					header("Content-Disposition: attachment; filename=db_export_worksheet".time().".csv");
					header("Pragma: no-cache");
					header("Expires: 0");
					ob_clean();
					flush();
					readfile($path);
					exit;		
				}else{
					exit;
				}				
			}else{
				exit;
			}
		}
	}*/
}
?>