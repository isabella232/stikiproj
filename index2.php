<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KucingManis" />

	<title>Status Ruang Kelas</title>
    <link rel="shortcut icon" href="images/stiki.png"/>
    <link rel="stylesheet" href="css/style2.css" type="text/css"/>
</head>

<body>
<div class="row">
    <div class="column ColHeader">
        <h3><div id="jam">Hari: Jam: </div></h3>
    </div>
</div> 
<div class="vdata"></div>

<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $('.vdata').load('admin/moduls/databsensi-cron.php');
    
    var auto_refresh = setInterval(function (){
        $("#jam").load("admin/moduls/jamsistem.php");
    }, 1000);  
    
</script>
<script src="js/loadjadwal2.js"></script>
</body>
</html>