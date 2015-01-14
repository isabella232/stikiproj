$(document).ready(function(){	

	$('#login').click(function(){
		if($('input#username').val() == "" || $('input#password').val() == "")
		{
			$('#feedback').removeClass().addClass('error').text('Silahkan masukkan username dan password!').fadeIn();
			return false;
		}
		else
		{
			$('#loading').fadeIn();
			$('#feedback').hide();
            
			$.ajax
			({
				type: 'POST',
				url: 'process.php',
				dataType: 'json',
				data:
				{
					username: $('input#username').val(),
					password: $('input#password').val()
				},
				success:function(data)
				{
				       
					$('#loading').hide();
					$('#feedback').removeClass().addClass((data.error === true) ? 'error':'success').text(data.message).fadeIn();
                    
					if(data.error === true)
					{
					   $('#loading').fadeOut();
					   $('#feedback').removeClass().fadeIn().addClass('error').text('Maaf Login Anda ditolak');
					   $('#memberLoginForm').fadeIn();  
					}
					else
					{
						$('#memberLoginForm').fadeOut();
						$('#footer').fadeOut();
						$('.link').fadeIn();
                        
                        location.href = 'dashboard.php';
     
					}
				},
				error:function(XMLHttpRequest,textStatus,errorThrown)
				{
					$('#loading').fadeOut();
					$('#feedback').removeClass().fadeIn().addClass('error').text('Maaf Terjadi Kesalahan pada Database');
					$('#memberLoginForm').fadeIn();
				}
			});
			return false;
		}
	});	
	
	$('#register').click(function(){
		if($('input#register-username').val() == "" || $('input#register-password').val() == "" 
		|| $('input#secret-answer').val() == "" ||  $('input#register-email').val() == "" ||  $('input#captcha').val() == "")
		{	
			$('#feedback').removeClass().addClass('error').text('Silahkan mengisi semua text field di atas!').fadeIn();
			return false;
		}
		else
		{
			$('#loading').fadeIn();
			$('#feedback').hide();
			
			$.ajax
			({
				type: 'POST',
				url: 'process.php',
				dataType: 'json',
				data:
				{
					regUsername: $('input#register-username').val(),
					regPassword: $('input#register-password').val(),
					secretAnswer: $('input#secret-answer').val(),
					regEmail: $('input#register-email').val(),
					captcha: $('input#captcha').val()
				},
				success:function(data)
				{
					$('#loading').hide();
					$('#feedback').removeClass().addClass((data.error === true) ? 'error':'success').text(data.message).fadeIn();
					if(data.error === true)
					{
						$('#memberLoginForm').fadeOut();
					}
					else
					{
						$('#memberLoginForm').fadeOut();
						$('#footer').fadeOut();
						$('.link').fadeIn();
					}
				},
				error:function(XMLHttpRequest,textStatus,errorThrown)
				{
					$('#loading').fadeOut();
					$('#feedback').removeClass().fadeIn().addClass('error').text('Maaf, ada kesalahan pada sistem ajax');
					// $('#memberLoginForm').fadeIn();
				}
			});
			return false;
		}
	});
	
	$('#forgot-password').click(function(){
		if($('input#forgot-email').val() == "")
		{
			$('#feedback').removeClass().addClass('error').text('Masukkan email !').fadeIn();
			return false;
		}
		else
		{
			$('#loading').fadeIn();
			$('#feedback').hide();
			
			$.ajax
			({
				type: 'POST',
				url: 'process.php',
				dataType: 'json',
				data:
				{
					forgotEmail: $('input#forgot-email').val()
				},
				success:function(data)
				{
					$('#loading').hide();
					$('#feedback').removeClass().addClass((data.error === true) ? 'error':'success').text(data.message).fadeIn();
					if(data.error === true)
					{
						// $('#memberLoginForm').fadeOut();
					}
					else
					{
						$('#forgotPasswordForm').fadeOut();
						$('#footer').fadeOut();
						$('.link').fadeIn();
					}
				},
				error:function(XMLHttpRequest,textStatus,errorThrown)
				{
					$('#loading').fadeOut();
					$('#feedback').removeClass().fadeIn().addClass('error').text('Mohon Maaf Customer Service kami sedang melayani Customer');
					// $('#memberLoginForm').fadeIn();
				}
			});
			return false;
		}
	});
	
	$('#renew-password').click(function(){
		if($('input#re-password').val() == "" || $('input#re-password-2').val() == "")
		{
			$('#feedback').removeClass().addClass('error').text('Masukkan password baru untuk akun Anda!').fadeIn();
			return false;
		}
		else
		{
			$('#loading').fadeIn();
			$('#feedback').hide();
			
			$.ajax
			({
				type: 'POST',
				url: 'process.php',
				dataType: 'json',
				data:
				{
					newPass: $('input#re-password').val(),
					newPass2: $('input#re-password-2').val(),
					newEmail: newEmailVariable
				},
				success:function(data)
				{
					$('#loading').hide();
					$('#feedback').removeClass().addClass((data.error === true) ? 'error':'success').text(data.message).fadeIn();
					if(data.error === true)
					{
						// $('#memberLoginForm').fadeOut();
					}
					else
					{
						$('#forgotPasswordForm').fadeOut();
						$('#footer').fadeOut();
						$('.link').fadeIn();
					}
				},
				error:function(XMLHttpRequest,textStatus,errorThrown)
				{
					$('#loading').fadeOut();
					$('#feedback').removeClass().fadeIn().addClass('error').text('Maaf, ada kesalahan pada sistem ajax');
					// $('#memberLoginForm').fadeIn();
				}
			});
			return false;
		}
	});
});