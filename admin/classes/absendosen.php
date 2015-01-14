<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
class AbsenDosen{
	public $conn, $db;
	public function __construct()
	{
		$this->conn = mysql_connect(DB_HOST,DB_USER,DB_PASS)
			or die('Maaf sistem tidak bisa melakukan sambungan ke server. Silakan periksa segera!');
		$this->db = mysql_select_db(DB_NAME)
			or die('Maaf sistem tidak bisa melakukan sambungan ke server. Silakan periksa segera!');
	}
    public function day2hari(){
        $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $namahari = $hari[date("w")];
        return $namahari;
    }
    public function date2hari($tgl){
        $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $query = "SELECT datediff('$tgl', CURDATE()) as selisih";
        $hasil = mysql_query($query,$this->conn);
        $data  = mysql_fetch_array($hasil);
        $selisih = $data['selisih'];  
        $x  = mktime(0, 0, 0, date("m"), date("d")+$selisih, date("Y"));
        $namahari = $hari[date("w",$x)];
        return $namahari;
    }
    public function dosenlist(){
        $GRH = $this->day2hari();
        
        $sql1 = "select `jadwal`.`IDJADWAL`,`jadwal`.`MULAIJAMKE` AS `mulaijamke`,`jadwal`.`BERAKHIRJAMKE` AS `berakhirjamke`,`jadwal`.`RUANG` AS `ruang`,`jadwal`.`IDMK` AS `idmk`,`matakuliah`.`MK` AS `matakuliah`,`jadwal`.`KELAS` AS `kelas`,`jadwal`.`IDDOSEN` AS `iddosen`,`dosen`.`DOSEN` AS `namadosen`,`jadwal`.`HARI` AS `hari` from ((`jadwal` join `dosen` on((`jadwal`.`IDDOSEN` = `dosen`.`IDDOSEN`))) join `matakuliah` on((`jadwal`.`IDMK` = `matakuliah`.`IDMK`))) WHERE hari='" . $GRH . "' order by `jadwal`.`RUANG`,`jadwal`.`MULAIJAMKE`;";
        $stmt = mysql_query($sql1,$this->conn);
    
        while($row1 = mysql_fetch_array($stmt)){
            $idsn = $row1['iddosen'];
            $tgl = date('Y-m-d');
            $idjadwal = $row1['IDJADWAL'];
            $sql2 = "SELECT IDDOSEN FROM absensidosen WHERE TGL='" . $tgl . "' and IDDOSEN='" . $idsn . "' and IDJADWAL=" . $idjadwal . ";";
        
            $stmt2 = mysql_query($sql2,$this->conn);
            
            $jml = 0;
            while($hsl = mysql_fetch_array($stmt2)){
                $jml++;    
            }
                
            if($jml==0){
                $sql3 = "INSERT INTO absensidosen(IDJADWAL,IDDOSEN, TGL, HARI,STTHDR,KET) VALUES(" . $idjadwal . ",'" . $idsn . "','" . $tgl . "','" . $GRH . "','0','');";
                //echo $sql3;
                mysql_query($sql3,$this->conn);
            }
            $jml = 0;
        }    
    }
    
