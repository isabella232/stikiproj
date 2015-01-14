<?php
/**
 * @author NudeSource
 * @copyright 2014
 */

include('../../moduls/config.php');
include('../classes/absendosen.php');

$idsn = $_REQUEST['IDSN'];
$jam = $_REQUEST['JAMSKR'];
$mdel = $_REQUEST['JNS'];
$idj = $_REQUEST['IDJ'];
$ket = '';

$JK = new AbsenDosen;
$hsl = $JK->checkinout($idsn,$idj,$jam,$mdel,$ket);
echo $hsl;
?>