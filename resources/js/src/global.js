export function checkSubmission(form){
	let button = form.lastChild.getElementsByTagName('button')[0];
	button.getElementsByTagName('span')[0].innerText = 'Process...';
	button.disabled = true;
}

export function prosesButton(obj){
	let button = obj;
	button.getElementsByTagName('span')[0].innerText = 'Process...';
	button.disabled = true;
}

export function disabledButton(obj){
	let _check = obj.tagName;
	if(_check === 'BUTTON'){
		obj.getElementsByTagName('i')[0].classList.add('d-none');
		obj.getElementsByTagName('div')[0].classList.remove('d-none');
	}
	obj.disabled = true;
}

export function enabledButton(obj){
	let _check = obj.tagName;
	if(_check === 'BUTTON'){
		obj.getElementsByTagName('i')[0].classList.remove('d-none');
		obj.getElementsByTagName('div')[0].classList.add('d-none');
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
			$('#loader').hide();
		}
	});
}

export function loadLargeContent(_this){
	disabledButton(_this);
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

export function loadLargeFixContent(_this){
	disabledButton(_this);
	var href = _this.getAttribute('data-attr');
	$.ajax({
		url: href,
		success: function(result) {
			$('#appForm').addClass('d-flex');
			$('#appForm .modal-dialog').removeClass('modal-sm modal-md modal-lg modal-fullscreen-md-down modal-dialog-scrollable').addClass('modal-xl d-flex flex-fill');
			$('#appForm .modal-content').addClass('d-flex flex-fill');
			$('#appForm .modal-header').addClass('flex-shrink-1');
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

export function loadContent(_this){
	disabledButton(_this);
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

export function togglePassword(event){
	event.preventDefault();
	let x = event.target.parentNode.parentNode.children[0];
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}
	let y = event.target;
	if(y.innerText === 'visibility_off'){
		y.innerText = 'visibility';
		y.classList.remove('text-info');
		y.classList.add('text-light');
	}else{
		y.innerText = 'visibility_off';
		y.classList.remove('text-light');
		y.classList.add('text-info');
	}
}

export function clearValue(event){
	event.preventDefault();
	let x = event.target.parentNode.parentNode.children[0];
	x.value = '';
	x.focus();
}

var myModalEl = document.getElementById('appForm');
if (typeof(myModalEl) != 'undefined' && myModalEl != null){
	myModalEl.addEventListener('hidden.bs.modal', event => {
		if (document.contains(document.getElementById("bodyEditor"))){
			tinymce.remove('#bodyEditor');
		}
		$('#appForm .modal-body').html('');
	});
	myModalEl.addEventListener('shown.bs.modal', event => {
		$('.auto_focus').trigger('focus');
		$('.auto_focus').select();
	});
}

export function updateJudul(_this, _url){
	$(_url).val('/'+_this.value.replace(/\s+/g, '-').toLowerCase());
}