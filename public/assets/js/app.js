$(document).on('click', '.clearValue', function(e){
	e.preventDefault();
	if(e.which===1){
		$(this).parent('div').children('input').val('');
		$(this).parent('div').children('input').focus()
	}
});

$(document).on('click', '.hideShowPassword', function(e){
	e.preventDefault();
	if(e.which===1){
		var x = $(this).parent('div').children('input');
		if (x[0].type === "password") {
			x[0].type = "text";
		} else {
			x[0].type = "password";
		}
		var y = $(this).children('i').html();
		if(y === 'visibility_off'){
			$(this).children('i').html('visibility');
			$(this).children('i').removeClass('text-info').addClass('text-light');
			$(this).attr('title', 'Hide password');
		}else{
			$(this).children('i').html('visibility_off');			
			$(this).children('i').removeClass('text-light').addClass('text-info');
			$(this).attr('title', 'Show password');
		}
		x.focus();
	}
});