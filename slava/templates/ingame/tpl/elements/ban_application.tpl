<div class="table-row">
	<div class="row">
		<div class="col-lg-3 with-description">
			<p>
				<a href="../bans/ban?id={id}">{nick}</a>
			</p>
			<span>Ник игрока</span>
		</div>
		<div class="col-lg-3 with-description with-icon">
			<img src="../{avatar}" alt="{login}">
			<p>
				<a target="_blank" href="../profile?id={author}">
					{login}
				</a>
			</p>
			<span>Профиль игрока</span>
		</div>
		<div class="col-lg-3 with-description with-icon">
			<i class="far fa-dot-circle"></i>
			<p class="text-{color}">
				{status}
			</p>
			<span>Статус</span>
		</div>
		<div class="col-lg-3 with-description with-icon">
			<i class="far fa-calendar-alt"></i>
			<p>
				{date}
			</p>
			<span>Дата подачи</span>
		</div>
	</div>
</div>