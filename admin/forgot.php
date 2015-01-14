<?php
require_once 'classes/Login.php';
$Login = new Login;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="media/css/style.css" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="media/js/bwi.script.custom.js"></script>
        <title>IbuNia.com &rarr; Login | <?php echo SITE_NAME; ?></title>
	</head>
	
	<body>
		<div id="container">
			
			<?php if(isset($_GET['email']) && (isset($_GET['reset']))) : ?>
				
			<script type="text/javascript">
				var newEmailVariable = "<?php echo $_GET['email']; ?>";
			</script>
				
			<?php if($validate = $Login->validateResetInfo($_GET['email'],$_GET['reset'])) : ?>
				<div id="form">
					<h1>Password Reset: <?php echo $_GET['email']; ?></h1>
					<fieldset id="newPasswordForm">
						<legend>Lupa Password | Versi: <?php echo VERSION; ?></legend>
						<form method="post" action="#">
							<p>
								<label for="re-password">Password: </label>
								<input type="password" name="re-password" id="re-password" class="input" value=""/>
							</p>
							<p>
								<label for="re-password-2">Password: </label>
								<input type="password" name="re-password-2" id="re-password-2" class="input" value=""/>
							</p>
							<p>
								<input type="submit" name="login" id="renew-password" class="button" value="Change" />
							</p>
						</form>
					</fieldset>
					<div id="loading"><img src="media/images/loader.gif" alt="Loading..." /></div>
					<div id="feedback"></div>
				</div><!-- end form -->
			<?php else: ?>
				<meta http-equiv="refresh" content="0; url=login.php" />
				<?php die(); ?>
			<?php endif; ?>
			
			<?php else: ?>
				<div id="form">
					<h1>Lupa Password | <?php echo SITE_NAME; ?></h1>
					<fieldset id="forgotPasswordForm">
						<legend>Selamat Datang di Admin | Versi: <?php echo VERSION; ?></legend>
						<form method="post" action="#">
							<p>
								<label for="forgot-email">Email: </label>
								<input type="text" name="email" id="forgot-email" class="input" value=""/>
							</p>
							<p>
								<input type="submit" name="login" id="forgot-password" class="button" value="Pulihkan Akun" />
							</p>
						</form>
					</fieldset>
					<div id="loading"><img src="media/images/loader.gif" alt="Loading..." /></div>
					<div id="feedback"></div>
				</div><!-- end form -->
			<?php endif; ?>
			
			<div id="footer">
				<p>&copy; <?php echo date("Y"); ?> - <?php echo SITE_NAME; ?> - <a href="login.php">Login?</a></p>
			</div><!-- end footer -->
			
		</div><!-- end container -->		
	</body>
</html>
