					</div>
				</div>
			</div>
			<div class="footer">
				<div class="container">
					<div class="row">
						<div class="col-lg-4">
							<a class="logo" href="../">
								<?php echo $logo_name; ?>
							</a>
							<div class="clearfix"></div>
							<p>
								<?php echo $footer_description; ?>
							</p>
							<hr class="my-3 d-block d-lg-none">
						</div>
						<div class="col-lg-2">
						</div>
						<div class="col-lg-2">
							<strong>
								Навигация
							</strong>
							<ul>
								<?php for($i=0; $i < count($vertical_menu_2); $i++): ?>  
								<li>
									<a href="<?php echo $vertical_menu_2[$i]['link']; ?>" title="<?php echo $vertical_menu_2[$i]['name']; ?>"><?php echo $vertical_menu_2[$i]['name']; ?></a>
								</li>
								<?php endfor; ?>
							</ul>
						</div>
						<div class="col-lg-2">
							<strong>
								Проект
							</strong>
							<ul>
								<?php for($i=0; $i < count($vertical_menu_3); $i++): ?>  
								<li>
									<a href="<?php echo $vertical_menu_3[$i]['link']; ?>" title="<?php echo $vertical_menu_3[$i]['name']; ?>"><?php echo $vertical_menu_3[$i]['name']; ?></a>
								</li>
								<?php endfor; ?>
							</ul>
						</div>
						<div class="col-lg-2">
							<strong>
								Информация
							</strong>
							<ul>
								<?php for($i=0; $i < count($vertical_menu_4); $i++): ?>  
								<li>
									<a href="<?php echo $vertical_menu_4[$i]['link']; ?>" title="<?php echo $vertical_menu_4[$i]['name']; ?>"><?php echo $vertical_menu_4[$i]['name']; ?></a>
								</li>
								<?php endfor; ?>
							</ul>
							<?php if($conf->cote == 1): ?>
								<div id="cote" onclick="click_cote();"><img src="{site_host}/ajax/sound/cote1.gif"></div>
							<?php endif; ?>
						</div>

						<div class="col-lg-12">
							<hr class="my-3">
						</div>

						<div class="col-lg-12 copyright">
							<p><a href="{site_host}" title="{site_name}">{site_name}</a> © Все права защищены </p>
							

                        <a href="https://webmaster.yandex.ru/sqi?host=in-g.su"><img align="right" width="88" height="31" alt="" border="0" src="https://yandex.ru/cycounter?in-g.su&theme=light&lang=ru"/></a>
						<a href=""><img src="../templates/ingame/img/unitpay.png" align="right"></a>
                        <!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://cdn.jsdelivr.net/npm/yandex-metrica-watch/tag.js", "ym"); ym(53609629, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/53609629" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->

						</div>
					</div>
				</div>
			</div>
		</div>
		<div id='hidden_modals'></div>

		<script src="{site_host}templates/{template}/js/lightbox.js"></script>
		<script>
			window.onload = function () {
				$('[tooltip="yes"]').tooltip();
				$('[data-toggle="dropdown"]').dropdown();
			};
		</script>
	</body>