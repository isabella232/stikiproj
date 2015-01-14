<?php

/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/datadosen.php');

$iddosen = $_POST['IDDOSEN'];

$pg = new DataDosen;
$hsl['stt'] = $pg->hapusdosen($iddosen);
echo json_encode($hsl);
?>