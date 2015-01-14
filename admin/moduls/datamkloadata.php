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
        var mk = $('#carimk').val();
        if(mk=="Filter Matakuliah"){
            mk="";
        }
                
        $('.paginate_click').removeClass('active');
        $("#tampildata").html('');
        $("#tampildata").load("moduls/datamkld.php", {'PAGE': (page_num-1),'OPSI':0,'MK':mk}, function(){});
        $(this).addClass('active');
        
        
        return false;
    });
});
</script>
<script type="text/javascript" src="moduls/js/datamatakuliah.js"></script>
<?PHP 
include('../../moduls/config.php');
include_once('../classes/datamatakuliah.php');

$page = '';
$hr=0;

if(isset($_POST['PAGE'])){
    $page = $_POST['PAGE'];
}
if(isset($_POST['MK'])){
    $hr=$_POST['MK'];   
}

$pg = new DataMatakuliah;

if($_POST['OPSI']==0){
    $txdata = $pg->listdata($page,$hr);
    echo $txdata;
}
if($_POST['OPSI']==1){
    $txdata = $pg->pagging($page,$hr);
    echo $txdata;
}
?>