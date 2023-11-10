(function ($) {

	// ______________Owl-carousel-icons2
	var owl = $('.owl-carousel-icons2');
	owl.owlCarousel({
		loop: true,
		rewind: false,
		margin: 25,
		animateIn: 'fadeInDown',
		animateOut: 'fadeOutDown',
		autoplay: false,
		autoplayTimeout: 5000, // set value to change speed
		autoplayHoverPause: true,
		dots: false,
		nav: true,
		autoplay: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1,
				nav: true
			},
			600: {
				items: 2,
				nav: true
			},
			1300: {
				items: 5,
				nav: true
			}
		}
	})

})(jQuery);
