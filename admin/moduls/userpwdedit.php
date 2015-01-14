<?php

/**
 * @author KucingManis
 * @copyright 2014
 */

if (isset($_POST['IDUSER'])){
    $usrid = $_POST['IDUSER'];
    $mode = $_POST['MD'];
    
    include('../../moduls/config.php');
    include('../classes/useraccount.php');

    $pg = new UserAccount;
    if($mode=="PWD"){
        $pwd1 = $_POST['PWD'];
        $datax = $pg->ChangePWD($usrid,$pwd1);
    }
    if($mode=="LEVEL"){
        $lev = $_POST['LEV'];
        $datax = $pg->ChangeLEV($usrid,$lev);
    }
    if($mode=="HPS"){
        $datax = $pg->DelUser($usrid);
    }
   
    if($mode=="NEW"){
        $usr=$_POST['USER'];
        $pwd=$_POST['PWD'];
        $lvl = $_POST['LEV'];
        $datax = $pg->NewOPS($usr,$pwd,$lvl);
    }
}
?>