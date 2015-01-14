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

$tgl = date('Y-m-d');

$JK = new jadwalkuliah;
$GRH = $JK->day2hari();

$sql1 = "SELECT DISTINCT IDDOSEN FROM list WHERE hari='" . $GRH . "';";

if (!($res1 = $cn->query($sql1))) {
    echo "Fetch failed: (" . $cn->errno . ") " . $cn->error;
}else{
    while($row1 = $res1->fetch_assoc()){
        $idsn = $row1['iddosen'];
        $sql2 = "SELECT IDDOSEN FROM absensidosen WHERE TGL='" . $tgl . "' and IDDOSEN='" . $idsn . "';";
        
        if (!($res2 = $cn->query($sql2))) {
            echo "Fetch failed: (" . $cn->errno . ") " . $cn->error;
        }else{
            $jml = 0;
            while($row2 = $res2->fetch_assoc()){
                $jml++;    
            }
            if($jml==0){
                $sql3 = "INSERT INTO absensidosen(IDDOSEN, TGL, HARI,STTHDR,KET) VALUES('" . $idsn . "','" . $tgl . "','" . $GRH . "','0','');";
                $cn->query($sql3);
            }
            $jml = 0;
        }
        
    }    
}

?>