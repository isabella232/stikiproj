<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KucingManis" />

	<title></title>
<link type="text/css" href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
    
<style type="text/css">
button {
	margin: 2px; 
	position: relative; 
	padding: 4px 8px 4px 4px; 
	cursor: pointer;   
	list-style: none;
}
button span.ui-icon {
	float: left; 
	margin: 0 14px;
}
#menu-tombol {
	padding-bottom:10px;
	padding:15px 15px 15px 15px;
}
#tombol-tambah{
	float:left;
	width:250px;
}
.ca-content{
    margin: 14px;
    font-family: verdana;
    font-size: 16px;
    
}
#lewat{
  background-color:#00FF66;
  color:#FFFFFF;
  font-family:Verdana, Arial, Helvetica, sans-serif;
  border-color: #FFFFFF;
}
#aktif{
  background-color:brown;
  color:#FFFFFF;
  font-family:Verdana, Arial, Helvetica, sans-serif;
  border-color: #FFFFFF;
}
#kosong{
  background-color:#FF0000;
  color:#FFFFFF;
  font-family:Verdana, Arial, Helvetica, sans-serif;
  border-color: #FFFFFF;
}
#filterdata{
	display:inline;
	padding-left:140px;
	text-align:right;
}
.jamaktif{
	background:#00D96C;
}
#daftar
{
	font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
	font-size: 12px;
	margin-top: 15px;
	border-collapse: collapse;
	text-align: left;
}
#daftar th
{
	font-size: 12px;
	font-weight: normal;
	color: #039;
	padding: 10px 8px;
	border-bottom: 2px solid #6678b1;
    text-align: center;
}
#daftar td
{
	padding: 9px 8px 0px 8px;
    border: 1px solid;
}
#daftar tbody tr:hover td
{
	
}

</style>
</head>

<body>

