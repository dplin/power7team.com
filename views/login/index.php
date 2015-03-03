<?php
	/****** Start Math Captcha ******/
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
	/****** End Math Captcha ******/
?>
<div>
	<div style="margin:25% auto;width:230px;" id="math" data-math="<?=$math?>">
		<form class="pure-form" id="login_form">
			<fieldset>	
				<legend>Admin Console</legend>

				<input type="email" placeholder="Email" value="" id="inputEmail" name="email"><br />
				<input type="password" placeholder="Password" id="inputPwd" name="password"><br />
				<div style="height:35px;">
					<button type="submit" class="btn btnLogin" style="width:110px;text-align:center;">Login<i class="icon-long-arrow-right"></i></button>
				</div>			
				<div class="forgot_pass">
					<span>Forgot password?&nbsp;<a href="#pwdRecovery-modal-content" id="btnShowPwdRecoveryDialog">Click here</a></span>
				</div>
			</fieldset>
		</form>
	</div>
</div>