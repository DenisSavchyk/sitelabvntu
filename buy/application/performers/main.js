function get_url() {
	return "https://" + location.host + "/";
}

function send_post(website, form_data, callback, method = "POST") {
	form_data.append("phpaction", "1");
	form_data.append("token", $("#token").val());

	$.ajax({
		type: method,
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

function win_message(type, message) {
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

$timer_end = false;
$timer = 0;

function progress(id, type, position = 0, timeout = 500, increment = .5, maxprogress = 110) {
	switch(type){
		case 'end':
			clearTimeout($timer);
			$(id).css({"width": "100%"});
			$timer_end = true;
			
			setTimeout(function() {
				$(".progress").css({"display": "none"});
			}, 1500);
			
		break;
		
		case 'start':
			$(".progress").css({"display": "flex"});
			$timer_end = false;
			
			$timer = setTimeout(function() {
				position += increment;
				
				if(position < maxprogress) {
					$(id).css({"width": position + "%"});
					progress(id, 'continue', position, timeout, increment, maxprogress);
				}
			}, timeout);
			
		break;
		
		default:
			position += increment;
			
			$timer = setTimeout(function() {
				position += increment;
				
				if(position < maxprogress && !$timer_end) {
					$(id).css({"width": position + "%"});
					progress(id, 'continue', position, timeout, increment, maxprogress);
				}
				else {
					$(".progress").css({"display": "none"});
					$timer_end = true;
				}
			}, timeout);
			
		break;
	}
}

function login() {
	var form_data = new FormData;
	form_data.append("authorized", "1");
	form_data.append("login", $("#l_login").val());
	form_data.append("password", $("#l_password").val());

	send_post(get_url() + "application/performers/actions/main.php", form_data, function(result) {
		if(result.status == 1) {
			setTimeout("location.reload()", 50);
		}
		else {
			win_message("warning", result.message);
		}
	});
}

function register() {
	var form_data = new FormData;
	form_data.append("registration", "1");
	form_data.append("login", $("#login").val());
	form_data.append("password", $("#password").val());
	form_data.append("name", $("#name").val());

	send_post(get_url() + "application/performers/actions/main.php", form_data, function(result) {
		if(result.status == 1) {
			setTimeout("location.reload()", 50);
		}
		else {
			win_message('warning', result.message);
		}
	});
}

function logout() {
	var form_data = new FormData;
	form_data.append("logout", "1");

	send_post(get_url() + "application/performers/actions/main.php", form_data, function(result) {
		if(result.status == 1) {
			setTimeout("location.reload()", 50);
		}
		else {
			win_message('warning', result.message);
		}
	});
}

function binding(id) {
	var address = prompt('Введите адрес сервера или сайта', '');
	if(address && address != '') {
		buy(id, address);		
	}
}

function buy(id, address = '0') {
	var form_data = new FormData;
	form_data.append("buy", "1");
	form_data.append("id", id);
	form_data.append("address", address);

	send_post(get_url() + "application/performers/actions/main.php", form_data, function(result) {
		if(result.status == 1) {
			win_message('success', result.message);
		}
		else {
			win_message('warning', result.message);
		}
	})
}

$(document).ready(function () {
	$("#product_add_form").submit(function (e) {
		e.preventDefault();
		$("#submit").attr("disabled", "disabled");

		var form_data = new FormData(this);
		form_data.append("binding", $("#primaryBinding").prop("checked") ? "1" : "0");

		send_post(this.action, form_data, function(result) {
			$("#submit").removeAttr("disabled");
			if(result.status == 1) {
				$('#product_add_form')[0].reset();
				editor.setData('');
				win_message('success', 'Товар успешно добавлен!');
			}
			else {
				win_message('error', result.message);
			}
		}, this.method);
	});
});

$(function(){
	$(".progress").css({"display": "none"});
});

function del(index) {
	if(confirm("Вы действительно хотите удалить товар?")) {
		var form_data = new FormData;
		form_data.append("delete", "1");
		form_data.append("id", index);

		send_post(get_url() + "application/performers/actions/main.php", form_data, function(result) {
			if(result.status == 1) {
				win_message('success', 'Товар успешно удалён!');
				setTimeout('location.reload();', 1);
			}
			else {
				win_message('error', result.message);
			}
		});
	}
}

function replenish(system, value) {
	var form_data = new FormData;
	form_data.append("replenish", "1");
	form_data.append("system", system);
	form_data.append("value", value);

	send_post(get_url() + "application/performers/actions/main.php", form_data, function(result) {
		location.href = result.url;
	});
}

function download(index) {
	var form_data = new FormData;
	form_data.append("download", "1");
	form_data.append("id_purchases", index);

	send_post(get_url() + "application/performers/actions/main.php", form_data, function(result) {
		win_message(result.alert, result.message);
		if(result.alert == 'success') {
			var link = document.createElement('a');
			link.setAttribute('href', result.file);
			link.setAttribute('download', result.filename);
			link.click();
		}
	});
}

function update_system() {
	progress('.progress-bar', 'start');
	$("#update_button").attr("disabled", "disabled");

	var form_data = new FormData;
	form_data.append("update_system", "1");

	send_post(get_url() + "application/performers/actions/main.php", form_data, function(result) {
		progress('.progress-bar', 'end');
		setTimeout(function() {
			$("#update_button").removeAttr("disabled");
		}, 1500);
		
		win_message(result.alert, result.message);
		
		setTimeout(function() {
			location.reload();
		}, 200);
	});
}

function js_qiwi(type, params) {
	var form_data = new FormData;
	form_data.append("js_qiwi", "1");
	form_data.append("type", type);
	form_data.append("params", params);

	send_post(get_url() + "application/performers/actions/main.php", form_data, function(result) {
		win_message(result.alert, result.message);
	});
}

function js_fk(type, params) {
	var form_data = new FormData;
	form_data.append("js_fk", "1");
	form_data.append("type", type);
	form_data.append("params", params);

	send_post(get_url() + "application/performers/actions/main.php", form_data, function(result) {
		win_message(result.alert, result.message);
	});
}

function js_main(type, params) {
	var form_data = new FormData;
	form_data.append("js_main", "1");
	form_data.append("type", type);
	form_data.append("params", params);

	send_post(get_url() + "application/performers/actions/main.php", form_data, function(result) {
		win_message(result.alert, result.message);
	});
}

function js_delete(index) {
	if(confirm("Вы действительно хотите удалить товар?")) {
		var form_data = new FormData;
		form_data.append("delete_product", "1");
		form_data.append("index", index);

		send_post(get_url() + "application/performers/actions/admin.php", form_data, function(result) {
			if(result.alert == 'success') {
				win_message(result.alert, result.message);
				setTimeout("location.reload()", 50);
			}
			else {
				win_message(result.alert, result.message);
			}
		});
	}
}