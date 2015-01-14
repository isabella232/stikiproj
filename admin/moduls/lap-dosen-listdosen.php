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
    
    $(".paginatekelas_click").change(function (){        
        var clicked_id = $(this).val();
        var page_num = clicked_id;
        var dsn = "";
        
        $('.paginaterekap_click').removeClass('active');
        $("#tampildata").html('');
        $("#tampildata").load("moduls/lap-dosenld.php", {'PAGE': (page_num-1),'OPSI':0}, function(){});
        $(this).addClass('active');
        return false;
    });
});
</script>
<script type="text/javascript" src="moduls/js/lap-dosen.js"></script>
<?PHP 
include('../../moduls/config.php');
include_once('../classes/absendosen.php');

$pg = new AbsenDosen;
$filter='';
$page = '';
$hr=0;
$tgl1= date('Y-m-d');
$bln = date('m');
$thn = date('Y');

$tgl2=$pg->tglbatas($tgl1);

if(isset($_POST['PAGE'])){
    $page = $_POST['PAGE'];
}
if(isset($_POST['tgl1'])){
    $tgl1 = $_POST['TGL1'];
}
if(isset($_POST['tgl2'])){
    $tgl2 = $_POST['TGL2'];
}
if(isset($_POST['filter'])){
    $filter = $_POST['filter'];
}

if($_POST['OPSI']==0){
    $txdata = $pg->rekapabsenlist($page,$tgl1,$tgl2,$filter);
    echo $txdata;
}
if($_POST['OPSI']==1){
    $txdata = $pg->paggingrekap($page,$hr);
    echo $txdata;
}
?>