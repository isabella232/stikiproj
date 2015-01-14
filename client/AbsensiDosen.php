<?PHP
$ipx="";

$fh = fopen("konfigurasi.txt", "r");

$x=0; 
while (!feof($fh)) {
    $isi = fgets($fh);
    if(!$isi==""){
        $line[$x]=$isi;
        $x++;   
    }
}

$url="http://localhost/stikiproj";
$r="";
$mac="";

foreach($line as $isix)
{ 
   if(substr($isix,0,4)=="url="){
    $url = trim(str_replace("url=","",$isix));  
   }
   if(substr($isix,0,6)=="ruang="){
    $r = str_replace("ruang=","",$isix); 
   }
} 
fclose($fh);
if($r==""){
    $urlx = $url . "/AbsensiDosen.php";
}else{
    $urlx = $url . "/AbsensiDosen.php?r=" . $r . "&ip=" . $ipx . "&mac=" . $mac;
}
header("location: " . $urlx);
?>