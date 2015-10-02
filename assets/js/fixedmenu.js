$(window).bind('scroll', function () {
	land = $('.landing').height();
	if ($(window).scrollTop() > land) {
		$('header').addClass('fixed');
		$('.services').addClass('ptop');
	} else {
		$('header').removeClass('fixed')
		$('.services').removeClass('ptop');
	}
});
