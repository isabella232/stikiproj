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
    $('#tampildata').load('moduls/datamkloadata.php',{OPSI: 0});
    $('#pagging').load('moduls/datamkloadata.php',{OPSI: 1});
    $('#carimk').keyup(function(){
        loadata();
    });
    function loadata(){
        var y = $('#carimk').val();
        $.ajax({
            type: 'POST',
				url: 'moduls/datamkloadata.php',
				data: 'MK='+y+'&OPSI=0',
				success:function(data)
				{
				    $('#tampildata').html(data);
                    $('#pagging').load('moduls/datamkloadata.php',{OPSI: 1,MK: $('#carimk').val() });
				}
        });
    }
    
    $('#cmdnew').click(function(){
        $('#cmdnew').hide();
        $('#kopjadwal').hide();
        $('#tampildata').load('moduls/mkbaru.php');    
    });
    
});
</script>
<div class="alert alert-info">
    <i class="icon-list-alt"></i> Matakuliah
    <button id="cmdnew"> NEW </button>    
</div>

<div class="well txjudulmenu">
    <div id="kopjadwal">
    <input type="text" id="carimk" class="caridata" onblur="if(this.value=='')this.value='Filter Matakuliah';" onfocus="if(this.value=='Filter Matakuliah')this.value='';" value="Filter Matakuliah">
    <span id="pagging"></span>
    </div>
        
    <div id="tampildata"></div>
        
</div>