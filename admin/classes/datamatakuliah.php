<?php

/**
 * @author NudeSource
 * @copyright 2014
 */
class DataMatakuliah
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
    
    public function listdata($pg,$filter){
        //global $jamke;
        $sql = "select count(MK) as num from matakuliah;";
        $stmt = mysql_query($sql,$this->conn);
        $hsl = mysql_fetch_array($stmt);
        $count = $hsl['num'];
        $tx = '';
        $position=0;
        if($pg==''){
            $pg=0;
        }
        $position = ($pg * 10);
        if($filter=="0"){
           $filter=="";
           $sql = "select MK,SKS,JURUSAN,IDMK from matakuliah ORDER BY IDMK limit $position,10;";
        }else{ 
           
            $sql = "select MK,SKS,JURUSAN,IDMK from matakuliah WHERE MK like '%" . $filter . "%' ORDER BY IDMK limit $position,10;"; 
        }
        $stmt = mysql_query($sql,$this->conn);
        $tx .= "<TABLE id=\"rounded-corner\">";
        $tx .= "<thead><TR>";
        $tx .= "<TH>No</TH><TH>KODE MK</TH><TH>MATAKULIAH</TH><TH>SKS</TH><TH>JURUSAN</TH><TH>AKSI</TH>";
        $tx .= "</TR></thead><tbody>";
/**/
        $no=$position+1;
        while($hsl = mysql_fetch_array($stmt)){
            $lsid = $hsl['IDMK'];
            $tx .= "<TR>";
            $tx .= "<TD>" . $no . "</TD>";
            $tx .= "<TD>" . $hsl['IDMK'] . "</TD>";
            $tx .= "<TD>" . $hsl['MK'] . " </TD>";
            $tx .= "<TD>" . $hsl['SKS'] . " </TD>";
            $tx .= "<TD>" . $hsl['JURUSAN'] . " </TD>";
            $tx .= "<TD><a href='#' class='lsedit' id='" . $lsid . "_edit'><i class=\"icon-edit\"></i></a></TD>";
            $tx .= "</TR>";
            $no++;
        }
        $pgx = $pg+1; 
        $tx .= "</tbody></TABLE>Page: " . $pgx . " Total Data: " . $count;
        /**/
        return $tx; 
    }
    public function viewidmk($idmk){
        $sql = "SELECT MK,SKS,JURUSAN,IDMK FROM matakuliah WHERE IDMK='$idmk';";
        $stmt = mysql_query($sql,$this->conn);
        $hsl = mysql_fetch_array($stmt);
            $datax[0] = $hsl['MK'];
            $datax[1] = $hsl['SKS'];
            $datax[2] = $hsl['IDMK'];
            $datax[3] = $hsl['JURUSAN'];
        return $datax;
    }
    public function pagging($pg,$filter){
       if($pg==''){
           $pg=0;
       }
       
       if($filter==""){
           $sql = "SELECT count(*) as num FROM matakuliah;";  
       }else{ 
           $sql = "SELECT count(*) as num FROM matakuliah WHERE MK like '%" . $filter . "';"; 
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
            $pagination .= '<option value="'.$i.'">'.$i.'</option>';
          }
 
        }
        //$pagination .= '</ul></div>';
        $pagination .= '</select></div>';
        
        return $pagination;
    }
    
    public function simpanbaru($mk,$sks,$jur,$idmk){        
        $sql = "INSERT INTO matakuliah(IDMK,MK,SKS,JURUSAN) VALUES ('" . $idmk . "','" . $mk . "'," . $sks . ",'" . $jur . "');";
        $stmt = mysql_query($sql,$this->conn);
        return $stmt;
    }
    public function simpanedit($mk,$sks,$jur,$idmk,$idlama){
        $sql = "UPDATE matakuliah SET IDMK='" . $idmk . "', MK='" . $mk . "',SKS='" . $sks . "', JURUSAN='" . $jur . "' WHERE IDMK='$idlama';";
        $stmt = mysql_query($sql,$this->conn);
        //return $stmt;
	return $sql;	

    }
    public function hapusmk($idmk){
        $sql = "DELETE FROM matakuliah WHERE IDMK='$idmk';";
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