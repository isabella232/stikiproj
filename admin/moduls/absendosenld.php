<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include_once('../classes/absendosen.php');

$page = '';
$hr='';

if(isset($_POST['PAGE'])){
    $page = $_POST['PAGE'];
}
if(isset($_POST['DOSEN'])){
    $hr=$_POST['DOSEN'];   
}

$pg = new AbsenDosen;

if($_POST['OPSI']==0){
    $txdata = $pg->listdata($page,$hr);
}
echo $txdata;
?>
<script type="text/javascript" src="moduls/js/absendosen.js"></script>