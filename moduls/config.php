<?php

/**
 * @author NudeSource
 * @copyright 2014
 */

date_default_timezone_set("Asia/Makassar");

if(!isset($_SESSION)){
    session_start();
};
if(!isset($_SESSION['GR'])){
    session_regenerate_id();
    $_SESSION['GR'] = '';
}
if(!isset($_SESSION['GRH'])){
    session_regenerate_id();
    $_SESSION['GRH'] = '';
}
if(!isset($_SESSION['init']))
{
	session_regenerate_id();
	$_SESSION['init'] = true;
}
/** Pemilik **/
if(!defined('AUTHOR_LINK')){
    define('AUTHOR_LINK','artha.web.id');
}

if(!defined('AUTHOR_MAIL')){
    define('AUTHOR_MAIL','made@artha.web.id');
}

/** Pengaturan Database **/
if(!defined('DB_HOST')){
    define('DB_HOST','localhost');
}
if(!defined('DB_USER')){
    define('DB_USER','root');
}
if(!defined('DB_PASS')){
    define('DB_PASS','');
}
if(!defined('DB_NAME')){
    define('DB_NAME','stikiproj');
}

if(!defined('VERSION')){
    define('VERSION','1.0');
}
 
$jamke = array("07.30 - 08.15", "08.15 - 09.00", "09.00 - 09.45", "09.45 - 10.30", "10.30 - 11.15", "11.15 - 12.00", "12.00 - 12.45", "12.45 - 13.30", "13.30 - 14.15", "14.15 - 15.00", "15.00 - 15.45", "15.45 - 16.30", "16.30 - 17.15", "17.30 - 18.15", "18.15 - 19.00", "19.00 - 19.45", "19.45 - 20.30", "20.30 - 21.15", "21.15 - 22.00");
?>