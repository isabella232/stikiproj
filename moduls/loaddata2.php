<?PHP
session_start();
include_once('config.php');
include_once('jadwalkuliah.php');

//include('../admin/classes/absendosen.php');
//$GRHX = new AbsenDosen;

$cn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if ($cn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $cn->connect_errno . ") " . $cn->connect_error;
}

$JK = new jadwalkuliah;
$GRH = $JK->day2hari();

if(isset($_POST['GR'])){
    $GR = $_POST['GR'];
    $GR = str_replace('RUANG ','R.',$GR);
    $_SESSION['GR'] = $GR;
}else{
    $GR = $_SESSION['GR'];
}
if(isset($_POST['GRH'])){
    $GRH = $_POST['GRH'];
    $_SESSION['GRH'] = $GRH;
}else{
    $GRH = $_SESSION['GRH'];
}

$sql1 = "SELECT * FROM ruangkelas ORDER by kelompok, ruang";

//echo "nnn: ". $_SESSION['servertime'];

if (!($res1 = $cn->query($sql1))) {
    echo "Fetch failed: (" . $cn->errno . ") " . $cn->error;
}else{
    $jruang=0;
    $row1 = $res1->fetch_assoc();
    $kelompok = $row1['kelompok'];
    echo "<div class=\"row\">";
    $sql1 = "SELECT * FROM ruangkelas ORDER by kelompok, ruang";
    $res1 = $cn->query($sql1);
    while($row1 = $res1->fetch_assoc()){
        $datakelas[$jruang] = $row1['ruang'];
        $klp = trim($row1['kelompok']);
        if($klp==$kelompok){
        }else{
            $kelompok = trim($row1['kelompok']);
            echo "</div><div class=\"row\">";
        }
        
        $sqljamke=  "select jampertemuan.JAMKE from jampertemuan where jampertemuan.MULAI <= '" . $_SESSION['servertime'] . "' and jampertemuan.BERAKHIR >= '" . $_SESSION['servertime'] . "'
order by jampertemuan.JAMKE desc limit 0,1;";
        //$sql2 = "select * FROM jampertemuan where  MULAI <='" . $_SESSION['servertime'] . "' and BERAKHIR >= '" . $_SESSION['servertime'] . "';";
        if (!($resjamke2 = $cn->query($sqljamke))) {
            //echo "Fetch failed: (" . $cn->errno . ") " . $cn->error;
            die();
        }else{
            $rowresjamke2 = $resjamke2->fetch_assoc();
            $jamke = $rowresjamke2['JAMKE'];
        }
        //$sql2 = "Select jadwal.IDJADWAL, jadwal.MULAIJAMKE, jadwal.BERAKHIRJAMKE from jadwal where jadwal.HARI='" . $_SESSION['serverday'] . "' and jadwal.MULAIJAMKE=1 and jadwal.BERAKHIRJAMKE=3 order by jadwal.MULAIJAMKE;";
        $sql2 = "select 
	absensidosen.TGL, absensidosen.HARI, absensidosen.STTHDR,
	jadwal.MULAIJAMKE, jadwal.BERAKHIRJAMKE, jadwal.RUANG,
    dosen.DOSEN
from
	absensidosen
		inner join jadwal
			on absensidosen.IDJADWAL = jadwal.IDJADWAL
        inner join dosen
			on absensidosen.IDDOSEN = dosen.IDDOSEN
where
	absensidosen.TGL='" . $_SESSION['serverdatef'] . "' and jadwal.MULAIJAMKE=" . $jamke . " and jadwal.BERAKHIRJAMKE>=" . $jamke . " and jadwal.RUANG='" . $row1['ruang'] . "';";
        //echo $sql2;
        
        if (!($res2 = $cn->query($sql2))) {
            echo "Fetch failed: (" . $cn->errno . ") " . $cn->error;
        }else{
            $jml = 1;
            $row2 = $res2->fetch_assoc();
            $namadosen = $row2['DOSEN'];
            $stt = $row2['STTHDR'];
            $ruang = $row1['ruang'];
            if($stt==0){
                $stt='Off';
            }elseif($stt==1){
                $stt='On';
            }else{
                $stt='';
            }
            if($namadosen==""){
                $namadosen='&nbsp;';
                $stt='';
            }
        } 
              
        $jruang++;  

?>
    <div class="<?PHP  echo "col-" . $kelompok;?> col-lg-1" id="kotak">
        <div class="small-box-<?PHP echo $kelompok;?> bg-aqua">
            <div class="inner">
                <h3><?PHP  echo $ruang; ?></h3>
                <div id="nmdosen"><?PHP echo $namadosen;?></div>
                <div class="onoff"><?PHP echo $stt ?></div>
            </div>
        </div>
    </div>
<?PHP
      
    }
    echo "</div>";
    
}
?>