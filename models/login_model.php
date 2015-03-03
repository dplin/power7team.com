<?php
class Login_Model extends Model{
	function __construct(){	
		parent::__construct();		
	}	
	
	function pwdrecovery(){		
		$sth = $this->db->prepare('SELECT COUNT(*) FROM users WHERE email = :email');		
		$sth->bindParam(':email', $_POST['email']);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();			

		$existed = $sth->fetchColumn();		

		if ($existed){	
			$pass = $this->random_password();
			
			$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
			
			$saltedPW =  $pass . $salt;

			$hashedPW = hash('sha256', $saltedPW);	
			
			$sth = $this->db->prepare('UPDATE users SET password=:password, salt=:salt WHERE email=:email');				
			$sth->bindParam(':password', $hashedPW);
			$sth->bindParam(':salt', $salt);
			$sth->bindParam(':email', $_POST['email']);
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$success = $sth->execute();		
			
			// Send confirmation email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= $headers . "Content-type: text/html; charset=utf-8" . "\r\n";
			$headers .= $headers . "From: info@power7team.com";			
			$message = '
				<html>
				<body style="font-family:Verdana;font-size:1em;">
				<div style="width:600px;">
				<p><span style="font-size:1.5em;">Y</span>our password has been reset. Your temporary password is "'.$pass.'".</p>

				<p>Please change your password on first login.  If you have any questions, please do not hesitate to contact us at <a href="mailto:info@power7team.com" title="Power 7 Team" style="color:#3B8893;">info@power7team.com</a>, we will be more than happy to assist you.</p>			

				<p style="margin-top:120px;">Regards,<br />
				Power 7 Team<br />
				Website: <a href="www.power7team.com" title="Power 7 Team" style="color:#3B8893;">www.power7team.com</a><br />
				Email: <a href="mailto:info@power7team.com" title="Power 7 Team" style="color:#3B8893;">info@power7team.com</a></p>
				</div>
				</body>
				</html>
			';	
			
			//mail($_POST['email'],'Power7Team.com Password Recovery',$message,$headers);
			mail('derek.pc.lin@gmail.com','Power7Team.com Password Recovery',$message,$headers);
			
			return $success;
		}
		return 0;
	}
	function random_password($length = 8) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}	
	function register(){	
		$email = $_POST['email'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];		
		
		// Make sure student doesn't exist
		$sth = $this->db->prepare('SELECT COUNT(*) FROM users WHERE email = :email');		
		$sth->bindParam(':email', $_POST['email']);		
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();			
		
		$existed = $sth->fetchColumn();
								
		if (!$existed){
			// Check to see if Admin exist.  Admin right will be assign to this user if it is.
			$notAdmin = 1;
			$sth = $this->db->prepare('SELECT COUNT(*) FROM users WHERE access_type=0');					
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();	
			
			if ($sth->fetchColumn() == 0){
				$notAdmin = 0;
			}		
		
			$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
			
			$saltedPW =  $_POST['password'] . $salt;
			
			$hashedPW = hash('sha256', $saltedPW);	
			
			$sth = $this->db->prepare('INSERT INTO users(email, first_name, last_name, password, salt, access_type, join_date) VALUES(:email, :first_name, :last_name, :password, :salt, :access_type, CURDATE())');
			$sth->bindParam(':email', $email);
			$sth->bindParam(':first_name', $first_name);
			$sth->bindParam(':last_name', $last_name);		
			$sth->bindParam(':password', $hashedPW);		
			$sth->bindParam(':salt', $salt);		
			$sth->bindParam(':access_type', $notAdmin);
			$sth->setFetchMode(PDO::FETCH_ASSOC);		
			$success = $sth->execute();	

			if ($success){
				// Proceed with login
				Session::init();
				Session::set('loggedIn', true);
				Session::set('access', $notAdmin);				
				Session::set('email', $email);					
				Session::set('activate', 1);
				
				// Redirect				
				if ($notAdmin == 1){				
					// Redirect to Student Centre
					return URL.'studentcentre';
				}elseif ($notAdmin == 0){	
					// Redirect to Admin section
					return URL.'admin';
				}					
			}					
		}else{
			return 0;
		}			
	}
	
	function login(){		
		$sth = $this->db->prepare('SELECT salt FROM users WHERE email = :email');				
		$sth->bindParam(':email', $_POST['email']);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();	
		
		$salt = $sth->fetchColumn();		
		$saltedPW = $_POST['password'] . $salt;
		
		$hashedPW = hash('sha256', $saltedPW);
		
		$sth = $this->db->prepare('SELECT * FROM users WHERE email = :email AND password = :password');		
		$sth->bindParam(':email', $_POST['email']);
		$sth->bindParam(':password', $hashedPW);		
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();					
		$userInfo = $sth->fetchAll();
				
		if (count($userInfo)){		
			// Proceed with login
			Session::init();
			Session::set('loggedIn', true);			
			Session::set('email', $_POST['email']);			
			return URL.'admin';
		}else{
			//Unable to login
			$msgID = 0;
			if ($salt == ""){
				$msgID = 1;
			}else{
				$msgID = 2;
			}									
			return $msgID;
		}
	}	
	
	function checkEmail(){	
		$sth = $this->db->prepare('SELECT * FROM users WHERE email = :email');				
		$sth->bindParam(':email', $_POST['email']);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();			
		$emailResult = $sth->fetchAll();
		
		if (isset($_POST['register'])){
			if (count($emailResult)){
				return 'false';
			}else{
				return 'true';	
			}				
		}else{
			if (count($emailResult)){
				return 'true';
			}else{
				return 'false';	
			}		
		}
	}
	function changePassword(){
		// Make sure Old Password is correct
		$sth = $this->db->prepare('SELECT salt FROM users WHERE email = :email');		
		$sth->bindParam(':email', $_SESSION['email']);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();	
		
		$salt = $sth->fetchColumn();
		
		$saltedPW = $_POST['password'] . $salt;
		
		$hashedPW = hash('sha256', $saltedPW);
		
		$sth = $this->db->prepare('SELECT access_type FROM users WHERE email = :email AND password = :password');		
		$sth->bindParam(':email', $_SESSION['email']);
		$sth->bindParam(':password', $hashedPW);		
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();			
				
		if ($sth->rowCount() > 0){			
			// Old Password is correct.  Now changing to new password.
			$pass = $_POST['new_password'];
			
			$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
			
			$saltedPW =  $pass . $salt;
			
			$hashedPW = hash('sha256', $saltedPW);	
						
			$sth = $this->db->prepare('UPDATE users SET password=:password, salt=:salt WHERE email=:email');				
			$sth->bindParam(':password', $hashedPW);
			$sth->bindParam(':salt', $salt);
			$sth->bindParam(':email', $_SESSION['email']);
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			return $sth->execute();
		}else{
			return false;
		}
	}
	function checkPassword(){	
		$sth = $this->db->prepare('SELECT salt FROM users WHERE email = :email');				
		$sth->bindParam(':email', $_POST['email']);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();	
		
		$salt = $sth->fetchColumn();
		
		$saltedPW = $_POST['password'] . $salt;
		
		$hashedPW = hash('sha256', $saltedPW);
		
		$sth = $this->db->prepare('SELECT access_type FROM users WHERE email = :email AND password = :password');		
		$sth->bindParam(':email', $_POST['email']);
		$sth->bindParam(':password', $hashedPW);		
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();			
		
		$access_type = $sth->fetchColumn();
				
		if ($sth->rowCount() > 0){		
			return 'true';
		}else{
			return 'false';
		}
	}	
}
?>