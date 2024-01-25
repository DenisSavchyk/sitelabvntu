<div id="answer_{id}">
	<div class="left-side">
		<img src="../{avatar}" alt="{login}">
		<a href="../profile?id={author}">
			{login}
		</a>
		<p style="color: {gp_color}">{gp_name}</p>
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
		<a href="#answer_{id}" class="date"><i class="far fa-calendar"></i> {date}</a>{if('{edited_by_id}' != '')}<span class="edited">, отредактировал: <a href="../profile?id={edited_by_id}" title="{edited_by_login}">{edited_by_login}</a>, {edited_time}</span>{/if}

		<div id="text_{id}" class="with_code">
			{text}
		</div>

		{if('{signature}' != '')}
		<div class="with_code signature">
			{signature}
		</div>
		{/if}

		<div class="clearfix"></div>

		{mess_thanks}

		<div class="likes-area">
			{if('{author_id}' != '{my_id}')}
			<button class="btn btn-success btn-sm" onclick="thank({id}, 0);">
				<i class="far fa-heart"></i>
			</button>
			{/if}


			<button class="btn btn-light btn-sm float-right" onclick="answer({id}, '{login}', '{link}');">
				<i class="far fa-comment"></i> Ответить
			</button>

			{if(is_worthy("r"))}
			<button class="btn btn-danger btn-sm float-right" onclick="dell_answer('{id}');">
				<i class="far fa-trash"></i>
			</button>
			{/if}
			{if((is_worthy("r")) || (is_auth() && ('{author_id}' == '{my_id}') and ('1' == '{check}')))}
			<a class="btn btn-primary btn-sm float-right"  href="../forum/edit_message?id={topic_id}&id2={id}">
				<i class="far fa-pencil"></i>
			</a>
			{/if}
		</div>
	</div>
</div>