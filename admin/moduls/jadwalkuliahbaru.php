<?php

/**
 * @author NudeSource
 * @copyright 2014
 */
include('../../moduls/config.php');
include('../classes/jadwalkuliah.php');
$pg = new JadwalKuliah;
$txmk = $pg->MatakuliahList(0);
$txjamulai = $pg->JaMulaiList(0);
$txjamakhir = $pg->JamAkhirList(0);
$txruang = $pg->RuangKelasList(0);
$txdosen = $pg->DosenList(0);

?>
<style type="text/css">
#cmdjadwalbaru, #cmdbatal{
    margin-top: 20px;
    margin-left: 10px;
    width: 150px;
    height: 40px;
    cursor:pointer;
}
.erro{
    border-color: red;
}
</style>
<table>

<tr>
<td>MATAKULIAH</td>
<td>: <select id="pilihmk">
<?php echo $txmk; ?>
</select> <span id="loadmk" style="display: none;">*</span></td>
</tr>

<tr>
<td>HARI</td>
<td>: <select id="pilihari">
<option value="0">Pilih Hari</option>
<option>SENIN</option>
<option>SELASA</option>
<option>RABU</option>
<option>KAMIS</option>
<option>JUMAT</option>
<option>SABTU</option>
</select> <span id="loadhari" style="display: none;">*</span></td>
</tr>

<tr>
<td>JAM MULAI</td>
<td>: <select id="pilihmulai">
<?php echo $txjamulai; ?>
</select> <span id="loadmulai" style="display: none;">*</span></td>
</tr>

<tr>
<td>JAM BERAKHIR</td>
<td>: <select id="pilihakhir">
<?php echo $txjamakhir; ?>
</select> <span id="loadslesai" style="display: none;">*</span></td>
</tr>

<tr>
<td>KELAS</td>
<td>: <input type="text" size="2,1" id="pilihkelas"> <span id="loadkls" style="display: none;">*</span></td>
</tr>

<tr>
<td>RUANG</td>
<td>: <select id="pilihruang">
<?php echo $txruang; ?>
</select> <span id="loadruang" style="display: none;">*</span>
</select></td>
</tr>

<tr>
<td>DOSEN</td>
<td>: <select id="pilihdosen">
<?php echo $txdosen; ?>
</select> <span id="loaddosen" style="display: none;">*</span>
</select></td>
</tr>

<tr>
<td><button id="cmdjadwalbaru">Simpan</button></td>
<td><button id="cmdbatal">Batal</button></td>
</table>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#pilihmk').change(function(){
        var nl = $('#pilihmk').val();
        if(nl==0){
            $('#pilihmk').addClass('erro');
        }else{ 
            $('#pilihmk').removeClass('erro');
        }
    });
    $('#pilihari').change(function(){
        var nl = $('#pilihari').val();
        if(nl==0){
            $('#pilihari').addClass('erro');
        }else{ 
            $('#pilihari').removeClass('erro');
        }
    });
    $('#pilihmulai').change(function(){
        var nl = $('#pilihmulai').val();
        if(nl==0){
            $('#pilihmulai').addClass('erro');
        }else{ 
            $('#pilihmulai').removeClass('erro');
        }
    });
    $('#pilihakhir').change(function(){
        var nl = $('#pilihakhir').val();
        if(nl==0){
            $('#pilihakhir').addClass('erro');
        }else{ 
            $('#pilihakhir').removeClass('erro');
        }
    });
    $('#pilihkelas').change(function(){
        var nl = $('#pilihkelas').val();
        if(nl==0){
            $('#pilihkelas').addClass('erro');
        }else{ 
            $('#pilihkelas').removeClass('erro');
        }
    });
    $('#pilihruang').change(function(){
        var nl = $('#pilihruang').val();
        if(nl==0){
            $('#pilihruang').addClass('erro');
        }else{ 
            $('#pilihruang').removeClass('erro');
        }
    });
    $('#pilihdosen').change(function(){
        var nl = $('#pilihdosen').val();
        if(nl==0){
            $('#pilihdosen').addClass('erro');
        }else{ 
            $('#pilihdosen').removeClass('erro');
        }
    });
    $('#cmdjadwalbaru').click(function(){
        var txerrket = "OK";
        var txerr = "";
        
        var mk = $('#pilihmk').val();
        var hari = $('#pilihari').val();
        var jmulai = parseInt($('#pilihmulai').val());
        var jslesai = parseInt($('#pilihakhir').val());
        var kls = $('#pilihkelas').val();
        var r = $('#pilihruang').val();
        var dsn = $('#pilihdosen').val();
        
        //alert(jmulai + " " + jslesai);

        if(mk==0){
            $('#pilihmk').addClass('erro');
            txerr=txerr+"\n->Silahkan pilih Matakuliah";
            txerrket="ERROR";
        }
        if(hari==0){
            $('#pilihari').addClass('erro');
            txerr=txerr+"\n->Silahkan pilih Hari";
            txerrket="ERROR";
        }
        if(jmulai==0){
            $('#pilihmulai').addClass('erro');
            txerr=txerr+"\n->Silahkan pilih Jam Mulai";
            txerrket="ERROR";
        }
        if(jslesai==0){
            $('#pilihakhir').addClass('erro');
            txerr=txerr+"\n->Silahkan pilih Jam Berakhir";
            txerrket="ERROR";
        }
        if(jmulai > jslesai){
            $('#pilihakhir').addClass('erro');
            txerr=txerr + "\n->Jam Selesai Lebih Kecil dari Jam Mulai";
            txerrket="ERROR";
        }
        if(kls.length<=0){
            $('#pilihkelas').addClass('erro');
            txerr=txerr+"\n->Silahkan Tuliskan Kelas";
            txerrket="ERROR";
        }
        if(r==0){
            $('#pilihruang').addClass('erro');
            txerr=txerr+"\n->Silahkan pilih Ruang Perkuliahan";
            txerrket="ERROR";
        }
        if(dsn==0){
            $('#pilihdosen').addClass('erro');
            txerr=txerr+"\n->Silahkan pilih Dosen Pemateri";
            txerrket="ERROR";
        }
        if(txerrket=="OK"){
            var dt = 'mk='+mk+'&hr='+hari+'&jmulai='+jmulai+'&jselesai='+jslesai+'&kls='+kls+'&r='+r+'&dsn='+dsn;

            $.ajax({
    			type	: "POST",
    			url		: "moduls/jadwalkuliahsimpandata.php",
    			data	: dt,
                dataType: "json",
    			success	: function(data){
    			     var url = "moduls/jadwalkuliah.php";
                     $('.span9').load(url);
    			}
    		});
        }else{
            txerr="Form Isian ada yang salah diantaranya:"+txerr+"\nSilahkan di Check Kembali";
            alert(txerr);
            return false;
        }      
    });
    $('#cmdbatal').click(function(){
        var url = "moduls/jadwalkuliah.php";
        $('.span9').load(url);
    });
});
</script>