<?php
/** Error reporting */
error_reporting(E_ALL);

function date2hari($tgl){
        $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $query = "SELECT datediff('$tgl', CURDATE()) as selisih";
        $hasil = mysql_query($query,$this->conn);
        $data  = mysql_fetch_array($hasil);
        $selisih = $data['selisih'];  
        $x  = mktime(0, 0, 0, date("m"), date("d")+$selisih, date("Y"));
        $namahari = $hari[date("w",$x)];
        return $namahari;
    }
    
date_default_timezone_set('Europe/London');

require_once '../../moduls/config.php';

/** PHPExcel */
require_once '../Classes/PHPExcel/IOFactory.php';
    //$dosen = $_REQUEST['IDDOSEN'];
    $dosen = "sss";
    $hrini = date("Ymd");
    $flname = "Rekap-" . $hrini . "-" . $dosen . ".xls";
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load("doktemplate/Book1.xlsx");
    
// Set properties
$objPHPExcel->getProperties()->setCreator("Made Artha")
							 ->setLastModifiedBy("Made Artha")
							 ->setTitle("Rekap Data Absen Dosen")
							 ->setSubject("Rekap Absen Dosen STIKI")
							 ->setDescription("Rekap Absen Dosen.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("");


    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $flname . '"');
    header('Cache-Control: max-age=0');
    
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

$idosen = "16";
$tgl1 = "2014-12-1";
$tgl2 = "2014-12-31";

$sql1 = "SELECT DISTINCT a.TGL, a.HARI, a.STTHDR, a.KET, d.DOSEN, d.NIDN, j.IDMK, a.JAM1, a.JAM2 FROM absensidosen as a inner join dosen as d on a.IDDOSEN=d.IDDOSEN inner join jadwal as j on a.IDJADWAL=j.IDJADWAL where a.IDDOSEN=$idosen and tgl BETWEEN ('" . $tgl1 . "' and '" . $tgl2 . "') order by j.IDMK, a.TGL,j.MULAIJAMKE, j.IDMK;";
echo $sql1; die();

$stmt = mysqli_query($conn,$sql1);
if (!$stmt) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
$row1 = mysqli_fetch_array($stmt,MYSQLI_ASSOC);

$periode = "Januari 2014";
$namadosen = "Nama Dosen : " . $row1['DOSEN'];
$baseRow = 9;
$x=0;
$objPHPExcel->getActiveSheet()->setCellValue('B2',  $periode);
$objPHPExcel->getActiveSheet()->setCellValue('B5',  $namadosen);

$stmt = mysqli_query($conn,$sql1);
while($row1 = $mysqli_fetch_array($stmt)){
    $sql2="SELECT MK, SKS FROM matakuliah WHERE IDMK='" . $row1['IDMK']  . "'";
    $stmt2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($stmt2,MYSQLI_ASSOC);
            
    if($row1['STTHDR']=='1'){
        $stthadir = "Hadir";
    }else{
        $stthadir = "Tidak";
    }
    
    $no = $x + $baseRow;
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $no,  $x+1);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $no,  $row2['MK']);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $no,  date2hari($row1['TGL']) . ", " . $row1['TGL']);
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $no,  $row1['JAM1']);
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $no,  $row1['JAM2']);
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $no,  $row1['KET']);
    $x++;
}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
?>