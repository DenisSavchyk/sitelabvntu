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

		{if('{type}' == '1')}
		<a class="btn btn-primary btn-sm" href="../messages?create_id={id}">
			<i class="far fa-envelope mr-2"></i> Написать сообщение
		</a>
		{/if}
		{if('{type}' == '2')}
		<div class="row">
			<div class="col-lg-6">
				<a class="btn btn-primary btn-sm" href="../messages?create_id={id}">
					<i class="far fa-envelope mr-2"></i> Написать сообщение
				</a>
			</div>
			<div class="col-lg-6">
				<a class="btn btn-light btn-sm" href="#" onclick="cancel_friend('{id}'),dell_block('{id}')">
					<i class="far fa-times mr-2"></i> Отменить
				</a>
			</div>
		</div>
		{/if}
		{if('{type}' == '3')}
		<a class="btn btn-primary btn-sm" href="../messages?create_id={id}">
			<i class="far fa-envelope mr-2"></i> Написать сообщение
		</a>
		<div class="row">
			<div class="col-lg-6">
				<a class="btn btn-success btn-sm" href="#" onclick="take_friend('{id}'), dell_block('{id}'), load_col_infriends()">
					<i class="far fa-check mr-2"></i> Принять
				</a>
			</div>
			<div class="col-lg-6">
				<a class="btn btn-danger btn-sm" href="#" onclick="reject_friend('{id}'), dell_block('{id}'), load_col_infriends()">
					<i class="far fa-times mr-2"></i> Отклонить
				</a>
			</div>
		</div>
		{/if}
	</div>
</div>