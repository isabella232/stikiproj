<?php
/**
 * @author Sinatria
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/datadosen.php');

$iddosen = $_POST['IDDOSEN'];

$pg = new DataDosen;

$datax = $pg->viewiddosen($iddosen);

?>
<style type="text/css">
#cmddosensimpan, #cmdbatal, #cmddosenhapus{
    margin-top: 20px;
    margin-left: 10px;
    width: 150px;
    height: 40px;
    cursor:pointer;
}
.erro{
    border-color: red;
}
.navx ul li{
    display: inline;
}
.filter{
    width: 80%;
    padding: 1%;
    background: #fff;
    -moz-box-shadow: 2px 3px 4px 0px #e9e9e9;
    -webkit-box-shadow: 2px 3px 4px 0px #e9e9e9;
    box-shadow: 2px 3px 3px 0px #e9e9e9;
    display: inline-block;
    margin-top: 1em;
}
.filter input {
    width: 75px;
}
button{
    height: 35px;
    width: 70px;
    margin-top: 0px;
    padding-top: 0px;
}
</style>
<link rel="stylesheet" href="css/bootstrap-datepicker.css">
<p>&nbsp;</p>
<div class="alert alert-info">
    <i class="icon-user"></i> Rekap Detail Absensi Dosen: <b>
    <?php 
    echo $datax['0'];
    if(!$datax[1]==""){
        echo " - " . $datax['1'];
    } 
    ?> </b>
    <ul class="navx pull-right">
    <li>
    <a href="#">Filter</a>
    
    </li>
    </ul>
</div>
<div class="filter">
Rekap Tgl <input type="text" id="tgl1"> - <input type="text" id="tgl2" />
<div id="tombol"> 
<button id="doit">Filter</button>
<button id="close">Tutup</button>
</div>
</div>
<div class="lodatax"></div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.filter').hide();
    $('.navx').click(function(){
        $('.filter').show();
    });
    $('#close').click(function(){
        $('.filter').hide();
    });
    $('#doit').click(function(){
       var tgl1x = $('#tgl1').val();
       var tgl2x = $('#tgl2').val();
       $('.lodatax').load('moduls/lap-dosendetailloadata.php',{'IDDOSEN': <?PHP echo $iddosen; ?>,'TGL1': tgl1x,'TGL2': tgl2x });
    });
    $('.lodatax').load('moduls/lap-dosendetailloadata.php',{'IDDOSEN': <?PHP echo $iddosen; ?> });
    $('#tgl1').datepicker({
        format: "yyyy/mm/dd"
    });
    $('#tgl2').datepicker({
        format: "yyyy/mm/dd"
    });
})
</script>