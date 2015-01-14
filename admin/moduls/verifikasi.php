<?php

/**
 * @author NudeSource
 * @copyright 2014
 */

$usr = $_POST['uid'];
$pwd = $_POST['passwd'];
$kue = true;

include('../../moduls/config.php');
include_once('../classes/loginclass.php');

$lg = new LoginClass;
$hsl = $lg->checkUserLogin($usr,$pwd,$kue);

sleep(2);
echo $hsl;
?>