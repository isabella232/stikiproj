<?php

/**
 * @author NudeSource
 * @copyright 2014
 */
class JadwalKuliah
{
    protected $username="", $password="", $admin=1;
	public $conn, $db;

	public function __construct()
	{
		$this->conn = mysql_connect(DB_HOST,DB_USER,DB_PASS)
			or die('Maaf sistem tidak bisa melakukan sambungan ke server. Silakan periksa segera!');
		$this->db = mysql_select_db(DB_NAME)
			or die('Maaf sistem tidak bisa melakukan sambungan ke server. Silakan periksa segera!');
	}
    public function id2jam($ke,$opsi){
        if($opsi==0){
            $sql = "select MULAI FROM jampertemuan WHERE JAMKE=$ke";    
        }else{
            $sql = "select BERAKHIR FROM jampertemuan WHERE JAMKE=$ke";
        }
        $stmt = mysql_query($sql,$this->conn);
        $hsl = mysql_fetch_array($stmt);
        return $hsl[0];
    }
    public function listdata($pg,$filter){
        //global $jamke;
        
        $tx = '';
        $position=0;
        if($pg==''){
            $pg=0;
        }
        if($filter==""){
           $filter==0;
           
           $sql = "select `jadwal`.`IDJADWAL` AS `IDJADWAL`,`jadwal`.`HARI` AS `HARI`,`jadwal`.`MULAIJAMKE` AS `MULAIJAMKE`,`jadwal`.`BERAKHIRJAMKE` AS `BERAKHIRJAMKE`,`jadwal`.`RUANG` AS `RUANG`,`jadwal`.`KELAS` AS `KELAS`,`dosen`.`DOSEN` AS `DOSEN`,`matakuliah`.`MK` AS `MK`,`matakuliah`.`SKS` AS `SKS` from ((`jadwal` join `dosen` on((`jadwal`.`IDDOSEN` = `dosen`.`IDDOSEN`))) join `matakuliah` on((`jadwal`.`IDMK` = `matakuliah`.`IDMK`))) ORDER BY jadwal.IDORDER, jadwal.MULAIJAMKE limit 0,10;";
           $sql1 = "select count(*) as num from ((`jadwal` join `dosen` on((`jadwal`.`IDDOSEN` = `dosen`.`IDDOSEN`))) join `matakuliah` on((`jadwal`.`IDMK` = `matakuliah`.`IDMK`))) ORDER BY jadwal.IDORDER, jadwal.MULAIJAMKE";
        }else{
           $hari = array(0=>'ALL',1=>'SENIN',2=>'SELASA',3=>'RABU',4=>'KAMIS',5=>'JUMAT',6=>'SABTU'); 
           $position = ($pg * 10);
           if($hari[$filter]=="ALL"){
            $sql = "select `jadwal`.`IDJADWAL` AS `IDJADWAL`,`jadwal`.`HARI` AS `HARI`,`jadwal`.`MULAIJAMKE` AS `MULAIJAMKE`,`jadwal`.`BERAKHIRJAMKE` AS `BERAKHIRJAMKE`,`jadwal`.`RUANG` AS `RUANG`,`jadwal`.`KELAS` AS `KELAS`,`dosen`.`DOSEN` AS `DOSEN`,`matakuliah`.`MK` AS `MK`,`matakuliah`.`SKS` AS `SKS` from ((`jadwal` join `dosen` on((`jadwal`.`IDDOSEN` = `dosen`.`IDDOSEN`))) join `matakuliah` on((`jadwal`.`IDMK` = `matakuliah`.`IDMK`))) ORDER BY jadwal.IDORDER, jadwal.MULAIJAMKE limit $position,10;";
            $sql1 = "select count(*) as num  from ((`jadwal` join `dosen` on((`jadwal`.`IDDOSEN` = `dosen`.`IDDOSEN`))) join `matakuliah` on((`jadwal`.`IDMK` = `matakuliah`.`IDMK`))) ORDER BY jadwal.IDORDER, jadwal.MULAIJAMKE limit $position,10;";
           }else{
            $sql = "select `jadwal`.`IDJADWAL` AS `IDJADWAL`,`jadwal`.`HARI` AS `HARI`,`jadwal`.`MULAIJAMKE` AS `MULAIJAMKE`,`jadwal`.`BERAKHIRJAMKE` AS `BERAKHIRJAMKE`,`jadwal`.`RUANG` AS `RUANG`,`jadwal`.`KELAS` AS `KELAS`,`dosen`.`DOSEN` AS `DOSEN`,`matakuliah`.`MK` AS `MK`,`matakuliah`.`SKS` AS `SKS` from ((`jadwal` join `dosen` on((`jadwal`.`IDDOSEN` = `dosen`.`IDDOSEN`))) join `matakuliah` on((`jadwal`.`IDMK` = `matakuliah`.`IDMK`))) WHERE HARI='" . $hari[$filter] . "' ORDER BY jadwal.IDORDER, jadwal.MULAIJAMKE limit $position,10;";
            $sql1 = "select select count(*) as num from ((`jadwal` join `dosen` on((`jadwal`.`IDDOSEN` = `dosen`.`IDDOSEN`))) join `matakuliah` on((`jadwal`.`IDMK` = `matakuliah`.`IDMK`))) WHERE HARI='" . $hari[$filter] . "' ORDER BY jadwal.IDORDER, jadwal.MULAIJAMKE limit $position,10;";
           } 
        }
        //echo $sql1;
        $stmt = mysql_query($sql1,$this->conn);
        $hslx = mysql_fetch_array($stmt);
        $count = $hslx['num'];
        
        $stmt = mysql_query($sql,$this->conn);
        
        $tx .= "<TABLE id=\"rounded-corner\">";
        $tx .= "<thead><TR>";
        $tx .= "<TH>No</TH><TH>HARI</TH><TH>JAM</TH><TH>RUANG</TH><TH>KELAS</TH><TH>DOSEN</TH><TH>Matakuliah/SKS</TH><TH>AKSI</TH>";
        $tx .= "</TR></thead><tbody>";

        $no=$position+1;
        /**/
        while($hsl = mysql_fetch_array($stmt)){
            $lsid = $hsl['IDJADWAL'] . "-" . $hsl['HARI'] . "-" . $hsl['MULAIJAMKE'] . "-" . $hsl['RUANG'];
            $tx .= "<TR>";
            $tx .= "<TD>" . $no . "</TD>";
            $tx .= "<TD>" . $hsl['HARI'] . "</TD>";
            $tx .= "<TD>" . $this->id2jam($hsl['MULAIJAMKE'],0) . "-" . $this->id2jam($hsl['BERAKHIRJAMKE'],1) . "</TD>";
            $tx .= "<TD>" . $hsl['RUANG'] . "</TD>";
            $tx .= "<TD>" . $hsl['KELAS'] . "</TD>";
            $tx .= "<TD>" . $hsl['DOSEN'] . "</TD>";
            $tx .= "<TD>" . $hsl['MK'] . " / " . $hsl['SKS'] . "</TD>";
            $tx .= "<TD><a href='#' class='lsedit' id='" . $lsid . "-edit'><i class=\"icon-edit\"></i></a> <a href='#' class='lsdel' id='" . $lsid . "-edit'><i class=\"icon-remove\"></i></a></TD>";
            $tx .= "</TR>";
            $no++;
        }
        /**/
        $pgx = $pg+1;
        $tx .= "</tbody></TABLE>Page: " . $pgx . " Total Data: " . $count;
        //$tx .= $this->pagging($pg,$filter);
        //$tx = "SQL: " . $sql;
        return $tx; 
    }
    public function viewidjadwal($idjadwal){
        $sql = "SELECT IDJADWAL,HARI,MULAIJAMKE,BERAKHIRJAMKE,RUANG,IDMK,KELAS,IDDOSEN FROM jadwal WHERE IDJADWAL=$idjadwal;";
        $stmt = mysql_query($sql,$this->conn);
        $hsl = mysql_fetch_array($stmt);
            $datax[0] = $hsl['IDJADWAL'];
            $datax[1] = $hsl['IDMK'];
            $datax[2] = $hsl['HARI'];
            $datax[3] = $hsl['MULAIJAMKE'];
            $datax[4] = $hsl['BERAKHIRJAMKE'];
            $datax[5] = $hsl['KELAS'];
            $datax[6] = $hsl['RUANG'];
            $datax[7] = $hsl['IDDOSEN'];
    
        return $datax;
    }
    public function pagging($pg,$filter){
       if($pg==''){
           $pg=0;
       }
       
       $hari = array(0=>'ALL',1=>'SENIN',2=>'SELASA',3=>'RABU',4=>'KAMIS',5=>'JUMAT',6=>'SABTU');
       if($filter=="0"){
           $sql = "SELECT count(*) as num FROM jadwal;";  
       }else{ 
           $sql = "SELECT count(*) as num FROM jadwal WHERE HARI='" . $hari[$filter] . "';"; 
       } 

       $stmt = mysql_query($sql,$this->conn);
       $hsl = mysql_fetch_array($stmt);
       $count = $hsl['num'];
       $limit = 10;
       $pages = ceil($count/$limit);
       //$pagination = '<div class="pagination"><ul>';
       $pagination = '<div class="pagination">Pages <select class="paginatekelas_click" id="pagetextid">';
       if($pages > 1){
          for($i = 1; $i<=$pages; $i++){
            //$pagination .= '<li><a href="#" class="paginate_click" id="'.$i.'-' . $filter . '-page">'.$i.'</a></li>';
            $pagination .= '<option value="'.$i.'">'.$i. '</option>';
          }
 
        }
        //$pagination .= '</ul></div>';
        $pagination .= '</select></div>';
        
        return $pagination;
    }
    public function MatakuliahList($idmk){
        $sql = "SELECT  MK, SKS, IDMK FROM matakuliah;";
        $stmt = mysql_query($sql,$this->conn);
        if($idmk==0){
            $tx ="<option value='0' Selected='Selected'>Pilih Matakuliah</option>";
        }else{
            $tx ="<option value='0'>Pilih Matakuliah</option>";
        }
        while($hsl = mysql_fetch_array($stmt)){
            if($idmk==$hsl['IDMK']){
                $tx .= "<option value='" . $hsl['IDMK'] . "' Selected='Selected'>" .  $hsl['MK']. "</option>";
            }else{
                $tx .= "<option value='" . $hsl['IDMK'] . "'>" .  $hsl['MK']. "</option>";
            }
            
        }
        return $tx;
    }
    public function JaMulaiList($jamulai){
        $sql = "SELECT  MULAI, JAMKE FROM jampertemuan;";
        $stmt = mysql_query($sql,$this->conn);
        
        if($jamulai==0){
            $tx ="<option value='0' Selected='Selected'>Pilih Jam Mulai</option>";
        }else{
            $tx ="<option value='0'>Pilih Jam Berakhir</option>";
            $tx ="<option value='0'>Pilih Jam Mulai</option>";
        }
        while($hsl = mysql_fetch_array($stmt)){
            if($jamulai==$hsl['JAMKE']){
                $tx .= "<option value='" . $hsl['JAMKE'] . "' Selected='Selected'>" .  $hsl['MULAI']. "</option>";
            }else{
                $tx .= "<option value='" . $hsl['JAMKE'] . "'>" .  $hsl['MULAI']. "</option>";
            }
        }
        return $tx;
    }
    public function JamAkhirList($jamslesai){
        $sql = "SELECT  BERAKHIR, JAMKE FROM jampertemuan;";
        $stmt = mysql_query($sql,$this->conn);
        
        if($jamslesai==0){
            $tx ="<option value='0' Selected='Selected'>Pilih Jam Berakhir</option>";
        }else{
            $tx ="<option value='0'>Pilih Jam Berakhir</option>";
        }
        while($hsl = mysql_fetch_array($stmt)){
            if($jamslesai==$hsl['JAMKE']){
                $tx .= "<option value='" . $hsl['JAMKE'] . "' Selected='Selected'>" .  $hsl['BERAKHIR']. "</option>";
            }else{
                $tx .= "<option value='" . $hsl['JAMKE'] . "'>" .  $hsl['BERAKHIR']. "</option>";
            }
            
        }
        return $tx;
    }
    public function RuangKelasList($idkelas){
        $sql = "SELECT  ruang, idruang FROM ruangkelas;";
        $stmt = mysql_query($sql,$this->conn);
        if($idkelas==0){
            $tx ="<option value='0' Selected='Selected'>Pilih Ruang Kuliah</option>";
        }else{
            $tx ="<option value='0'>Pilih Ruang Kuliah</option>";
        }
        
        while($hsl = mysql_fetch_array($stmt)){
            if($idkelas==$hsl['ruang']){
                $tx .= "<option value='" . $hsl['ruang'] . "' Selected='Selected'>" .  $hsl['ruang']. "</option>";
            }else{
                $tx .= "<option value='" . $hsl['ruang'] . "'>" .  $hsl['ruang']. "</option>";
            }
        }
        return $tx;
    }
    public function DosenList($idosen){
        $sql = "SELECT  DOSEN, IDDOSEN FROM dosen;";
        $stmt = mysql_query($sql,$this->conn);
        if($idosen==0){
            $tx ="<option value='0' Selected='Selected'>Pilih Dosen</option>";
        }else{
            $tx ="<option value='0'>Pilih Dosen</option>";
        }
        while($hsl = mysql_fetch_array($stmt)){
            if($idosen==$hsl['IDDOSEN']){
                $tx .= "<option value='" . $hsl['IDDOSEN'] . "' Selected='Selected'>" .  $hsl['DOSEN']. "</option>";
            }else{
                $tx .= "<option value='" . $hsl['IDDOSEN'] . "'>" .  $hsl['DOSEN']. "</option>";
            }
        }
        return $tx;
    }
    public function simpanbaru($mk,$hr,$jmulai,$jselesai,$kls,$r,$dsn){
        if($hr=="SENIN"){
            $idorder = 1;
        }elseif($hr=="SELASA"){
            $idorder = 2;
        }elseif($hr=="RABU"){
            $idorder = 3;
        }elseif($hr=="KAMIS"){
            $idorder = 4;
        }elseif($hr=="JUMAT"){
            $idorder = 5;
        }elseif($hr=="SABTU"){
            $idorder = 6;
        }
        
        $sql = "INSERT INTO jadwal(IDMK,HARI,MULAIJAMKE,BERAKHIRJAMKE,KELAS,RUANG,IDDOSEN,IDORDER) VALUES ('" . $mk . "','" . $hr . "'," . $jmulai . "," . $jselesai . ",'" . $kls . "','" . $r . "'," . $dsn . "," . $idorder . ");";
        $stmt = mysql_query($sql,$this->conn);
        return $sql;
        //return $stmt;
    }
    public function simpanedit($mk,$hr,$jmulai,$jselesai,$kls,$r,$dsn,$idjadwal){
        if($hr=="SENIN"){
            $idorder = 1;
        }elseif($hr=="SELASA"){
            $idorder = 2;
        }elseif($hr=="RABU"){
            $idorder = 3;
        }elseif($hr=="KAMIS"){
            $idorder = 4;
        }elseif($hr=="JUMAT"){
            $idorder = 5;
        }elseif($hr=="SABTU"){
            $idorder = 6;
        }
        
        $sql = "UPDATE jadwal SET IDMK='" . $mk . "',HARI='" . $hr . "',MULAIJAMKE=" . $jmulai . ",BERAKHIRJAMKE=" . $jselesai . ",KELAS='" . $kls . "',RUANG='" . $r . "',IDDOSEN=" . $dsn . ",IDORDER=" . $idorder . " WHERE IDJADWAL=$idjadwal;";
        $stmt = mysql_query($sql,$this->conn);
        return $sql;
    }
    public function hapusjadwal($idjadwal){
        $sql = "DELETE FROM jadwal WHERE IDJADWAL=$idjadwal;";
        $stmt = mysql_query($sql,$this->conn);
        return $sql;
    }
    public function __destruct()
	{
		$closeConnection = mysql_close($this->conn);
		if($closeConnection){return true;}
	} 
}
?>