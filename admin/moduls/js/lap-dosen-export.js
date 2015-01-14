$(document).ready(function(){
    $('#expExcel').click(function(){
        var iddosen = 'Nama Dosen Stiki';
        //var url = 'moduls/lap-dosen-2xls.php';
        $(location).attr('href','moduls/lap-dosen-2xls.php');
        //$('#tampildata').load('moduls/lap-dosen-2xls.php',{"IDDOSEN":iddosen});
        return false;
    });
});