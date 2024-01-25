<div class="col-lg-4" id="{id}">
	<div class="user">
		<a title="{login}" href="../profile?id={id}">
			<img alt="{login}" src="../{avatar}">
		</a>
		<span style="background: {gp_color}">
			{gp_name}
		</span>
		<a title="{login}" href="../profile?id={id}">
			{login}
		</a>

		<a class="btn btn-primary btn-sm" href="../messages?create_id={id}">
			<i class="far fa-envelope mr-2"></i> Написать сообщение
		</a>
		{if(is_worthy("f") && is_worthy("g"))}
		<div class="row">
			{if(is_worthy("f"))}
			<div class="col-lg-6">
				<a class="btn btn-light btn-sm" href="../edit_user?id={id}">
					Редактировать
				</a>
			</div>
			{/if}
			{if(is_worthy("g"))}
			<div class="col-lg-6">
				<a class="btn btn-light btn-sm" href="#" onclick="dell_user('{id}')">
					Удалить
				</a>
			</div>
			{/if}
		</div>
		{/if}
	</div>
</div>