<?php

/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/datamatakuliah.php');

$idmk = $_POST['IDMK'];

$pg = new DataMatakuliah;
$hsl['stt'] = $pg->hapusmk($idmk);
echo json_encode($hsl);
?>