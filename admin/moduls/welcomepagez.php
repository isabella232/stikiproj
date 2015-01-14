<?php 
include('../../moduls/modsys/config.php');
include_once('../includes/config.inc.php');
include_once('../classes/pages.php');
$tx='';
$pg = new pages;
$tx = $pg->tampiltext(1);
?> 
<link href="css/redactor.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/redactor.min.js"></script>
<script type="text/javascript">
			$(document).ready(function(){
								
				$('#welcomepage').redactor({
					buttons: ['html', '|', 'bold', 'italic', 'underline', '|', 'formatting', '|','unorderedlist', 'orderedlist', 'outdent', 'indent', '|' , 'image','video', 'table', 'link', 'alignment', 'horizontalrule'],
                    imageUpload: 'moduls/upload.php',
                    autosave: 'moduls/savewelcome.php',
                    autosaveInterval: 120,
                    autosaveCallback: function(data)
                    {
                        console.log(json);
                    } 
				});
				
                $('#welcomepage').load('moduls/viewwelcome.php');
                $('#welcomepage').click(function(){
                    $('#psndata').html('');
                });
			});
            
            
            function sendForm()
                {    
                    var dtx =  $('#welcomepage').val();
                                        
                    $.ajax({
                        url: 'moduls/savewelcome.php',
                        type: 'post',
                        data: 'idpage=1&content=' + dtx,
                        dataType: "json",
                        success	: function(data){
				            $('#psndata').html(data.psn);
		  	           }
        
                    });
                }
</script>
                          
<div class="alert alert-info">
    <i class="icon-home"></i> Welcome Page
</div>
<div class="well blank-text">
    <div class="controls">
        <textarea name="welcomepage" class="input-xlarge" id="welcomepage" wrap="true"><?php echo $tx; ?></textarea>
    </div>
    <div class="controls">
        <button onclick="sendForm();"> Simpan </button>
    </div><br />
    <div id="psndata"></div>
</div>