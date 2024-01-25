	<head>
		<meta charset="utf-8">
		<title>{title}</title>

		<link rel="canonical" href="https://in-g.su"/>
      	<link rel="stylesheet" href="{site_host}templates/{template}/css/main.css?v={cache}">
		<link rel="shortcut icon" href="{site_host}templates/{template}/img/favicon.ico?v={cache}">
		<link rel="image_src" href="{image}">

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="robots" content="{robots}">
		<meta name="revisit" content="1">
		<meta name="description" content="{description}">
		<meta name="keywords" content="{keywords}">
		<meta name="document-state" content="dynamic">
		<meta property="og:title" content="{title}">
		<meta property="og:description" content="{description}">
		<meta property="og:type" content="{type}">
		<meta property="og:image" content="{image}">
		<meta property="og:site_name" content="{site_name}">
		<meta property="og:url" content="{url}">

		<meta name="dc.title" content="{title}">
		<meta name="dc.language" content="RU">

		<script src="{site_host}templates/{template}/js/jquery.js?v={cache}"></script>
		<script src="{site_host}templates/{template}/js/nprogress.js?v={cache}"></script>
		<script src="{site_host}templates/{template}/js/noty.js?v={cache}"></script>
		<script src="{site_host}templates/{template}/js/mix.js?v={cache}"></script>
		<script src="{site_host}templates/{template}/js/bootstrap.js?v={cache}"></script>
		<script src="{site_host}ajax/ajax-user.js?v={cache}"></script>

		{if($conf->new_year == 1 || $conf->win_day == 1)}
		<script src="{site_host}templates/{template}/js/holiday.js"></script>
		{/if}

		{files}
		{other}
      	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PD3VWC3');</script>
<!-- End Google Tag Manager -->
	</head>
	<body>
      	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PD3VWC3"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
		
		{if($conf->new_year == 1)}
			{include file="/elements/new_year.tpl"}
		{/if}
		{if($conf->win_day == 1)}
			{include file="/elements/win_day.tpl"}
		{/if}

		<input id="token" type="hidden" value="{token}">

		<div id="global_result">
			<span class="m-icon icon-ok result_ok disp-n"></span>
			<span class="m-icon icon-remove result_error disp-n"></span>
			<span class="m-icon icon-ok result_ok_b disp-n"></span>
			<span class="m-icon icon-remove result_error_b disp-n"></span>
		</div>
		<div id="result_player"></div>