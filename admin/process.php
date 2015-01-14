<?php
sleep(2);
include('../moduls/config.php');
//include_once('includes/config.inc.php');
include('classes/loginclass.php');
$message['error'] = false;

if(!empty($_POST['username']) && !empty($_POST['password']))
{
	$username = strip_tags($_POST['username']);
	$password = strip_tags(md5($_POST['password']));
	
    
	setcookie('username', $username);
	
    $Login = new LoginClass;
    $message = $Login->checkUserLogin($username,$password);
    echo json_encode($message);
}
?>