<?php 
class Condos extends Controller{
	function __construct(){
		parent::__construct();
		// Initialize Page Variables
		$this->view->title = "New Condos";
		// Initialize JavaScript
		$this->view->js = array(							
			'condos/js/jquery.validate.min.js',	
			'condos/js/additional-methods.min.js',						
			'condos/js/jquery.color.min.js',
			'condos/js/jquery.flexslider-min.js',			
			'condos/js/jquery.mCustomScrollbar.concat.min.js',
			'condos/js/default.js'
		);	
		// Initialize CSS
		$this->view->css = array(
			'condos/css/flexslider.css',
			'condos/css/jquery.mCustomScrollbar.css',
			'condos/css/pure-min.css',
			'condos/css/default.css'
		);			
	}
	
	function index(){
		// Get records
		$this->view->records = $this->model->getRecords();
		
		// Render Page
		$this->view->render('condos/index');			
	}	

	function detail($cid=null){
		$file = 'views/condos/detail.php';		
		if (file_exists($file)){						
			if (isset($cid)){
				if (ctype_digit($cid)){					
					// Get condo detail
					$this->view->condo = $this->model->getRecord($cid);
					// Get gallery images
					$this->view->gallery = $this->model->getGallery($cid);
					// Get floor plans
					$this->view->floor_plans = $this->model->getFloorPlans($cid);					
					// Render Page
					$this->view->render('condos/detail');
					
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
		$subject = 'VIP Registration';		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		// Additional headers
		$headers .= 'To: Power7Team <'.$to.'>' . "\r\n";
		$headers .= 'From: '.$_POST['first_name'].' '.$_POST['last_name'].' <'.$_POST['email'].'>' . "\r\n";		
		$message = '
		<html>
			<body style="font-family:Verdana;font-size:1em;">
				<table style="width:100%;border-collapse:collapse;">
					<tr>
						<td style="padding:5px 50px 5px 0;width:15%;">First Name:</td>
						<td style="width:85%;">'.$_POST['first_name'].'</td>
					</tr>
					<tr>
						<td style="padding:5px 50px 5px 0;">Last Name:</td>
						<td>'.$_POST['last_name'].'</td>
					</tr>				
					<tr>
						<td style="padding:5px 50px 5px 0;">Email:</td>
						<td>'.$_POST['email'].'</td>
					</tr>														
					<tr>
						<td style="padding:5px 50px 15px 0;">Phone:</td>
						<td style="padding-bottom:15px;">'.$_POST['phone'].'</td>
					</tr>
					<tr>
						<td style="padding-right:50px;padding-top:15px;border-top:3px solid #555555;" valign="top">Message:</td>
						<td style="padding-top:15px;border-top:3px solid #555555;">'.$_POST['message'].'</td>
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