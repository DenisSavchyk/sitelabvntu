$(document).ready(function () {
	//menu
	$('.collapsible-menu > [class="collapsible"] > a').on("click", function (e) {
		if ($(this).parent().has("ul")) {
			e.preventDefault();
		}

		if (!$(this).hasClass("open")) {
			$(this).next("ul").slideDown(350);
			$(this).addClass("open");
		} else if ($(this).hasClass("open")) {
			$(this).removeClass("open");
			$(this).next("ul").slideUp(350);
		}

		$('.collapsible-menu > .collapsible').each(function () {
			$(this).find('ul').css("min-width", $(this).find('a').innerWidth() + "px");
		});
	});

	$(document).mouseup(function (e) {
		if ($('.collapsible-menu > [class="collapsible"]').has(e.target).length === 0 && $('.collapsible-menu > [class="collapsible"] > a').hasClass("open")) {
			$('.collapsible-menu > [class="collapsible"] > ul').parent().find("a").removeClass("open");
			$('.collapsible-menu > [class="collapsible"] > ul').slideUp(350);
		}
	});

	//spoiler
	$('div.spoiler-title').click(function () {
		$(this)
			.children()
			.first()
			.toggleClass('show-icon')
			.toggleClass('hide-icon');
		$(this)
			.parent().children().last().toggle(100);
	});
});

//ie fix
function is_ie() {
	var ua = window.navigator.userAgent;

	var msie = ua.indexOf('MSIE ');
	if (msie > 0) {
		return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
	}

	var trident = ua.indexOf('Trident/');
	if (trident > 0) {
		var rv = ua.indexOf('rv:');
		return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
	}

	var edge = ua.indexOf('Edge/');
	if (edge > 0) {
		return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
	}

	return false;
}

if (is_ie()) {
	$('.custom-input.with-title > input').addClass('placeholder-hidden');
}

//ios sroll z-index fix
function is_ios() {
	var userAgent = navigator.userAgent || navigator.vendor || window.opera;

	if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
		return true;
	} else {
		return false;
	}
}

function move_modals() {
	if (is_ios() && $('#hidden_modals').length > 0) {
		$(".table-responsive td .modal").each(function () {
			$(this).clone().appendTo("#hidden_modals");
			$(this).remove();
		});
	}

	$("#servers .modal").each(function () {
		$(this).clone().appendTo("#hidden_modals");
		$(this).remove();
	});
}

$(document).ajaxComplete(function () {
	move_modals();
});

//bs-custom-file-input
$(document).ready(function () {
	bsCustomFileInput.init();
});

//monitoring
$(document).ajaxComplete(function (event, xhr) {
	if (xhr.responseText.indexOf('<div class="server">') + 1) {
		$('#servers').owlCarousel({
			loop: false,
			margin: 16,
			nav: true,
			rtl: true,
			responsive: {
				0: {
					items: 1
				},
				500: {
					items: 2
				},
				800: {
					items: 3
				},
				1000: {
					items: 4
				}
			}
		});
	}
});