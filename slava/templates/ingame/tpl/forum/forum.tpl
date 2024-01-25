<script>
    $(".monitoring").remove();
</script>
</div>
</div>

<div class="forum-info">
	<div class="container">
		<a href="../forum/" class="go-to-back">
			<i class="far fa-arrow-left"></i>
		</a>

		<h3>
			{name}
		</h3>
		<p>
			{{$row->description}}
		</p>
		<div id="pagination2">{pagination}</div>

		{if(is_worthy("w"))}
		<a href="../forum/add_topic?id={id}" class="add-topic">
			<i class="far fa-plus"></i>
		</a>
		{/if}
	</div>
</div>

<div class="container">
	<div class="block mt-5" id="forum_topics">
		<div class="row">
			{func Forum:get_forum("{id}","{start}","{limit}")}
		</div>