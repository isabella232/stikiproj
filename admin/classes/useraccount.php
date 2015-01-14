<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
class UserAccount{
	public $conn, $db;
	public function __construct()
	{
		$this->conn = mysql_connect(DB_HOST,DB_USER,DB_PASS)
			or die('Maaf sistem tidak bisa melakukan sambungan ke server. Silakan periksa segera!');
		$this->db = mysql_select_db(DB_NAME)
			or die('Maaf sistem tidak bisa melakukan sambungan ke server. Silakan periksa segera!');
	}
    public function userlist($pg='',$uname=''){
        $position=0;
        if($pg==''){
            $pg=0;
        }
        $position = ($pg * 10);
        
        if($uname==''){
            $sql1 = "SELECT member_id, member_username, member_admin FROM members limit $position,10;";
        }else{
            $sql1 = "SELECT member_id, member_username, member_admin FROM members WHERE member_username like '%" . $uname . "' limit $position,10;";
        }    
        $stmt = mysql_query($sql1,$this->conn);
        $tx = "<div class='headerdl'></div>";
        $tx .= "<table id=\"rounded-corner\" class='daftardosen'>";
        $tx .= "<thead><tr><th>No</th><th>User</th><th>Level</th><th>Action</th></tr></thead><tbody>";
        $no=$position+1;
        while($row1 = mysql_fetch_array($stmt)){
            $tx .= "<tr><td>" . $no . "</td><td>" . $row1['member_username'] . "</td>";
            $tx .= "<td><div class='jam1-" . $row1['member_admin'] . "'>" . $row1['member_admin'] . "</div></td>";
            $tx .= "<td><a href='#' class='lsedituser' id='" . $row1['member_id'] . "-edit'><i class=\"icon-edit\"></i></a></td></tr>";
            $no++;
        }    
        $tx .= "</tbody></TABLE>";
        return $tx;
    }
    public function pagging($pg='',$filter=''){
        if($pg==''){
           $pg=0;
       }
       
       if($filter==""){
           $sql = "SELECT count(*) as num FROM members;";  
       }else{ 
           $sql = "SELECT count(*) as num FROM members WHERE member_username like '%" . $filter . "';"; 
       } 

       $stmt = mysql_query($sql,$this->conn);
       $hsl = mysql_fetch_array($stmt);
       $count = $hsl['num'];
       $limit = 10;
       $pages = ceil($count/$limit);
       $pagination = '<div class="pagination"><ul>';
       if($pages > 1){
          for($i = 1; $i<=$pages; $i++){
            if($filter==""){
                $pagination .= '<li><a href="#" class="paginateuser_click" id="'.$i.'-page">'.$i.'</a></li>';
            }else{
                $pagination .= '<li><a href="#" class="paginateuser_click" id="'.$i.'-' . $filter . '-page">'.$i.'</a></li>';
            }
          }
 
        }
        $pagination .= '</ul></div>';
        
        return $pagination;
        
    }
    public function username2data($uid){
        $sql1 = "SELECT member_id, member_username, member_admin FROM members WHERE member_id ='" . $uid . "';";
        $stmt = mysql_query($sql1,$this->conn);
        $row1 = mysql_fetch_array($stmt);
        $tx[0] = $row1['member_username'];
        $tx[1] = $row1['member_admin'];
        $tx[2] = $row1['member_id'];
        return $tx;
    }
    public function NewOPS($usr,$pwd,$level){
        $sql1 = "INSERT INTO members(member_username,member_password,member_admin) VALUES('" . $usr . "','" . md5($pwd) . "','" . $level . "');";
        $stmt= mysql_query($sql1,$this->conn);
        return $stmt;
    }
    public function ChangePWD($uid,$pwd1){
        $sql1 = "UPDATE members SET member_password=md5('" . $pwd1 . "') WHERE member_id ='" . $uid . "';";
        $stmt= mysql_query($sql1,$this->conn);
        return $stmt;
    }
    public function DelUser($uid,$pwd1){
        $sql1 = "DELETE FROM members WHERE member_id ='" . $uid . "';";
        $stmt= mysql_query($sql1,$this->conn);
        return $stmt;
    }
    public function ChangeLEV($uid,$lev){
        if(!$lev==0){
        $sql1 = "UPDATE members SET member_admin='" . $lev . "' WHERE member_id ='" . $uid . "';";
        $stmt= mysql_query($sql1,$this->conn);
        }
        return $stmt;
    }
    public function __destruct()
	{
		$closeConnection = mysql_close($this->conn);
		if($closeConnection){return true;}
	} 
 }
?>