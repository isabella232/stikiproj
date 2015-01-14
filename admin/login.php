<?php 
include('../moduls/config.php');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<title>Login Form</title>
<link href="css/stylelogin.css" rel="stylesheet" type="text/css" />
<link href='css/FontsGoogle.css' rel='stylesheet' type='text/css' />
</head>

<body>

<!-- Box Start-->
<div id="box_bg">



<div id="content">
	<h1>Sign In</h1>
	<div class="errox">
        Akses anda ditolak; Periksa kembali penulisan User Name dan Password Anda!
    </div>
	<!-- Login Fields -->
	<div id="login">
	<input type="text" onblur="if(this.value=='')this.value='Username';" onfocus="if(this.value=='Username')this.value='';" value="Username" class="login user"/>
	<input type='text' name='password' value='Password'  onfocus="if(this.value=='' || this.value == 'Password') {this.value='';this.type='password'}"  onblur="if(this.value == '') {this.type='text';this.value=this.defaultValue}" class="login password"/>
	</div>
	
	<!-- Green Button -->
	<div class="button green"><a href="#" id="SignIn">Sign In</a></div>

	<!-- Checkbox -->
	<div class="checkbox">
	<li>
	<fieldset>
	<![if !IE | (gte IE 8)]><legend id="title2" class="desc"></legend><![endif]>
	<!--[if lt IE 8]><label id="title2" class="desc"></label><![endif]-->
	<div>
		<span>
		
		</span>
	</div>
	</fieldset>
	</li>
	</div>

</div>
</div>
<div id="loading" style="display:none"><img src="img/loading.gif" /></div>

<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript"> 
$(function() {
	$('#loading').ajaxStart(function(){
		$(this).fadeIn();
	}).ajaxStop(function(){
		$(this).fadeOut();
	});
    
    $('.errox').hide();
    
	$('#menu a').click(function() {
		var url = $(this).attr('href');
		$('#content').load(url);
		return false;
	});
    $('.user').change(function(){
        $('.user').removeClass('erro');
    });
    $('.password').change(function(){
        $('.password').removeClass('erro');
    });
    $('#SignIn').click(function(){
        $('.errox').hide();
        var usr = $('.user').val();
        var pwd = $('.password').val();
        //var setkue = $('#Field').prop('checked');
        var erro = [0,0];
        
        if((usr.length<1) || (usr=='Username')){
            erro[0] = 1;
        }
        if((pwd.length<1) || (pwd=='Password')){
            erro[1] = 1;
        }
        if((erro[0]==1) || (erro[1]==1)){
            if(erro[0]==1){
                $('.user').addClass('erro');
            };
            if(erro[1]==1){
                $('.password').addClass('erro');
            };
        }else{
            $.ajax({
			type	: "POST",
			url		: "moduls/verifikasi.php",
			data	: "uid="+usr+
					"&passwd="+pwd,
			success	: function(data){
			     
				if(data==1){
				    
				    $('#box_bg').fadeOut();
                    location.href = 'dashboard.html';
				}else{
				    $('.errox').show();
				}
			}
		});
        };
    });
});
</script>
<style>
.erro{
    border-color: red;
}
.errox{
    border-style: solid;
    color: red;
    font-weight: bold;
}
</style>
</body>
</html>
