<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/datamatakuliah.php');
$idmk = $_POST['IDMK'];

$pg = new DataMatakuliah;
$datax = $pg->viewidmk($idmk);
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
<?PHP
$pilihsk="";
$pilihti="";
if($datax[3]=="SK"){
    $pilihsk =  ' selected="selected"';
}else{
    $pilihti =  ' selected="selected"';
}
?>
<select id="txjurusan">
<option<?PHP echo $pilihsk;?>>SK</option>
<option<?PHP echo $pilihti;?>>TI</option>
</select>
</td>
</tr>

<tr>
<td><button id="cmdmksimpan">Simpan</button></td>
<td><button id="cmdmkhapus">Hapus</button> <button id="cmdbatal">Batal</button></td>
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
            var dt = 'MK='+mk+'&SKS='+sks+'&IDMK='+idmk+'&JURUSAN='+jur+'&IDMKLAMA=<?php echo $datax[2];?>';
            $.ajax({
    			type	: "POST",
    			url		: "moduls/datamksimpandataedit.php",
    			data	: dt,
                dataType: 'json',
    			success	: function(data){
    			    $('.span9').hide();
                    $('.span9').show(); 
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
        var dt = "IDMK=<?PHP echo $datax[2];?>";
        $.ajax({
    		type	: "POST",
    		url		: "moduls/datamksimpandatahps.php",
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