{if('{title}' != '1')}
<div class="col-lg-9">
	<h3>
		<i class="far fa-paperclip" tooltip="yes" title="Тема закреплена"></i>
		{if('{status}' == '2' || '{status}' == '4')}
		<i class="far fa-lock" tooltip="yes" title="Тема закрыта"></i>
		{/if}
		<a href="../forum/topic?id={id}" title="{name}">{name}</a>
	</h3>
	<p>
		<span tooltip="yes" title="Автор темы">
			<img src="../{topic_avatar}" alt="{topic_login}">
			<a href="../profile?id={topic_author}" style="color: {topic_user_gp_color}" title="{topic_user_gp_name}">{topic_login}</a>
		</span>
		<span tooltip="yes" title="Просмотров"><i class="far fa-eye"></i> {views}</span>
		<span tooltip="yes" title="Ответов"><i class="far fa-comment"></i> {answers}</span>
	</p>
</div>
<div class="d-none d-lg-block col-lg-3">
	<div>
		{if('{last_msg}' == '')}
		<p>Сообщений нет</p>
		{else}
		<img src="../{msg_avatar}" alt="{msg_login}">
		<p>
			<i class="fas fa-user"></i>
			<a href="../profile?id={msg_author}" style="color: {msg_user_gp_color}" title="{msg_user_gp_name}">{msg_login}</a>
		</p>
		<p>{date}</p>
		{/if}
	</div>
</div>
{/if}