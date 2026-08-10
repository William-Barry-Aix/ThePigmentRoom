jQuery(document).ready(function($){    
    
    var rtl;
    var sliderIntervalMs = 2000;

    function blossomPinitApplySliderBackgrounds($slider) {
        $slider.find('.item').each(function(){
            var $item = $(this);
            var $image = $item.find('img').first();
            var imageSrc = $image.attr('src');

            if (!imageSrc) {
                return;
            }

            $item.css('--slide-bg-image', 'url("' + imageSrc.replace(/"/g, '\\"') + '")');
        });
    }
    
    rtl = (typeof blossom_pinit_data !== 'undefined' && blossom_pinit_data.rtl == '1') || $('html').attr('dir') === 'rtl';

    var $bannerSlider = $('.banner-layout-two');
    var sliderAutoDirection = rtl ? 'prev.owl.carousel' : 'next.owl.carousel';
    var sliderItemCount = $bannerSlider.find('.item').length;

    $bannerSlider
    .on('initialized.owl.carousel refreshed.owl.carousel', function(){
        blossomPinitApplySliderBackgrounds($(this));
    })
    .owlCarousel({
        loop: true,
        autoplay: false,
        smartSpeed: 600,
        margin: 50,
        nav: true,
        dots: false,
        rtl: rtl,
        items: 1,
        thumbs: false,
        stagePadding: 300,
        navText: ['<svg xmlns="http://www.w3.org/2000/svg" viewBox="-19991 -11813 18 12"><path id="path" class="cls-1" d="M353.6,392.8v2H339.4l3.6,3.6-1.4,1.4-6-6,6-6,1.4,1.4-3.6,3.6Z" transform="translate(-20326.6 -12200.8)"/></svg> ', ' <svg xmlns="http://www.w3.org/2000/svg" viewBox="-18147 -11813 18 12"><path id="path" class="cls-1" d="M353.6,392.8v2H339.4l3.6,3.6-1.4,1.4-6-6,6-6,1.4,1.4-3.6,3.6Z" transform="translate(-17793.4 -11413.2) rotate(180)"/></svg> '],
        responsive:{
            0: {
                stagePadding: 0,
                margin: 0
            },
            420: {
                stagePadding: 20,
                margin: 0
            },  
            768: {
                stagePadding: 100,
                margin: 30
            },
            1025: {
                stagePadding: 100,
                margin: 20
            },
            1200: {
                stagePadding: 200,
                margin: 40
            },
            1400: {
                stagePadding: 200,
                margin: 100
            }

        }
    });

    if ($bannerSlider.length && sliderItemCount > 1) {
        var existingTimer = $bannerSlider.data('pinitAutoTimer');

        if (existingTimer) {
            window.clearInterval(existingTimer);
        }

        var autoTimer = window.setInterval(function(){
            $bannerSlider.trigger(sliderAutoDirection, [600]);
        }, sliderIntervalMs);

        $bannerSlider.data('pinitAutoTimer', autoTimer);
    }

    $bannerSlider.find('img').on('load', function(){
        blossomPinitApplySliderBackgrounds($(this).closest('.banner-layout-two'));
    }).each(function(){
        if (this.complete) {
            $(this).trigger('load');
        }
    });

    var $window = $(window);
    var $body = $('body');
    var $mobileHeader = $('.mobile-header');
    var $mobileHeaderActions = $mobileHeader.find('.mobile-header-actions');
    var mobileBreakpoint = window.matchMedia('(max-width: 1024px)');
    var lastScrollTop = $window.scrollTop();
    var mobileHeaderActionsHeight = 0;
    var stickyThreshold = 0;
    var stickyTicking = false;

    function blossomPinitGetAdminBarHeight() {
        var $adminBar = $('#wpadminbar');

        if ( !$adminBar.length || !$body.hasClass('admin-bar') ) {
            return 0;
        }

        return $adminBar.outerHeight();
    }

    function blossomPinitResetMobileHeader() {
        $body.css('padding-top', '');
        $mobileHeaderActions.removeClass('is-sticky is-visible').css('top', '');
    }

    function blossomPinitMeasureMobileHeader() {
        if ( !$mobileHeader.length || !$mobileHeaderActions.length || !mobileBreakpoint.matches ) {
            blossomPinitResetMobileHeader();
            return;
        }

        mobileHeaderActionsHeight = $mobileHeaderActions.outerHeight();
        stickyThreshold = $mobileHeaderActions.offset().top + mobileHeaderActionsHeight;
        $mobileHeaderActions.css('top', blossomPinitGetAdminBarHeight() + 'px');
    }

    function blossomPinitUpdateMobileHeader() {
        stickyTicking = false;

        if ( !$mobileHeader.length || !$mobileHeaderActions.length || !mobileBreakpoint.matches ) {
            blossomPinitResetMobileHeader();
            return;
        }

        var currentScrollTop = $window.scrollTop();
        var isPastHeader = currentScrollTop > stickyThreshold;
        var isScrollingUp = currentScrollTop < lastScrollTop;

        $mobileHeaderActions.css('top', blossomPinitGetAdminBarHeight() + 'px');

        if ( isPastHeader ) {
            $body.css('padding-top', mobileHeaderActionsHeight + 'px');
            $mobileHeaderActions.addClass('is-sticky');

            if ( isScrollingUp ) {
                $mobileHeaderActions.addClass('is-visible');
            } else {
                $mobileHeaderActions.removeClass('is-visible');
            }
        } else {
            blossomPinitResetMobileHeader();
        }

        lastScrollTop = currentScrollTop > 0 ? currentScrollTop : 0;
    }

    function blossomPinitRequestMobileHeaderUpdate() {
        if ( stickyTicking ) {
            return;
        }

        stickyTicking = true;
        window.requestAnimationFrame( blossomPinitUpdateMobileHeader );
    }

    blossomPinitMeasureMobileHeader();
    blossomPinitUpdateMobileHeader();

    $window.on('scroll', blossomPinitRequestMobileHeaderUpdate);
    $window.on('load resize', function() {
        blossomPinitMeasureMobileHeader();
        blossomPinitUpdateMobileHeader();
    });

});