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
    $('.lseditkelas').click(function(){
        
        var clicked_id = $(this).attr("id").split("-");
        var idpage = parseInt(clicked_id[0]);
        $('#cmdnew').hide();
        $('#kopjadwal').hide();
        $('#tampildata').load('moduls/ruangkelasdit.php',{"IDKELAS":idpage,OPSI: 0});
          
        return false;
    });
    $(".paginatekelas_click").change(function(){
        
        var clicked_id = $(this).val();
        var page_num = parseInt(clicked_id[0]);
        var dsn = (clicked_id[1]);
        
        $('.paginatekelas_click').removeClass('active');
        $("#tampildata").html('');
        $("#tampildata").load("moduls/ruangkelasld.php", {'PAGE': (page_num-1)}, function(){});
        $(this).addClass('active');
        return false;
    });
});
</script>

<?PHP 
include('../../moduls/config.php');
include_once('../classes/ruangkelas.php');

$page = '';
$hr=0;

if(isset($_POST['PAGE'])){
    $page = $_POST['PAGE'];
}
$pg = new RuangKelas;

if($_POST['OPSI']==0){
    $txdata = $pg->ruanglist($page);
    echo $txdata;
}
if($_POST['OPSI']==1){
    $txdata = $pg->pagging('');
    echo $txdata;
}
?>