jQuery(document).ready(function($) {
    "use strict";

    //Preloader

    $('body.preloader').jpreLoader({
        showSplash : false,
        loaderVPos : '50%',
    }).css('visibility','visible');

    //Scroll

    $(".scroll").click(function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        var hash = href.split('#');
        var url_hash = '#' + hash[1];

        if ($(url_hash).length > 0) {
            var offset = ($(window).width()<968) ? 20 : 100;
            $('html, body').animate({
                scrollTop: $(url_hash).offset().top-offset
            }, 1000);
        }
        else{
            location.href = href;
        }

         if($(window).width()<968){
            var $menu_responsive = $('#ABdev_main_header nav');
            $menu_responsive.animate({width:'toggle'},350);
        }
    });

    //Language switcher

    if ($('.lang_switcher_wpmu').length) {
        $('.lang_switcher_wpmu').find('.lang_select li:first-of-type').addClass('active');
        $('.lang_switcher_wpmu').on('click', '.lang_select',function(e){
            e.preventDefault();
            var $this = $(this);
            $this.parent('.lang_switcher_wpmu').toggleClass('visible');
            $this.find('li').toggleClass('show');
        });
    }

    //Back to top

    $('#back_to_top').click(function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, 900);
        return false;
    });

    //Woocommerce tweaks

   $("a.woocommerce-review-link").click(function(e){
       e.preventDefault();
       $(".woocommerce-tabs>ul.tabs>li.reviews_tab>a").click();
       $('html, body').animate({scrollTop: $(".woocommerce-tabs").offset().top-100}, 1000);
   });

    $(window).load(function(){

        var $product_image = $('.woocommerce ul.products li.product a .imagewrapper');
        var $product_item = $('.woocommerce ul.products li.product');
        var $product_button_variable = $('.woocommerce ul.products li.product a.button.product_type_variable');
        var $image_height = $product_image.outerHeight()/2;

        $product_item.each(function(){
            var $product_button = $(this).find('.single_add_to_cart_button.button, .button.add_to_cart_button');
            $product_button.css({'margin-left': - $product_button.outerWidth()/2 + 'px', 'top' : $image_height + 'px'});
            var $compare_button = $(this).find('a.button.compare');
            $compare_button.css({'margin-left': - $compare_button.outerWidth()/2 + 'px', 'top' : $image_height + 'px'});
            var $product_button_gridlist = $(this).find('.gridlist-buttonwrap .single_add_to_cart_button.button, .gridlist-buttonwrap .button.add_to_cart_button');
            $product_button_gridlist.css({'margin-left': - $product_button_gridlist.outerWidth()/2 + 'px', 'top' : $image_height + 'px'});
            var $compare_button_gridlist = $(this).find('.gridlist-buttonwrap a.button.compare');
            $compare_button_gridlist.css({'margin-left': - $compare_button_gridlist.outerWidth()/2 + 'px', 'top' : $image_height + 'px'});
        });

        $product_button_variable.css({'margin-left': - $product_button_variable.outerWidth()/2 + 'px', 'top' : $image_height + 'px'});
    });

    //Menu Cart hover

    var menu_cart = $('#shop_links'), subelement = menu_cart.find('.cart_dropdown_widget').css({display:'none', opacity: 0});

    menu_cart.hover(
        function(){
            subelement.css({display:'block'}).stop().animate({opacity:1});
        },
        function(){
            subelement.stop().animate({opacity:0}, function(){
                subelement.css({display:'none'});
            });
        }
    );

    //List/Grid toggle

    $( document ).ready(function() {
        $('.woocommerce .gridlist-toggle a#grid').empty().append('<i class="ci_icon-th"></i>');
        $('.woocommerce .gridlist-toggle a#list').empty().append('<i class="ci_icon-th-list"></i>');
    });

    // +- buttons

    $(function(a){
    a(".woocommerce-ordering").on("change", "select.orderby", function(){
        a(this).closest("form").submit()
    }),
    a("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass("buttons_added").append('<input type="button" value="+" class="plus" />').prepend('<input type="button" value="-" class="minus" />'), a("input.qty:not(.product-quantity input.qty)").each(function(){
        var b=parseFloat(a(this).attr("min"));b&&b>0&&parseFloat(a(this).val())<b&&a(this).val(b)
    }),
    a(document).on("click", ".plus, .minus", function(){
        var b=a(this).closest(".quantity").find(".qty"),
        c=parseFloat(b.val()),
        d=parseFloat(b.attr("max")),
        e=parseFloat(b.attr("min")),
        f=b.attr("step");c&&""!==c&&"NaN"!==c||(c=0),
        (""===d||"NaN"===d)&&(d=""),
        (""===e||"NaN"===e)&&(e=0),
        ("any"===f||""===f||void 0===f||"NaN"===parseFloat(f))&&(f=1),
        a(this).is(".plus")?b.val(d&&(d==c||c>d)?d:c+parseFloat(f)):e&&(e==c||e>c)?b.val(e):c>0&&b.val(c-parseFloat(f)),
        b.trigger("change")
        })
    });

    //Waypoints

    $('.home.page .dnd_section_dd, .home.page .tcvpb_section_tc').waypoint(function(direction) {
        var section_id = $(this).attr('id');
        var $menu_item;
        if(section_id!==undefined){
            $('.current-menu-item, .current-menu-ancestor').removeClass('current-menu-item').removeClass('current-menu-ancestor');
            if(direction==='down'){
                $menu_item = $('#main_menu a[href=#'+section_id+']').parent();
                if($menu_item.length>0){
                    $menu_item.addClass('current-menu-item');
                }
                else{
                    $('#main_menu .current_page_item').addClass('current-menu-item');
                }
            }
            else if(direction==='up'){
                var previous_section_id = $(this).prevAll('[id]:first').attr('id');
                $menu_item = $('#main_menu a[href=#'+previous_section_id+']').parent();
                if($menu_item.length>0){
                    $menu_item.addClass('current-menu-item');
                }
                else{
                    $('#main_menu .current_page_item').addClass('current-menu-item');
                }
            }
        }
    },{
      offset: 100
    });

    //Timeline tabs

    $('.dnd-tabs-timeline, .tcvpb-tabs-timeline').each(function(){
        var $this = $(this);
        var $tabs = $this.find('.dnd-tabs-ul > li');
        var tabsCount = $tabs.length;
        $tabs.addClass('tab_par_'+tabsCount);
    });

    //Header effects

    var $main_slider = $('#ABdev_main_slider');
    $main_slider.height('auto');
    var $main_header = $('#ABdev_main_header');
    var $header_spacer = $('#ABdev_header_spacer');

    $('#ABdev_main_slider.ABdev_parallax_slider').height($(window).height());

    var header_height = $main_header.outerHeight();

    $header_spacer.height(header_height);
    var admin_toolbar_height = parseInt($('html').css('marginTop'), 10);

    var $topBar = $('#top_bar');
    var topBar_height = $topBar.outerHeight();

    function sticky_header(){
        if($(window).width()>1190){
            $topBar.removeClass('top_bar_hide');
            $(document).scroll(function(){
                var scrollTop = parseInt($(document).scrollTop() ,10);
                if(scrollTop>400){
                    $topBar.addClass('top_bar_hide');
                    $('#search-container').slideUp('300', function(){
                        if($("#search-container").css('display', 'none')){
                            $(".search-toggle > i").removeClass("ci_icon-remove").addClass("ci_icon-search");
                            $(".search-toggle").removeClass("active");
                        } else{
                            $(".search-toggle > i").removeClass("ci_icon-search").addClass("ci_icon-remove");
                        }
                    });
                }
                else{
                    $topBar.removeClass('top_bar_hide');
                }
            });
        }
    }
    sticky_header();

    // Search toggle

    var $search_class = $(".search-toggle > i");
    $search_class.addClass("ci_icon-search");
    $('.search-toggle').on('click', function(e) {
        e.preventDefault();
        var $that = $(this);
        var $wrapper = $('.search-box-wrapper');

        $that.toggleClass('active');
        $wrapper.slideToggle(300);
        var header_var_height = $main_header.outerHeight();

        $wrapper.css('top', header_var_height);

        if($search_class.hasClass("ci_icon-search")){
            $search_class.removeClass("ci_icon-search").addClass("ci_icon-remove");
        } else{
            $search_class.removeClass("ci_icon-remove").addClass("ci_icon-search");
        }

        if ($that.hasClass('active')) {
            $wrapper.find('input').focus();
        }
    } );

    $('.accordion-group').on('show', function() {
        $(this).find('i').removeClass('icon-plus').addClass('icon-minus');
    });
    $('.accordion-group').on('hide', function() {
        $(this).find('i').removeClass('icon-minus').addClass('icon-plus');
    });

    //Superfish

    var $sf = $('#main_menu');
    if($('#ABdev_menu_toggle').css('display') === 'none') {
        // enable superfish when the page first loads if we're on desktop
        $sf.superfish({
            delay:          300,
            animation:      {opacity:'show',height:'show'},
            animationOut:   {height:'hide'},
            speed:          'fast',
            speedOut:       'fast',
            cssArrows:      false,
            disableHI:      true /* load hoverIntent.js in header to use this option */,
            onBeforeShow:   function(){
                var ww = $(window).width();
                if(this.parent().offset() !== undefined){
                    var locUL = this.parent().offset().left + this.width();
                    var locsubUL = this.parent().offset().left + this.parent().width() + this.width();
                    var par = this.parent();
                    if(par.parent().is('#main_menu') && (locUL > ww)){
                        this.css('marginLeft', "-"+(locUL-ww+20)+"px");
                    }
                    else if (!par.parent().is('#main_menu') && (locsubUL > ww)){
                        this.css('left', "-"+(this.width())+"px");
                    }
                }
            }
        });
    }

    //Responsive menu

    var $menu_responsive = $('#ABdev_main_header nav');
    $('#ABdev_menu_toggle').click(function(){
        $menu_responsive.animate({width:'toggle'},350);
    });

    $(".submit").click(function () {
        $(this).closest("form").submit();
    });

    $('input, textarea').placeholder();

    // Timeline AJAX

    var $content = $("#timeline_posts");
    var $loader = $("#timeline_loading");
    var itemSelector = ('.timeline_post');

    function timeline_classes(){
        $content.find(itemSelector).each(function(){
           var posLeft = $(this).css("left");
           if(posLeft == "0px"){
               $(this).removeClass('timeline_post_right').addClass('timeline_post_left');
           }
           else{
               $(this).removeClass('timeline_post_left').addClass('timeline_post_right');
           }
        });
    }

    $content.imagesLoaded( function() {
        $content.masonry({
          columnWidth: ".timeline_post_first",
          gutter: 100,
          itemSelector: itemSelector,
        });

        timeline_classes();

    });

    $(window).on('scroll', function () {
        if ($(window).scrollTop() + $(window).height()  >= $(document).height() - $('#ABdev_main_footer').height()) {
             if(!( $loader.hasClass('timeline_loading_loader') || $loader.hasClass('timeline_no_more_posts'))){
                load_posts();
            }
        }
    });

    var page_number = 1;
    var cat = $loader.data('category');

    function load_posts(){
        if(!($loader.hasClass('timeline_loading_loader') || $loader.hasClass('timeline_no_more_posts'))){
            page_number++;
            var str = '&cat=' + cat + '&page_number=' + page_number + '&action=abdev_get_timeline_posts';
            $("#timeline_last_post_month").remove();
            var noPosts = $loader.data("noposts");
            $.ajax({
                type       : "POST",
                dataType   : "html",
                url: abdev_timeline_posts.ajaxurl,
                data: str,
                success : function(data){
                    var $data = $(data);
                    if($data.length){
                            var $newElements = $data.css({ opacity: 0 });
                            $content.append( $newElements );
                        $content.imagesLoaded(function(){
                            $loader.removeClass('timeline_loading_loader');
                            $content.masonry( 'appended', $newElements, false );
                            $newElements.animate({ opacity: 1 });
                            timeline_classes();
                        });
                    } else {
                        $loader.addClass('timeline_no_more_posts').html(abdev_timeline_posts.noposts);
                    }
                },
                beforeSend : function(){
                    $loader.addClass('timeline_loading_loader').html('');
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                },
                complete : function(){
                    $loader.removeClass('timeline_loading_loader');
                    timeline_classes();
                }
            });
        }
        return false;
    }

    // Countdown

    $('.dnd_countdown').each(function() {
        var $this = $(this);
        var currentDate = new Date();

        var year = $this.find('.dnd_countdown_inner .countdown.year').data('value');
        var month = $this.find('.dnd_countdown_inner .countdown.month').data('value');
        var day = $this.find('.dnd_countdown_inner .countdown.day').data('value');
        var hour = $this.find('.dnd_countdown_inner .countdown.hour').data('value');
        var minute = $this.find('.dnd_countdown_inner .countdown.minute').data('value');
        var second = $this.find('.dnd_countdown_inner .countdown.second').data('value');

        var countDownString = year + "/" + month + "/" + day + " " + hour + ":" + minute + ":" + second;

        $this.find('.countdown.year').countdown(countDownString).on('update.countdown', function(event){
            var $this = $(this).html(event.strftime('%Y'));
        });

        $this.find('.countdown.month').countdown(countDownString).on('update.countdown', function(event){
            var $this = $(this).html(event.strftime('%m'));
        });

        $this.find('.countdown.day').countdown(countDownString).on('update.countdown', function(event){
            var $this = $(this).html(event.strftime('%d'));
        });

        $this.find('.countdown.hour').countdown(countDownString).on('update.countdown', function(event){
            var $this = $(this).html(event.strftime('%H'));
        });

        $this.find('.countdown.minute').countdown(countDownString).on('update.countdown', function(event){
            var $this = $(this).html(event.strftime('%M'));
        });

        $this.find('.countdown.second').countdown(countDownString).on('update.countdown', function(event){
            var $this = $(this).html(event.strftime('%S'));
        });
    });

    //Portfolio isotope

    var $isotope_container = $('#ABdev_latest_portfolio');
    var sortBy = 'original-order';
    var columnWidth = '.portfolio_item';
    if( $isotope_container.find('.portfolio_item').hasClass('portfolio_masonry_fullwidth')){
        sortBy = 'random';
        columnWidth = '.portfolio_item.small';
    }

    $isotope_container.imagesLoaded( function() {
        $isotope_container.isotope({
            layoutMode: 'masonry',
            masonry: {
              columnWidth: columnWidth
            },
            itemSelector : '.portfolio_item',
            sortBy: sortBy
        });
        var $optionSets = $('.option-set'),
            $optionLinks = $optionSets.find('a');
        $optionLinks.click(function(){
            var $this = $(this);
            if ( $this.hasClass('selected') ) {
                return false;
            }
            var $optionSet = $this.parents('.option-set');
            $optionSet.find('.selected').removeClass('selected');
            $this.addClass('selected');
            var options = {},
                key = $optionSet.attr('data-option-key'),
                value = $this.attr('data-option-value');
            value = value === 'false' ? false : value;
            options[ key ] = value;
            if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
                changeLayoutMode( $this, options );
            } else {
                $isotope_container.isotope( options );
            }
            return false;
        });
    });


    $(window).load(function() {

        //Nivo Slider in Portfolio

        $('#portfolio_gallery_slider').nivoSlider({
            effect:'fade', // Specify sets like: 'fold,fade,sliceDown'
            pauseTime:3000, // How long each slide will show
            directionNav:false, // Next & Prev navigation
            controlNavThumbs:true,
            controlNavThumbsFromRel:false,
            manualAdvance: false,
        });

        //Post Excerpt image

        if ($(window).width()<768){
            $('.dnd_posts_image').append('<div class="box"></div>');
            var $box = $('.dnd_posts_image').find('.box');
            var $box_width = $('.dnd_posts_shortcode').outerWidth();

            $box.height($box_width);

            $('.dnd_latest_news_shortcode_content, .tcvpb_latest_news_shortcode_content').css('padding-top', $box_width+30+'px');
        }

        //Carousel

        $('.dnd-carousel').each(function (){
            var $prev = $(this).find('.carousel_prev');
            var $next = $(this).find('.carousel_next');

            var $autoPlay = $(this).data("autoplay") == '0' ? false : true;
            var $items = $(this).data("items");
            var $effect = $(this).data("effect");
            var $easing = $(this).data("easing");
            var $duration = $(this).data("duration");

            $(this).find('ul').carouFredSel({
                prev: $prev,
                next: $next,
                width: '100%',
                play: true,
                auto: $autoPlay,
                scroll: {
                    items: $items,
                    fx: $effect,
                    easing: $easing,
                    duration: $duration,
                }
            });
        });

    });

    //Resize

    $(window).resize(function() {

        timeline_classes();

        sticky_header();

        $isotope_container.imagesLoaded( function() {
            $isotope_container.isotope('layout');
        });

        if($('#ABdev_menu_toggle').css('display') === 'none' && !$sf.hasClass('sf-js-enabled')) {
            // you only want SuperFish to be re-enabled once ($sf.hasClass)
            $menu_responsive.show();
            $sf.superfish({
                delay:          300,
                animation:      {opacity:'show',height:'show'},
                animationOut:   {height:'hide'},
                speed:          'fast',
                speedOut:       'fast',
                cssArrows:      false,
                disableHI:      true /* load hoverIntent.js in header to use this option */,
                onBeforeShow:   function(){
                    this.css('marginLeft', "0px");
                    var ww = $(window).width();
                    var locUL = this.parent().offset().left + this.width();
                    var locsubUL = this.parent().offset().left + this.parent().width() + this.width();
                    var par = this.parent();
                    if(par.parent().is('#main_menu') && (locUL > ww)){
                        this.css('marginLeft', "-"+(locUL-ww+20)+"px");
                    }
                    else if (!par.parent().is('#main_menu') && (locsubUL > ww)){
                        this.css('left', "-"+(this.width())+"px");
                    }
                }
            });
        } else if($('#ABdev_menu_toggle').css('display') != 'none' && $sf.hasClass('sf-js-enabled')) {
            // smaller screen, disable SuperFish
            $sf.superfish('destroy');
            $menu_responsive.hide();
            $menu_responsive.find('.sf-mega').css('marginLeft','0');
        }
    });


});


