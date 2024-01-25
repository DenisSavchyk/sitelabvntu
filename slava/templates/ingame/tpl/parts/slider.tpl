<div id="main-slider" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		{for($i=0;$i < count($slider);$i++)}
		<div class="carousel-item {if($i==0)}active{/if}">
			<img class="d-block w-100" src="{{$slider[$i]['image']}}" alt="{{$slider[$i]['title']}}">
			<div class="carousel-caption">
				<h1>
					{if(!empty($slider[$i]['link']))}<a href="{{$slider[$i]['link']}}" target="_blank">{/if}
						{{$slider[$i]['title']}}
						{if(!empty($slider[$i]['link']))}</a>{/if}
				</h1>
				{if(!empty($slider[$i]['link']))}
				<a href="{{$slider[$i]['link']}}" class="px-4 btn btn-lg btn-dark" target="_blank">
					Подробнее &nbsp
					<i class="fas fa-arrow-right" style="font-size: 90%"></i>
				</a>
				{/if}
			</div>
			<div class="he"></div>
		</div>
		{/for}
	</div>
	<a class="carousel-control-prev" href="#main-slider" role="button" data-slide="prev">
		<i class="fas fa-arrow-left"></i>
	</a>
	<a class="carousel-control-next" href="#main-slider" role="button" data-slide="next">
		<i class="fas fa-arrow-right"></i>
	</a>
</div>