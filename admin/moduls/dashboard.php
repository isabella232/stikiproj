<?php 
include('../../moduls/config.php');
?>                   
<style type="text/css">
.dashboard, .dashboardlg{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #123d54;
	padding: 10px 20px;
	background: -moz-linear-gradient(
		top,
		#afd9fa 0%,
		#588fad);
	background: -webkit-gradient(
		linear, left top, left bottom,
		from(#afd9fa),
		to(#588fad));
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
	border-radius: 6px;
	border: 1px solid #003366;
	-moz-box-shadow:
		0px 1px 3px rgba(000,000,000,0.5),
		inset 0px 0px 1px rgba(255,255,255,1);
	-webkit-box-shadow:
		0px 1px 3px rgba(000,000,000,0.5),
		inset 0px 0px 1px rgba(255,255,255,1);
	box-shadow:
		0px 1px 3px rgba(000,000,000,0.5),
		inset 0px 0px 1px rgba(255,255,255,1);
	text-shadow:
		0px -1px 0px rgba(000,000,000,0.7),
		0px 1px 0px rgba(255,255,255,0.3);
}
</style> <div class="arena">
                    <div class="alert alert-info">
						<i class="icon-info-sign"></i> Selamat Datang di Dashboard Jadwal Kuliah versi <?php echo VERSION ?>
					</div>
					<div class="well blank-slate">
                        <br />
                        
                        <p>
                        <button class="dashboard" id="ruangkelas"><i class="icon-magnet"></i> Ruang Kelas</button>
                    	<button class="dashboard" id="jadwalkuliah"><i class="icon-calendar"></i> Jadwal Kuliah</button>
                        <button class="dashboard" id="datadosen"><i class="icon-briefcase"></i> Data Dosen</button>
                        <button class="dashboard" id="matakuliah"><i class="icon-list-alt"></i> MataKuliah</button>
<?php 
if($_SESSION['LOGINLEVEL']==1){
?>                         
                        <button class="dashboard" id="user"><i class="icon-user"></i> User Managemen</button>
<?PHP } ?>
                        </p>
                        <br /><p>
                        <button class="dashboard" id="absendosen"><i class="icon-bell"></i> Absen Dosen</button>
                        <button class="dashboard" id="lap-dosen"><i class="icon-file"></i> Rekap Absensi Dosen</button>
                        </p>
                        <br /><p>
                        <button class="dashboard" id="account"><i class="icon-user"></i> @<?php echo $_SESSION['LOGINAME']?></button>
                        <button class="dashboard" id="logout"><i class="icon-off"></i> Logout</button>
                        </p>
                        </div>
					</div>

<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.blank-slate button').click(function(){
        if($(this).attr('id')=='logout'){
	       location.href = 'dashboard.php?logout';  
        }else{
		  var url = "moduls/"+$(this).attr('id')+'.php';
		  $('.arena').load(url);
        }
    })
});
</script>