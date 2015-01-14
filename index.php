<?PHP
$hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hr = $hari[date("w")];
?><!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="NudeSource" />

	<title>JADWAL KULIAH SEMESTER GENAP</title>
    <link rel="shortcut icon" href="images/stiki.png"/>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
<style>

</style>
<!-- <?PHP echo $hr;?> -->
</head>

<body>
<div class="footernav">

</div>
<div class="menubar">
    <div id="jam"></div>
    <div class="pilihruang">
    Group Ruang<br />
    <select id="groupruang">
    <option>RUANG 1</option>
    <option>RUANG 2</option>
    <option>RUANG 3</option>
    <option>RUANG 4</option>
    <option>LAB</option>
    <option>LAB A </option>
    <option>LAB B</option>
    <option>LAB C</option>
    <option>LAB D</option>
    <option>LAB JARKOM</option>
    <option>LAB ROBOTIK</option>
    </select>
    <div class="grpruanghari">Group Ruang - Hari</div>
    <select id="groupruanghari">
    <option<?PHP echo ($hr=="Senin" ? ' SELECTED="selected"' : ''); ?>>SENIN</option>
    <option<?PHP echo ($hr=="Selasa" ? ' SELECTED="selected"' : ''); ?>>SELASA</option>
    <option<?PHP echo ($hr=="Rabu" ? ' SELECTED="selected"' : ''); ?>>RABU</option>
    <option<?PHP echo ($hr=="Kamis" ? ' SELECTED="selected"' : ''); ?>>KAMIS</option>
    <option<?PHP echo ($hr=="Jumat" ? ' SELECTED="selected"' : ''); ?>>JUMAT</option>
    <option<?PHP echo ($hr=="Sabtu" ? ' SELECTED="selected"' : ''); ?>>SABTU</option>
    </select>
    </div>
    
    
    
    <div class="legend">
        Status Kelas Dosen 
        <div>
        <span class="legendkuning">Ijin</span>
        <span class="legendmerah">Hadir</span>
        <span class="legendhijau">Selesai</span>
        </div>
    </div>
    
    <div class="legend">
        <button class="btnlogin">Login ke AdminPage</button>
    </div>
    
</div>

<div style="display: none;"></div>

<div class="headerbar">Jadwal PerKuliahan Tahun Ajaran 2013/2014</div>
<div class="vdata"></div>

<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>  

<script src="js/jqClock.min.js"></script>
<script src="js/loadjadwal.js"></script>
<script src="js/jadwalaktif.js"></script>
<script src="js/alertbox.js"  type="text/javascript"></script>
<script type="text/javascript">
    $('.btndosen').alerbox({
        url :'http://localhost/stikiproj/moduls/dosenlistac.php?GRH='+$('#groupruanghari').val()
    });
    $('#alertclose').alerbox({
        div :'#container'
    });
    
</script>

<script type="text/javascript">
    function checkin(ex){
        var urlx = "moduls/dosenabsen.php";
        var d = new Date();
        var tgl = d.getDay();
        var bln = d.getMonth();
        var thn = d.getFullYear();
        var jam = d.getHours(); 
        var menit = d.getMinutes();
        var jam = (jam+":"+menit);
        var tgl = thn+'-'+bln+'-'+tgl;
        var masuk = 'IN';
        
        $('.dosenlist').load(urlx, {'IDSN': (ex),'JAMSKR':jam,'TGLSKR':tgl,'JNS':masuk}, function(){});
    }
    function checkout(ex){
        var urlx = "moduls/dosenabsen.php";
        var d = new Date();
        var tgl = d.getDay();
        var bln = d.getMonth();
        var thn = d.getFullYear();
        var jam = d.getHours(); 
        var menit = d.getMinutes();
        var jam = (jam+":"+menit);
        var tgl = thn+'-'+bln+'-'+tgl;
        var keluar = 'OUT';
        
        $('.dosenlist').load(urlx, {'IDSN': (ex),'JAMSKR':jam,'TGLSKR':tgl,'JNS':keluar}, function(){});
    }
    function keterangan(ex){
        var urlx = "moduls/dosenabsen.php";
        var d = new Date();
        var tgl = d.getDay();
        var bln = d.getMonth();
        var thn = d.getFullYear();
        var jam = d.getHours(); 
        var menit = d.getMinutes();
        var jam = (jam+":"+menit);
        var tgl = thn+'-'+bln+'-'+tgl;
        var ket = 'REM';
        
        $('.dosenlist').load(urlx, {'IDSN': (ex),'JAMSKR':jam,'TGLSKR':tgl,'JNS':ket}, function(){});
        return false;
    }
    $('.btnlogin').click(function(){
        window.open('admin/index.php');
    });
    function closewind(){
        //var url = "http://localhost/stikiproj/moduls/dosenlistac.php?GRH="+$('#groupruanghari').val();
        $('.dosenlist').load("moduls/dosenlist.php", {'GRH': $('#groupruanghari').val()}, function(){});
    }
</script>
</body>
</html>