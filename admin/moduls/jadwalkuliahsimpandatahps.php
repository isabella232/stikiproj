<?php

/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/jadwalkuliah.php');

$idjadwal = $_POST['idjadwal'];

$pg = new JadwalKuliah;
$hsl['stt'] = $pg->hapusjadwal($idjadwal);
echo json_encode($hsl);
?>