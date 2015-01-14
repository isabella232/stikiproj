<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
class RuangKelas{
	public $conn, $db;
	public function __construct()
	{
		$this->conn = mysql_connect(DB_HOST,DB_USER,DB_PASS)
			or die('Maaf sistem tidak bisa melakukan sambungan ke server. Silakan periksa segera!');
		$this->db = mysql_select_db(DB_NAME)
			or die('Maaf sistem tidak bisa melakukan sambungan ke server. Silakan periksa segera!');
	}

    public function ruanglist($pg=''){
        
        $no=1;
        if($pg==''){
            $pg=0;
        }
        $position = ($pg * 10);
        $no=$position+1;
        
        $sql = "select count(MK) as num from matakuliah;";
        $stmt = mysql_query($sql,$this->conn);
        $hsl = mysql_fetch_array($stmt);
        $count = $hsl['num'];
        
        $sql1 = "select ruang, idruang from ruangkelas limit $position,10;";
 
        $stmt = mysql_query($sql1,$this->conn);
        
        $jruang=0;
        $tx = "<div class='headerdl'></div>";
        $tx .= "<table id=\"rounded-corner\" class='daftardosen'>";
        $tx .= "<thead><tr><th>No</th><th>Ruang Kelas</th><th>&nbsp;</th></tr></thead><tbody>";
        while($row1 = mysql_fetch_array($stmt)){
            $lsid = $row1['idruang'];
            
            $tx .= "<tr><td>" . $no . "</td>";
            
            $tx .= "<td><div class='jam1-" . $row1['ruang'] . "'>" . $row1['ruang'] . "</div></td>";
            $tx .= "<td><a href='#' class='lseditkelas' id='" . $lsid . "-edit'><i class=\"icon-edit\"></i></a></td>";
            
            $tx .= "</tr>";
            $no++;        
        }
        $pgx = $pg++;
        $tx .= "</tbody></TABLE>Page: " . $pgx . " Total Data: " . $count;
        //return $sql1;
        return $tx;
                        
    }
    public function ruangkelasbaru($kls){
        $sql = "INSERT INTO ruangkelas(ruang) VALUES('" . $kls . "');";
        $stmt = mysql_query($sql,$this->conn);
        return "OK";
    }
    public function ruangkelasedit($kls,$idkls){
        $sql = "UPDATE ruangkelas SET ruang='" . $kls . "' WHERE idruang=" . $idkls . ";";
        $stmt = mysql_query($sql,$this->conn);
        return "OK";
    }  
    public function ruangkelashapus($idkls){
        $sql = "DELETE FROM ruangkelas WHERE idruang=" . $idkls . ";";
        $stmt = mysql_query($sql,$this->conn);
        return "OK";
    }  
    public function pagging($filter){
       
       if($filter==""){
           $sql = "SELECT count(*) as num FROM ruangkelas;";  
       }else{ 
           $sql = "SELECT count(*) as num FROM ruangkelas WHERE ruang like '%" . $filter . "%';"; 
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
            //$pagination .= '<li><a href="#" class="paginatekelas_click" id="'.$i.'-' . $filter . '-page">'.$i.'</a></li>';
            $pagination .= '<option value="'.$i.'">'.$i.'</option>';
          }
 
        }
        //$pagination .= '</ul></div>';
        $pagination .= '</select></div>';
        
        return $pagination;
    }
    public function viewidkelas($idkelas){
       $sql = "SELECT ruang FROM ruangkelas WHERE idruang=" . $idkelas;
       $stmt = mysql_query($sql,$this->conn);
       $hsl = mysql_fetch_array($stmt);
       return $hsl['ruang'];
    }
    public function __destruct()
	{
		$closeConnection = mysql_close($this->conn);
		if($closeConnection){return true;}
	} 
}
?>