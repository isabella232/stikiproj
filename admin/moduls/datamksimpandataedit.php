<?php

/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/datamatakuliah.php');

$mk=$_POST['MK'];
$sks=$_POST['SKS'];
$idmk=$_POST['IDMK'];
$jur=$_POST['JURUSAN'];
$idlama=$_POST['IDMKLAMA'];

$pg = new DataMatakuliah;
$hsl['stt'] = $pg->simpanedit($mk,$sks,$jur,$idmk,$idlama);
echo json_encode($hsl);
?>