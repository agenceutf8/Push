window.addEventListener("load", function(){
	var load_screen = document.getElementById("loading");
		load_screen.className += ' loaded';

	$(document).ready(function(){

	/*POP UP MENTIONS LEGALES ET CGU*/
	$('#cgu').on('click', function(e){
		e.preventDefault();
		$('.cgu').css('display','block');
		$('#voile').css('display','block');
	});
	$('#mentions').on('click', function(e){
		e.preventDefault();
		$('.mentions-legales').css('display','block');
		$('#voile').css('display','block');
	});
	
	$('#voile').on('click', function(e){	
		e.preventDefault();
		$(this).fadeOut('slow');
		$('.mentions-legales').css('display','none');
		$('.cgu').css('display','none');
	});

	/*Ajax register beta*/
	$('#beta-register').submit(function(e){
		e.preventDefault();
		var response = $.ajax({
			url: 'ajax/beta', //route
			type: 'POST',
			data: $("#beta-register").serialize()
		});
		response.done(function(data){
			if(data == "Success")
				$('#beta-success').html('Bravo, vous êtes inscrit à la bêta !')
			else if(data == "Error")
				console.log('not ok');
		});
	});

	/*Detect Mobile*/
	var isMobile = {
	    Android: function() {
	        return navigator.userAgent.match(/Android/i);
	    },
	    BlackBerry: function() {
	        return navigator.userAgent.match(/BlackBerry/i);
	    },
	    iOS: function() {
	        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	    },
	    Opera: function() {
	        return navigator.userAgent.match(/Opera Mini/i);
	    },
	    Windows: function() {
	        return navigator.userAgent.match(/IEMobile/i);
	    },
	    any: function() {
	        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	    }
	}

	if(isMobile.any()) {
		//We are in mobile
	}
	else{
		for(var i=0;i<=5;i++)
		{
			addBombec(i);
		}
	}

	var counted = false;
	$(window).scroll(function(){
		/*Fire event*/
		var divRepas = document.getElementById("featurette-repas");
		if(isElementInViewport(divRepas)){
			if(!counted){
				counted = true;
				$('.compteur-repas').count({end:50, duration:5000});	
			}
		}
		else{
			//do nothing
		}

	});
	$.fn.count = function(options){
		var settings = $.extend({
			start:0,
			end:100,
			easing:'swing',
			duration:'2000',
			complete:''
		}, options);

		var elem = $(this);
		$({count: settings.start}).animate({count:settings.end},{
			duration: settings.duration,
			easing: settings.easing,
			step: function(){
				var mathCount = Math.ceil(this.count);
				elem.text(mathCount);
			},
			complete:settings.complete
		});
	}
	/*Help Jean-Kevin lol*/
	$('.btn-help').on("click", function(){
		var data = $(this).attr('data-attribute');
		console.log(data);
		if(data == 'yes'){
			var pageToScroll = $('#application');
			$('footer').show(150);
			$('#contact').show(150);
			$('#application').show(150);
			setTimeout(function() {
				$('html, body').animate({ scrollTop: pageToScroll.offset().top }, 'slow');

			}, 150);
			return false;
		}
		if(data == 'no'){
			var pageToScroll = $('#application');
			$('footer').show(150);
			$('#contact').show(150);
			$('#application').show(150);
			setTimeout(function() {
				$('html, body').animate({ scrollTop: pageToScroll.offset().top }, 'slow');

			}, 150);
			return false;
		}
	});

	function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();

    return rect.bottom > 0 &&
        rect.right > 0 &&
        rect.left < (window.innerWidth || document.documentElement.clientWidth) /* or $(window).width() */ &&
        rect.top < (window.innerHeight || document.documentElement.clientHeight) /* or $(window).height() */;
	}

	function addBombec(delay){
		var div = document.getElementById('box-toilet');
		var nCandy = Math.floor((Math.random()*3)+1);
		var rLeft = Math.floor(Math.random()*(51-42+1)+42);
		var candy = document.createElement("IMG");
		var duration = Math.floor((Math.random()*2)+5);
		candy.style.animationDuration = duration+"s";
		candy.style.animationDelay = delay+"s";
		candy.style.left = rLeft+"%";
		candy.className = "bonbon";
		switch(nCandy){
			case 1:
				candy.src = '/web/img/bonbon-multi.png';
				break;
			case 2:
				candy.src = '/web/img/bonbon-rouge.png';
				break;
			case 3:
				candy.src = '/web/img/poisson.png';
				break;
			default:
		}
		div.appendChild(candy);

	}

});
	
});



