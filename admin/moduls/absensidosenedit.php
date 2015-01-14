<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
?>
<style type="text/css">
select#jamhdr,#mnthdr{
    width: 50px;
}
select#stthdr{
    width: 110px;       
}
input#txdosen,#txket{
    width: 500px;
}
#btnsimpandata, #btnbatalsimpandata{
    margin-top: 20px;
    margin-left: 10px;
    width: 150px;
    height: 40px;
    cursor:pointer;
}
.erro{
    border-color: red;
}
</style>
<?php
include('../../moduls/config.php');
include('../classes/absendosen.php');
$iddosen = $_POST['IDDOSEN'];

$pg = new AbsenDosen;
$datax = $pg->remarkdosen($iddosen);
echo "<br>" . $datax;
?>
<script type="text/javascript">
$(document).ready(function(){
    $('#btnbatalsimpandata').click(function(){
        var url = "moduls/absendosen.php";
        $('.span9').load(url);    
    });
    $('#btnsimpandata').click(function(){
        var urlx = "moduls/absendosensimpan.php";
        var url = "moduls/absendosen.php";
        var iddosen = $('#txidosen').val();
        var stthdr = $('#stthdr').val();
        var jam = '00:00';
        var md = 0;
        var ket = $('#txket').val();
        var d = new Date();
        var tgl = d.getDay();
        var bln = d.getMonth();
        var thn = d.getFullYear();
        var tgl = thn+'-'+bln+'-'+tgl;
        var masuk = 'IN';
        var ex = '<?php echo $iddosen; ?>';
        if(stthdr=='Hadir'){
            md = 1;
            jam = $('#jamhdr').val() + ":" + $('#mnthdr').val();
        }else{
            if(ket.length==0){
                alert('Maaf, Field Keterangan masih kosong');
                $("#txket").focus();
                return false();
		    }
            masuk="IJIN";
        }
        
        $('.span9').load(urlx, {'IDSN': ex,'JAMSKR':jam,'TGLSKR':tgl,'JNS':masuk,'KET':ket}, function(){});
        $(".span9").delay(10000).fadeIn();
        $('.span9').load(url);
        return false();
    
    });   
});
</script>