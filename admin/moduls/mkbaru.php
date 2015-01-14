<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/datamatakuliah.php');
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
<table>

<tr>
<td>Kode Matakuliah</td>
<td>: <input type="text" id="txkodemk" value="<?php echo $datax[2];?>"> <span id="loadhari" style="display: none;">*</span></td>
</tr>

<tr>
<td>Matakuliah</td>
<td>: <input type="text" id="txmk" value="<?php echo $datax[0];?>"></td>
</tr>

<tr>
<td>SKS</td>
<td>: <input type="text" id="txsks" value="<?php echo $datax[1];?>"></td>
</tr>

<tr>
<td>Jurusan</td>
<td>: 
<select id="txjurusan">
<option>SK</option>
<option>TI</option>
</select>
</td>
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
       var mk = $('#txmk').val();
       var sks = $('#txsks').val();
       var idmk = $('#txkodemk').val();
       var jur = $('#txjurusan').val(); 
       
       if(txerrket=="OK"){
            var dt = 'MK='+mk+'&SKS='+sks+'&IDMK='+idmk+'&JURUSAN='+jur;  
            $.ajax({
    			type	: "POST",
    			url		: "moduls/datamksimpandatabaru.php",
    			data	: dt,
                dataType: 'json',
    			success	: function(data){
alert(data.stt);
    		     	var url = "moduls/matakuliah.php";
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
		      var url = "moduls/matakuliah.php";
              $('.span9').load(url);
    		}
  		});
    });     
    $('#cmdbatal').click(function(){
        var url = "moduls/matakuliah.php";
        $('.span9').load(url);
    });
});
</script>