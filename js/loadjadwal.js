$(document).ready(function(){
    loadjadwal();
    
    $('#groupruang').change(function(){
        loadjadwal();
    });
    
    $('#groupruanghari').change(function(){
        loadjadwal();
    });
    
    var auto_refresh = setInterval(function (){ 
        loadjadwal(); 
    }, 100000);
    
    function loadjadwal(){
        
       groupruang = $('#groupruang').val();
       groupruanghari = $('#groupruanghari').val();
       //alert(groupruanghari);
       $.ajax({
			type	: "POST",
			url		: "moduls/loaddata.php",
			data	: "GR="+groupruang+"&GRH="+groupruanghari,
			success	: function(data){
			     $('.vdata').html(data);
			}
		});
 
       return false;
       
    }
/*       
    $('.btndosen').click(function(){
        groupruanghari = $('#groupruanghari').val();
        $.ajax({
			type	: "POST",
			url		: "moduls/dosenlist.php",
			data	: "GRH="+groupruanghari,
			success	: function(data){
			     $('.vdata').html(data);
			}
		});
    });
*/                 
    $("#jam").clock({"format":"12","calendar":"true"});
    
});