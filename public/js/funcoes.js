//LOGO SHAKE EFFECT
$(document).ready(function(){
	$('.logo').hover(function() {$(this).vibrate();});
});

//DIVS SHOW AND HIDE
$(document).ready(function(){
	$('.create-account').click(function(){
		$('.logar').fadeOut('slow');
		$('.cadastro').fadeIn('slow');
	})
	$('.close-cadastro').click(function(){
		$('.cadastro').fadeOut('slow');
		$('.logar').fadeIn('slow');
	})
	$('.forgot-password').click(function(){
		$('.login').fadeOut('slow');
		$('.lost-password').fadeIn('slow');
	})
	$('.close-psw').click(function(){
		$('.lost-password').fadeOut('slow');
		$('.login').fadeIn('slow');
	})
})

//PASSWORD CONFIRM
$(document).ready(function(){
	$('#password-confirm').keyup(function(){
		  if($("#password").val() == $("#password-confirm").val()){
			$('#password-confirm').css( "background-color", "white" );
		  }else{
			$('#password-confirm').css( "background-color", "#FFE8E8" );
			
			$('#cadastro').submit(function() {
				if($("#password").val() == $("#password-confirm").val()){
					return true;
				}else{
					$('#msg-psw').html('password do not match');
					return false;
				}
			});
		  }
	 });
})
