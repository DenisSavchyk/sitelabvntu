<div class="col-lg-9 order-is-first">
	{include file="/parts/slider.tpl"}
	{**{include file="/elements/chat.tpl"}**}

	{if($conf->show_news != '0')}
	<h2 class="mb-3 float-left">
		Новости
	</h2>
	<a class="btn btn-light btn-sm float-right" href="../news/">
		<i class="far fa-bookmark"></i>
		К новостям
	</a>
	<div class="clearfix"></div>
	<div id="new_news" class="row">
		{func Widgets:last_news($conf->show_news)}
	</div>
	{/if}

	{include file="/parts/site_stats.tpl"}
</div>
<div class="disp-n" id="auth-result">{conf_mess}</div>
<script>
    var conf_mess = $("#auth-result > p").text();

    if(conf_mess != '') {
        var conf_mess_style = $("#auth-result > p").attr("class");

        if(conf_mess_style.indexOf("danger") > 0) {
            conf_mess_style = 'error';
        } else {
            conf_mess_style = 'success';
        }

        show_noty('Down', 'error', conf_mess, 10000);
    }
</script>
<div class="col-lg-3 order-is-last">
	{include file="/parts/mini-profile.tpl"}
	{include file="/parts/sidebar.tpl"}
	{include file="/elements/vk_widgets.tpl"}
</div>