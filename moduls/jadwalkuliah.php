<?php

/**
 * @author NudeSource
 * @copyright 2014
 */

class jadwalkuliah{
    
	public $conn, $db;

	public function __construct()
	{
		$this->cn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if ($this->cn->connect_errno) {
            echo "Failed to connect to MySQL: (" . $cn->connect_errno . ") " . $cn->connect_error;
        }

	}
    
    public function day2hari(){
        $namahari = date('l');
        if ($namahari == "Sunday") $namahari = "MINGGU";
        else if ($namahari == "Monday") $namahari = "SENIN";
        else if ($namahari == "Tuesday") $namahari = "SELASA";
        else if ($namahari == "Wednesday") $namahari = "RABU";
        else if ($namahari == "Thursday") $namahari = "KAMIS";
        else if ($namahari == "Friday") $namahari = "JUMAT";
        else if ($namahari == "Saturday") $namahari = "SABTU";
        
        return $namahari;
    }
    
    public function jamkuliah(){
        $sql1 = "SELECT * FROM jampertemuan Order by JAMKE;";
        $psn = "";
        if (!($res1 = $this->cn->query($sql1))) {
            $psn =  "Fetch failed: (" . $this->cn->errno . ") " . $cn->error;
        }else{
            $no = 0;
            while($row1 = $res1->fetch_assoc()){
                $psn[$no] =  $row1['MULAI'] . ' - ' . $row1['BERAKHIR']; 
            }
        }
        return $psn;
    }
    
    public function dosenlist($hari='SENIN'){
        //$sql1 =  
    }
}
?>