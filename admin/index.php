<?php
session_start();
include_once('../moduls/config.php');
if(isset($_SESSION['login'])){
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>WEBMIN &rarr; Pengalihan - Mohon tunggu...</title>
		<style type="text/css">
			*{padding:0;margin:0;}
			body
			{
				font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
				font-weight: 300;
				font-size: 14px;
				line-height: 1.6;
				background-color: #f9f9f9;
				color: #000000;
				width:960px;
				margin:4em auto 4em auto;
			}
			small{padding:0;margin:0;}
		</style>
	</head>
	
	<body>
		<meta http-equiv="refresh" content="1; url=dashboard.php">
	</body>
</html><?php    
}else{
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>WEBMIN &rarr; Pengalihan - Mohon tunggu...</title>
		<style type="text/css">
			*{padding:0;margin:0;}
			body
			{
				font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
				font-weight: 300;
				font-size: 14px;
				line-height: 1.6;
				background-color: #f9f9f9;
				color: #000000;
				width:960px;
				margin:4em auto 4em auto;
			}
			small{padding:0;margin:0;}
		</style>
	</head>
	
	<body>
		<meta http-equiv="refresh" content="1; url=login.php">
	</body>
</html>
<?php
}
?>