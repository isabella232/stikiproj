<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/ruangkelas.php');
$nmkelas = $_POST['KLS'];
$idkls = $_POST['IDKLS'];

$pg = new RuangKelas;
$hsl = $pg->ruangkelasedit($nmkelas,$idkls);
echo ($hsl);
?>