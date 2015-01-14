<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
?>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
   	$('#loadingdata').ajaxStart(function(){
		$(this).fadeIn();
	}).ajaxStop(function(){
		$(this).fadeOut();
	});
	$("#theTable tr:even").addClass("stripe1");
	$("#theTable tr:odd").addClass("stripe2");
	$("#theTable tr").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
    
    $(".paginatekelas_click").change(function(){
        
        var clicked_id = $(this).val();
        var page_num = $(this).val();
        //var hari = parseInt(clicked_id[1]);
        var hari = $('#filterhari').val();
        
        $('.paginate_click').removeClass('active');
        $("#tampildata").html('');
        $("#tampildata").load("moduls/jadwalkuliahld.php", {'PAGE': (page_num-1),'OPSI':0,'HARI':hari}, function(){});
        $(this).addClass('active');
        return false;
    });
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

<?PHP 
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
    echo $txdata;
}
if($_POST['OPSI']==1){
    $txdata = $pg->pagging($page,$hr);
    echo $txdata;
}
?>