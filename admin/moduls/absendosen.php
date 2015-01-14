<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
?>
<style type="text/css">
#hdr-ijin, #hdr-hdr, #hdr-blm{
    text-align: center;
    display: block;
    padding-right: 4px;
    padding-left: 4px;
    margin-right: 5px;
    -webkit-border-radius: 8px;
    border-radius: 8px;
}
#hdr-ijin{
    background-color: red;
    color: #ffffff;
}
#hdr-hdr{
    background-color: green;
    color: #ffffff;
}
#filtgl, #filbln,#filthn{
    width: 50px;
}
#filabsen{
    margin-top: 0px;
    margin-left: 10px;
    width: 100px;
    height: 35px;
    cursor:pointer;
}
</style>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  var tgl = $('#filthn').val() + "-" + $('#filbln').val() +"-"+$('#filtgl').val()   
  $('#hariini').load('moduls/databsensi-hari.php');  
  $('.lodata').load('moduls/databsensi-cron.php');
  $("#tampildata").delay(18000).fadeIn();
  $('#tampildata').load('moduls/absendosenlist.php',{'TGL': tgl});
  $('#pagging').load('moduls/absendosenlistpagging.php',{OPSI: 1,DOSEN: $('#caridosen').val() });
});
</script>

<div class="alert alert-info">
    <i class="icon-briefcase"></i> List Dosen Hari <strong><span id="hariini"></span></strong>
</div>

<div class="well txjudulmenu">
    <div id="kopjadwal">
<?PHP
include('../../moduls/config.php');
include('../classes/absendosen.php');
$GRHX = new AbsenDosen;
$GRH = $GRHX->filtertgl();
echo $GRH;
?>
    <span id="pagging"></span>
    </div>
        
    <div id="tampildata"></div>
        
</div>
<div class="lodata"></div>
<script type="text/javascript" src="moduls/js/absendosen.js"></script>
<script type="text/javascript">
    function checkin(ex){
        var urlx = "moduls/absendosen-inout.php";
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
        $('#tampildata').load('moduls/absendosenlist.php');
    }
    function checkout(ex){
        var urlx = "moduls/absendosen-inout.php";
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
        $('#tampildata').load('moduls/absendosenlist.php');
    }
</script>