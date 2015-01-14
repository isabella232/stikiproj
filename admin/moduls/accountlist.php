<?php
include('../../moduls/config.php');
/**
 * @author NudeSource
 * @copyright 2014
 */
if(!isset($_SESSION)){
    session_start();
};
include('../classes/useraccount.php');

$uname = $_SESSION['LOGINID'];

$JK = new UserAccount;
$hsl = $JK->username2data($uname);
$lvl=$hsl[1];
if($hsl[1]==1){
    $lvl = 'Administrator';
}elseif($hsl[1]==2){
    $lvl = 'Operator';
}elseif($hsl[1]==3){
    $lvl = 'Dosen';
}
?>
<style type="text/css">
#cmdupdate{
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
<?PHP
echo "<br>";
echo "<table border='0'><tr>";
echo "<td>USER NAME</td>";
echo "<td><input type='text' id='uname' value='" . $uname . "' disabled='disabled'></td></tr>";
echo "<tr><td colspan='2'></tr>";
echo "<td>USER LEVEL</td>";
echo "<td><input type='text' id='uname' value='" . $lvl . "' disabled='disabled'></td></tr>";
echo "<tr><td colspan='2'><hr>Ganti Password</tr>";
echo "<tr><td>Password Lama</td>";
echo "<td><input type='password' id='txpwdlama'></td></tr>";
echo "<tr><td>Password Baru</td>";
echo "<td><input type='password' id='txpwdbaru1'></td></tr>";
echo "<tr><td>Verifikasi Password Baru</td>";
echo "<td><input type='password' id='txpwdbaru2'></td></tr>";
echo "<tr><td></td>";
echo "<td><button id='cmdupdate'>Update</button></td></tr>";
echo "</tr></table><div class='test'></div>";

?>
<div class='loadata'></div>
<script type="text/javascript">
$(document).ready(function(){
  $('#cmdupdate').click(function(){
     var pwd0 = $('#txpwdlama').val();
     var pwd1 = $('#txpwdbaru1').val();
     var pwd2 = $('#txpwdbaru2').val();
     
     if(pwd1==pwd2){
        $.ajax({
            type: 'POST',
				url: 'moduls/accountpwd.php',
				data: 'PWDLAMA='+pwd0+'&PWD1='+pwd1+'&PWD2='+pwd2,
				success:function(data)
				{ 
				    if(data==1){    
				        alert('Perubahan Password telah Berhasil dilakukan\nSilahkan Lakukan Login Ulang');
                        location.href = 'dashboard.php?logout';
                    }else{
                        alert('Perubahan Password Tidak Berhasil dilakukan\nSilahkan Lakukan kembali');
                    }
				}
        });        
     }else{
        alert('Perubahan Password Tidak Berhasil dikarenakan Verifikasi Password tidak Valid\nPassword Baru tidak sama dengan Verifikasi Password nya');
     }  
  });
});
</script>