    public function listabsen($TGL,$pg='',$dsn=''){
        $GRH = $this->date2hari($TGL);
        if($TGL==''){
            $TGL = date('Y-m-d');
            $GRH = $this->day2hari();
        }
 
        $position = ($pg-1) * 10;
        if(($pg=='') || ($position<0)){
            $position=0;
        }
        
        $no=$position+1;
        
        $sql1 = "SELECT DISTINCT a.IDDOSEN, a.DOSEN, o.TGL, o.JAM1, o.JAM2, o.STTHDR, o.KET, o.IDJADWAL,j.MULAIJAMKE,j.BERAKHIRJAMKE, j.IDMK, o.idaksesndosen  FROM dp as a left outer join absensidosen as o on a.IDDOSEN = o.IDDOSEN inner join jadwal as j on j.IDJADWAL = o.IDJADWAL WHERE a.HARI='" . $GRH . "' and o.TGL='" . $TGL . "' limit $position,10;";
        $sql = "SELECT count(*) as num FROM dp as a left outer join absensidosen as o on a.IDDOSEN = o.IDDOSEN inner join jadwal as j on j.IDJADWAL = o.IDJADWAL WHERE a.HARI='" . $GRH . "' and o.TGL='" . $TGL . "'";
        if(strlen($dsn)>5){
            $sql1 = "SELECT DISTINCT a.IDDOSEN, a.DOSEN, o.TGL, o.JAM1, o.JAM2, o.STTHDR, o.KET, o.IDJADWAL,j.MULAIJAMKE,j.BERAKHIRJAMKE, j.IDMK, o.idaksesndosen  FROM dp as a left outer join absensidosen as o on a.IDDOSEN = o.IDDOSEN inner join jadwal as j on j.IDJADWAL = o.IDJADWAL WHERE a.DOSEN ='" . $dsn . "' and a.HARI='" . $GRH . "' and o.TGL='" . $TGL . "' limit $position,10;";
            $sql = "SELECT count(*) as num FROM dp as a left outer join absensidosen as o on a.IDDOSEN = o.IDDOSEN inner join jadwal as j on j.IDJADWAL = o.IDJADWAL WHERE a.DOSEN ='" . $dsn . "' and a.HARI='" . $GRH . "' and o.TGL='" . $TGL . "'";
        }
        
        
        $stmt = mysql_query($sql,$this->conn);
        $hsl = mysql_fetch_array($stmt);
        $count = $hsl['num'];
        
        $stmt = mysql_query($sql1,$this->conn);
        
        $jruang=0;
        $tx = "<div class='headerdl'></div>";
        $tx .= "<table id=\"rounded-corner\" class='daftardosen'>";
        $tx .= "<thead><tr><th>No</th><th>Nama Dosen</th><th>Matakuliah</th><th>Pukul</th><th>Check In</th><th>Check Out</th><th>Status</th><th>Keterangan</th></tr></thead><tbody>";
        while($row1 = mysql_fetch_array($stmt)){
            if($row1['STTHDR']=='0'){
                $stthdr = "Belum Hadir";
            }elseif($row1['STTHDR']=='1'){
                $stthdr = "Hadir";
            }elseif($row1['STTHDR']=='3'){
                $stthdr = "Selesai";
            }else{
                $stthdr = "Tidak Hadir";
            }
            $jam1 =  $row1['JAM1'];
            $jam1x =  $row1['JAM1'];
            $jam2 =  $row1['JAM2'];
            $jadwal = $this->id2jam($row1['MULAIJAMKE'],0) . " - " . $this->id2jam($row1['BERAKHIRJAMKE'],1);
            $mk = $this->idmk2mk($row1['IDMK']);
            $idaksesndosen = $row1['idaksesndosen'];
             
            if(($jam1=='00:00:00') && ($row1['STTHDR']=='0')){
                //$jam1 = "<a href='#' onclick='checkin(\"" . $row1['IDDOSEN'] . "\",\"" . $row1['IDJADWAL'] . "\");'><i class='icon-check'></i> Check</a>";
                $jam1 = "<a href='#' onclick='checkin(\"" . $idaksesndosen . "\");'><i class='icon-check'></i> Check</a>";
            }
            if(($jam2=='00:00:00') ){
                if($jam1x=='00:00:00'){
                    $jam2='';
                }else{
                    //$jam2 = "<a href='#' onclick='checkout(\"" . $row1['IDDOSEN'] . "\",\"" . $row1['IDJADWAL'] . "\");'><i class='icon-check'></i> Check</a>";
                    $jam2 = "<a href='#' onclick='checkout(\"" . $idaksesndosen . "\");'><i class='icon-check'></i> Check</a>";
                }
            }
            $ket = $row1['KET'];
            if($ket==''){
                if($jam1x=='00:00:00'){
                    //$ket = "<div><a class='lseditrem' href='#' id='" . $row1['IDDOSEN'] . "-" . $row1['IDJADWAL'] . "-edit\");'><i class='icon-edit'></i> edit</a></div>";
                    $ket = "<div><a class='lseditrem' href='#' id='" . $idaksesndosen . "-edit\");'><i class='icon-edit'></i> edit</a></div>";
                }else{
                    $ket = "";
                }
            }
            $tx .= "<tr><td>" . $no . "</td><td>" . $row1['DOSEN'] . "</td>";
            $tx .= "<td>" . $mk . "</td>";
            $tx .= "<td>" . $jadwal . "</td>";
            
            $tx .= "<td><div class='jam1-" . $row1['IDDOSEN'] . "'>$jam1</div></td>";
            $tx .= "<td><div class='jam2-" . $row1['IDDOSEN'] . "'>$jam2</div></td>";
            
            if($row1['STTHDR']=='2'){
                $tx .= "<td><div id='hdr-ijin' class='hdr-" . $row1['IDDOSEN'] . "'>" . $stthdr . "</div></td>";
            }elseif($row1['STTHDR']=='1'){
                $tx .= "<td><div  id='hdr-hdr' class='hdr-" . $row1['IDDOSEN'] . "'>" . $stthdr . "</div></td>";
            }else{
                $tx .= "<td><div  id='hdr-blm' class='hdr-" . $row1['IDDOSEN'] . "'>" . $stthdr . "</div></td>";
            }
            $tx .= "<td><div class='ket-" . $row1['IDDOSEN'] . "'>" . $ket . "<div></td>";
            $tx .= "</tr>";
            $no++;        
        }
        $pgz = $pg + 1;
        $tx .= "</tbody></TABLE>Page: " . $pgz . " Total Data: " . $count;
        //return $sql1;
        return $tx;
                        
    }
    public function listabsenID($TGL,$IDSN,$RUANG){
        $GRH = $this->date2hari($TGL);
        
        $jamskr = date('H');
        $mntskr = date('i');
        
        if($TGL==''){
            $TGL = date('Y-m-d');
            $GRH = $this->day2hari();
        }
        
        $sql1 = "SELECT DISTINCT a.IDDOSEN, a.DOSEN, o.TGL, o.JAM1, o.JAM2, o.STTHDR, o.KET, o.IDJADWAL,j.MULAIJAMKE,j.BERAKHIRJAMKE, j.IDMK, o.idaksesndosen  FROM dp as a left outer join absensidosen as o on a.IDDOSEN = o.IDDOSEN inner join jadwal as j on j.IDJADWAL = o.IDJADWAL WHERE a.HARI='" . $GRH . "' and o.TGL='" . $TGL . "' and j.RUANG='" . $RUANG . "' and a.DOSEN = '" . $IDSN . "';";
        if($RUANG==""){
            $sql1 = "SELECT DISTINCT a.IDDOSEN, a.DOSEN, o.TGL, o.JAM1, o.JAM2, o.STTHDR, o.KET, o.IDJADWAL,j.MULAIJAMKE,j.BERAKHIRJAMKE, j.IDMK, o.idaksesndosen  FROM dp as a left outer join absensidosen as o on a.IDDOSEN = o.IDDOSEN inner join jadwal as j on j.IDJADWAL = o.IDJADWAL WHERE a.HARI='" . $GRH . "' and o.TGL='" . $TGL . "' and a.DOSEN = '" . $IDSN . "';";            
        }
        
    
        $stmt = mysql_query($sql1,$this->conn);
        
        $no = 1;
        $jruang=0;
        $row1 = mysql_fetch_array($stmt);
        $tx = "Nama Dosen:" . $row1['DOSEN'];
        
        $stmt = mysql_query($sql1,$this->conn);
        $tx .= "<div class='headerdl'></div>";
        $tx .= "<table id=\"rounded-corner\" class='daftardosen'>";
        $tx .= "<thead><tr><th>No</th><th>Matakuliah</th><th>Pukul</th><th>Check In</th><th>Check Out</th></tr></thead><tbody>";
        while($row1 = mysql_fetch_array($stmt)){
            if($row1['STTHDR']=='0'){
                $stthdr = "Kosong";
            }elseif($row1['STTHDR']=='1'){
                $stthdr = "Hadir";
            }else{
                $stthdr = "Tidak Hadir";
            }
            $jam1 =  $row1['JAM1'];
            $jam1x =  $row1['JAM1'];
            $jam2 =  $row1['JAM2'];
            
            $jamstart = $this->id2jam($row1['MULAIJAMKE'],0);
                  
            $jadwal = $this->id2jam($row1['MULAIJAMKE'],0) . " - " . $this->id2jam($row1['BERAKHIRJAMKE'],1);
            $mk = $this->idmk2mk($row1['IDMK']);
            $idaksesndosen = $row1['idaksesndosen'];
            $jam1xx = "";
            $jam2xx = "";
            if(($jam1=='00:00:00') && ($row1['STTHDR']=='0')){
                if($this->mnt15($jamstart)){
                    $jam1xx = 1;
                    $jam1 = "<a href='#' onclick='checkin(\"" . $idaksesndosen . "\");'>Check</a>";    
                }else{
                    $jam1 = "";
                    $jam1xx = "X";
                }
            }
            if(($jam2=='00:00:00') ){
                if($jam1x=='00:00:00'){
                    $jam2='';
                    $jam2xx = "";
                }else{
                    $jam2 = "<a href='#' onclick='checkout(\"" . $idaksesndosen . "\");'>Check</a>";
                    $jam2xx = 2;
                }
            }
            
            $tx .= "<tr><td>" . $no . "</td>";
            $tx .= "<td>" . $mk . "</td>";
            $tx .= "<td>" . $jadwal  .  "</td>";
            
            $tx .= "<td><div id ='jam" . $jam1xx . "' class='jam" . $jam1xx . "-" . $row1['IDDOSEN'] . "'>$jam1</div></td>";
            $tx .= "<td><div id ='jam" . $jam2xx . "' class='jam" . $jam2xx . "-" . $row1['IDDOSEN'] . "'>$jam2</div></td>";
            
            $tx .= "</tr>";
            $no++;        
        }
        $tx .= "</tbody></TABLE>";
        //return $sql1;
        return $tx;
                        
    }  
    public function checkinout($idsn,$idj,$jam,$mdel,$ket=''){
        $tgl=date('Y-m-d');
        $sqljam = "select sysdate() as jamtgl;";
        $hsl = mysql_query($sqljam,$this->conn);
        
        $row1 = mysql_fetch_array($hsl);
        $jam = strtotime($row1[0]);
        $tgl = date('Y-m-d',$jam);
        $jam = date('H:i:s',$jam);
        
        if(($mdel=="IN")){
            //$sql1 = "UPDATE absensidosen SET JAM1='" . $jam . "', STTHDR='1' WHERE IDDOSEN='" . $idsn . "' and TGL='" . $tgl . "' and IDJADWAL=" . $idj . ";";
            $sql1 = "UPDATE absensidosen SET JAM1='" . $jam . "', STTHDR='1', STTKLS='1' WHERE idaksesndosen=" . $idsn . ";";
        }elseif($mdel=="OUT"){
            //$sql1 = "UPDATE absensidosen SET JAM2='" . $jam . "' WHERE IDDOSEN='" . $idsn . "' and TGL='" . $tgl . "' and IDJADWAL=" . $idj . ";";
            $sql1 = "UPDATE absensidosen SET JAM2='" . $jam . "', STTKLS='0' WHERE idaksesndosen=" . $idsn . ";";
            
        }elseif($mdel=="IJIN"){
            //$sql1 = "UPDATE absensidosen SET STTHDR='2', KET='" . $ket .  "' WHERE IDDOSEN='" . $idsn . "' and TGL='" . $tgl . "' and IDJADWAL=" . $idj . ";";
            $sql1 = "UPDATE absensidosen SET STTHDR='2', KET='" . $ket .  "' WHERE idaksesndosen=" . $idsn . ";";
        }
        //echo $sql1
        $stmt = mysql_query($sql1,$this->conn);
        //return $sql1;
    }
    public function remarkdosen($idsn){
        $tgl=date('Y-m-d');
        
        $sql1 = "SELECT IDDOSEN FROM absensidosen WHERE idaksesndosen='" . $idsn . "'";
        $stmt = mysql_query($sql1,$this->conn);
        while($row1 = mysql_fetch_array($stmt)){
            $iddosen = $row1['IDDOSEN'];
        }
        $sql1 = "SELECT DOSEN FROM DOSEN WHERE IDDOSEN='" . $iddosen . "';";
        $stmt = mysql_query($sql1,$this->conn);
        while($row1 = mysql_fetch_array($stmt)){
            $dosen = $row1['DOSEN'];
        }
        
        $tx = "<div>&nbsp;</div>";
        $tx .= "<table>";
        
        $tx .= "<tr>";
        $tx .= "<td id='labelx'>Nama Dosen</td>";
        $tx .= "<td><input type='text' id='txdosen' value='" . $dosen . "' disabled='disabled'></td>";
        $tx .= "</tr>";
        $tx .= "<tr>";
        $tx .= "<td id='labelx'>Status Hadir</td>";
        $tx .= "<td><select id='stthdr'><option>IJIN</option><option>HADIR</option></select></td>";
        $tx .= "</tr>";
        $tx .= "<tr>";
        $tx .= "<td id='labelx'>Jam Hadir</td>";
        $tx .= "<td><select id='jamhdr'>";
        
        for($i=7;$i<=22;$i++){
            $jm = $i;
            if(strlen($i)<2){
                $jm = "0" . $i;
            }
            $tx .= "<option>$jm</option>";
        }
        $tx .= "</select> : <select id='mnthdr'>";
        for($i=0;$i<=59;$i++){
            $jm = $i;
            if(strlen($i)<2){
                $jm = "0" . $i;
            }
            $tx .= "<option>$jm</option>";
        }
        $tx .= "</select>";
        $tx .= "</td>";
        $tx .= "</tr>";
        $tx .= "<tr>";
        $tx .= "<td id='labelx'>Keterangan</td>";
        $tx .= "<td><input type='text' id='txket'><input type='hidden' id='txidosen' value='" . $idsn . "'></td>";
        $tx .= "</tr>";
        
        $tx .= "</table>";
        $tx .= "<button id='btnsimpandata'>Simpan Data</button> <button id='btnbatalsimpandata'>Batal</button>";
        return $tx;
    }
    public function mnt15($start){
        $hsl = false;
        $skr = date('H:i');
        $min15 = strtotime('-15 minutes',strtotime($start));
        $min15 = date('H:i',$min15);
        
        if($skr>=$min15){
            $hsl = true;
        }
        return $hsl;
    }
    public function pagging($pg,$tgl){
       if($pg==''){
           $pg=0;
       }
       if($tgl==""){
            $tgl=date('Y-m-d');
       }
       $sql = "SELECT count(*) as num FROM absensidosen WHERE TGL='" . $tgl . "';"; 
        
       $stmt = mysql_query($sql,$this->conn);
       $hsl = mysql_fetch_array($stmt);
       $count = $hsl['num'];
       $limit = 10;
       $pages = ceil($count/$limit);
       //$pagination = '<div class="pagination"><ul>';
       $pagination = '<div class="pagination"> <select class="paginatekelas_click" id="pagetextid">';
       if($pages > 1){
          for($i = 1; $i<=$pages; $i++){
            //$pagination .= '<li><a href="#" class="paginateabsen_click" id="'.$i.'-' . $filter . '-page">'.$i.'</a></li>';
            $pagination .= '<option value="'.$i. '">'.$i.'</option>';
          }
 
       }
        //$pagination .= '</ul></div>';
       $pagination .= '</select></div>';
        
       return $pagination;
    }
    public function rekapabsenlist($pg,$tgl1,$tgl2,$filter){
        if($tgl2==''){
            $tgl2 = $this->tglbatas($tgl1);    
        }
        //$sql1 = "SELECT DISTINCT a.TGL, a.HARI, a.STTHDR, a.KET, d.DOSEN, d.NIDN FROM absensidosen as a inner join dosen as d on a.IDDOSEN=d.IDDOSEN where tgl BETWEEN '" . $tgl1 . "' and '" . $tgl2 . "';";
        $position=0;
        if($pg==''){
            $pg=0;
        }
        $position = ($pg * 10);
        if($filter=="0"){
           $filter=="";
           $sql1 = "select IDDOSEN,DOSEN,NIDN from dosen ORDER BY dosen limit $position,10;";
           $sql = "select count(IDDOSEN) as num from dosen ORDER BY dosen;";
        }else{ 
            $sql = "select count(IDDOSEN) as num from dosen WHERE DOSEN like '%" . $filter . "%' ORDER BY dosen;";
            $sql1 = "select IDDOSEN,DOSEN,NIDN from dosen WHERE DOSEN like '%" . $filter . "%' ORDER BY dosen limit $position,10;"; 
        }
        
        $stmt = mysql_query($sql,$this->conn);
        $hsl = mysql_fetch_array($stmt);
        $count = $hsl['num'];
        
        $stmt = mysql_query($sql1,$this->conn);
        
        $no=$position+1;
        $tx = "<div class='headerdl'></div>";
        $tx .= "<table id=\"rounded-corner\" class='daftardosen'>";
        $tx .= "<thead><tr><th>No</th><th>Nama Dosen</th><th>NIDN</th><th>AKSI</th></thead><tbody>";
        while($row1 = mysql_fetch_array($stmt)){
            
            $nidn = $row1['NIDN'];
            if($nidn==""){
                $nidn=" - ";
            }
            $lsid = $row1['IDDOSEN'];
            $tx .= "<tr>";  
            $tx .= "<td>" . $no . "</td>";
            $tx .= "<td>" . $row1['DOSEN'] . "</td>";
            $tx .= "<td>" . $nidn . "</td>";
            $tx .= "<td><a href='detailabsen-" . $lsid . ".html' class='lslapdetail' id='" . $lsid . "-lsdetail'><i class=\"icon-edit\"></i></a></td>";
            $tx .= "</tr>";
            $no++;  
        }
        $pgz=$pg+1;
        $tx .= "</tbody></TABLE>Page: " . $pgz . " Total Data: " . $count;
        return $tx; 
    }
    public function lapdosendetail($idosen,$tgl1,$tgl2){
        if($tgl1==""){
            $tgl1 = date('Y-m') . "-01";
            $tgl2 = $this->tglbatas($tgl1); 
        }
                
        $sql1 = "SELECT DISTINCT a.TGL, a.HARI, a.STTHDR, a.KET, d.DOSEN, d.NIDN, j.IDMK, a.JAM1, a.JAM2 FROM absensidosen as a inner join dosen as d on a.IDDOSEN=d.IDDOSEN inner join jadwal as j on a.IDJADWAL=j.IDJADWAL where a.IDDOSEN=$idosen and tgl BETWEEN '" . $tgl1 . "' and '" . $tgl2 . "' order by j.IDMK, a.TGL,j.MULAIJAMKE, j.IDMK;";
        
        $stmt = mysql_query($sql1,$this->conn);
        
        $tx = "<div class='headerdl'></div>";
        $tx .= "<table id=\"rounded-corner\" class='daftardosen'>";
        $tx .= "<thead><tr><th>No</th><th>MATAKULIAH</th><th>HARI|TGL</th><th>CHECK IN</th><th>CHECK OUT</th><th>KETERANGAN</th></thead><tbody>";
        
        $no = 1;
        while($row1 = mysql_fetch_array($stmt)){
            $sql2="SELECT MK, SKS FROM matakuliah WHERE IDMK='" . $row1['IDMK']  . "'";
            $stmt2 = mysql_query($sql2,$this->conn);
            $row2 = mysql_fetch_array($stmt2);
            
            if($row1['STTHDR']=='1'){
                $stthadir = "Hadir";
            }else{
                $stthadir = "Tidak";
            }
            
            $tx .= "<tr>";  
            $tx .= "<td>" . $no . "</td>";
            $tx .= "<td>" . $row2['MK'] . "</td>";
            $tx .= "<td>" . $this->date2hari($row1['TGL']) . ", " . $row1['TGL'] . "</td>";
            $tx .= "<td>" . $row1['JAM1'] . "</td>";
            $tx .= "<td>" . $row1['JAM2'] . "</td>";
            $tx .= "<td>" . $row1['KET'] . "</td>";
            $tx .= "</tr>";
            $no++;      
        }
        
        $tx .= "</tbody></TABLE><button id='cprint'>Print</button><button id='expExcel'> Excel </button>";
        
        return $tx;
    }
    //=================//
    public function lapdosendetail2excel($idosen,$tgl1,$tgl2){
        if($tgl1==""){
            $tgl1 = date('Y-m') . "-01";
            $tgl2 = $this->tglbatas($tgl1); 
        }
                
        $sql1 = "SELECT DISTINCT a.TGL, a.HARI, a.STTHDR, a.KET, d.DOSEN, d.NIDN, j.IDMK, a.JAM1, a.JAM2 FROM absensidosen as a inner join dosen as d on a.IDDOSEN=d.IDDOSEN inner join jadwal as j on a.IDJADWAL=j.IDJADWAL where a.IDDOSEN=$idosen and tgl BETWEEN '" . $tgl1 . "' and '" . $tgl2 . "' order by j.IDMK, a.TGL,j.MULAIJAMKE, j.IDMK;";
        
        $stmt = mysql_query($sql1,$this->conn);
        
        while($row1 = mysql_fetch_array($stmt)){
            $sql2="SELECT MK, SKS FROM matakuliah WHERE IDMK='" . $row1['IDMK']  . "'";
            $stmt2 = mysql_query($sql2,$this->conn);
            $row2 = mysql_fetch_array($stmt2);
            
            if($row1['STTHDR']=='1'){
                $stthadir = "Hadir";
            }else{
                $stthadir = "Tidak";
            }
            
            $tx .= "<tr>";  
            $tx .= "<td>" . $no . "</td>";
            $tx .= "<td>" . $row2['MK'] . "</td>";
            $tx .= "<td>" . $this->date2hari($row1['TGL']) . ", " . $row1['TGL'] . "</td>";
            $tx .= "<td>" . $row1['JAM1'] . "</td>";
            $tx .= "<td>" . $row1['JAM2'] . "</td>";
            $tx .= "<td>" . $row1['KET'] . "</td>";
            $tx .= "</tr>";
            $no++;      
        }
        
        $tx .= "</tbody></TABLE><button id='cprint'>Print</button><button id='expExcel'> Excel </button>";
        
        return $tx;
    }
    //=================//
    public function paggingrekap($pg,$tgl){
       if($pg==''){
           $pg=0;
       }
        
       $sql = "SELECT count(*) as num FROM dosen;"; 
        

       $stmt = mysql_query($sql,$this->conn);
       $hsl = mysql_fetch_array($stmt);
       $count = $hsl['num'];
       $limit = 10;
       $pages = ceil($count/$limit);
       //$pagination = '<div class="pagination"><ul>';
       $pagination = '<div class="pagination"> <select class="paginatekelas_click" id="pagetextid">';
       if($pages > 1){
          for($i = 1; $i<=$pages; $i++){
            //$pagination .= '<li><a href="#" class="paginaterekap_click" id="'.$i.'-page">'.$i.'</a></li>';
            $pagination .= '<option value="'.$i. '">'.$i.'</option>';
          }
 
        }
        //$pagination .= '</ul></div>';
        $pagination .= '</select></div>';
        
        return $pagination;
    }
    public function tglbatas($tgl){
        $bln='';
        $thn='';
        
        list($thn, $bln, $hr) = explode('-', $tgl);
        
        if(($bln=='01') || ($bln=='03') || ($bln=='05') || ($bln=='07') || ($bln=='08') || ($bln=='10') || ($bln=='12') ){
            $tglxx = $thn . "-" . $bln . '-31';
        }
        if(($bln=='04') || ($bln=='06') || ($bln=='09') || ($bln=='11') ){
            $tglxx = $thn . "-" . $bln . '-30';
        }
        if(($bln=='02')){
            if(isTahunKabisat($thn)){
                $tglxx = $thn . "-" . $bln . '-29';
            }else{
                $tglxx = $thn . "-" . $bln . '-28';
            }
        }
        return $tglxx;
    }
    private function isTahunKabisat($angkaTahun) {
    	if($angkaTahun % 100 === 0) {
    		if($angkaTahun % 400 === 0) return (bool)TRUE;
    		else return (bool)FALSE;
    	} else {
    		if($angkaTahun % 4 === 0) return (bool)TRUE;
    		else return (bool)FALSE;
    	}
    }
    public function filtertgl(){
        $tx="";
        $TH = date('Y');
        $BLN = date('m');
        $HR = date('d');
        $maxday=31;
        if($BLN<8){
            if($BLN % 2 === 0 ){
                $maxday=30;    
            }
        }else{
            if(($BLN % 2 === 1) ){
                $maxday=30;    
            }
        }
        if($BLN==2){
            if(isTahunKabisat($THN)){
                $maxday=29;        
            }
        }
        $tx .='Filter TGL <select id="filtgl">';
        for($i=1;$i<=$maxday;$i++){
            if(strlen($i)===1){
                $tglx = '0' . $i;
            }else{
                $tglx = $i;
            }
            if($HR==$i){
                $tx .='<option SELECTED="SELECTED">'. $tglx .'</option>';   
            }else{
                $tx .='<option>'. $tglx .'</option>';
            }
        }    
        
        $tx .='</select>';
        $tx .= ' - <select id="filbln">';
        for($i=1;$i<=12;$i++){
            if(strlen($i)===1){
                $blnx = '0' . $i;
            }else{
                $blnx = $i;
            }
            if($BLN==$i){
                $tx .='<option SELECTED="SELECTED">'. $blnx .'</option>';   
            }else{
                $tx .='<option>'. $blnx .'</option>';
            }
        }
        $tx .= '</select>';
        $tx .= ' - <input type="text" id="filthn" value="' . $TH . '"> <button id="filabsen">Filter Data</button>';
        return $tx;
    }
    private function id2jam($ke,$opsi){
        if($opsi==0){
            $sql = "select MULAI FROM jampertemuan WHERE JAMKE=$ke";    
        }else{
            $sql = "select BERAKHIR FROM jampertemuan WHERE JAMKE=$ke";
        }
        $stmt = mysql_query($sql,$this->conn);
        $hsl = mysql_fetch_array($stmt);
        return $hsl[0];
    }
    private function idmk2mk($idmk){
        $sql = "select MK FROM matakuliah WHERE IDMK='$idmk'";    
        
        $stmt = mysql_query($sql,$this->conn);
        $hsl = mysql_fetch_array($stmt);
        return $hsl[0];
    }
    public function SERVERTIME(){
        $sqljam = "select sysdate() as jamtgl;";
        $hsl = mysql_query($sqljam,$this->conn);

        $row1 = mysql_fetch_array($hsl);
        $jam = strtotime($row1[0]);
        $hslx = date('H:i:s',$jam);
        
        return $hslx;
    }
    public function SERVERDATE(){
        $array_bln = array(1=>'Januari','Pebruari','Maret','April','Mei', 'Juni','Juli', 'Agustus', 'September', 'Oktober','November','Desember');
        
        $sqljam = "select sysdate() as jamtgl;";
        $hsl = mysql_query($sqljam,$this->conn);

        $row1 = mysql_fetch_array($hsl);
        $jam = strtotime($row1[0]);
        $tglx = date('d',$jam);
        $blnx = (int)date('m',$jam);
        $thnx = date('Y',$jam);
        
        $hslx = $tglx . " " . $array_bln[$blnx] . " " . $thnx;
        
        return $hslx;
    }
    public function SERVERDATEF(){
        $sqljam = "select sysdate() as jamtgl;";
        $hsl = mysql_query($sqljam,$this->conn);

        $row1 = mysql_fetch_array($hsl);
        $jam = strtotime($row1[0]);
        $tglx = date('d',$jam);
        $blnx = (int)date('m',$jam);
        $thnx = date('Y',$jam);
        
        $hslx = date('Y-m-d',$jam);
        
        return $hslx;
    }
    public function SERVERDAY(){
        $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
        $sqljam = "select sysdate() as jamtgl;";
        $hsl = mysql_query($sqljam,$this->conn);

        $row1 = mysql_fetch_array($hsl);
        $jam = strtotime($row1[0]);
        $jam = date('N',$jam);
        $hslx = $array_hari[$jam];
        
        return $hslx;
    }
    public function __destruct()
	{
		$closeConnection = mysql_close($this->conn);
		if($closeConnection){return true;}
	} 
}
?>