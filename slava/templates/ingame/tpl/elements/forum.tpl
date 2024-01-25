<div class="col-lg-8">
	<img src="../{img}" alt="{name}">
	<div>
		<h3><a href="../forum/forum?id={id1}" title="{description}">{name}</a></h3>
		<p>{description}</p>
	</div>
</div>
<div class="d-none d-lg-block col-lg-4">
	{if('{msg_id}' == '')}
	<div>
		<p>Форум пуст</p>
	</div>
	{else}
	<div>
		<img src="../{msg_avatar}" alt="{msg_login}">
		<p><a href="../forum/topic?id={msg_id}&page=last">{msg_name}</a></p>
		<p><i class="fas fa-user"></i> <a href="../profile?id={msg_author}" style="color: {gp_color}" title="{gp_name}">{msg_login}</a></p>
		<p>{msg_date}</p>
	</div>
	{/if}
</div>