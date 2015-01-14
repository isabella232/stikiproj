<?php

/**
 * @author NudeSource
 * @copyright 2014
 */

include('../../moduls/config.php');
include('../classes/absendosen.php');

$JK = new AbsenDosen;
$hsl = $JK->dosenlist();
?>