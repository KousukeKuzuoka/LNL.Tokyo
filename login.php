<?php
require_once 'core/init.php';
if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate   = new Validation();
		$validation = $validate->check($_POST, array(
			'username' => array('required' => true),
			'password' => array('required' => true)
			));
		if($validation->passed()) {
			//log the user in
			$user = new User();
			//if the check box is checked its gonna be on 
			$remember = (Input::get('remember') === 'on') ? true : false;
			$login  = $user->login(Input::get('username'), Input::get('password'), Input::get('remember'));
			if($login) {
				Session::flash('home', 'You logged in');
				Redirect::to('/');
			} else {
				print 'You need to activate your account';
			}

		} else {
			//get the error message
			foreach($validation->errors() as $error) {
				print $error . "</br>";
			}
		}
	}

}


?>
<!DOCTYPE html>
<html>
	<?php include('includes/head.php'); ?>
	<body>
		<div class="login_main1">
			<div class="jumbotron">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<div class="section1-1">
								<h2>Login</h2>
								<form action="login.php" method="POST">
									<p>
										<input type="text" name="username" value="<?php print 'type your username' ?>">
									</p>
									<p>
										<input type="password" name="password" value="">
									</p>
									<p>
										<input type="checkbox" name="remember"> Remember me
									</p>
										<input type="hidden" name="token" value="<?php print Token::generate(); ?>">
									<ul>
										<li><a href="register.php">Register</a></li>
										<li><a href="forgotpassword.php">Lost your password?</a></li>
									</ul>
								<input type="submit" name="submit" value="Submit">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>