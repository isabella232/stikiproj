<?php
/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include_once('../classes/useraccount.php');

$page = '';
$hr='';

if(isset($_POST['PAGE'])){
    $page = $_POST['PAGE'];
}

$pg = new UserAccount;

$txdata = $pg->userlist($page);

echo $txdata;
?>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript">
    $('.lsedituser').click(function(){
        var clicked_id = $(this).attr("id").split("-");
        var idpage = parseInt(clicked_id[0]);
        
        $('#cmdnew').hide();
        $('#kopjadwal').hide();
        $('#tampildata').load('moduls/userdit.php',{"IDUSER":idpage,OPSI: 0});
  
        return false;
    });
</script>