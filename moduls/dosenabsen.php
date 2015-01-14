<?php
/**
 * @author NudeSource
 * @copyright 2014
 */

include_once('config.php');
$cn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if ($cn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $cn->connect_errno . ") " . $cn->connect_error;
}

$idsn = $_REQUEST['IDSN'];
$jam = $_REQUEST['JAMSKR'];
$tgl = $_REQUEST['TGLSKR'];
$mdel = $_REQUEST['JNS'];
$tgl = date('Y-m-d');

if(($mdel=="IN")){
    $sql1 = "UPDATE absensidosen SET JAM1='" . $jam . "', STTHDR='1' WHERE IDDOSEN='" . $idsn . "' and TGL='" . $tgl . "';";
}elseif($mdel=="OUT"){
    $sql1 = "UPDATE absensidosen SET JAM2='" . $jam . "' WHERE IDDOSEN='" . $idsn . "' and TGL='" . $tgl . "';";
}elseif($mdel=="IJIN"){
    $ket = $_REQUEST['KET'];
    $sql1 = "UPDATE absensidosen SET STTHDR='2', KET='" . $ket .  "' WHERE IDDOSEN='" . $idsn . "' and TGL='" . $tgl . "';";
}

if($mdel=="REM"){
    $sql2 = "SELECT DOSEN FROM DOSEN WHERE IDDOSEN='" . $idsn . "';";
    if (!($res2 = $cn->query($sql2))) {
        echo "Fetch failed: (" . $cn->errno . ") " . $cn->error;
    }else{
        while($row1 = $res2->fetch_assoc()){
            $dosen = $row1['DOSEN'];
        }
    }
    
    echo "<div class='headerdl'>Data Dosen</div>";
    echo "<table>";
    
    echo "<tr>";
    echo "<td id='labelx'>Nama Dosen</td>";
    echo "<td><input type='text' id='txdosen' value='" . $dosen . "'></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td id='labelx'>Status Hadir</td>";
    echo "<td><select id='stthdr'><option>Hadir</option><option>Ijin</option></select></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td id='labelx'>Jam Hadir</td>";
    echo "<td><select id='jamhdr'>";
    for($i=7;$i<=22;$i++){
        $jm = $i;
        if(strlen($i)<2){
            $jm = "0" . $i;
        }
        echo "<option>$jm</option>";
    }
    echo "</select><select id='mnthdr'>";
    for($i=0;$i<=59;$i++){
        $jm = $i;
        if(strlen($i)<2){
            $jm = "0" . $i;
        }
        echo "<option>$jm</option>";
    }
    echo "</select>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td id='labelx'>Keterangan</td>";
    echo "<td><input type='text' id='txket'></td>";
    echo "</tr>";
    
    echo "</table>";
    echo "<button class='btnsimpandata'>Simpan Data</button> <button Class='btnbatalsimpandata'>Batal</button>";
}else{
    $cn->query($sql1);
?>
<script>
    closewind();
</script>
<?php 
}
?>
<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.btnbatalsimpandata').click(function(){
        closewind();
    });
    $('.btnsimpandata').click(function(){
        var stthdr = $('#stthdr').val();
        var jam = '00:00';
        var md = 0;
        var ket = $('#txket').val();
        var urlx = "moduls/dosenabsen.php";
        var d = new Date();
        var tgl = d.getDay();
        var bln = d.getMonth();
        var thn = d.getFullYear();
        var tgl = thn+'-'+bln+'-'+tgl;
        var masuk = 'IN';
        var ex = '<?php echo $idsn; ?>';
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
        $('.dosenlist').load(urlx, {'IDSN': ex,'JAMSKR':jam,'TGLSKR':tgl,'JNS':masuk,'KET':ket}, function(){});
        return false();
    });
});
</script>