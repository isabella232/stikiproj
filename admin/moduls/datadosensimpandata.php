<?php

/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/datadosen.php');

$dosen=$_POST['dosen'];
$pdd=$_POST['pdd'];
$nidn=$_POST['nidn'];

$pg = new DataDosen;
$hsl['stt'] = $pg->simpanbaru($dosen,$pdd,$nidn);
echo json_encode($hsl);
?>