<?php

/**
 * @author KucingManis
 * @copyright 2014
 */
session_start();

include('../../moduls/config.php');
include('../../admin/classes/absendosen.php');
$GRHX = new AbsenDosen;
$_SESSION['serverday'] = $GRHX->SERVERDAY();
$_SESSION['serverdate'] = $GRHX->SERVERDATE();
$_SESSION['servertime'] = $GRHX->SERVERTIME();
$_SESSION['serverdatef'] = $GRHX->SERVERDATEF();

$GRH = $GRHX->SERVERDAY();
$GRH .= ", ";
$GRH .= $GRHX->SERVERDATE();
$GRH .= "<br>Jam: ";
$GRH .= $GRHX->SERVERTIME();
echo $GRH;

?>