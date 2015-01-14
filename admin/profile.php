<?php
require_once 'includes/define.inc.php';
require_once 'classes/Login.php';
$Login = new Login;
$Login->verify(); // mudahnya cek login

if(isset($_GET['logout'])){$Login->logUserOut();}
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
		<meta charset="utf-8">
		<title><?php echo SITE_NAME ?> - Administrator</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="css/site.css" rel="stylesheet">
		<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
	</head>
	<body>
		<div class="container">
        	<!-- start navigasi -->
            <div class="navbar navbar-inverse">
              <div class="navbar-inner">
                <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a class="brand" href="#"><?php echo SITE_NAME; ?></a>
                  <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav">
                      <li class="active"><a href="dashboard.php">Dashboard</a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bantuan <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="#">Tentang</a></li>
                          <li class="divider"></li>
                          <li class="nav-header">Bila Ada masalah :</li>
                          <li><a href="mailto:<?php echo AUTHOR_MAIL ?>"><?php echo AUTHOR_MAIL ?></a></li>
                        </ul>
                      </li>
                    </ul>
                    <!-- separator -->
                    <ul class="nav pull-right">
                      <li class="divider-vertical"></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Akun <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="#"><i class="icon-user"></i> @<?php echo $_SESSION['member_username'] ?></a></li>
                          <li class="divider"></li>
                          <li><a href="?logout"><i class="icon-off"></i> Logout</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
            </div><!-- /navbar -->
			<!-- /end navigasi -->
			<div class="row">
				<div class="span3">
					<div class="well" style="padding: 8px 0;">
						<ul class="nav nav-list">
							<li class="nav-header">
								Navigasi
							</li>
							<li>
								<a href="dashboard.php"><i class="icon-home"></i> Dashboard</a>
							</li>
							<li>
								<a href="alumnis.php"><i class="icon-folder-open"></i> Kelola Alumni</a>
							</li>
                            <li class="divider"></li>
							<li class="nav-header">
								Akun Anda
							</li>
							<li class="active">
								<a href="#"><i class="icon-user"></i> @<?php echo $_SESSION['member_username']?></a>
							</li>
							<li>
								<a href="?logout"><i class="icon-off"></i> Logout</a>
							</li>
							<li class="divider"></li>
						</ul>
					</div>
				</div>
				<div class="span9">
					<h1>
						Edit Profil Administrator
					</h1>
					<form id="edit-profile" class="form-horizontal">
						<fieldset>
							<legend>Profil Anda</legend>
							<div class="control-group">
								<label class="control-label" for="input01">Name</label>
								<div class="controls">
									<input type="text" class="input-xlarge" id="input01" value="John Smith" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">Phone</label>
								<div class="controls">
									<input type="text" class="input-xlarge" id="input01" value="555 555 555" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">Email</label>
								<div class="controls">
									<input type="text" class="input-xlarge" id="input01" value="john.smith@example.org" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="fileInput">Photo</label>
								<div class="controls">
									<input class="input-file" id="fileInput" type="file" />
								</div>
							</div>						
							<div class="control-group">
								<label class="control-label" for="textarea">Biography</label>
								<div class="controls">
									<textarea class="input-xlarge" id="textarea" rows="4">Web technology junkie who writes innovative and bestselling technical books. Also enjoys Sunday bicycle rides and all "good" comedy.</textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="optionsCheckbox">Public Profile</label>
								<div class="controls">
									<input type="checkbox" id="optionsCheckbox" value="option1" checked="checked" />
								</div>
							</div>						
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Save</button> <button class="btn">Cancel</button>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
	</body>
</html>
