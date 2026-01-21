var $ = jQuery.noConflict();
$(document).ready(function() {

	"use strict";

	// Responsive video
	$(".hentry, .widget").fitVids();
	
	/*----------------------------------------------------*/
	/*  Superfish Menu
	/*----------------------------------------------------*/

	// initialise plugin
	var example = $('.sf-menu').superfish({
		delay:       100,                            // one second delay on mouseout
		speed:       'fast',                          // faster animation speed
		autoArrows:  false                            // disable generation of arrow mark-up       
	});

	/*----------------------------------------------------*/
	/*  Sidr Responsive Menu
	/*----------------------------------------------------*/

	$('#primary-mobile-menu').sidr({
	  name: 'sidr-existing-primary',
	  source: '#primary-nav'    
	});

	$('#secondary-mobile-menu').sidr({
	  name: 'sidr-existing-secondary',
	  source: '#secondary-nav'
	});

	/*= News Ticker
	---------------------------------------------------------------------*/
	var newsTicker = jQuery('li.news-item');
	var tickerTimeId = 0;
	var currentNews = 0;
	var olderNews = 0;
	var sumNews = jQuery(newsTicker).size();

	function newsTickerInit(){
		jQuery(newsTicker).eq(0).fadeIn();
		newsTickerClick();
		tickerTimeId = setInterval(autoTicherScroll,6000);
	}
	newsTickerInit();

	function newsTickerClick(){
		jQuery(newsTicker).each(function(index){
			if(!jQuery(this).children('a').is(':hidden')){
				currentNews = index;
			}
		});
		jQuery('a.headline-prev').click(function(e){
			e.preventDefault();
			clearInterval(tickerTimeId);
			olderNews = currentNews;
			if(currentNews == 0){
				currentNews = sumNews-1;
			}else{
				currentNews = currentNews-1;
			}
			jQuery(newsTicker).eq(olderNews).stop(true,true).fadeOut().queue(function(){
				jQuery(newsTicker).eq(currentNews).stop(true,true).fadeIn();
			});

			tickerTimeId = setInterval(autoTicherScroll,6000);
		});
		jQuery('a.headline-next').click(function(e){
			e.preventDefault();
			clearInterval(tickerTimeId);
			olderNews = currentNews;
			if(currentNews == sumNews-1){
				currentNews = 0;
			}else{
				currentNews = currentNews+1;
			}
			jQuery(newsTicker).eq(olderNews).stop(true,true).fadeOut().queue(function(){
				jQuery(newsTicker).eq(currentNews).stop(true,true).fadeIn();
			});
			tickerTimeId = setInterval(autoTicherScroll,6000);
		});
	}

	function autoTicherScroll(){
		olderNews = currentNews;
		if(currentNews == sumNews-1){
			currentNews = 0;
		}else{
			currentNews = currentNews+1;
		}
		jQuery(newsTicker).eq(olderNews).stop(true,true).fadeOut().queue(function(){
			jQuery(newsTicker).eq(currentNews).stop(true,true).fadeIn();
		});
	}

	/*----------------------------------------------------*/
	/*  Tabs
	/*----------------------------------------------------*/

	var $tabsNav    = $('.tabs-nav'),
		$tabsNavLis = $tabsNav.children('li'),
		$tabContent = $('.tab-content');

	$tabsNav.each(function() {
		var $this = $(this);

		$this.next().children('.tab-content').stop(true,true).hide()
											 .first().show();

		$this.children('li').first().addClass('active').stop(true,true).show();
	});

	$tabsNavLis.on('click', function(e) {
		var $this = $(this);

		$this.siblings().removeClass('active').end()
			 .addClass('active');

		$this.parent().next().children('.tab-content').stop(true,true).hide()
													  .siblings( $this.find('a').attr('href') ).fadeIn();

		e.preventDefault();
	});


	$(function() {

		/*----------------------------------------------------*/
		/*  Featured Content (Carousel-0)
		/*----------------------------------------------------*/     

		$('#carousel-0').jcarousel({
			wrap: 'circular'
		});

		$('#carousel-0').jcarouselAutoscroll({
			autostart: true
		});

		$('.jcarousel-pagination')
			.on('jcarouselpagination:active', 'a', function() {
				$(this).addClass('active');
			})
			.on('jcarouselpagination:inactive', 'a', function() {
				$(this).removeClass('active');
			})
			.jcarouselPagination();

		/*----------------------------------------------------*/
		/*  Carousel Content (Carousel-1/2)
		/*----------------------------------------------------*/

		/*
		Carousel initialization
		*/    
		$('.jcarousel')
			.jcarousel({
				// Options go here
				wrap: 'circular'                
			});

		/*
		 Prev control initialization
		 */
		$('.jcarousel-control-prev')
			.on('jcarouselcontrol:active', function() {
				$(this).removeClass('inactive');
			})
			.on('jcarouselcontrol:inactive', function() {
				$(this).addClass('inactive');
			})
			.jcarouselControl({
				// Options go here
				target: '-=1'
			});

		/*
		 Next control initialization
		 */
		$('.jcarousel-control-next')
			.on('jcarouselcontrol:active', function() {
				$(this).removeClass('inactive');
			})
			.on('jcarouselcontrol:inactive', function() {
				$(this).addClass('inactive');
			})
			.jcarouselControl({
				// Options go here
				target: '+=1'
			});

	});                

});

var $ = jQuery.noConflict();
	$(document).ready(function() { 
		$('#mainslider').flexslider({
			animation: "slide",
			manualControls: "#main-slider-control-nav li",
			animationLoop: true,
			slideshow: true,
		});
	});


$(window).load(function() {
  $('#photo-slider').flexslider({
	animation: "slide"
  });
});