<?php 
class Listings extends Controller{
	function __construct(){
		parent::__construct();
		// Initialize Page Variables
		$this->view->title = "Listings";
		// Initialize JavaScript
		$this->view->js = array(			
			'listings/js/jquery.validate.min.js',					
			'listings/js/additional-methods.min.js',			
			'listings/js/jquery.flexslider-min.js',		
			'listings/js/jquery-impromptu.js',
			'listings/js/jquery.color.min.js',
			'listings/js/zebra_datepicker.js',			
			'listings/js/default.js'
		);	
		// Initialize CSS
		$this->view->css = array(								
			'listings/css/flexslider.css',	
			'listings/css/themes/base.css',			
			'listings/css/pure-min.css',
			'listings/css/zebra.css',
			'listings/css/metallic.css',			
			'listings/css/default.css'
		);	
	}
	
	function index(){
		// Get total pages
		$pages = $this->model->getTotalPages();	
		
		// Generate Pagination
		$this->view->pagination = $this->model->renderNavigation(3, 0, $pages);
	
		// Get records
		$this->view->records = $this->model->getRecords();
	
		// Render Page
		$this->view->render('listings/index');			
	}	
	
	function page($page_num=null){		
		// Get total pages
		$pages = $this->model->getTotalPages();		
		
		// Get Records
		if (isset($page_num)){
			if (ctype_digit($page_num)){
				if ($page_num > $pages){
					// Load Error Page
					$this->view->title = "Error";
					$this->view->render('error/index');				
				}else{					
					// Generate Pagination
					$this->view->pagination = $this->model->renderNavigation(3, $page_num-1, $pages);
					
					// Get records
					$this->view->records = $this->model->getRecords($page_num-1);

					// Render Page
					$this->view->render('listings/index');
				}
			}else{
				// Load Error Page
				$this->view->title = "Error";
				$this->view->render('error/index');
			}
		}else{
			// Load Error Page
			$this->view->title = "Error";
			$this->view->render('error/index');		
		}
	}
	
	function detail($lid=null){
		$file = 'views/listings/detail.php';		
		if (file_exists($file)){						
			if (isset($lid)){
				if (ctype_digit($lid)){					
					// Get listing detail
					$this->view->listing = $this->model->getRecord($lid);
					// Get gallery images
					$this->view->gallery = $this->model->getGallery($lid);
					// Render Page
					$this->view->render('listings/detail');					
				}else{
					// Load Error Page
					$this->view->title = "Error";
					$this->view->render('error/index');
				}
			}else{
				// Load Error Page
				$this->view->title = "Error";
				$this->view->render('error/index');		
			}
		}		
	}
	function captcha(){
		Session::init();
		if ($_SESSION['answer'] == $_POST['answer'] )
					echo 'true';
			else
					echo 'false';
	}
	function send(){
		// Target Email Address
		$to = 'info@power7team.com';		
		// Set Subject		
		$subject = $_POST['subject'];		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		// Additional headers
		$headers .= 'To: Power7Team <'.$to.'>' . "\r\n";
		$headers .= 'From: '.$_POST['full_name'].' <'.$_POST['email'].'>' . "\r\n";		
		$message = '
		<html>
			<body style="font-family:Verdana;font-size:1em;">
				<table style="width:100%;border-collapse:collapse;">
					<tr>
						<td style="padding:5px 50px 5px 0;width:15%;">Name:</td>
						<td style="width:85%;">'.$_POST['full_name'].'</td>
					</tr>		
					<tr>
						<td style="padding:5px 50px 15px 0;">Phone:</td>
						<td style="padding-bottom:15px;">'.$_POST['phone'].'</td>
					</tr>					
					<tr>
						<td style="padding:5px 50px 15px 0;">Email:</td>
						<td style="padding-bottom:15px;">'.$_POST['email'].'</td>
					</tr>';			
					
		if ($_POST['submit_form'] == "schedule"){
			$message .= '
					<tr>
						<td style="padding:5px 50px 15px 0;">Prefered Date:</td>
						<td style="padding-bottom:15px;">'.$_POST['prefered_date'].'</td>
					</tr>
			';
		}
					
		$message .=	'<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td style="padding-right:50px;padding-top:15px;border-top:3px solid #555555;" valign="top">Comment:</td>
						<td style="padding-top:15px;border-top:3px solid #555555;">'.$_POST['comment'].'</td>
					</tr>
				</table>
			</body>
		</html>';

		// Mail it
		$rel = mail($to, $subject, $message, $headers);				
		
		if ($rel){
			// Construct and send back a new Captcha on Success
			Session::init();

			$digit1 = mt_rand(1,15);
			$digit2 = mt_rand(1,15);
			if( mt_rand(0,1) === 1 ) {
				$math = "$digit1 + $digit2";
				$_SESSION['answer'] = $digit1 + $digit2;
			} else {
				$math = "$digit1 - $digit2";
				$_SESSION['answer'] = $digit1 - $digit2;
			}	
			
			echo $math;
		}
	}	
}
?>