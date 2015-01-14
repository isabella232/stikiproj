<?php

/**
 * @author Sinatria
 * @copyright 2014
 */

include('../../moduls/config.php');
include('../classes/absendosen.php');
$tgl1='';
$tgl2='';
if(isset($_POST))
$pg = new AbsenDosen;
$datax = $pg->viewiddosen($iddosen);
?>