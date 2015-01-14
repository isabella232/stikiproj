<?php
if(!isset($_SESSION)){
    session_start();
};
include('../moduls/config.php');
include_once('classes/loginclass.php');
$Login = new LoginClass;
$Login->verify(); //mudahnya cek login
if(isset($_GET['logout'])){$Login->logUserOut();}
if(isset($_GET['m'])){
    $prm = $_GET['m'];
}else{
    $prm = 'WELCOME';
}
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
		<meta charset="utf-8">
		<title>Jadwal KULIAH - Administrator</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="BCMHost">
        <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.5" media="screen" />
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
                  <a class="brand" href="dashboard.html">JADWAL KULIAH</a>
                  <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav">
                    
                    </ul>
                    <!-- separator -->
                    <ul class="nav pull-right">
                      <!--  
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bantuan <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li class="nav-header">Tentang</li>
                          <li class="aboutapps"><a href="#"><i class="icon-asterisk"></i> WEB ADMIN Versi <?php echo VERSION; ?></a></li>
                          <li class="divider"></li>
                          <li class="nav-header">Salam :</li>
                          <li><a href="mailto:<?php echo AUTHOR_MAIL ?>"><i class="icon-envelope"></i> <?php echo AUTHOR_MAIL ?></a></li>
                        </ul>
                      </li>
                      -->  
                      <li class="divider-vertical"></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Akun <b class="caret"></b></a>
                        <ul class="dropdown-menu account">
                          <li><a href="account.html"><i class="icon-user"></i> @<?php echo $_SESSION['LOGINAME'] ?></a></li>
                          <li class="divider"></li>
                          <li><a class="logout" href="logout.html"><i class="icon-off"></i> Logout</a></li>
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
                            <li class="active">
								<a href="dashboard.html"><i class="icon-folder-open"></i> Dashboard</a>
							</li>
                            <li class="divider"></li>
							<li class="nav-header">
								Navigasi Page
							</li>
							<li>
								<a href="ruangkelas.html"><i class="icon-magnet"></i> Ruang Kelas</a>
							</li>
							<li>
								<a href="jadwalkuliah.html"><i class="icon-calendar"></i> Jadwal Perkuliah</a>
							</li>
                            <li>
								<a href="datadosen.html"><i class="icon-briefcase"></i> Data Dosen</a>
							</li>
                            <li>
								<a href="matakuliah.html"><i class="icon-list-alt"></i> Matakuliah</a>
							</li>
<?php 
if($_SESSION['LOGINLEVEL']==1){
?>                            
                            <li>
								<a href="user.html"><i class="icon-user"></i> User Managemen</a>
							</li>
<?PHP } ?>
                            <li class="divider"></li>
                            <li class="nav-header">
								Absen Dosen
							</li>
                            <li>
								<a href="absendosen.html"><i class="icon-bell"></i> Absen Dosen</a>
							</li>
                            <li class="divider"></li>
                            <li class="nav-header">
								Report
							</li>
                            <li>
								<a href="lap-dosen.html"><i class="icon-file"></i> Rekap Absensi Dosen</a>
							</li>
                            
                            <li class="divider"></li>
							<li class="nav-header">
								Akun Anda
							</li>
							<li>
								<a href="account.html"><i class="icon-user"></i> @<?php echo $_SESSION['LOGINAME']?></a>
							</li>
							<li>
								<a href="logout.html"><i class="icon-off"></i> Logout</a>
							</li>
							<li class="divider"></li>
						</ul>
					</div>
				</div>
				<div class="span9">
					
				</div>
			</div>
		</div>
        <div id="loading" style="display:none"><img src="img/loading.gif" /><br />Mohon tunggu. Data sedang dimuat.....</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
        <script type="text/javascript" src="js/jquery.mousewheel-3.0.6.pack.js"></script>
        <script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.5"></script>
        <script type="text/javascript" src="../js/jquery.stickybar.js"></script>

        <script type="text/javascript">
$(function() {
	$('#loading').ajaxStart(function(){
		$(this).fadeIn();
	}).ajaxStop(function(){
		$(this).fadeOut();
	});
    
 $('.span9').load('moduls/<?php echo $prm . ".php"; ?>');
 
    $('.navbar').stickyBar();    
    
});
</script>

	</body>
</html> 