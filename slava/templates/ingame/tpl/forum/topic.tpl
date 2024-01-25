<script>
    $(".monitoring").remove();
</script>
</div>
</div>

<div class="forum-info no-shadow">
	<div class="container">
		<a href="../forum/forum?id={id2}" class="go-to-back">
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
			<span tooltip="yes" title="Просмотров"><i class="far fa-eye"></i> {{$topic->views}}</span>
			<span tooltip="yes" title="Ответов"><i class="far fa-comment"></i> {{$topic->answers}}</span>
		</p>

		<div id="pagination2">{pagination}</div>

			{if(is_worthy("e"))}
		<a href="#" onclick="dell_topic('{id}' , '{id2}');" class="dell-topic">
			<i class="far fa-trash"></i>
		</a>
		{/if}
		{if((is_worthy("e")) || (is_auth() && '{author_id}' == '{my_id}'))}
		<a href="../forum/edit_topic?id={id}" class="add-topic">
			<i class="far fa-pencil"></i>
		</a>
		{/if}
	</div>
</div>

<div class="container">
	<div id="answers" class="topic-answers">
		{if('{page}' == '1')}
		<div id="answer_0">
			<div class="left-side">
				<img src="../{author_avatar}" alt="{author_login}">
				<a href="../profile?id={author_id}">
					{author_login}
				</a>
				<p style="color: {group_color}">{group_name}</p>
				<span>
					<i class="far fa-heart"></i> {thanks}
				</span>
				<span>
					<i class="far fa-comment-alt"></i> {answers}
				</span>
				<br>
				<span>
					<i class="far fa-star"></i> {reit}
				</span>
			</div>

			<div class="right-side">
				<a href="#answer_0" class="date"><i class="far fa-calendar"></i> {date}</a>{if('{edited_by_id}' != '')}<span class="edited">, отредактировал: <a href="../profile?id={edited_by_id}" title="{edited_by_login}">{edited_by_login}</a>, {edited_time}</span>{/if}

				<div id="text_0" class="with_code">
					{text}
				</div>
				{if('{signature}' != '')}
				<div class="with_code signature">
					{signature}
				</div>
				{/if}

				<div class="clearfix"></div>

				{thanks_str}

				<div class="likes-area">
					{if('{author_id}' != '{my_id}')}
					<button class="btn btn-success btn-sm" onclick="thank({id}, 1);">
						<i class="far fa-heart"></i>
					</button>
					{/if}
					<button class="btn btn-light btn-sm float-right" onclick="answer(0, '{author_login}', '{link}');">
						<i class="far fa-comment"></i> Ответить
					</button>
				</div>
			</div>
		</div>
		{/if}

		{func Forum:get_answers("{id}", "{start}", "{limit}", "{script}", "{link}")}
	</div>

	<div id="pagination2" class="mt-4">{pagination}</div>

	{if(is_auth())}
	<div class="block mt-4">
		{if('{status}' == '1' or '{status}' == '3')}
		<div class="block_head mb-4">
			Оставить ответ
		</div>
		<div id="send_answer">
			<textarea id="text"></textarea>
			<div class="smile_input_forum mt-3">
				<button id="send_btn" class="btn btn-primary" type="button" onclick="send_answer('{id}');">Отправить</button>
				<div id="smile_btn" class="smile_btn visible-lg-inline-block" data-container="body" data-toggle="popover" data-placement="top" data-content="empty"></div>
			</div>
		</div>
		{else}
		<div class="empty-element">Тема закрыта <span class="glyphicon glyphicon-ban-circle"></span></div>
		{/if}
	</div>
	{/if}

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
	<div>