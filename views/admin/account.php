<?php include('nav/admin_nav.php'); ?>	

	<div class="pure-u-1-2 white_bar_no_border" style="border-bottom:1px solid #DFDFDF;">		
		<div style="padding:30px;">
			<form class="pure-form pure-form-aligned" id="account_form">			
				<fieldset>
					<legend>Account</legend>
					<div class="pure-control-group">
						<label for="account">Account</label>
						<span><?=$_SESSION['email']?></span>
					</div>
					<div class="pure-control-group">
						<label for="password">Old Password</label>
						<input id="password" type="password" placeholder="Old Password" name="password">
					</div>

					<div class="pure-control-group">
						<label for="new_password">New Password</label>
						<input id="new_password" type="password" placeholder="New Password" name="new_password">
					</div>

					<div class="pure-control-group">
						<label for="confirm_new_password">Confirm New Password</label>
						<input id="confirm_new_password" type="password" placeholder="Confirm New Password" name="confirm_new_password">
					</div>

					<div class="pure-controls">
						<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnChangePwd">Submit</button>
					</div>
				</fieldset>		
			</form>
		</div>
	</div>	
