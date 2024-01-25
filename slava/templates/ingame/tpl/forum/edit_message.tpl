<script>
    $(".monitoring").remove();
</script>
</div>
</div>

<div class="forum-info">
	<div class="container">
		<a href="../forum/topic?id={topic_id}" class="go-to-back">
			<i class="far fa-arrow-left"></i>
		</a>

		<h3>
			{if('{status}' == '3' || '{status}' == '4')}
			<i class="far fa-paperclip" tooltip="yes" title="Тема закреплена"></i>
			{/if}
			{if('{status}' == '2' || '{status}' == '4')}
			<i class="far fa-lock" tooltip="yes" title="Тема закрыта"></i>
			{/if}

			{name}
		</h3>
		<p>
			<span tooltip="yes" title="Просмотров"><i class="far fa-eye"></i> {views}</span>
			<span tooltip="yes" title="Ответов"><i class="far fa-comment"></i> {answers}</span>
		</p>
	</div>
</div>


<div class="container">
	<div class="block mt-5">
		<textarea id="text" rows="10">{text}</textarea>

		<div class="smile_input_forum mt-3">
			<button id="create_btn" onclick="edit_message('{id}');" type="button" class="btn btn-primary">Изменить</button>
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
                        selected = 'gcms_smiles';
                    }
                });
            });

            function set_smile(elem) {
                var smile = "<img src=\"" + $(elem).attr("src") + "\" class=\"g_smile\" height=\"20px\" width=\"20px\">";
                tinymce.activeEditor.insertContent(smile);
                $('#smile_btn').popover('hide');
                selected = 'gcms_smiles';
            }
		</script>
