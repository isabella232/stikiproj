<?php

/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');

?>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#tampildata').load('moduls/datadosenloadata.php',{OPSI: 0});
    $('#pagging').load('moduls/datadosenloadata.php',{OPSI: 1});
    $('#caridosen').keyup(function(){
        loadata();
    });
    function loadata(){
        var y = $('#caridosen').val();
        $.ajax({
            type: 'POST',
				url: 'moduls/datadosenloadata.php',
				data: 'DOSEN='+y+'&OPSI=0',
				success:function(data)
				{
				    $('#tampildata').html(data);
                    $('#pagging').load('moduls/datadosenloadata.php',{OPSI: 1,DOSEN: $('#caridosen').val() });
				}
        });
    }
    
    $('#cmdnew').click(function(){
        $('#cmdnew').hide();
        $('#kopjadwal').hide();
        $('#tampildata').load('moduls/datadosenbaru.php');    
    });
    
});
</script>
<div class="alert alert-info">
    <i class="icon-briefcase"></i> Data Dosen
    <button id="cmdnew"> NEW </button>    
</div>

<div class="well txjudulmenu">
    <div id="kopjadwal">
    <input type="text" id="caridosen" class="caridata">
    <span id="pagging"></span>
    </div>
        
    <div id="tampildata"></div>
        
</div>