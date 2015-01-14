<?php

/**
 * @author NudeSource
 * @copyright 2014
 */

include('../../moduls/config.php');
include('../classes/absendosen.php'); 
$GRHX = new AbsenDosen;
$HR = $GRHX->day2hari();
echo $HR;
?>