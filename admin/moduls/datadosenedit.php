<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/datadosen.php');
$iddosen = $_POST['IDDOSEN'];

$pg = new DataDosen;
$datax = $pg->viewiddosen($iddosen);
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

<tr>
<td>Nama Dosen</td>
<td>: <input type="text" id="txnamadosen" value="<?php echo $datax[0];?>"> <span id="loadhari" style="display: none;">*</span></td>
</tr>

<tr>
<td>NIDN</td>
<td>: <input type="text" id="txnidn" value="<?php echo $datax[1];?>"></td>
</tr>

<tr>
<td>JENJANG</td>
<td>: <input type="text" id="txjanjang" value="<?php echo $datax[3];?>"></td>
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
       var dosen = $('#txnamadosen').val();
       var nidn = $('#txnidn').val();
       var pdd = $('#txjanjang').val();
       var iddosen = "<?PHP echo $datax[2];?>";
       
       if(txerrket=="OK"){
            var dt = 'dosen='+dosen+'&nidn='+nidn+'&iddosen='+iddosen+'&pdd='+pdd;    
            $.ajax({
    			type	: "POST",
    			url		: "moduls/datadosensimpandataedit.php",
    			data	: dt,
    			success	: function(data){
    		     	var url = "moduls/datadosen.php";
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
        var dt = "IDDOSEN=<?PHP echo $datax[2];?>";
        $.ajax({
    		type	: "POST",
    		url		: "moduls/datadosensimpandatahps.php",
    		data	: dt,
    		success	: function(data){
		      var url = "moduls/datadosen.php";
              $('.span9').load(url);
    		}
  		});
    });     
    $('#cmdbatal').click(function(){
        var url = "moduls/datadosen.php";
        $('.span9').load(url);
    });
});
</script>