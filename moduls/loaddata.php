<?PHP
//session_start();
include_once('config.php');
include_once('jadwalkuliah.php');

/*
function cekdosen(){
    $cn = new mysqli("localhost", "root", "", "stikiproj");
    if ($cn->connect_errno) {
        echo "Failed to connect to MySQL: (" . $cn->connect_errno . ") " . $cn->connect_error;
    }
    
    $sqlhdr = "CALL ishdrdosen('',);";
}
*/
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

$sql1 = "SELECT * FROM ruangkelas WHERE ruang like '" . $GR . "%';";
//$sql1 = "CALL ruangkelas_list('" . $GR . "');";

if (!($res1 = $cn->query($sql1))) {
    echo "Fetch failed: (" . $cn->errno . ") " . $cn->error;
}else{
    $jruang=0;
    while($row1 = $res1->fetch_assoc()){
        $datakelas[$jruang] = $row1['ruang'];
        
        $sql2 = "SELECT * FROM list WHERE hari='" . $GRH . "' and ruang like '" . $row1['ruang'] . "%';";
//        $sql2 = "SELECT * FROM list WHERE hari='SENIN' and ruang like '" . $row1['ruang'] . "';";
        
//        echo $sql2 . "<br>";
        
        if (!($res2 = $cn->query($sql2))) {
            echo "Fetch failed: (" . $cn->errno . ") " . $cn->error;
        }else{
            $xx=0;
            for($i=0;$i<19;$i++){
                $datajadwal[$jruang][$i][0] = "";
                $datajadwal[$jruang][$i][1] = "";
                $datajadwal[$jruang][$i][2] = "";
                $datajadwal[$jruang][$i][3] = "";
                $datajadwal[$jruang][$i][4] = "";
                $datajadwal[$jruang][$i][5] = "";
                $datajadwal[$jruang][$i][6] = "";
            }
            
            while($row2 = $res2->fetch_assoc()){
                $jj = $row2['berakhirjamke'] - $row2['mulaijamke'] + 1;
                $xx1 = $row2['mulaijamke']-1;
                $datajadwal[$jruang][$xx1][0] = $row2['matakuliah'];
                $datajadwal[$jruang][$xx1][1] = $row2['kelas'];
                $datajadwal[$jruang][$xx1][2] = $row2['namadosen'];
                $datajadwal[$jruang][$xx1][3] = $row2['mulaijamke'];
                $datajadwal[$jruang][$xx1][4] = $row2['berakhirjamke'];
                $datajadwal[$jruang][$xx1][5] = $jj;
                $datajadwal[$jruang][$xx1][6] = $row2['iddosen'];
                
                $ml = $datajadwal[$jruang][$xx1][3];
                
                for($cx=$ml; $cx<$jj+$ml-1; $cx++){
                    $datajadwal[$jruang][$cx][0] = "XXX";
                    $datajadwal[$jruang][$cx][1] = "";
                    $datajadwal[$jruang][$cx][2] = "";
                    $datajadwal[$jruang][$cx][3] = "";
                    $datajadwal[$jruang][$cx][4] = "";
                    $datajadwal[$jruang][$cx][5] = $jj+$ml-$cx;
                    $datajadwal[$jruang][$cx][6] = "";
                }
                
            }
        }
        $jruang++;
    }
}
?>
<table class="gridtable">
<tr>
<th id="jamke">JAM<br>KE</th>
<th id="jamx">JAM</th>
<?php 

$xx = 0;
foreach($datakelas as $x_value)
   {
    
   echo "<th><div id=\"jd\">" . $x_value . "</div></th>\n";
   $xx++;
   }
?>
</tr>

<?PHP
$xx = $xx;
for($jamkex=0;$jamkex<19;$jamkex++){
    $pertemuan = $jamkex+1;
?>
<tr> 
<td id="jamkeisi" class="jam<?php echo $pertemuan; ?>"><?php echo $pertemuan; ?></td>
<td class="jam<?php echo $pertemuan; ?>"><?PHP echo $jamke[$jamkex];?></td>
<?PHP

for($ruangkex=0;$ruangkex<$xx;$ruangkex++){  
        $mk =  $datajadwal[$ruangkex][$jamkex][0];
        $jam = $datajadwal[$ruangkex][$jamkex][3];
        $dsn = $datajadwal[$ruangkex][$jamkex][2];
        $sks = $datajadwal[$ruangkex][$jamkex][5];
        $kls = $datajadwal[$ruangkex][$jamkex][1];
        $idsn = $datajadwal[$ruangkex][$jamkex][6];
        
            if($jam==$pertemuan){
                $jamz ="";
                for($z=1;$z<=$sks;$z++){
                    $jamz .= "jam" . $z . " ";    
                }
                $tgl = date('Y-m-d');
                $sql3 = "SELECT STTHDR, STTKLS, KET FROM absensidosen WHERE TGL='" . $tgl . "' and IDDOSEN=" . $idsn . ";";
                $sql3 = "SELECT A.STTHDR, A.STTKLS, A.KET FROM absensidosen as A inner join jadwal as J on A.IDJADWAL = J.IDJADWAL WHERE A.TGL='" . $tgl . "' and A.IDDOSEN=" . $idsn . " and J.MULAIJAMKE=" . $jam . ";"; 
                $sttdosen='';
                if (!($res3 = $cn->query($sql3))) {
                    echo "Fetch failed: (" . $cn->errno . ") " . $cn->error;
                }else{
                    $row3 = $res3->fetch_assoc();
                
                    $sttdosen = $row3['STTHDR'];
                    $sttkls = $row3['STTKLS'];
                    $ket = $row3['KET'];
                    if($sttdosen=='1'){
                        
                        if($sttkls=='1'){
                            $sttdosen='<span class="legendmerah">Hadir</span>';
                        }else{
                            $sttdosen='<span class="legendhijau">Selesai</span>';
                        }
                        
                    }elseif($sttdosen=='2'){
                        $sttdosen='<span class="legendkuning">IJIN [' . $ket . ']</span>';
                    }else{
                        $sttdosen='';
                    }
                }
                echo "<td id=\"jd\" class=\"$jam\" rowspan=\"" . $sks . "\">";
                echo $mk . "-" . $kls;
                echo "<br>" . $dsn . "<br>$sttdosen";
                echo "</td>\n";
            }else{
                if($mk=="XXX"){
        
                }else{
                    echo "<td id=\"jd\" class=\"$jamkex\">&nbsp;</td>\n";
                }
            }
}
?>
</tr>

<?php 
}
?>
</table>