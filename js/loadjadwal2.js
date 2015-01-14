$(document).ready(function(){
    loadjadwal();
    
    var auto_refreshx = setInterval(function (){ 
        loadjadwal(); 
    }, 1000);
    
    function loadjadwal(){
        
       groupruang = $('#groupruang').val();
       groupruanghari = $('#groupruanghari').val();
       //alert(groupruanghari);
       $.ajax({
			type	: "POST",
			url		: "moduls/loaddata2.php",
			success	: function(data){
			     $('.vdata').html(data);
			}
		});
 
       //return false;
       
    }
    
});