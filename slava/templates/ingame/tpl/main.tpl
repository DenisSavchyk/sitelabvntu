{include file="config.tpl"}
<!DOCTYPE html>
<html lang="ru">
	{if($conf->off == 1 and $sessionadmin != 'yes')}
		{include file="off_site.tpl"}
	{else}
		{content}
	{/if}
</html>