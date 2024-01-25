function toasty(type, message) {
	var toast = new Toasty({
		classname: "toast",
		transition: "slideLeftRightFade",
		insertBefore: false,
		progressBar: true,
		enableSounds: true
	});
	
	switch(type) {
		case 'success':
			toast.success(message);
			break;
		case 'error':
			toast.error(message);
			break;
		case 'warning':
			toast.warning(message);
			break;
	}
}

function get_url() {
	return "https://" + location.host + "/";
}

function send_post(website, form_data, callback) {
	$.ajax({
		type: "POST",
		url: website,
		processData: false,
		contentType: false,
		data: form_data,
		dataType: "json",
		success: function(result) {
			callback(result);
		}
	});
}

$(function(){
	$("#form_mysql").submit(function(event) {
		event.preventDefault();
		var form_data = new FormData(this);
		form_data.append("check_mysql", "1");
		
		send_post(get_url() + "application/configs/install/initiator.php", form_data, function(result) {
			if(result.alert == 'success') {
				$("#b_install").removeAttr("disabled");
			}
			
			toasty(result.alert, result.message);
		});
	});
	
	$("#form_install").submit(function(event) {
		event.preventDefault();
		var form_data = new FormData(this);
		form_data.append("install", "1");
		form_data.append("hostname", $("#hostname").val());
		form_data.append("dataname", $("#dataname").val());
		form_data.append("username", $("#username").val());
		form_data.append("password", $("#password").val());
		
		send_post(get_url() + "application/configs/install/initiator.php", form_data, function(result) {
			if(result.alert == 'success') {
				location.reload();
			}
			
			toasty(result.alert, result.message);
		});
	});
	
	$('[data-bs-toggle="tooltip"]').tooltip();
});

function href(url) {
	location.href = url;
}

