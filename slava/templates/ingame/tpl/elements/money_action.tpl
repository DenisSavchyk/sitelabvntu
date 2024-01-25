<div id="admin{id}" class="table-row">
	<div class="row">
		<div class="col-lg-7 with-description with-icon">
			{if('{shilings}' > '0')}
			<i class="fas fa-plus"></i>
			<p class="text-success">{shilings} рублей</p>
			{else}
			<i class="fas fa-minus"></i>
			<p class="text-danger">{shilings} рублей</p>
			{/if}
			<span>{type}</span>
		</div>
		<div class="col-lg-5">
			<p class="float-left float-lg-right">{date}</p>
		</div>
	</div>
</div>