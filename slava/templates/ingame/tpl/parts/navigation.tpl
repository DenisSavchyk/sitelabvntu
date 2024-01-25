<ul>
	{for($i=0;$i < count($header_menu);$i++)}
	<li>
		<a href="{{$header_menu[$i]['link']}}">{{$header_menu[$i]['name']}}</a>
	</li>
	{/for}
</ul>