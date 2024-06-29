export function checkSubmission(form){
	let button = form.lastChild.getElementsByTagName('button')[0];
	button.getElementsByTagName('span')[0].innerText = 'Process...';
	button.disabled = true;
}

export function disabledButton(obj){
	let _check = obj.tagName;
	if(_check === 'BUTTON'){
		obj.getElementsByTagName('i')[0].classList.add('visually-hidden');
		obj.getElementsByTagName('div')[0].classList.remove('visually-hidden');
		obj.classList.remove("btn-warning");
		obj.classList.add("btn-secondary");
	}
	obj.disabled = true;
}

export function enabledButton(obj){
	let _check = obj.tagName;
	if(_check === 'BUTTON'){
		obj.getElementsByTagName('i')[0].classList.remove('visually-hidden');
		obj.getElementsByTagName('div')[0].classList.add('visually-hidden');
		obj.classList.remove("btn-secondary");
		obj.classList.add("btn-warning");
	}
	obj.disabled = false;
}

export function loadSmallContent(_this){
	disabledButton(_this);
	var href = _this.getAttribute('data-attr');
	$.ajax({
		url: href,
		success: function(result) {
			$('#appForm div').removeClass('modal-xl modal-lg modal-sm').addClass('modal-md');
			$('#appForm .modal-body').html(result.data.content);
			$('#appFormLabel').text(result.data.title);
		},
		complete: function() {
			const myModal = new bootstrap.Modal(document.getElementById('appForm'), {
				keyboard: false
			});
			enabledButton(_this);
			myModal.show();
		},
		error: function(jqXHR, testStatus, error) {
			enabledButton(_this);
			alert("Page " + href + " cannot open. Error:" + error);
			$('#loader').hide();
		}
	});
}

export function loadMediumContent(_this){
	disabledButton(_this);
	var href = _this.getAttribute('data-attr');
	$.ajax({
		url: href,
		success: function(result) {
			$('#appForm div').removeClass('modal-xl modal-md modal-sm').addClass('modal-lg');
			$('#appForm .modal-body').html(result.data.content);
			$('#appFormLabel').text(result.data.title);
		},
		complete: function() {
			const myModal = new bootstrap.Modal(document.getElementById('appForm'), {
				keyboard: false
			});
			enabledButton(_this);
			myModal.show();
		},
		error: function(jqXHR, testStatus, error) {
			enabledButton(_this);
			alert("Page " + href + " cannot open. Error:" + error);
		}
	});
}

export function loadLargeContent(_this){
	var href = _this.getAttribute('data-attr');
	$.ajax({
		url: href,
		success: function(result) {
			$('#appForm div').removeClass('modal-sm modal-md modal-lg').addClass('modal-xl');
			$('#appForm .modal-body').html(result.data.content);
			$('#appFormLabel').text(result.data.title);
		},
		complete: function() {
			const myModal = new bootstrap.Modal(document.getElementById('appForm'), {
				keyboard: false
			});
			myModal.show();
		},
		error: function(jqXHR, testStatus, error) {
			alert("Page " + href + " cannot open. Error:" + error);
			$('#loader').hide();
		}
	});
}

export function loadContent(_this){
	var href = _this.getAttribute('data-attr');
	$.ajax({
		url: href,
		success: function(result) {
			$('#appForm .modal-body').html(result.data.content);
			$('#appFormLabel').text(result.data.title);
		},
		complete: function() {
			const myModal = new bootstrap.Modal(document.getElementById('appForm'), {
				keyboard: false
			});
			myModal.show();
		},
		error: function(jqXHR, testStatus, error) {
			alert("Page " + href + " cannot open. Error:" + error);
			$('#loader').hide();
		}
	});
}

export function change_icon(_icon){
	$('#showIcon').html(_icon);
}

export function setIcon(_icon){
	$('#icon').val(_icon);
	$('.show-icon').html(_icon);
}

export function setIndex(_value, _id){
	var _setUrl = '/'+_value.toLowerCase().replace(" ", "-");
	$('#'+_id).val(_setUrl);
}

export function filterSkpd(_this){
	var select = document.getElementById("skpd");
	for (var i = 0; i < select.length; i++) {
		var txt = select.options[i].text;
		if (!txt.match(_this.value)) {
			$(select.options[i]).attr('disabled', 'disabled').hide();
		} else {
			$(select.options[i]).removeAttr('disabled').show();
		}
	}
}