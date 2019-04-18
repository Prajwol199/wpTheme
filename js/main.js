+(function($){
	$(document).ready(function() {
		bannerSlider();
		testimonialsSlider();
		clientSlider();	
		$(".rt-nav-bar-section").sticky({topSpacing:0});	
	})

	function bannerSlider() {
		$('.rt-banner-slider-init').slick({
		  	dots: true,
		  	infinite: true,
		 	speed: 1500,
		  	slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			fade: true,
			prevArrow: '<button type="button" class="slick-prev rt-prev-arrow arow-lf"><i class="fas fa-angle-left"></i></button>',
		  	nextArrow: '<button type="button" class="slick-next rt-next-arrow arow-lf"><i class="fas fa-angle-right"></i></button>',
		});
	}

	function clientSlider() {
		$('.partner-slider-init').slick({
		  	dots: true,
		  	infinite: true,
		 	speed: 1500,
		  	slidesToShow: 3,
			slidesToScroll: 1,
			arrows: false,
			prevArrow: '<button type="button" class="slick-prev bt-prev-arrow arow-lf"><i class="fa fa-angle-left"></i></button>',
		  	nextArrow: '<button type="button" class="slick-next bt-next-arrow arow-lf"><i class="fa fa-angle-right"></i></button>',
		});
	}

	function testimonialsSlider() {
		$('.bt-testimonials-slider-init').slick({
		  	dots: true,
		  	infinite: true,
		 	speed: 1000,
		  	slidesToShow: 2,
			slidesToScroll: 1,
			arrows: true,
			prevArrow: '<button type="button" class="slick-prev bt-prev-arrow arrow-right"><i class="fa fa-angle-left"></i></button>',
		  	nextArrow: '<button type="button" class="slick-next bt-next-arrow arrow-right"><i class="fa fa-angle-right"></i></button>',
		  	responsive: [			    
			    {
			      breakpoint: 480,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1
			      }
			    }			    
			]
		});
	}
	
})(jQuery);