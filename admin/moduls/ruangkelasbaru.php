<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/ruangkelas.php');
//$idmk = $_POST['IDMK'];

//$pg = new DataMatakuliah;
//$datax = $pg->viewiddosen($iddosen);
for($i=0;$i<=2;$i++){
    $datax[$i]="";
}
?>
<style type="text/css">
#cmdmksimpan, #cmdbatal, #cmdmkhapus{
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
<td>Ruang Kelas</td>
<td>: <input type="text" id="txkelas"> <span id="loadhari" style="display: none;">*</span></td>
</tr>

<tr>
<td><button id="cmdmksimpan">Simpan</button></td>
<td><button id="cmdbatal">Batal</button></td>
</table>

<script type="text/javascript">
$(document).ready(function(){
    
    $('#cmdmksimpan').click(function(){
       var txerrket = "OK";
       var txerr = "";
       var mk = $('#txkelas').val();
       
       if(txerrket=="OK"){
            var dt = 'KLS='+mk;
            
            $.ajax({
    			type	: "POST",
    			url		: "moduls/ruangkelasbarusimpan.php",
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
    $('#cmdmkhapus').click(function(){
        var dt = "IDDOSEN=<?PHP echo $datax[2];?>";
        $.ajax({
    		type	: "POST",
    		url		: "moduls/datadosensimpandatahps.php",
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