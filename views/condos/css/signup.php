<?php
	if (isset($_POST)){	
	
		if ($_POST['num1'] + $_POST['num2'] == $_POST['math_challenge_answer']){
			// Target Email Address
			$to = 'contact@ulifeacademics.com';
			// Set Subject
			$subject = 'New Sign-Up';		
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";		
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			// Additional headers
			$headers .= 'To: ULife <'.$to.'>' . "\r\n";
			$headers .= 'From: ULife <'.$to.'>' . "\r\n";		
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
							<td style="padding:5px 50px 5px 0;">Phone:</td>
							<td style="padding-bottom:15px;">'.$_POST['phone'].'</td>
						</tr>					
						<tr>
							<td style="padding:5px 50px 15px 0;">UT Student ID:</td>
							<td style="padding-bottom:15px;">'.$_POST['ut_student_id'].'</td>
						</tr>
						<tr>
							<td style="padding-right:50px;padding-top:15px;border-top:3px solid #555555;" valign="top">Course(s):</td>
							<td style="padding-top:15px;border-top:3px solid #555555;">';
						
			$all_courses = '';			
			if (isset($_POST['course'])){
				foreach ($_POST['course'] as $course){			
					$all_courses .= str_replace("_","&#47;",$course) . '<br />';
				}			
			}

							$message .= $all_courses . '</td>
						</tr>
					</table>
				</body>
			</html>';
			
			// Mail it
			$rtn = mail($to, $subject, $message, $headers);
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= $headers . "Content-type: text/html; charset=utf-8" . "\r\n";
			$headers .= $headers . "From: contact@ulifeacademics.com";
			$message2 = '
				<html>
				<body style="font-family:Verdana;font-size:1em;">
				<div style="width:600px;">
				<p><span style="font-size:1.5em;">T</span>hank you for signing up to our mailing list to stay connected! From now on, you will be receiving our latest updates, seminar information, free materials and study tips in your inbox directly!</p>

				<p>If you have any questions, please do not hesitate to contact us at <a href="mailto:contact@ulifeacademics.com" title="ULife Academics" style="color:#3B8893;">contact@ulifeacademics.com</a>, we will be more than happy to assist you.</p>

				<p style="margin-top:120px;">Regards,<br />
				ULife Academics Team<br />
				Website: <a href="www.ulifeacademics.com" title="ULife Academics" style="color:#3B8893;">www.ULifeAcademics.com</a><br />
				Email: <a href="mailto:contact@ulifeacademics.com" title="ULife Academics" style="color:#3B8893;">contact@ulifeacademics.com</a><br />
				Tel: <span style="color:#3B8893;">416-948-9168</span></p>
				</div>
				</body>
				</html>
			';			
			
			mail($_POST['email'], "ULife Academics SignUp Confirmation", $message2, $headers );			
			
			echo $rtn;			
		}else{
			echo -1;
		}	
		
	}	
	
?>