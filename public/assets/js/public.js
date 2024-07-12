function getChildWilayahAdministrasi(obj, _type){
	var href = obj.getAttribute('data-attr') + '?ref='+obj.value+'&type='+_type;
	$.ajax({
		url: href,
		success: function(result) {
			let _child = document.getElementById(_type);
			_child.innerHTML = '';
			let text = "<option selected disabled>Pilih " + _type + "</option>";
			for (let x in result) {
				text += "<option value="+ result[x].kode +">" + result[x].nama + "</option>";
			}
			_child.innerHTML = text;
		},
		error: function(jqXHR, testStatus, error) {
			alert("Error:" + error);
		}
	});
}