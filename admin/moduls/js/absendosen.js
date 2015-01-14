$(document).ready(function(){
    $('.lseditrem').click(function(){
        
        var clicked_id = $(this).attr("id").split("-");
        var iddosen = parseInt(clicked_id[0]);
        
        $('#kopjadwal').hide();
        $('#tampildata').load('moduls/absensidosenedit.php',{"IDDOSEN":iddosen});
          
        return false;
    });
    $('#filabsen').click(function(){
        var tgl = $('#filtgl').val();
        var bln = $('#filbln').val();
        var thn = $('#filthn').val();
        var tglx = thn +"-"+bln+'-'+tgl;
        $('#tampildata').load('moduls/absendosenlist.php',{'TGL': tglx});
        $('#pagging').load('moduls/absendosenlistpagging.php',{OPSI: 1,DOSEN: $('#caridosen').val() });
    });    
});