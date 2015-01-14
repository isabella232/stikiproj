<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
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
<br />
<table>

<tr>
<td>Nama Dosen</td>
<td>: <input type="text" id="txnamadosen"> <span id="loadhari" style="display: none;">*</span></td>
</tr>

<tr>
<td>NIDN</td>
<td>: <input type="text" id="txnidn"></td>
</tr>

<tr>
<td>JENJANG</td>
<td>: <input type="text" id="txjanjang"></td>
</tr>

<tr>
<td><button id="cmddosensimpan">Simpan</button></td>
<td><button id="cmdbatal">Batal</button></td>
</table>


<script type="text/javascript">
$(document).ready(function(){
        
    $('#cmddosensimpan').click(function(){
    
       var txerrket = "OK";
       var txerr = "";
       var dosen = $('#txnamadosen').val();
       var nidn = $('#txnidn').val();
       var pdd = $('#txjanjang').val();
       
       if(txerrket=="OK"){
            var dt = 'dosen='+dosen+'&nidn='+nidn+'&pdd='+pdd;
            
            $.ajax({
    			type	: "POST",
    			url		: "moduls/datadosensimpandata.php",
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
         
    $('#cmdbatal').click(function(){
        var url = "moduls/datadosen.php";
        $('.span9').load(url);
    });
});
</script>