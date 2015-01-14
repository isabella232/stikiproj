<?php

/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/jadwalkuliah.php');

$mk=$_POST['mk'];
$hr=$_POST['hr'];
$jmulai=$_POST['jmulai'];
$jselesai=$_POST['jselesai'];
$kls=$_POST['kls'];
$r=$_POST['r'];
$dsn=$_POST['dsn'];

$pg = new JadwalKuliah;
$hsl['stt'] = $pg->simpanbaru($mk,$hr,$jmulai,$jselesai,$kls,$r,$dsn);
echo json_encode($hsl);
?>