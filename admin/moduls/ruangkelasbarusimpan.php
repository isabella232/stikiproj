<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/ruangkelas.php');
$nmkelas = $_POST['KLS'];

$pg = new RuangKelas;
$hsl = $pg->ruangkelasbaru($nmkelas);
echo ($hsl);
?>