<div id="tabku">
        <ul>
            <li><a href="#a">Hari</a></li>
            <li><a href="#b">Ruang</a></li>
        </ul>
        <div id="a">
            <button>SENIN</button>
            <button>SELASA</button>
            <button>RABU</button>
            <button>KAMIS</button>
            <button>JUMAT</button>
            <button>SABTU</button>
            <button>Hari Ini</button>
            <div id="inforuang">
            
            <div class="ca-content">
            Hari: <span id="jam"> </span> <div id="filterdata">Filter Data Kelas<select><option>Semua</option><option>R 1XX</option><option>R 2XX</option></select></div> 
            <table id="daftar">
            <thead>
            <tr>
            <th scope="col1">Jam</th>
            <th scope="col2">R 101</th>
            <th scope="col2">R 102</th>
            <th scope="col2">R 103</th>
            <th scope="col2">R 104</th>
            </tr>
            </thead>
            <tfoot>
    	<tr>
        	<td colspan="4" class="rounded-foot-left"><em>1. Aktif 2. Tidak Aktif 3. Sedang Berlangsung 4. Sudah Berlangsung </em></td>
        	<td class="rounded-foot-right">&nbsp;</td>
        </tr>
    </tfoot>
            <tr>
            <td class="jam1">07:30 - 08:15</td>
            <td rowspan="2" id="lewat">Kalkulkus I A<div>Dewa Ngakan KT Putra Negara, S.T., MT</div></td>
            <td rowspan="3" class="style1" id="aktif">Dasar Sistem Komputer_A<div>I Nyoman Buda Hartawan,S.Kom.,M.Kom</div></td>
            <td rowspan="2" id="aktif">Pancasila Dan Kewarganegaraan_P<div>HAPPY BUDYANA,SH., M.Kn</div></td>
            <td rowspan="2" id="aktif">Bahasa Inggris I_E<div>AGUS BISENA, S.Pd</div></td>
            </tr>
            
            <tr>
            <td class="jam2">08:15 - 09:00</td>
            </tr>
            
            <tr>
            <td class="jam3">09:00 - 09:45</td>
            <td rowspan="2" id="kosong">Etika Profesi C<div>DRS. Komang Dewanta Pendit</div><div>Ket: Sakit</div></td>
            <td rowspan="2" id="aktif">Interpersonal Skill_D <br>
              BAGUS KUSUMA WIJAYA,SE.,MBA</td> 
            <td rowspan="2" id="aktif">Agama_A<div>KOMANG SUWILINDIARI, S.Sn., M.Si</div></td>
            </tr>
            
            <tr>
            <td class="jam4">09:45 - 10:30</td>
            <td rowspan="3" id="aktif">Algoritma dan Pemrograman_P  <br>
              I DEWA GEDE AGUNG PANDAWANA, S.KOM.</td>
            </tr>
            
            <tr>
              <td class="jam5">10:30 - 11:15</td>
              <td rowspan="2" id="aktif">Object Oriented Programming D
                <div>I KDK DWI Gandika Supartha, ST</div>
                <div></div></td>
              <td></td>
              <td rowspan="2" id="kosong">Manajemen dan Organisasi_F  <br>
              GEDE DANA PRAMITHA,SE.,MM<div>Ket: Ijin Dinas Keluar Kota</div></td>
            </tr>
            
            <tr>
            <td class="jam6">11:15 - 12:00</td>
            <td></td>
            </tr>
            
            <tr>
              <td class="jam7">12:00 - 12:45</td>
              <td rowspan="3" id="aktif">Arsitektur dan Organisasi Komputer<div>Putu Putra Astawa, M.Kom</div></td>
              <td></td>
              <td rowspan="2" id="aktif">Komputer dan Masyarakat_A<br>
              I Nyoman Buda Hartawan,S.Kom.,M.Kom</td>
              <td></td>
            </tr>
            
            <tr>
              <td class="jam8">12:45 - 13:30</td>
              <td></td>
              <td></td>
            </tr>
            
            <tr>
              <td class="jam9">13:30 - 14:15</td>
              <td></td>
              <td></td>  
              <td></td>
            </tr>
            
            <tr>
              <td class="jam10">14:15 - 15:00</td>
              <td></td>
              <td rowspan="2" id="aktif">Bahasa Inggris I_C  <br>
              SRI WIDIASTUTIK, SS., M.HUM</td>
              <td></td>
              <td></td>
            </tr>
            
            <tr>
              <td class="jam11">15:00 - 15:45</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            
            <tr>
              <td class="jam12">15:45 - 16:30</td>
              <td rowspan="2"><p>Jaringan Komputer D<br>
                I Made Sudarsana, S.Kom</p>              </td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            
            <tr>
              <td class="jam13">16:30 - 17:15</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            
            <tr>
              <td class="jam14">17:30 - 18:15</td>
              <td rowspan="3"><p>Dasar Sistem Komputer B<br>
              Ketut Ngr Semadi, S.Kom., MM.Kom</p>              </td>
              <td rowspan="3">Komunikasi Data B<br>
              Ayu Manik Dirgayusari S.Kom.,M.MT</td>
              <td></td>
              <td rowspan="2">Kalkulus I_N  <br>
              NI WAYAN EKAYANTI, S.Pd.,M.Si</td>
            </tr>
            
            <tr>
              <td class="jam15">18:15 - 19:00</td>
              <td></td>
              </tr>
            
            <tr>
              <td class="jam16">19:00 - 19:45</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td class="jam17">19:45 - 20:30</td>
              <td rowspan="3">Arsitektur dan Organisasi Komputer N<br>
                Nyoman Ngurah Adisanjaya, S.Si.,M.Si </td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            
            <tr>
              <td class="jam18">20:30 - 21:15</td>
              <td rowspan="2">Akuntansi_L<br>
              KETUT LAKSMI MASWARI, SP., MM</td>
              <td rowspan="2">Agama_O  <br>
              I KETUT SUTIKA, SH,S.Pd., M.Si</td>
              <td></td>
            </tr>
            
            <tr>
              <td class="jam19">21:15 - 22:00</td>
              <td></td>
            </tr>
            </table>
            </div>
            
            </div>
        </div>
        
        <div id="b">
            <button>R 101</button>
            <button>R 102</button>
            <button>R 103</button>
            <button>R 104</button>
            <button>R 105</button>
            <button>R 106</button>
        </div>

