jQuery(document).ready(function($){    
    
    var rtl;
    var sliderIntervalMs = 4000;
    var sliderTransitionMs = 350;
    
    rtl = (typeof blossom_pinit_data !== 'undefined' && blossom_pinit_data.rtl == '1') || $('html').attr('dir') === 'rtl';

    var $bannerSlider = $('.banner-layout-two');
    var sliderAutoDirection = rtl ? 'prev.owl.carousel' : 'next.owl.carousel';
    var sliderItemCount = $bannerSlider.find('.item').length;
    var deferredBannerImageQueue = [];
    var deferredBannerIsLoading = false;

    function blossomPinitCollectDeferredBannerImageIds() {
        var orderedIds = [];
        var seenIds = {};

        $bannerSlider.find('.owl-item:not(.cloned) img.banner-image[data-banner-image-id]').each(function() {
            var imageId = $(this).attr('data-banner-image-id');

            if ( imageId && !seenIds[imageId] ) {
                seenIds[imageId] = true;
                orderedIds.push(imageId);
            }
        });

        if ( !orderedIds.length ) {
            $bannerSlider.find('img.banner-image[data-banner-image-id]').each(function() {
                var imageId = $(this).attr('data-banner-image-id');

                if ( imageId && !seenIds[imageId] ) {
                    seenIds[imageId] = true;
                    orderedIds.push(imageId);
                }
            });
        }

        return orderedIds;
    }

    function blossomPinitGetActiveBannerImageIndex(orderedIds) {
        var $activeImage = $bannerSlider.find('.owl-item.active:not(.cloned) img.banner-image[data-banner-image-id]').first();

        if ( !$activeImage.length ) {
            return 0;
        }

        return Math.max(0, $.inArray($activeImage.attr('data-banner-image-id'), orderedIds));
    }

    function blossomPinitBuildDeferredBannerQueue() {
        var orderedIds = blossomPinitCollectDeferredBannerImageIds();
        var queue = [];
        var queued = {};
        var activeIndex = blossomPinitGetActiveBannerImageIndex(orderedIds);
        var total = orderedIds.length;
        var distance;

        if ( !total ) {
            return queue;
        }

        for ( distance = 0; distance < total; distance++ ) {
            var rightIndex = (activeIndex + distance) % total;
            var leftIndex = (activeIndex - distance + total) % total;
            var rightId = orderedIds[rightIndex];
            var leftId = orderedIds[leftIndex];

            if ( rightId && !queued[rightId] ) {
                queued[rightId] = true;
                queue.push(rightId);
            }

            if ( leftId && !queued[leftId] ) {
                queued[leftId] = true;
                queue.push(leftId);
            }
        }

        return queue;
    }

    function blossomPinitHydrateBannerImageById(imageId, onDone) {
        var selector = 'img.banner-image[data-banner-image-id="' + imageId + '"]';
        var $targets = $bannerSlider.find(selector);
        var $sourceImage = $targets.filter('[data-src]').first();
        var src;
        var srcset;
        var sizes;
        var preloader;
        var didFinish = false;
        var finishTimer = null;

        function finishHydration() {
            if ( didFinish ) {
                return;
            }

            didFinish = true;
            window.clearTimeout(finishTimer);
            onDone();
        }

        if ( !$targets.length || !$sourceImage.length ) {
            finishHydration();
            return;
        }

        src = $sourceImage.attr('data-src');
        srcset = $sourceImage.attr('data-srcset');
        sizes = $sourceImage.attr('data-sizes');

        if ( !src ) {
            finishHydration();
            return;
        }

        preloader = new Image();

        preloader.decoding = 'async';
        preloader.fetchPriority = 'low';

        finishTimer = window.setTimeout(function() {
            finishHydration();
        }, 10000);

        preloader.onload = preloader.onerror = function() {
            $targets.each(function() {
                var $img = $(this);

                if ( $img.attr('data-src') ) {
                    $img.attr('src', $img.attr('data-src')).removeAttr('data-src');
                }

                if ( $img.attr('data-srcset') ) {
                    $img.attr('srcset', $img.attr('data-srcset')).removeAttr('data-srcset');
                }

                if ( $img.attr('data-sizes') ) {
                    $img.attr('sizes', $img.attr('data-sizes')).removeAttr('data-sizes');
                }

                if ( this.complete && this.naturalWidth > 0 ) {
                    $img.trigger('load');
                }
            });

            finishHydration();
        };

        if ( srcset ) {
            preloader.srcset = srcset;
        }

        if ( sizes ) {
            preloader.sizes = sizes;
        }

        preloader.src = src;
    }

    function blossomPinitRequestNextDeferredBannerImage() {
        var nextId;

        if ( deferredBannerIsLoading ) {
            return;
        }

        while ( deferredBannerImageQueue.length ) {
            nextId = deferredBannerImageQueue.shift();

            if ( nextId && $bannerSlider.find('img.banner-image[data-banner-image-id="' + nextId + '"][data-src]').length ) {
                deferredBannerIsLoading = true;

                blossomPinitHydrateBannerImageById(nextId, function() {
                    deferredBannerIsLoading = false;
                    blossomPinitRequestNextDeferredBannerImage();
                });

                return;
            }
        }
    }

    function blossomPinitKickoffDeferredBannerLoading() {
        deferredBannerImageQueue = blossomPinitBuildDeferredBannerQueue();
        blossomPinitRequestNextDeferredBannerImage();
    }

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
        blossomPinitKickoffDeferredBannerLoading();
    });

    $bannerSlider
    .owlCarousel({
        loop: true,
        autoplay: false,
        smartSpeed: sliderTransitionMs,
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
        var autoTimer = null;
        var isAutoMoving = false;

        var blossomPinitScheduleNextSlide = function() {
            window.clearTimeout(autoTimer);

            autoTimer = window.setTimeout(function(){
                isAutoMoving = true;
                $bannerSlider.trigger(sliderAutoDirection, [sliderTransitionMs]);
                isAutoMoving = false;
                blossomPinitScheduleNextSlide();
            }, sliderIntervalMs);
        };

        blossomPinitScheduleNextSlide();

        // Any pointer/touch interaction, drag end, or non-auto slide change restarts the countdown.
        $bannerSlider.on('mousedown touchstart click', blossomPinitScheduleNextSlide);
        $bannerSlider.on('dragged.owl.carousel', blossomPinitScheduleNextSlide);
        $bannerSlider.on('changed.owl.carousel', function(e) {
            if ( !isAutoMoving && e.property && e.property.name === 'position' ) {
                blossomPinitScheduleNextSlide();
            }
        });
    }

    $bannerSlider.find('img').on('load', function(){
        if ( $(this).attr('data-src') ) {
            return;
        }

        $(this).addClass('is-loaded');
        $(this).closest('.item').addClass('has-loaded-image');
    }).each(function(){
        if ( !$(this).attr('data-src') && this.complete && this.naturalWidth > 0 ) {
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
    var stickyEnterBuffer = 16;
    var stickyExitBuffer = 16;
    var stickyVisibilityDelta = 24;
    var stickyDirectionDeadZone = 2;
    var stickyTicking = false;
    var mobileHeaderIsSticky = false;
    var mobileHeaderIsVisible = false;
    var stickyVisibilityDirection = 0;
    var stickyVisibilityTravel = 0;
    var lastViewportWidth = window.innerWidth || document.documentElement.clientWidth;
    var resizeDebounceTimer = null;
    var resizeWidthThreshold = 2;

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

    function blossomPinitHandleLayoutResize(forceUpdate) {
        var currentViewportWidth = window.innerWidth || document.documentElement.clientWidth;
        var widthChanged = Math.abs(currentViewportWidth - lastViewportWidth) > resizeWidthThreshold;

        if ( !forceUpdate && !widthChanged ) {
            return;
        }

        lastViewportWidth = currentViewportWidth;
        blossomPinitSetBannerOffset();

        window.requestAnimationFrame(function() {
            $bannerSlider.trigger('refresh.owl.carousel');
        });

        blossomPinitMeasureMobileHeader();
        blossomPinitUpdateMobileHeader();
    }

    blossomPinitSetBannerOffset();

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
        mobileHeaderIsSticky = false;
        mobileHeaderIsVisible = false;
        stickyVisibilityDirection = 0;
        stickyVisibilityTravel = 0;
    }

    function blossomPinitMeasureMobileHeader() {
        if ( !$mobileHeader.length || !$mobileHeaderActions.length || !mobileBreakpoint.matches ) {
            blossomPinitResetMobileHeader();
            return;
        }

        var mobileSiteHeaderOffset = $mobileSiteHeader.length ? $mobileSiteHeader.offset() : null;
        var mobileSiteHeaderTop = mobileSiteHeaderOffset ? mobileSiteHeaderOffset.top : 0;
        var mobileSiteHeaderHeight = $mobileSiteHeader.length ? ($mobileSiteHeader.outerHeight(true) || 0) : 0;

        mobileHeaderActionsHeight = $mobileHeaderActions.outerHeight();
        if ( mobileSiteHeaderHeight > 0 ) {
            stickyThreshold = mobileSiteHeaderTop + mobileSiteHeaderHeight;
        } else {
            stickyThreshold = ($mobileHeaderActions.offset().top || 0) + mobileHeaderActionsHeight;
        }

        $mobileHeaderActions.css('top', blossomPinitGetAdminBarHeight() + 'px');
    }

    function blossomPinitUpdateMobileHeader() {
        stickyTicking = false;

        if ( !$mobileHeader.length || !$mobileHeaderActions.length || !mobileBreakpoint.matches ) {
            blossomPinitResetMobileHeader();
            return;
        }

        var currentScrollTop = $window.scrollTop();
        var scrollDelta = currentScrollTop - lastScrollTop;
        var stickyStartThreshold = Math.max(0, stickyThreshold + stickyEnterBuffer);
        var stickyStopThreshold = Math.max(0, stickyThreshold - stickyExitBuffer);

        // Add a small hysteresis window around the trigger point to prevent rapid toggling.
        if ( !mobileHeaderIsSticky && currentScrollTop >= stickyStartThreshold ) {
            mobileHeaderIsSticky = true;
            mobileHeaderIsVisible = false;
            stickyVisibilityDirection = 0;
            stickyVisibilityTravel = 0;
        } else if ( mobileHeaderIsSticky && currentScrollTop <= stickyStopThreshold ) {
            mobileHeaderIsSticky = false;
        }

        $mobileHeaderActions.css('top', blossomPinitGetAdminBarHeight() + 'px');

        if ( mobileHeaderIsSticky ) {
            $body.css('padding-top', mobileHeaderActionsHeight + 'px');
            $mobileHeaderActions.addClass('is-sticky');

            if ( Math.abs(scrollDelta) > stickyDirectionDeadZone ) {
                var currentDirection = scrollDelta > 0 ? 1 : -1;

                if ( currentDirection !== stickyVisibilityDirection ) {
                    stickyVisibilityDirection = currentDirection;
                    stickyVisibilityTravel = Math.abs(scrollDelta);
                } else {
                    stickyVisibilityTravel += Math.abs(scrollDelta);
                }

                if ( stickyVisibilityTravel >= stickyVisibilityDelta ) {
                    if ( stickyVisibilityDirection === -1 && !mobileHeaderIsVisible ) {
                        mobileHeaderIsVisible = true;
                        stickyVisibilityTravel = 0;
                    } else if ( stickyVisibilityDirection === 1 && mobileHeaderIsVisible ) {
                        mobileHeaderIsVisible = false;
                        stickyVisibilityTravel = 0;
                    }
                }
            }

            $mobileHeaderActions.toggleClass('is-visible', mobileHeaderIsVisible);
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
    $window.on('load', function() {
        blossomPinitHandleLayoutResize(true);
    });
    $window.on('resize', function() {
        window.clearTimeout(resizeDebounceTimer);
        resizeDebounceTimer = window.setTimeout(function() {
            blossomPinitHandleLayoutResize(false);
        }, 120);
    });
    $window.on('orientationchange', function() {
        window.setTimeout(function() {
            blossomPinitHandleLayoutResize(true);
        }, 120);
    });

});