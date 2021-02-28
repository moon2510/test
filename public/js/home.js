$(document).ready(function(){
	$(".book-list").slick({
		slidesToShow:5,
		slidesToScroll:2,
		arrows:true,
		infinite:true,
		variableWidth:true,
		autoplay: true,
		autoplaySpeed: 3000,
		responsive:[
		{
			breakpoint: 768,
			settings:{
				arrows:false,
				slidesToShow:1,
				slidesToScroll:1,
				variableWidth:false
			}
		}
		]
	});
	$('.slider-for').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.slider-nav',
		autoplay: true,
		autoplaySpeed: 3000,
	});
	$('.slider-nav').slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		autoplay: false,
		asNavFor: '.slider-for',
		focusOnSelect: true,
		slickPause: true
	});

});