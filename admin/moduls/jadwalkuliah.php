<?php

/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
/*
$page = '';
$pg = new JadwalKuliah;
$txpagging = $pg->listdata($page,0);
*/
?>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#tampildata').load('moduls/jadwalkuliahloadata.php',{OPSI: 0});
    $('#pagging').load('moduls/jadwalkuliahloadata.php',{OPSI: 1});
    $('#filterhari').change(function(){
        
        loadata();
    });
    function loadata(){
        var y = $('#filterhari').val();
        
        $.ajax({
            type: 'POST',
				url: 'moduls/jadwalkuliahloadata.php',
				data: 'HARI='+y+'&OPSI=0',
				success:function(data)
				{
				    $('#tampildata').html(data);
                    $('#pagging').html('');
                    $('#pagging').load('moduls/jadwalkuliahloadata.php',{OPSI: 1,HARI: $('#filterhari').val() });
				}
        });
    }
    
    $('#cmdnew').click(function(){
        $('#cmdnew').hide();
        $('#kopjadwal').hide();
        $('#tampildata').load('moduls/jadwalkuliahbaru.php');    
    });
    
});
</script>
<div class="alert alert-info">
    <i class="icon-calendar"></i> JADWAL PERKULIAHAN
    <button id="cmdnew"> NEW </button>    
</div>

<div class="well txjudulmenu">
    <div id="kopjadwal">
    <select id="filterhari"><option value="0">SEMUA HARI</option><option value="1">SENIN</option><option value="2">SELASA</option><option value="3">RABU</option><option value="4">KAMIS</option><option value="5">JUMAT</option><option value="6">SABTU</option></select>
    <span id="pagging"></span>
    </div>
        
    <div id="tampildata"></div>
        
</div>
