<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include_once('../classes/jadwalkuliah.php');

$page = '';
$hr=0;

if(isset($_POST['PAGE'])){
    $page = $_POST['PAGE'];
}
if(isset($_POST['HARI'])){
    $hr=$_POST['HARI'];   
}

$pg = new JadwalKuliah;

if($_POST['OPSI']==0){
    $txdata = $pg->listdata($page,$hr);
    //$txdata='DATA: ' . $page . " " . $hr;
}
echo $txdata;
?>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.lsedit').click(function(){
        var clicked_id = $(this).attr("id").split("-");
        var IDJADWALX = parseInt(clicked_id[0]);
        var HARIX = (clicked_id[1]);
        var MULAIJAMKEX = parseInt(clicked_id[2]);
        var RUANGX = (clicked_id[3]);
        $('#cmdnew').hide();
        $('#kopjadwal').hide();
        
        $('#tampildata').load('moduls/jadwalkuliahedit.php',{"IDJADWAL":IDJADWALX,"HARI":HARIX,"MULAIJAMKE":MULAIJAMKEX,"RUANG":RUANGX});  
        return false;
    });
    $('.lsdel').click(function(){
        var clicked_id = $(this).attr("id").split("-");
        var IDJADWALX = parseInt(clicked_id[0]);
        var HARIX = (clicked_id[1]);
        var MULAIJAMKEX = parseInt(clicked_id[2]);
        var RUANGX = (clicked_id[3]);
        $('#cmdnew').hide();
        $('#kopjadwal').hide();
        
        $('#tampildata').load('moduls/jadwalkuliahedit.php',{"IDJADWAL":IDJADWALX,"HARI":HARIX,"MULAIJAMKE":MULAIJAMKEX,"RUANG":RUANGX});  
        return false;
    });
});
</script>