</div>


<script>
    (function($){
        $("#tabku").tabs();
    })(jQuery);
    
</script>

<script src="js/jqClock.min.js"></script>
<script type="text/javascript">
   $(document).ready(function(){    
      $("#jam").clock({"format":"12","calendar":"true"});
   });
   
</script>
<script type="text/javascript">
    $(document).ready(function(){   
      setInterval(function(){  
      var d = new Date();
      var jam = d.getHours(); 
      var menit = d.getMinutes();
      
      if(jam >=22 ) {
        $('.jam19').css("background","");
      }else if(jam >=21 && (menit>=15) ) {
        $('.jam19').css("background","#00D96C");
        $('.jam18').css("background","");
      }else if(jam >=20 && (menit>=30) ) {
        $('.jam18').css("background","#00D96C");
        $('.jam17').css("background","");
      }else if(jam >=19 && (menit>=45) ) {
        $('.jam17').css("background","#00D96C");
        $('.jam16').css("background","");
      }else if(jam >=19 && (menit>=00) ) {
        $('.jam16').css("background","#00D96C");
        $('.jam15').css("background","");
      }else if(jam >=18 && (menit>=15) ) {
        $('.jam15').css("background","#00D96C");
        $('.jam14').css("background","");
      }else if(jam >=17 && (menit>=30) ) {
        $('.jam14').css("background","#00D96C");
        $('.jam13').css("background","");
      }else if(jam >=16 && (menit>=30) ) {
        $('.jam13').css("background","#00D96C");
        $('.jam12').css("background","");
      }else if(jam >=15 && (menit>=45) ) {
        $('.jam12').css("background","#00D96C");
        $('.jam11').css("background","");
      }else
      if(jam >=15 && (menit>=0) ) {
        $('.jam11').css("background","#00D96C");
        $('.jam10').css("background","");
      }else
      if(jam >=14 && (menit>=15) ) {
        $('.jam10').css("background","#00D96C");
        $('.jam9').css("background","");
      }else
      if(jam >=13 && (menit>=30) ) {
        $('.jam9').css("background","#00D96C");
        $('.jam8').css("background","");
      }else
      if(jam >=12 && (menit>=45) ) {
        $('.jam8').css("background","#00D96C");
        $('.jam7').css("background","");
      }else
      if(jam >=12 && (menit>=0) ) {
        $('.jam7').css("background","#00D96C");
        $('.jam6').css("background","");
      }else
      if(jam >=11 && (menit>=15) ) {
        $('.jam6').css("background","#00D96C");
        $('.jam5').css("background","");
      }else
      if(jam >=10 && (menit>=30) ) {
        $('.jam5').css("background","#00D96C");
        $('.jam4').css("background","");
      }else
      if(jam >=9 && (menit>=45) ) {
        $('.jam4').css("background","#00D96C");
        $('.jam3').css("background","");
      }else
      if(jam >=9 && (menit>=0) ) {
        $('.jam3').css("background","#00D96C");
        $('.jam2').css("background","");
      }else
      if(jam >=8 && (menit>=15) ) {
        $('.jam2').css("background","#00D96C");
        $('.jam1').css("background","");
      }else
      if(jam >=7 && (menit>=30) ) {
        $('.jam1').css("background","#00D96C");
      }
      },500);
   });    
</script>    
</body>
</html>
<?php 
function tgljam(){
    $jm = time();
    echo $jm;
}
?>