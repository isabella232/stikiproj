<?php

/**
 * @author NudeSource
 * @copyright 2014
 */

include('../../moduls/config.php');
include('../classes/absendosen.php');

$idsn = $_POST['IDSN'];
$jam = $_POST['JAMSKR'];
$mdel = $_POST['JNS'];
$ket = $_POST['KET'];
$idj = "";

$GRHX = new AbsenDosen;
$GRH = $GRHX->checkinout($idsn,$idj,$jam,$mdel,$ket);

?>