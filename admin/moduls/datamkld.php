<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include_once('../classes/datamatakuliah.php');

$page = '';
$hr='';

if(isset($_POST['PAGE'])){
    $page = $_POST['PAGE'];
}
if(isset($_POST['MK'])){
    $hr=$_POST['MK'];   
}

$pg = new DataMatakuliah;

if($_POST['OPSI']==0){
    $txdata = $pg->listdata($page,$hr);
}
echo $txdata;
?>
<script type="text/javascript" src="moduls/js/datamatakuliah.js"></script>