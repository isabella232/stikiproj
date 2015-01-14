<?php

/**
 * @author NudeSource
 * @copyright 2014
 */

?>
<div class="alert alert-info">
    <i class="icon-file"></i> Rekap Absensi Dosen  
</div>

<div class="well txjudulmenu">
    <div id="kopjadwal">
    <input type="text" id="caridosen" class="caridata">
    
        <span id="pagging"></span>
    </div>
    
    <div id="tampildata"></div>
        
</div>
<div class="lodata"></div>

<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    
    $('#tampildata').load('moduls/lap-dosen-listdosen.php',{'OPSI': 0 });
    $('#pagging').load('moduls/lap-dosen-listdosen.php',{'OPSI': 1 });
    $('#caridosen').keyup(function(){
        loadata();
    });
    function loadata(){
        var y = $('#caridosen').val();
        $.ajax({
            type: 'POST',
				url: 'moduls/lap-dosen-listdosen.php',
				data: 'filter='+y+'&OPSI=0',
				success:function(data)
				{
				    $('#tampildata').html(data);
                    $('#pagging').load('moduls/lap-dosen-listdosen.php',{OPSI: 1 });
				}
        });
    }
});
</script>