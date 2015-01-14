<?php

/**
 * @author KucingManis
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
<td>: <input type="text" id="txnamaops"></td>
</tr>

<tr>
<td>Password</td>
<td>: <input type="password" id="txpwd1"></td>
</tr>
<tr>
<td>Password (Konfimasi)</td>
<td>: <input type="password" id="txpwd2"></td>
</tr>

<tr>
<td>Ganti Hak Akses</td> 
<td>: <Select id='hakbaru'><option value="1">SYS Admin</option><option value="2">Operator</option></Select></td>
</tr>

<tr>
<td><button id="cmddosensimpan">Simpan</button>
<button id="cmdbatal">Batal</button></td>
</table>

<script type="text/javascript">
$(document).ready(function(){
    $('#cmddosensimpan').click(function(){
        var pwd1 = $('#txpwd1').val();
        var levx = $('#hakbaru').val();
        var user = $('#txnamaops').val();
        
        if(!pwd1==""){
            var pwd2 = $('#txpwd2').val();
            if(pwd1==pwd2){
                dt = "MD=NEW&IDUSER=&PWD=" + pwd1 + "&USER=" + user + "&LEV=" + levx;
                
                $.ajax({
        			type	: "POST",
        			url		: "moduls/userpwdedit.php",
        			data	: dt,
        			success	: function(data){
                        $('#txpwd1').val('');
                        $('#txpwd2').val('');
                        var url = "moduls/user.php";
                        $('.span9').load(url);
                        alert('Penambahan User Sukses ');
                    }
                });    
            }else{
                alert('Pengetikan Password tidak sama\nHarap diperhatikan pengetikan Password Baru harus sama dengan password konfirmasi');
            }         
        }
    })
    $('#cmdbatal').click(function(){
        var url = "moduls/user.php";
        $('.span9').load(url);
    });
})
</script>