$(document).ready(function() {
	$('.owl-carousel').owlCarousel({
		items: 1,
		loop: true,
		nav: true,
		autoplay: true,
		animateOut: 'fadeOut',
		transitionStyle : 'fade'
	});

	$('.select__color_list').click(function() {
		$(this).toggleClass('active-color');
	});
	$('.type__select-base_list').click(function() {
		$(this).toggleClass('active-color');
	});
	$('.color__list_white').click(function() {
		$(this).toggleClass('active-color-black');
	});

	/*$('.header__list_link').click(function() {
		$('.main-header').css('padding-top', '0').addClass('main-header__after');
		$('.main-header:before').css('top', '115px');
	});*/
	/*$('.select__list_selects').change(function() {
		$('html').css('overflow-y', 'auto');
		$('html,body').animate({scrollTop: $('.content-header__select_wrap').offset().top}, 1000);
	});*/

	// $(window).scroll(function(){                            
	// 	if ( $(window).scrollTop() == 0 ){                  
	// 		$('.main-header__other').css('top', '115px');        
	// 	} else {
	// 		$('.main-header__other').css('top', '0');
	// 	}
	// });
});