<?php

/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/datamatakuliah.php');

$mk=$_POST['MK'];
$sks=$_POST['SKS'];
$jur=$_POST['JURUSAN'];
$idmk=$_POST['IDMK'];
$pg = new DataMatakuliah;
$hsl['stt'] = $pg->simpanbaru($mk,$sks,$jur,$idmk);
echo json_encode($hsl);
?>