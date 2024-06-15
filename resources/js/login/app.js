document.body.addEventListener('click', function (evt) {
    if (evt.target.className === 'clearValue') {
        alert('123');
    }
}, false);

$(document).on('click', '.hideShowPassword', function(e){
	e.preventDefault();
	if(e.which===1){
		var x = document.getElementById("password");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
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
		$('#password').focus();
	}
});

$(document).on('click', '.clearValue', function(e){
	e.preventDefault();
	if(e.which===1){
		$(this).parent('div').children('input').val('');
		$(this).parent('div').children('input').focus()
	}
});