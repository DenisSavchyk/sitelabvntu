<div class="col-lg-9 order-is-first">
	<div class="block">
		<div class="block_head mb-3">
			Редактировать новость
		</div>

		<div class="form-group">
			<b>Изображение</b>
			<div class="row">
				<div class="col-lg-3">
					<img id="img" src="../{img}" class="w-100" alt="Изображеине новости">
				</div>
				<div class="col-lg-9">
					<div class="input-group">
						<form enctype="multipart/form-data" id="add_img_form">
							<input type="hidden" id="token" name="token" value="{token}">
							<input type="hidden" id="add_new_img" name="add_new_img" value="1">
							<input type="hidden" id="phpaction" name="phpaction" value="1">

							<div class="custom-file">
								<input type="file" class="custom-file-input" id="new_img" accept="image/*" name="new_img">
								<label class="custom-file-label" for="new_img">Выбрать...</label>
							</div>

							<div id="img_result" class="mt-1">
								<input value="{img}" type="hidden" id="input_img" maxlength="255" autocomplete="off">
							</div>
							<button class="btn btn-outline-primary btn-sm mt-2" type="submit">Загрузить</button>
							<button class="btn btn-primary btn-sm mt-2" onclick="change_new('{id}');" type="button">Сохранить</button>
						</form>
					</div>
				</div>
			</div>
		</div>


		<div class="form-group">
			<b>Категория</b>
			<select id="class" class="form-control">
				{classes}
			</select>
		</div>

		<div class="form-group">
			<b>Название</b>
			<input type="text" class="form-control" id="name" maxlength="250" autocomplete="off" value="{name}">
		</div>

		<div class="form-group">
			<b>Краткое описание</b>
			<textarea id="short_text" class="form-control" rows="3" maxlength="250">{short_text}</textarea>
		</div>
	
		<div class="form-group">
			<b>Текст новости</b>
			<textarea id="text" rows="10">{text}</textarea>
		</div>

		<div class="form-group">
			<b>Дата публикации</b>
			<input class="form-control" type="text" id="publish_date" value="{date}" onclick="$('.ui-datepicker-current').attr('onclick', 'set_current_time()'); $('.ui-datepicker-current').html('Сейчас'); $('.ui-datepicker-current2').addClass('disp-n');" >
		</div>
			
		<div id="new_result" class="mt-3"></div>
		<div class="smile_input_forum">
			<button id="create_btn" onclick="change_new('{id}');" type="button" class="btn btn-primary">Изменить</button>
			<div id="smile_btn" class="smile_btn" data-container="body" data-toggle="popover" data-placement="top" data-content="empty"></div>
		</div>
	</div>
</div>

<script type="text/javascript" src="{site_host}templates/admin/js/timepicker/timepicker.js"></script>
<script type="text/javascript" src="{site_host}templates/admin/js/timepicker/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="{site_host}templates/admin/js/timepicker/jquery-ui-timepicker-addon-i18n.min.js"></script>
<script type="text/javascript" src="{site_host}templates/admin/js/timepicker/jquery-ui-sliderAccess.js"></script>
<script>
	$("#add_img_form").submit(function (event){
		NProgress.start();
		event.preventDefault();
		var data = new FormData($('#add_img_form')[0]);
		$.ajax({
			type: "POST",
			url: "../ajax/actions_b.php",
			data: data,
			contentType: false,
			processData: false,
		}).done(function (html) {
			$("#img_result").html(html);
			$('#add_img_form')[0].reset();
		});
		NProgress.done();
	});

	$('#publish_date').datetimepicker({
		timeInput: true,
		timeFormat: "HH:mm",
		onSelect: function() {
			setTimeout(function() {
				$('.ui-datepicker-current').attr('onclick', 'set_current_time()');
				$('.ui-datepicker-current').html('Сейчас');
				$('.ui-datepicker-current2').addClass('disp-n');
			}, 500);
		}
	});

	$(document).ready(function() {
		init_tinymce("text", "full", "{file_manager_theme}", "{file_manager}", "{{md5($conf->code)}}");
		get_smiles('#smile_btn', 1);
	});

	$('#smile_btn').popover({ html: true, animation: true, trigger: "click" });
	$('#smile_btn').on('show.bs.popover', function () {
		$(document).mouseup(function (e) {
			var container = $(".popover-body");
			if (container.has(e.target).length === 0){
				$('#smile_btn').popover('hide');
				selected = 'gcms_smiles';
			}
		});
	});

	function set_smile(elem){
		var smile =  "<img src=\""+$(elem).attr("src")+"\" class=\"g_smile\" height=\"20px\" width=\"20px\">";
		tinymce.activeEditor.insertContent(smile);
		$('#smile_btn').popover('hide');
		selected = 'gcms_smiles';
	}
</script>

<div class="col-lg-3 order-is-last">
	{include file="/parts/mini-profile.tpl"}
	{include file="/parts/sidebar.tpl"}
	{include file="/elements/vk_widgets.tpl"}
</div>