<?php
/**
 * @author Sinatria
 * @copyright 2014
 */
 
include('../../moduls/config.php');
include('../classes/absendosen.php');
$pg = new AbsenDosen;
$iddosen = $_POST['IDDOSEN'];
if(isset($_POST['TGL1'])){
    $tgl1=$_POST['TGL1']; 
    $tgl2=$_POST['TGL2'];   
}else{
    $tgl1 = date('Y-m') . "-01";
    $tgl2 = $pg->tglbatas($tgl1);
}
if(isset($_POST['TGL2'])){
    $tgl2=$_POST['TGL2'];    
}
$datax = $pg->lapdosendetail($iddosen,$tgl1,$tgl2);
echo $datax;
?>
<div id="tampildata"></div>
<script type="text/javascript" src="moduls/js/lap-dosen-export.js"></script>