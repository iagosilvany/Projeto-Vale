$(document).ready(function(){
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 300) {
				$('#go-down').fadeOut();
			}
			else {
				$('#go-down').fadeIn();
			}
		});
		$('#go-down a').click(function () {
			land = $('.landing').height();
			$('body,html').animate({
				scrollTop: land
			}, 800);
			return false;
		});
	});
}); //baseado em: http://webdesignerwall.com/
