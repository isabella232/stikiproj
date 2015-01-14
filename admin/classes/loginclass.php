<?php

class LoginClass
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
	
	public function checkUserLogin($username,$password,$kue)
	{
	   $hsl = 0;    
	   $sql = 'SELECT member_username,member_admin, member_password, member_id FROM members WHERE member_username = "' . $username . '"';
       $stmt = mysql_query($sql,$this->conn);
	   $count = mysql_num_rows($stmt);
       if($count==1){
          $data = mysql_fetch_array($stmt);
          if ($data['member_password'] == md5($password)){
              date_default_timezone_set("Asia/Makassar");
              $kuex = date("YmdHis");  
              $_SESSION['LOGIN']=md5($kuex);
              $_SESSION['LOGINAME']=$data['member_username'];
              $_SESSION['LOGINLEVEL']=$data['member_admin'];
              $_SESSION['LOGINID']=$data['member_id']; 
              if($kue==true){
                  setcookie("user",$data['member_username'] , time()+3600);
                  setcookie("userlvl",$data['member_admin'] , time()+3600);
                  setcookie("userlid",$data['member_id'] , time()+3600);
              }
              $hsl=1;
          }
       }
       
       return $hsl; 
    }
    public function verify(){
        if(isset($_SESSION['LOGIN'])){
			return true;
		}else{
			header("Location: login.php");
			exit();
		}
    }
    public function logUserOut()
	{
		if(isset($_SESSION['LOGIN']))
		{
			// Will destroy all sessions::
			if(session_destroy())
			{
				header("Location: login.php");
				exit();
			}
		}
	}
    public function __destruct()
	{
		$closeConnection = mysql_close($this->conn);
		if($closeConnection){return true;}
	} 

} 
?>