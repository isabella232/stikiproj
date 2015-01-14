<?php

/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/datadosen.php');

$dosen=$_POST['dosen'];
$nidn=$_POST['nidn'];
$pdd=$_POST['pdd'];
$iddosen=$_POST['iddosen'];

$pg = new DataDosen;
$hsl['stt'] = $pg->simpanedit($dosen,$nidn,$pdd,$iddosen);
echo json_encode($hsl);
?>