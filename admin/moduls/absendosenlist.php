<?php

/**
 * @author NudeSource
 * @copyright 2014
 */

include('../../moduls/config.php');
include('../classes/absendosen.php');


if(isset($_REQUEST['PG'])){
    $pg = $_REQUEST['PG'];
    $_SESSION['pg'] = $pg;
}else{
    $pg = $_SESSION['GRH'];
}
$tgl = '';
if(isset($_POST['TGL'])){
    $tgl = $_POST['TGL'];
}
echo $tgl;
$GRHX = new AbsenDosen;
$GRH = $GRHX->listabsen($tgl,$pg);
echo $GRH;
?>
<script type="text/javascript" src="moduls/js/absendosen.js"></script>