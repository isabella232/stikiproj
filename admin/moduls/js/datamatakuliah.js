$(document).ready(function(){
    $('.lsedit').click(function(){
        var clicked_id = $(this).attr("id").split("_");
        var idmk = (clicked_id[0]);
    
        $('#cmdnew').hide();
        $('#kopjadwal').hide();
        $('#tampildata').load('moduls/datamkedit.php',{"IDMK":idmk});  
        return false;
    });
});