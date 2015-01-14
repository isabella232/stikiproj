$(document).ready(function(){
    $('.lsedit').click(function(){
        var clicked_id = $(this).attr("id").split("-");
        var iddosen = parseInt(clicked_id[0]);
        $('#cmdnew').hide();
        $('#kopjadwal').hide();
        $('#tampildata').load('moduls/datadosenedit.php',{"IDDOSEN":iddosen});  
        return false;
    });
});