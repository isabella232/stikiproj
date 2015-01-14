<?php
session_start();
/**
 * @author NudeSource
 * @copyright 2014
 */

$pwdlama = md5($_POST['PWDLAMA']);
$pwdbaru = md5($_POST['PWD1']);
$uid = $_SESSION['LOGINID'];

include('../../moduls/config.php');
include('../classes/useraccount.php');
$ac = NEW UserAccount;
 
$data= $ac->ChangePWD($uid,$pwdlama,$pwdbaru);
echo $data;
?>