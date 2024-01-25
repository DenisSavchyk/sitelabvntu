<div class="detailed-profile">
	<div>
		<a class="avatar" href="../profile?id={{$user->id}}">
			<img src="../{{$user->avatar}}" alt="{{$user->login}}">
		</a>
		<div>
			<span>{{$user->login}}</span>
			<span style="color: {{$users_groups[$user->rights]['color']}}">{{$users_groups[$user->rights]['name']}}</span>
		</div>
		<a href="../settings" tooltip="yes" title="Настройки профиля">
			<i class="far fa-cog"></i>
		</a>
	</div>

	<a href="../purse" class="money-info-block">
		<div>
			<i class="far fa-wallet"></i>
			<p>Баланс</p>
			<span id="money">{{$user->shilings}}Р</span>
		</div>
		<div>
			<i class="far fa-percent"></i>
			<p>Скидка</p>
			<span id="proc">{{$user->proc}}%</span>
		</div>
	</a>

	<a href="../exit" class="go-exit">
		<i class="far fa-sign-out"></i> Выход
	</a>
</div>