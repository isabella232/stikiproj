$(document).ready(function(){
    $('.lslapdetail').click(function(){
        var clicked_id = $(this).attr("id").split("-");
        var iddosen = parseInt(clicked_id[0]);
        var tgl1='';
        var tgl2='';
        $('#cmdnew').hide();
        $('#kopjadwal').hide();
        $('#tampildata').load('moduls/lap-dosendetail.php',{"IDDOSEN":iddosen,"TGL1": tgl1,"TGL2": tgl2});  
        return false;
    });
});