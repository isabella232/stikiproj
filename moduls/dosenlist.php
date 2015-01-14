<?php

/**
 * @author NudeSource
 * @copyright 2014
 */

include_once('config.php');
include_once('jadwalkuliah.php');

$cn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if ($cn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $cn->connect_errno . ") " . $cn->connect_error;
}

if(isset($_REQUEST['GRH'])){
    $GRH = $_REQUEST['GRH'];
    $_SESSION['GRH'] = $GRH;
}else{
    $GRH = $_SESSION['GRH'];
}

$GRHX = new jadwalkuliah;
$GRH = $GRHX->day2hari();

//$GRH='SENIN';
$sql1 = "CALL dosenpengajar('" . $GRH . "','" . date('Y-m-d') . "');";
//$sql1 = "CALL dosenpengajar('SENIN');";

//echo $sql1;

if (!($res1 = $cn->query($sql1))) {
    echo "Fetch failed: (" . $cn->errno . ") " . $cn->error;
}else{
    $jruang=0;
    
    echo "<div class='headerdl'>DAFTAR DOSEN PENGAJAR HARI " . $GRH . "</div>";
    echo "<table class='daftardosen'>";
    echo "<tr><th>No</th><th>Nama Dosen</th><th>Check In</th><th>Check Out</th><th>Status</th><th>Keterangan</th></tr>";
    $no=1;
    while($row1 = $res1->fetch_assoc()){
        if($row1['STTHDR']=='0'){
            $stthdr = "Belum Hadir";
        }elseif($row1['STTHDR']=='1'){
            $stthdr = "Hadir";
        }else{
            $stthdr = "Tidak Hadir";
        }
        $jam1 =  $row1['JAM1'];
        $jam1x =  $row1['JAM1'];
        $jam2 =  $row1['JAM2'];
        
        if($jam1=='00:00:00'){
            //$jam1 = "<a href='#' onclick='checkin(\"" . $row1['IDDOSEN'] . "\");' class='absendosenin'>Check</a>";
        }
        if(($jam2=='00:00:00') ){
            if($jam1x=='00:00:00'){
            //    $jam2='';
            }else{
            //    $jam2 = "<a href='#' onclick='checkout(\"" . $row1['IDDOSEN'] . "\");' class='absendosenout'>Check</a>";
            }
        }
        
        $ket = $row1['KET'];
        if($ket==''){
            if($jam1x=='00:00:00'){
                $ket = "<div class='absendosenketx'><a href='#' onclick='keterangan(\"" . $row1['IDDOSEN'] . "\");' class='absendosenket'>e</a></div>";
            }else{
                $ket = "";
            }
        }
        echo "<tr><td>" . $no . "</td><td>" . $row1['DOSEN'] . "</td>";
        
        echo "<td><div class='jam1-" . $row1['IDDOSEN'] . "'>$jam1</div></td>";
        echo "<td><div class='jam2-" . $row1['IDDOSEN'] . "'>$jam2</div></td>";
        
        echo "<td><div class='hdr-" . $row1['IDDOSEN'] . "'>" . $stthdr . "</div></td>";
        echo "<td><div class='ket-" . $row1['IDDOSEN'] . "'>" . $ket . "<div></td>";
        echo "</tr>";
        $no++;
    }
    echo "</table>";
}
?>