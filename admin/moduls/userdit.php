<?php

/**
 * @author KucingManis
 * @copyright 2014
 */

if (isset($_POST['IDUSER'])){
    $usrid = $_POST['IDUSER'];
    
    include('../../moduls/config.php');
    include('../classes/useraccount.php');

    $pg = new UserAccount;
    $datax = $pg->username2data($usrid);
    if($datax[1]=="1"){
        $lv = "SYS Admin";
    }else{
        $lv = "Operator";
    }
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
#kopjadwal{
    display: block;
    background-color: #D9EDF7;
    border-color: #BCE8F1;
    text-shadow: 0px 1px 0px rgba(255, 255, 255, 0.5);
    border: 1px solid #FBEED5;
    border-radius: 4px;
    padding: 3px;
    margin: 10px 0 10px 0;
}
.infopwd{
    display: block;
    margin: 5px 0px 10px 0px;
    font-size: 14px;
    font-weight: bold;
}
</style>
<table>

<tr>
<td>User Name</td>
<td>: <input type="text" id="txnamaops" value="<?php echo $datax[0];?>" disabled="disabled"></td>
</tr>

<tr>
<td>Level</td>
<td>: <?php echo $lv;?></td>
</tr>
</table>
<table>

<div id="kopjadwal">Ubah Data</div>

<tr>
<td>Password Baru</td>
<td>: <input type="password" id="txpwd1"></td>
</tr>
<tr>
<td>Password Baru (Konfimasi)</td>
<td>: <input type="password" id="txpwd2"></td>
</tr>

<tr>
<td colspan="2"><div class="infopwd">Kosongkan Form jika tidak menghendaki adanya perusahan pada password lama</div></td>
</tr>

<tr>
<td>Ganti Hak Akses</td> 
<td>: <Select id='hakbaru'><option value="O">-</option><option value="1">SYS Admin</option><option value="2">Operator</option></Select></td>
</tr>

<tr>
<td><button id="cmddosensimpan">Simpan</button></td>
<td><button id="cmddosenhapus">Hapus</button> <button id="cmdbatal">Batal</button></td>
</table>

<script type="text/javascript">
$(document).ready(function(){
    $('#cmddosensimpan').click(function(){
        var pwd1 = $('#txpwd1').val();
        var levx = $('#hakbaru').val();
        
        
        if(!pwd1==""){
            var pwd2 = $('#txpwd2').val();
            if(pwd1==pwd2){
                dt = "MD=PWD&PWD=" + pwd2 + "&IDUSER=<?PHP echo $datax[2]; ?>";
                
                $.ajax({
        			type	: "POST",
        			url		: "moduls/userpwdedit.php",
        			data	: dt,
        			success	: function(data){
                        $('#txpwd1').val('');
                        $('#txpwd2').val('');
                        var url = "moduls/user.php";
                        $('.span9').load(url);
                        alert('Perubahan Password Sudah Sukses dilakukan');
                    }
                });    
            }else{
                alert('Pengetikan Password tidak sama\nHarap diperhatikan pengetikan Password Baru harus sama dengan password konfirmasi');
            }         
        }
        if(levx !="O"){
            dt = "MD=LEVEL&LEV=" + levx + "&IDUSER=<?PHP echo $datax[2]; ?>";
                
                $.ajax({
        			type	: "POST",
        			url		: "moduls/userpwdedit.php",
        			data	: dt,
        			success	: function(data){
    		     	    //alert('Perubahan Level Akses Sudah Sukses dilakukan');
                        var url = "moduls/user.php";
                        $('.span9').load(url);
                        alert('Perubahan Level Akses Sudah Sukses dilakukan');
                    }
                });
        } 
    })
    $('#cmddosenhapus').click(function(){
        var dt = "MD=HPS&IDUSER=<?PHP echo $datax[2];?>";
        $.ajax({
    		type	: "POST",
    		url		: "moduls/userpwdedit.php",
    		data	: dt,
    		success	: function(data){
		      var url = "moduls/user.php";
              $('.span9').load(url);
              alert('Penghapusan Data Sukses dilakukan');
    		}
  		});
    });
    $('#cmdbatal').click(function(){
        var url = "moduls/user.php";
        $('.span9').load(url);
    });
})
</script>
<?php 
}
?>