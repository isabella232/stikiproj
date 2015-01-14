<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/ruangkelas.php');
$idkls = $_POST['IDKELAS'];

$pg = new RuangKelas;
$datax = $pg->viewidkelas($idkls);
?>
<style type="text/css">
#cmddosensimpan, #cmdbatal, #cmddosenhapus{
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
<table>
<br />
<tr>
<td>Ruang Kelas</td>
<td>: <input type="text" id="txkls" value="<?php echo $datax;?>"> <span id="loadhari" style="display: none;">*</span></td>
</tr>

<tr>
<td><button id="cmddosensimpan">Simpan</button></td>
<td><button id="cmddosenhapus">Hapus</button> <button id="cmdbatal">Batal</button></td>
</table>

<script type="text/javascript">
$(document).ready(function(){
    
    $('#cmddosensimpan').click(function(){
       var txerrket = "OK";
       var txerr = "";
       var nmkls = $('#txkls').val();
       var idkls = "<?PHP echo $idkls;?>";

       if(txerrket=="OK"){
            var dt = 'KLS='+nmkls+'&IDKLS='+idkls;    
            $.ajax({
    			type	: "POST",
    			url		: "moduls/ruangkelasimpandataedit.php",
    			data	: dt,
    			success	: function(data){
    		     	var url = "moduls/ruangkelas.php";
                     $('.span9').load(url);
    			}
    		});
        }else{
            txerr="Form Isian ada yang salah diantaranya:"+txerr+"\nSilahkan di Check Kembali";
            alert(txerr);
            return false;
        }      
    });
    $('#cmddosenhapus').click(function(){
        var dt = "IDKLS=<?PHP echo $idkls;?>";
        $.ajax({
    		type	: "POST",
    		url		: "moduls/ruangkelasimpandatahps.php",
    		data	: dt,
    		success	: function(data){
		      var url = "moduls/ruangkelas.php";
              $('.span9').load(url);
    		}
  		});
    });     
    $('#cmdbatal').click(function(){
        var url = "moduls/ruangkelas.php";
        $('.span9').load(url);
    });
});
</script>