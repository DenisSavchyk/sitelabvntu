<script>
    $(".monitoring").remove();
</script>
</div>
</div>

<div class="forum-info">
	<div class="container">
		<a href="../forum/forum?id={id}" class="go-to-back">
			<i class="far fa-arrow-left"></i>
		</a>

		<h3>
			{{$row->name}}
		</h3>
		<p>
			{{$row->description}}
		</p>
	</div>
</div>

<div class="container">
	<div class="block mt-5">
		<div class="form-group">
			<b>Изображение</b>
			<div class="row">
				<div class="col-lg-2">
					<img id="pic" src="../files/forums_imgs/none.jpg" class="w-100" alt="Изображение темы">
				</div>
				<div class="col-lg-3">
					<form enctype="multipart/form-data" action="ajax/actions_a.php" method="POST" id="add_img_form">
						<input type="hidden" id="token" name="token" value="{token}">
						<input type="hidden" id="add_topic_img" name="add_topic_img" value="1">
						<input type="hidden" id="phpaction" name="phpaction" value="1">

						<div class="custom-file">
							<input type="file" class="custom-file-input" id="img" accept="image/*" name="img">
							<label class="custom-file-label" for="img">Выбрать...</label>
						</div>

						<div id="img_result" class="mt-1"></div>
						<button class="btn btn-primary btn-sm mt-2" type="submit">Загрузить</button>
					</form>
				</div>
			</div>
			<script>
                $("#add_img_form").submit(function (event) {
                    NProgress.start();
                    event.preventDefault();
                    var data = new FormData($('#add_img_form')[0]);
                    $.ajax({
                        type: "POST",
                        url: "../ajax/actions_a.php",
                        data: data,
                        contentType: false,
                        processData: false,
                    }).done(function (html) {
                        $("#img_result").html(html);
                        $('#add_img_form')[0].reset();
                    });
                    NProgress.done();
                });
			</script>
		</div>
		<div class="form-group">
			<b>Название</b>
			<input type="text" class="form-control" id="name" maxlength="250" autocomplete="off">
		</div>
		<div class="form-group">
			<b>Текст темы</b>
			<textarea id="text" rows="10"></textarea>
		</div>

		<div class="smile_input_forum">
			<button id="create_btn" onclick="add_topic('{id}');" type="button" class="btn btn-primary">Создать</button>
			<div id="smile_btn" class="smile_btn" data-container="body" data-toggle="popover" data-placement="top" data-content="empty"></div>
		</div>
		<div id="topic_result"></div>

		<script>
            $(document).ready(function () {
                init_tinymce("text", "forum", "{file_manager_theme}", "{file_manager}", "{{md5($conf->code)}}");
                get_smiles('#smile_btn', 1);
            });

            $('#smile_btn').popover({html: true, animation: true, trigger: "click"});
            $('#smile_btn').on('show.bs.popover', function () {
                $(document).mouseup(function (e) {
                    var container = $(".popover-body");
                    if (container.has(e.target).length === 0) {
                        $('#smile_btn').popover('hide');
                        selected = 'stickers';
                    }
                });
            });

            function set_smile(elem) {
                var smile = "<img src=\"" + $(elem).attr("src") + "\" class=\"g_smile\" height=\"20px\" width=\"20px\">";
                tinymce.activeEditor.insertContent(smile);
                $('#smile_btn').popover('hide');
                selected = 'stickers';
            }
		</script>