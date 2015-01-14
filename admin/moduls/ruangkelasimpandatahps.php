<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/ruangkelas.php');
$idkls = $_POST['IDKLS'];

$pg = new RuangKelas;
$hsl = $pg->ruangkelashapus($idkls);
echo ($hsl);
?>