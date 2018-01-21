$(document).ready(function(){
	var slider = $('.img-product-slider ul').bxSlider({
						mode: 'fade', //mode: 'fade','horizontal'
						//speed: 300,
						auto: false,
						infiniteLoop: true,
						hideControlOnEnd: true,
						useCSS: false,
						pager:false,
				});
	$(".img-product-slider-pager ul li a").click(function(e){
		e.preventDefault();
		$(".bx-thumb ul li a.active").removeClass("active");
		$(this).addClass("active");
		var _index = $(this).parent().attr("data-slide-index");
		console.log("_index = ", _index);
		slider.goToSlide(_index);
	})

	$(".product-name").appendTo($(".img-product-slider .bx-viewport"));
	//product-name
})
