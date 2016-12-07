window.addEventListener("load", function(){
	var load_screen = document.getElementById("loading");
		load_screen.className += ' loaded';	
});

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
		/*Scroll Jacking*/
		var $root = $('body, html');
	    var debounce = 0;

		$(window).on('mousewheel DOMMouseScroll', function(e){
			e.preventDefault();
			var delta = e.originalEvent.detail < 0 || e.originalEvent.wheelDelta > 0 ? 1 : -1;
	        //get the current active slide
	        var $active = $('#story > .active');
			if(delta < 0 && debounce == 0) {
	            //mousewheel down
	            var $next = $active.next();
	            var nextDisplay = $next.css('display');
	            //check if there's a next slide available
		            if($next.length && nextDisplay == 'block'){
		                //animate scrolling to the next slide offset top
		               $root.animate({scrollTop:$next.offset().top},'slow');
		               //move also the indicator class 'active'
		               $next.addClass('active').siblings().removeClass('active');
		            }
		        debounce = 1;

		        setTimeout(function(){
		        	debounce = 0;
		        }, 1000);

            }
            else if(delta > 0 && debounce == 0)
            {

	            //mousewheel up
	            var $prev = $active.prev();
	            if($prev.length){
	                 //animate scrolling to the previous slide offset top
	                $root.animate({scrollTop:$prev.offset().top},'slow'); 
	                $prev.addClass('active').siblings().removeClass('active');
	            }

	            debounce = 1;

	            setTimeout(function(){
		        	debounce = 0;
		        }, 1000);
	        }
		});

		for(var i=0;i<=5;i++)
		{
			addBombec(i);
		}
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

	function isElementInViewport(el) {
    	var rect = el.getBoundingClientRect();

    return rect.bottom > 0 &&
        rect.right > 0 &&
        rect.left < (window.innerWidth || document.documentElement.clientWidth) /* or $(window).width() */ &&
        rect.top < (window.innerHeight || document.documentElement.clientHeight) /* or $(window).height() */;
	}


	/*Help Jean-Kevin lol*/
	$('.btn-help').on("click", function(){

		/*Get current div*/
		var curDiv = $('#story > .active');
		/*After click set active class to the next div*/
		var nDiv = curDiv.next();
		nDiv.addClass('active').siblings().removeClass('active');
		var data = $(this).attr('data-attribute');
		if(data == 'yes'){
			var pageToScroll = $('#application');
			$('.Title-application').html('Ne tombez pas dans l\'addiction, push est là pour vous aider');
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
			$('.Title-application').html('Découvrez push, votre parrain qui vous veut du bien');
			$('footer').show(150);
			$('#contact').show(150);
			$('#application').show(150);
			setTimeout(function() {
				$('html, body').animate({ scrollTop: pageToScroll.offset().top }, 'slow');

			}, 150);
			return false;
		}
	});

});



