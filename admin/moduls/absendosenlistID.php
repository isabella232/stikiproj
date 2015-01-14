<?php

/**
 * @author NudeSource
 * @copyright 2014
 **/

include('../../moduls/config.php');
include('../../admin/classes/absendosen.php');

if(isset($_REQUEST['GRH'])){
    $GRH = $_REQUEST['GRH'];
    $_SESSION['GRH'] = $GRH;
}else{
    $GRH = $_SESSION['GRH'];
}
$tgl = '';
if(isset($_POST['TGL'])){
    $tgl = $_POST['TGL'];
}
if(isset($_POST['IDSN'])){
    $idsn = $_POST['IDSN'];
}
if(isset($_POST['RUANG'])){
    $ruang = $_POST['RUANG'];
}
$GRHX = new AbsenDosen;
$GRH = $GRHX->listabsenID($tgl,$idsn,$ruang);
echo $GRH;

?>