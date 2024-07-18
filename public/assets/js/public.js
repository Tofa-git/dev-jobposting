$(document).on('change', '#provinsi', function(){
	var href = $(this).attr('data-target')+'?ref='+$(this).val();
	$.ajax({
		url: href,
		success: function(result) {
			let _opt = result.data;
			$('#lokasi_kerja').html(null);
			_opt.forEach(function(data){
				$('#lokasi_kerja').append('<div class="mt-1">'+data+'</div>');
			});
			$('#provinsi').select2();
			$('#kabupaten').select2();
		},
		error: function(jqXHR, testStatus, error) {
			alert("Error:" + error);
		}
	});
});

$(document).on('change', '#kabupaten', function(){
	var href = $(this).attr('data-target')+'?ref='+$(this).val();
	$.ajax({
		url: href,
		success: function(result) {
			let _opt = result.data;
			$('#lokasi_kerja').html(null);
			_opt.forEach(function(data){
				$('#lokasi_kerja').append('<div class="mt-1">'+data+'</div>');
			});
			$('#provinsi').select2();
			$('#kabupaten').select2();
			$('#kecamatan').select2();
		},
		error: function(jqXHR, testStatus, error) {
			alert("Error:" + error);
		}
	});
});

$(document).on('change', '#kecamatan', function(){
	var href = $(this).attr('data-target')+'?ref='+$(this).val();
	$.ajax({
		url: href,
		success: function(result) {
			let _opt = result.data;
			$('#lokasi_kerja').html(null);
			_opt.forEach(function(data){
				$('#lokasi_kerja').append('<div class="mt-1">'+data+'</div>');
			});
			$('#provinsi').select2();
			$('#kabupaten').select2();
			$('#kecamatan').select2();
			$('#kelurahan').select2();
		},
		error: function(jqXHR, testStatus, error) {
			alert("Error:" + error);
		}
	});
});