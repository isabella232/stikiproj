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

$pg = new AbsenDosen;
$filter='';
$page = '';
$hr=0;
$tgl1= date('Y-m-d');
$bln = date('m');
$thn = date('Y');

$tgl2=$pg->tglbatas($tgl1);

if(isset($_POST['PAGE'])){
    $page = $_POST['PAGE'];
}
if(isset($_POST['tgl1'])){
    $tgl1 = $_POST['TGL1'];
}
if(isset($_POST['tgl2'])){
    $tgl2 = $_POST['TGL2'];
}
if(isset($_POST['filter'])){
    $filter = $_POST['filter'];
}
if($_POST['OPSI']==0){
    $txdata = $pg->rekapabsenlist($page,$tgl1,$tgl2,$filter);
}
echo $txdata;
?>
<script type="text/javascript" src="moduls/js/lap-dosen.js"></script>