var timer = new Object;

function slider(){
	nextSlide();
	timer = window.setTimeout(slider,5000);
}

function nextSlide(){
	var $Slides = $("#slides");
	$("#nextSlide").unbind("click",nextSlide);
	$Slides.animate(
		{marginLeft:"-=960px"},
		1000,
		function(){
				$Slides.data("currentSlide",$Slides.data("currentSlide")+1);
				if($Slides.data("currentSlide") > $Slides.data("nbSlides")){
					$Slides
						.data("currentSlide",1)
						.css({marginLeft:"-960px"});
				}
				window.clearTimeout(timer);
				timer = window.setTimeout(slider,5000);
				$("#nextSlide").bind("click",nextSlide);
			}
	);
}

function prevSlide(){
	var $Slides = $("#slides");
	$("#prevSlide").unbind("click",prevSlide);
	$Slides.animate(
		{marginLeft:"+=960px"},
		1000,
		function(){
				$Slides.data("currentSlide",$Slides.data("currentSlide")-1);
				if($Slides.data("currentSlide") == 0){
					$Slides
						.data("currentSlide",$Slides.data("nbSlides"))
						.css({marginLeft:-(960*$Slides.data("currentSlide"))});
				}
				window.clearTimeout(timer);
				timer = window.setTimeout(slider,5000);
				$("#prevSlide").bind("click",prevSlide);
			}
	);
}


$(function(){
	var $Slides = $("#slides");
	var _step = $Slides.find("li:first").width();
	$Slides
		.data("currentSlide",1)
		.data("nbSlides",$Slides.find("li").size());
	$Slides
		.find("li:last")
			.clone()
			.prependTo("#slides");

	$Slides
		.find("li:first")
			.next()
			.clone()
			.appendTo("#slides");

	$Slides		
		.find("li:first")
			.addClass("clone")
		.end()
		.find("li:last")
			.addClass("clone")
		.end()
		.css({marginLeft:-_step});

	$Slides.width($Slides.find("li").size()*_step);
	
	$("#nextSlide").bind("click",nextSlide);
	$("#prevSlide").bind("click",prevSlide);
	
	timer = window.setTimeout(slider,5000);
	
})