$(document).ready(function(){
    $('#tampildata').load('moduls/ruangkelasloadata.php',{OPSI: 0});
    $('#pagging').load('moduls/ruangkelasloadata.php',{OPSI: 1});

    $('#caridosen').keyup(function(){
        loadata();
    });
    $('.lseditkelas').click(function(){

        var clicked_id = $(this).attr("id").split("-");
        var idpage = parseInt(clicked_id[0]);
        $('#cmdnew').hide();
        $('#kopjadwal').hide();
        $('#tampildata').load('moduls/ruangkelasdit.php',{"IDKELAS":idpage,OPSI: 0});
  
        return false;
    });
    function loadata(){
        var y = $('#caridosen').val();
        $.ajax({
            type: 'POST',
				url: 'moduls/ruangkelasloadata.php',
				data: 'DOSEN='+y+'&OPSI=0',
				success:function(data)
				{
				    $('#tampildata').html(data);
                    $('#pagging').load('moduls/ruangkelasloadata.php',{OPSI: 1,DOSEN: $('#caridosen').val() });
				}
        });
    }
    
    $('#cmdnew').click(function(){
        $('#cmdnew').hide();
        $('#kopjadwal').hide();
        $('#tampildata').load('moduls/ruangkelasbaru.php');    
    });

});