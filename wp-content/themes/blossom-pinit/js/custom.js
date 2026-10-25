jQuery(document).ready(function($){    
    
    var rtl;
    var sliderIntervalMs = 10000;
    
    rtl = (typeof blossom_pinit_data !== 'undefined' && blossom_pinit_data.rtl == '1') || $('html').attr('dir') === 'rtl';

    var $bannerSlider = $('.banner-layout-two');
    var sliderAutoDirection = rtl ? 'prev.owl.carousel' : 'next.owl.carousel';
    var sliderItemCount = $bannerSlider.find('.item').length;

    function blossomPinitSetBannerCaptionState(shouldReveal) {
        var $textHolder = $bannerSlider.find('.text-holder');

        $textHolder.removeClass('is-visible');

        if ( shouldReveal ) {
            $bannerSlider.find('.owl-item.center .text-holder, .owl-item.active .text-holder').addClass('is-visible');
        }
    }

    $bannerSlider.on('change.owl.carousel translate.owl.carousel drag.owl.carousel', function() {
        blossomPinitSetBannerCaptionState(false);
    });

    $bannerSlider.on('initialized.owl.carousel translated.owl.carousel refreshed.owl.carousel', function() {
        blossomPinitSetBannerCaptionState(true);
    });

    $bannerSlider
    .owlCarousel({
        loop: true,
        autoplay: false,
        smartSpeed: 600,
        margin: 0,
        nav: true,
        dots: false,
        rtl: rtl,
        center: true,
        autoWidth: true,
        items: 3,
        thumbs: false,
        stagePadding: 0,
        navText: ['<svg xmlns="http://www.w3.org/2000/svg" viewBox="-19991 -11813 18 12"><path id="path" class="cls-1" d="M353.6,392.8v2H339.4l3.6,3.6-1.4,1.4-6-6,6-6,1.4,1.4-3.6,3.6Z" transform="translate(-20326.6 -12200.8)"/></svg> ', ' <svg xmlns="http://www.w3.org/2000/svg" viewBox="-18147 -11813 18 12"><path id="path" class="cls-1" d="M353.6,392.8v2H339.4l3.6,3.6-1.4,1.4-6-6,6-6,1.4,1.4-3.6,3.6Z" transform="translate(-17793.4 -11413.2) rotate(180)"/></svg> '],
        responsive:{
            0: {
                stagePadding: 0,
                margin: 0,
                items: 1,
                autoWidth: false,
                center: false
            },
            420: {
                stagePadding: 0,
                margin: 0,
                items: 1,
                autoWidth: false,
                center: false
            },  
            768: {
                stagePadding: 0,
                margin: 0,
                items: 1,
                autoWidth: false,
                center: false
            },
            1025: {
                stagePadding: 0,
                margin: 0,
                items: 3
            },
            1200: {
                stagePadding: 0,
                margin: 0,
                items: 3
            },
            1400: {
                stagePadding: 0,
                margin: 0,
                items: 3
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
    }).each(function(){
        if (this.complete) {
            $(this).trigger('load');
        }
    });

    var $window = $(window);
    var $body = $('body');
    var $mobileHeader = $('.mobile-header');
    var $mobileSiteHeader = $('.mobile-header .mobile-site-header');
    var $mobileHeaderActions = $mobileHeader.find('.mobile-header-actions');
    var mobileBreakpoint = window.matchMedia('(max-width: 1024px)');
    var $desktopHeader = $('.site-header.header-layout-two');
    var lastScrollTop = $window.scrollTop();
    var mobileHeaderActionsHeight = 0;
    var stickyThreshold = 0;
    var stickyTicking = false;

    function blossomPinitSetBannerOffset() {
        var headerHeight = 0;

        if ( mobileBreakpoint.matches ) {
            if ( $mobileSiteHeader.length ) {
                headerHeight = $mobileSiteHeader.outerHeight(true) || 0;
            }
        } else if ( $desktopHeader.length ) {
            headerHeight = $desktopHeader.outerHeight(true) || 0;
        }

        if ( headerHeight > 0 ) {
            $bannerSlider.css('--banner-offset', headerHeight + 'px');
        }
    }

    blossomPinitSetBannerOffset();
    $window.on('resize orientationchange', blossomPinitSetBannerOffset);

    $window.on('resize orientationchange', function() {
        window.requestAnimationFrame(function() {
            $bannerSlider.trigger('refresh.owl.carousel');
        });
    });

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