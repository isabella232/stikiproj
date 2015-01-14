<?php

/**
 * @author NudeSource
 * @copyright 2014
 */
class DataDosen
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
        $sql1 = "SELECT count(*) as num FROM dosen;";
        $stmt = mysql_query($sql1,$this->conn);
        $hsl = mysql_fetch_array($stmt);
        $count = $hsl['num'];
        
        $tx = '';
        $position=0;
        if($pg==''){
            $pg=0;
        }
        $position = ($pg * 10);
        if(($filter=="0") || ($filter=="")){
           $filter=="";
           $sql = "select IDDOSEN,DOSEN,NIDN, PDD from dosen ORDER BY dosen limit $position,10;";
        }else{ 
           
            $sql = "select IDDOSEN,DOSEN,NIDN, PDD from dosen WHERE DOSEN like '%" . $filter . "%' ORDER BY dosen limit $position,10;"; 
        }
        
        $stmt = mysql_query($sql,$this->conn);
        //$tx .= "SQL: " . $sql;
        $tx .= "<TABLE id=\"rounded-corner\">";
        $tx .= "<thead><TR>";
        $tx .= "<TH>No</TH><TH>NAMA DOSEN</TH><TH>NIDN</TH><TH>JENJANG</TH><TH>AKSI</TH>";
        $tx .= "</TR></thead><tbody>";

        $no=$position+1;
        while($hsl = mysql_fetch_array($stmt)){
            $nidn = $hsl['NIDN'];
            $pdd = $hsl['PDD'];
            if($nidn==""){
                $nidn=" - ";
            }
            $lsid = $hsl['IDDOSEN'];
            $tx .= "<TR>";
            $tx .= "<TD>" . $no . "</TD>";
            $tx .= "<TD>" . $hsl['DOSEN'] . "</TD>";
            $tx .= "<TD>" . $nidn . " </TD>";
            $tx .= "<TD>" . $pdd . " </TD>";
            $tx .= "<TD><a href='#' class='lsedit' id='" . $lsid . "-edit'><i class=\"icon-edit\"></i></a></TD>";
            $tx .= "</TR>";
            $no++;
            

        }
        $pgz = $pg + 1;
        $tx .= "</tbody></TABLE>Page: " . $pgz . " Total Data: " . $count;
        return $tx; 
    }
    public function viewiddosen($iddosen){
        $sql = "SELECT DOSEN,NIDN,IDDOSEN,PDD FROM dosen WHERE IDDOSEN=$iddosen;";
        $stmt = mysql_query($sql,$this->conn);
        $hsl = mysql_fetch_array($stmt);
            $datax[0] = $hsl['DOSEN'];
            $datax[1] = $hsl['NIDN'];
            $datax[2] = $hsl['IDDOSEN'];
            $datax[3] = $hsl['PDD'];
        return $datax;
    }
    public function pagging($pg,$filter){
       if($pg==''){
           $pg=0;
       }
       
       if($filter==""){
           $sql = "SELECT count(*) as num FROM dosen;";  
       }else{ 
           $sql = "SELECT count(*) as num FROM dosen WHERE DOSEN like '%" . $filter . "';"; 
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
            //$pagination .= '<li><a href="#" class="paginate_click" id="'.$i.'-' . $filter . '-page">'.$i.'</a></li>';\
            $pagination .= '<option value="'.$i. '">'.$i.'</option>';
          }
 
        }
        //$pagination .= '</ul></div>';
        $pagination .= '</select></div>' ;
        
        return $pagination;
    }
    
    public function simpanbaru($dosen,$nidn,$pdd){ 
        $sql = "INSERT INTO dosen(DOSEN,NIDN,PDD) VALUES ('" . $dosen . "','" . $nidn . "','" . $pdd . "');";
        $stmt = mysql_query($sql,$this->conn);
        return $stmt;
    }
    public function simpanedit($dosen,$nidn,$pdd,$iddosen){
        $sql = "UPDATE dosen SET DOSEN='" . $dosen . "',NIDN='" . $nidn . "', PDD='" . $pdd . "' WHERE IDDOSEN=$iddosen;";
        $stmt = mysql_query($sql,$this->conn);
        return $sql;
    }
    public function hapusdosen($iddosen){
        $sql = "DELETE FROM dosen WHERE IDDOSEN=$iddosen;";
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