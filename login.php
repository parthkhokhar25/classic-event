<?php
	include_once("Database/connect.php");
	// Initialize variables for form values and error messages
	$username_error = "";
	$password_error = "";
	$login_error = "";
	$uname = "";
	if(isset($_POST['submit']))
	{
		session_start();
		$uname = isset($_POST['unm']) ? trim($_POST['unm']) : "";
		$pswd = isset($_POST['pswd']) ? $_POST['pswd'] : "";
		
		// Basic required-field validation
		if($uname === "")
		{
			$username_error = "Username required";
		}
		if($pswd === "")
		{
			$password_error = "Password required";
		}
		
		// Proceed only if no required-field errors
		if($username_error === "" && $password_error === "")
		{
			$qr=mysqli_query($con,"select * from login where unm='$uname' and pswd='$pswd'");
			if(mysqli_num_rows($qr))
			{
				$_SESSION['uname']=$uname;
				echo "<script> window.location.assign('index.php');</script>";
			}
			else
			{
				$login_error = "Wrong user name and password";
				// Empty username field on wrong credentials
				$uname = "";
			}
		}
	}
	include_once("header.php");
?>
<div class="banner about-bnr">
		<div class="container">
		</div>
	</div>
	<div class="codes">
		<div class="container"> 
		<h2 class="w3ls-hdg" align="center">User Login</h2>
				  
	<div class="grid_3 grid_4">
				<div class="tab-content">
					<div class="tab-pane active" id="horizontal-form">
						<form class="form-horizontal" action="" method="post">
							<?php if($login_error !== "") { ?>
							<p style="color:red; text-align:center;"><?php echo $login_error; ?></p>
							<?php } ?>
							<div class="form-group">
								<label for="focusedinput" class="col-sm-2 control-label">User Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control1"  name="unm" id="focusedinput" placeholder="User Name" value="<?php echo htmlspecialchars($uname, ENT_QUOTES); ?>">
									<?php if($username_error !== "") { ?>
									<p style="color:red; margin-top:5px;"><?php echo $username_error; ?></p>
									<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="col-sm-2 control-label">Password</label>
								<div class="col-sm-8">
									<input type="password" class="form-control1" name="pswd" id="inputPassword" placeholder="Password">
									<?php if($password_error !== "") { ?>
									<p style="color:red; margin-top:5px;"><?php echo $password_error; ?></p>
									<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-8">
									<p><a href="forgot_password.php" style="color: #0066cc;">Forgot Password?</a></p>
								</div>
							</div>
							<div class="contact-w3form" align="center">
					<input type="submit" name="submit" value="SEND">
					</div>
						</form><br/>
						<div align="center"><h5>Not an account? <a href="registration.php">Registration Here</a></h5></div>
						</div>
					</div>
				</div>
			</div>
		</div>
				<?php
				include_once("footer.php");
			?>