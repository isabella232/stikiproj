<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 

$r="";
$ruang="";
if(isset($_GET['r'])){
    $ruang = "Ruang: " . $_GET['r'];
    $r = $_GET['r'];       
}
if(isset($_GET['ip'])){
    $ip=$_GET['ip'];        
}
if(isset($_GET['mac'])){
    $mac=$_GET['mac'];        
}
include('moduls/config.php');
include('admin/classes/absendosen.php');
$JK = new AbsenDosen;
$hsl = $JK->dosenlist();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<title>Check Point Dosen</title>
<link href="admin/css/styledosen.css" rel="stylesheet" type="text/css" />
<link href="admin/css/styledosencheck.css" rel="stylesheet" type="text/css" />
<link href='admin/css/FontsGoogle.css' rel='stylesheet' type='text/css' />
<link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css" /> 
</head>

<body>

<!-- Box Start-->
<div id="box_bg">

<div id="content">
	<h1>Check Dosen <?php echo $ruang;?></h1>
    <div id="jam"></div>
    
	<div class="errox">       
    </div>
	<!-- Login Fields -->
	<div id="login">
	<input type="text" onblur="if(this.value=='')this.value='Nama Dosen';" onfocus="if(this.value=='Nama Dosen')this.value='';" value="Nama Dosen" id="namadsn" class="login user"/>
	<div class="button green"><a href="#" id="idtampil">Tampilkan</a></div>
    
	</div>
	<div class="checkbox">
	<li>
	<fieldset>
	

	</fieldset>
	</li>
	
    <div id="tampildata"></div>
    </div>
	<!-- Green Button -->

</div>
</div>
<div id="loading" style="display:none"><img src="admin/img/loading.gif" /></div>

<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="js/jquery-ui.min.js" type="text/javascript"></script>
<script src="js/jqClock.min.js" type="text/javascript"></script>
<script type="text/javascript"> 
$(function() {
	
    $('#updateabsensi').load("admin/moduls/databsensi-cron.php");
    
    $('#idtampil').click(function(){
        var idsn = $('#namadsn').val();
        if(idsn.length>=4){
            loadata();
        }
    });
    
    $('.errox').hide();
    
    function loadata(){
        var idsn = $('#namadsn').val();
 
        $.ajax({
            type: 'POST',
				url: 'admin/moduls/absendosenlistID.php',
				data: 'IDSN='+idsn+'&RUANG=<?PHP echo $r;?>',
				success:function(data)
				{
				    $('#tampildata').html(data);
				}
        });
    }
    
    var auto_refresh = setInterval(function (){
        var idsn = $('#namadsn').val();
        if(idsn.length>=4){
            loadata();
        }
        $("#jam").load("admin/moduls/jamsistem.php"); 
    }, 1000);
 
});
</script>
<script type="text/javascript">
$(function() {
	
	//autocomplete
	$("#namadsn").autocomplete({
		source: "admin/moduls/search.php",
		minLength: 1
	});				

});
</script>
<style>
#jam1, #jam2{
    display: block;
    background-color:#004080;
    padding: 2px;
    text-align: center;
    border-radius: 8px;
}
#jam1 a, #jam2 a{
    text-decoration: none;
    color: white;
}
.errox{
    border-style: solid;
    color: red;
    font-weight: bold;
}
</style>

<script type="text/javascript" src="moduls/js/absendosen.js"></script>
<script type="text/javascript">
    function checkin(ex){
        var urlx = "admin/moduls/absendosen-inout.php";
        var d = new Date();
        var tgl = d.getDay();
        var bln = d.getMonth();
        var thn = d.getFullYear();
        var jam = d.getHours(); 
        var menit = d.getMinutes();
        var jam = (jam+":"+menit);
        var tgl = thn+'-'+bln+'-'+tgl;
        var masuk = 'IN';
        var idj = '';
        
        $('#tampildata').load(urlx, {'IDSN': (ex),'IDJ':idj,'JAMSKR':jam,'JNS':masuk}, function(){});
        
    }
    function checkout(ex){
        var urlx = "admin/moduls/absendosen-inout.php";
        var d = new Date();
        var tgl = d.getDay();
        var bln = d.getMonth();
        var thn = d.getFullYear();
        var jam = d.getHours(); 
        var menit = d.getMinutes();
        var jam = (jam+":"+menit);
        var tgl = thn+'-'+bln+'-'+tgl;
        var masuk = 'OUT';
        var idj = '';
        
        $('#tampildata').load(urlx, {'IDSN': (ex),'IDJ':idj,'JAMSKR':jam,'JNS':masuk}, function(){});
        
    }
</script>
<div id="tampildata1"></div>
<div id="updateabsensi"></div>
</body>
</html>