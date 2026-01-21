$(document).ready(function(){
		$('.loaderImg').hide();
		var $mwo = $('.marquee-with-options');
	$('.marquee').marquee();
	$('.marquee-with-options').marquee({
		//speed in milliseconds of the marquee
		speed: 30000,
		//gap in pixels between the tickers
		gap: 20,
		//gap in pixels between the tickers
		delayBeforeStart: 0,
		//'left' or 'right'
		direction: 'left',
		//true or false - should the marquee be duplicated to show an effect of continues flow
		duplicated: true,
		//on hover pause the marquee - using jQuery plugin https://github.com/tobia/Pause
		pauseOnHover: true
	});
			function initialize() {
			  var myLatlng = new google.maps.LatLng(26.99388238,82.67403972);
			  var mapOptions = {
				zoom: 12,
				center: myLatlng
			  }
			  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

			  var marker = new google.maps.Marker({
				  position: myLatlng,
				  map: map,
				  title: 'Hello World!'
			  });
			}

			google.maps.event.addDomListener(window, 'load', initialize);
			
		
			
			$('#pictureGallery a').TosRUs();
			$('#pictureGallery2 a').TosRUs();
			$('#pictureGallery3 a').TosRUs();
			
			
			$('.gallery_link').click(function(){
				$('.gallery_cont').ScrollTo({
					duration: 800,
					easing: 'linear',
					offsetTop: '0'
				});
			});
			$('.home_link').click(function(){
				$('.home_cont').ScrollTo({
					duration: 800,
					easing: 'linear',
					offsetTop: '0'
				});
			});
			$('.about_link').click(function(){
				$('.about_cont').ScrollTo({
					duration: 800,
					easing: 'linear',
					offsetTop: '0'
				});
			});
			$('.media_link').click(function(){
				$('.media_cont').ScrollTo({
					duration: 800,
					easing: 'linear',
					offsetTop: '0'
				});
			});
			$('.contact_link').click(function(){
				$('.contact_cont').ScrollTo({
					duration: 800,
					easing: 'linear',
					offsetTop: '0'
				});
			});

			
			
		});
		$("#myform").validate({
		  rules: {
			name: {
			  required: true,
			  maxlength: 100
			},
			email: {
			  required: true,
			  email: true
			},
			phone: {
			  required: true,
			  rangelength: [10, 13],
			  number: true
			},
			message: {
			  required: true,
			  maxlength: 200
			}

		  },
		  messages: {
			name: {
			  required: "Please specify your name"
			},
			email: {
			  required: "We need your email address to contact you",
			  email: "Your email address must be in the format of name@domain.com"
			},
			phone: {
			  required: "We need your phone number to contact you",
			  rangelength: "Your phone number must be in the correct format"
			},
			message: {
			  required: "Enter your query message",
			  maxlength: "Your message must not be more than 200 characters long"
			},
			subject: {
			  required: "Please select your subject"
			}
		  },
		  errorLabelContainer: ".errorBox",
		  submitHandler: function(form) {
			$('.loaderImg').show();
			 $.ajax({
                    type:'POST',
                    url:'http://pramodyadav.in/sendInquiryContact.php',
                    data:$('#myform').serialize(),
                    success:function(response)
                    {
                        //$("#successBox").html(response);
						$('.loaderImg').hide();
						//console.log('form submitted');
						$("input[type=text],input[type=email], textarea").val("");
						alert(response);
                    },
				fail:function(response)
                    {
                       alert(response);
                    }

		  });
		  }
		});
