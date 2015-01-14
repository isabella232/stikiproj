<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="NudeSource" />

	<title>Dosen List</title>
</head>

<body>

<div class="dosenlist">Harap Tunggu....</div>
<div class="dosenedit"></div>

<div class="pagging"></div>

<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
    
    $.ajax({
			type	: "POST",
			url		: "moduls/databsensi-cron.php",
			success	: function(data){
				$('.dosenlist').load("moduls/dosenlist.php", {'GRH': $('#groupruanghari').val()}, function(){});
			}
		});
});
</script>
</body>
</html>