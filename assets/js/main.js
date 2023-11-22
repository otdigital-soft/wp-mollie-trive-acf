/* eslint-disable no-undef */
/* eslint-disable func-names */
// eslint-disable-next-line func-names
(function($) {
  const helper = {
    // custom helper function for debounce - how to work see https://codepen.io/Hyubert/pen/abZmXjm
    /**
     * Debounce
     * need for once call function
     *
     * @param { function } - callback function
     * @param { number } - timeout time (ms)
     * @return { function }
     */
    debounce(func, timeout) {
      let timeoutID;
      // eslint-disable-next-line no-param-reassign
      timeout = timeout || 200;
      return function() {
        const scope = this;
        // eslint-disable-next-line prefer-rest-params
        const args = arguments;
        clearTimeout(timeoutID);
        timeoutID = setTimeout(function() {
          func.apply(scope, Array.prototype.slice.call(args));
        }, timeout);
      };
    },
    /**
     * Helper if element exist then call function
     */
    isElementExist(_el, _cb, _argCb) {
      const elem = document.querySelector(_el);
      if (document.body.contains(elem)) {
        try {
          if (arguments.length <= 2) {
            _cb();
          } else {
            _cb(..._argCb);
          }
        } catch (e) {
          // eslint-disable-next-line no-console
          console.log(e);
        }
      }
    },

    /**
     *  viewportCheckerAnimate function
     *
     * @param whatElement - element name
     * @param whatClassAdded - class name if element is in viewport
     * @param classAfterAnimate - class name after element animates
     */
    viewportCheckerAnimate(whatElement, whatClassAdded, classAfterAnimate) {
      jQuery(whatElement)
        .addClass('a-hidden')
        .viewportChecker({
          classToRemove: 'a-hidden',
          classToAdd: `animated ${whatClassAdded}`,
          offset: 10,
          callbackFunction(elem) {
            if (classAfterAnimate) {
              elem.on('animationend', () => {
                elem.addClass('animation-end');
              });
            }
          }
        });
    },
    // helpler windowResize
    windowResize(functName) {
      const self = this;
      $(window).on('resize orientationchange', self.debounce(functName, 200));
    },
    /**
     * Init slick slider only on mobile device
     *
     * @param {DOM} $slider
     * @param {array} option - slick slider option
     */
    mobileSlider($slider, option) {
      if (window.matchMedia('(max-width: 768px)').matches) {
        if (!$slider.hasClass('slick-initialized')) {
          $slider.slick(option);
        }
      } else if ($slider.hasClass('slick-initialized')) {
        $slider.slick('unslick');
      }
    },
    /**
     * Set cookie
     *
     * @param {string} name
     * @param {string} value
     * @param {int} days
     */
    setCookie(name, value, days) {
      var expires = '';
      if (days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = '; expires=' + date.toUTCString();
      }
      document.cookie = name + '=' + (value || '') + expires + '; path=/';
    },
    /**
     *Get Cookie
     *
     * @param {string} name
     * @return {string}
     */
    getCookie(name) {
      var nameEQ = name + '=';
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
      }
      return null;
    },
    /**
     * Erase Cookie,
     *
     * @param {string} name
     */
    eraseCookie(name) {
      document.cookie =
        name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }
  };

  const theme = {
    /**
     * Main init function
     */
    init() {
      this.plugins(); // Init all plugins
      this.initHeader(); // Init header function
      this.initBooking(); // Init Booking
      this.bindEvents(); // Bind all events
      this.initAnimations(); // Init all animations
    },

    /**
     * Init External Plugins
     */
    plugins() {
      // init JCF select
      jcf.setOptions('Select', {
        wrapNative: false,
        wrapNativeOnMobile: false,
        fakeDropInBody: false
      });
      jcf.replace('.form-select, .jcf-select');

      // Attach custom click event on cloned elements,
      // trigger click event on corresponding link
      // $(document).on('click', '.slick-cloned', function(e) {
      //   $(selector)
      //     .eq(($(this).attr('data-slick-index') || 0) % $(selector).length)
      //     .trigger('click.fb-start', { $trigger: $(this) });
      //   return false;
      // });
    },

    /**
     * init header function
     */
    initHeader() {
      // Hamburger menu
      $('.hamburger').on('click', function() {
        $('.header').toggleClass('is-opened');
        $('html').toggleClass('disable-scrolling');
      });

      let lastScrollTop = 0;
      $(window).on('scroll', function() {
        // // hide header on scroll down and show on scroll up
        // const st = $(this).scrollTop();
        // if (st > lastScrollTop && st > 100) {
        //   $('.header').addClass('header--hide');
        // } else {
        //   $('.header').removeClass('header--hide');
        // }
        // lastScrollTop = st;
        // add sticky class to header
        if ($(window).scrollTop() >= 20) {
          $('.header').addClass('header--sticky');
          $('.sticky-booking-btn').addClass('is-sticky');
        } else {
          $('.header').removeClass('header--sticky');
          $('.sticky-booking-btn').removeClass('is-sticky');
        }
        if (
          $(window).scrollTop() >=
          $('.footer').offset().top - $('.footer').outerHeight()
        ) {
          $('.sticky-booking-btn').addClass('is-hidden');
        } else {
          $('.sticky-booking-btn').removeClass('is-hidden');
        }
      });

      // toggle sub menu items
      $('.header-menu .menu-item-has-children > a').on('click', function() {
        const $parent = $(this).closest('.menu-item-has-children');
        $(this).toggleClass('is-opened');
        $('.sub-menu', $parent).slideToggle();
        return false;
      });

      // close header on click taste
      $('.header-nav a').on('click', function() {
        $('.header').removeClass('is-opened');
        $('html').removeClass('disable-scrolling');
      });
    },

    /**
     * init booking
     */
    initBooking() {
      // update booking link
      function updateBookingLink() {
        let href = $('.booking-popup').attr('data-default-url');
        let date = $('#booking-popup__calendar--range').val();

        if (date) {
          let dateArr = date.split(' to ');
          if (dateArr[0]) href += '&arrive=' + dateArr[0];
          if (dateArr[1]) href += '&depart=' + dateArr[1];
        }
        $('.booking-submit').attr('href', href);
      }

      // init date range picker
      $('#booking-popup__calendar--range')
        .dateRangePicker({
          inline: true,
          container: '#booking-popup__calendar--calendar',
          alwaysOpen: true,
          showShortcuts: false,
          showTopbar: false,
          selectForward: true,
          singleMonth: true,
          startDate: new Date()
        })
        .bind('datepicker-change', function(event, obj) {
          updateBookingLink();
        });

      // show booking widget
      $('.btn-booking-popup').on('click', function() {
        $('html, body').addClass('disable-scrolling');
        $('.booking-popup').addClass('is-opened');
        return false;
      });

      // close booking widget
      $('.booking-popup__close, #booking_cancel').on('click', function() {
        $('html, body').removeClass('disable-scrolling');
        $('.header').removeClass('header--booking');
        if ($(this).hasClass('header-cta--mobile')) {
          $(this).show();
        }
        $('.booking-popup').removeClass('is-opened');
      });
    },

    /**
     * Bind all events here
     *
     */
    bindEvents() {
      const self = this;
      /** * Run on Document Ready ** */
      $(document).on('ready', function() {
        self.smoothScrollLinks();
        helper.isElementExist('.page-navigation', theme.initPageNavigation);
        helper.isElementExist('.hp-rooms', theme.initHPRooms);
        helper.isElementExist('.hp-taste__media', theme.initHPTastes);
        helper.isElementExist('.hp-explore__images', theme.initExploreImages);
        helper.isElementExist('.rooms-block', theme.initRoomsSlider);
        helper.isElementExist('.gallery-grid', theme.initGalleryGrid);
        helper.isElementExist('.room-related', theme.initRoomRelated);

        // scroll to next section on click .btn-scroll-next
        $('.btn-scroll-next').on('click', function() {
          const $parent = $(this).closest('section');
          const offset = $parent.next().offset().top;
          $('html, body').animate(
            {
              scrollTop: offset
            },
            500
          );
        });
  
        // play learn video
        $('.learn-video__play').on('click', function() {
          $(this).toggleClass('is-playing');
          if ($(this).hasClass('is-playing')) {
            $('.learn-video__video video')
              .get(0)
              .play();
          } else {
            $('.learn-video__video video')
              .get(0)
              .pause();
          }
        });

        // link back to top
        $('.link-back').on('click', function() {
          if (document.referrer && document.referrer.indexOf('rooms') !== -1) {
            window.history.back();
            return false;
          }
        });
      });
      /** * Run on Window Load ** */
      $(window).on('scroll', function() {});
    },

    /**
     * init scroll revealing animations function
     */
    initAnimations() {
      helper.viewportCheckerAnimate('.a-up', 'fadeInUp', true);
      helper.viewportCheckerAnimate('.a-down', 'fadeInDown');
      helper.viewportCheckerAnimate('.a-left', 'fadeInLeft');
      helper.viewportCheckerAnimate('.a-right', 'fadeInRight');
      helper.viewportCheckerAnimate('.a-op', 'fade');
    },

    /**
     * Smooth Scroll link
     */
    smoothScrollLinks() {
      $('a[href^="#"').on('click touchstart', function() {
        const target = $(this).attr('href');
        if (target !== '#' && $(target).length > 0) {
          let offset = $(target).offset().top - $('header').outerHeight();
          if ($('.page-navigation').length) {
            offset -= $('.page-navigation').outerHeight();
          }
          $('html, body').animate(
            {
              scrollTop: offset
            },
            500
          );
        }
        return false;
      });
    },
    /**
     * init page navigation
     */
    initPageNavigation() {
      // active link on scroll when section is visible on viewport
      const sections = $('.page-navigation__link');
      const nav = $('.page-navigation');
      const nav_height = nav.outerHeight();
      $(window).on('scroll', function() {
        const cur_pos = $(this).scrollTop();
        let anchorOffset;
        sections.each(function() {
          if ($(this.hash).length === 0) return;
          // get viewport height
          if (window.matchMedia('(max-width: 768px)').matches) {
            anchorOffset = 0;
          } else {
            anchorOffset = $(window).height() / 2;
          }
          const top = $(this.hash).offset().top - nav_height - anchorOffset;
          const bottom = top + $(this.hash).outerHeight() - anchorOffset;
          if (cur_pos >= top && cur_pos <= bottom) {
            nav.find('.page-navigation__link').removeClass('is-active');
            nav
              .find('a[href="' + $(this).attr('href') + '"]')
              .addClass('is-active');

            // scroll left when link is active on mobile
            // if (window.matchMedia('(max-width: 768px)').matches) {
            //   const activeLink = $('.page-navigation__link.is-active');
            //   const offset = activeLink.offset().left;
            //   if ($('.pagination').offset().left <= offset) {
            //     $('.page-navigation').scrollLeft(offset);
            //   }
            // }
          }
        });
        if (
          $('body').hasClass('page-template-dinings') ||
          $('body').hasClass('page-template-gather') ||
          $('body').hasClass('page-template-events') ||
          $('body').hasClass('page-template-events-calendar')
        ) {
          if ($(window).scrollTop() >= $('.default-banner').outerHeight()) {
            $('.page-navigation').addClass('is-visible');
          } else {
            $('.page-navigation').removeClass('is-visible');
          }
        }
      });
    },
    /**
     * init homepage rooms slider
     */
    initHPRooms() {
      if ($('.hp-rooms__slide').length > 1) {
        $('.hp-rooms__carousel').slick({
          arrows: false,
          dots: false,
          fade: true,
          asNavFor: '.hp-rooms__caption'
        });
        $('.hp-rooms__caption').slick({
          arrows: false,
          dots: false,
          fade: true,
          asNavFor: '.hp-rooms__carousel'
        });
      }
      // update .hp-rooms__carousel slide index when clicking .hp-rooms__thumbnail
      $('.hp-rooms__thumbnail').hover(function() {
        const index = $(this).index();
        $('.hp-rooms__carousel').slick('slickGoTo', index);
      });
      $('.hp-rooms__thumbnail').on('click', function() {
        const index = $(this).index();
        $('.hp-rooms__carousel').slick('slickGoTo', index);
      });
    },
    /**
     * init homepage tastes slider
     */
    initHPTastes() {
      if ($('body').hasClass('page-template-rooms')) {
        if ($('.hp-taste__media img').length > 1) {
          $('.hp-taste__media').slick({
            arrows: false,
            dots: false,
            fade: true,
            autoplay: true
          });
        }
      } else {
        $('.hp-taste__media').each(function() {
          if ($('.hp-taste__slide', this).length > 1) {
            $(this).slick({
              arrows: false,
              dots: false,
              fade: true
            });
          }
        });
        // update .hp-taste__media slide index when clicking .hp-taste__thumbnail
        $('.hp-taste__link').on('mouseover', function() {
          const index = $(this).index();
          $('.hp-taste__media').slick('slickGoTo', index);
        });
        $('.hp-taste__link').on('touchstart', function() {
          const index = $(this).index();
          $('.hp-taste__link').removeClass('is-active');
          $(this).addClass('is-active');
          $('.hp-taste__media').slick('slickGoTo', index);
        });
      }
    },
    /**
     * init explore images
     */
    initExploreImages() {
      if ($('.hp-explore__image').length > 1) {
        $('.hp-explore__images').slick({
          arrows: false,
          dots: false,
          fade: true,
          asNavFor: '.hp-explore__caption'
        });
        $('.hp-explore__caption').slick({
          arrows: false,
          dots: false,
          fade: true,
          asNavFor: '.hp-explore__images'
        });
      }
      // update .hp-explore__images slide index when hover .hp-explore__link
      $('.hp-explore__link').on('mouseover', function() {
        const index = $(this).index();
        $('.hp-explore__images').slick('slickGoTo', index);
      });
      $('.hp-explore__link').on('touchstart', function() {
        const index = $(this).index();
        $('.hp-explore__link').removeClass('is-active');
        $(this).addClass('is-active');
        $('.hp-explore__images').slick('slickGoTo', index);
      });
    },
    /**
     * init rooms slider
     */
    initRoomsSlider() {
      $('.rooms-slider').each(function() {
        const $parent = $(this).closest('.rooms-block');
        if ($('.loop-room', this).length > 1) {
          // slick slider current index of total index
          $(this).on('init reInit afterChange', function(
            event,
            slick,
            currentSlide,
            nextSlide
          ) {
            let i = (currentSlide ? currentSlide : 0) + 1;
            const total = slick.slideCount;
            $('.slick-pagination', $parent).text(`${i} of ${total}`);
          });
          $(this).slick({
            arrows: true,
            dots: false,
            nextArrow: $('.btn-slick-next', $parent),
            prevArrow: $('.btn-slick-prev', $parent),
            draggable: false,
            autoplay: false
          });
          $('.slick-slide:not(.slick-cloned) .loop-room__carousel', this).each(
            function() {
              const id = $(this).attr('id');
              // Skip cloned elements
              $().fancybox({
                selector: `.slick-slide:not(.slick-cloned) #${id} .loop-room__slide:not(.slick-cloned)`,
                hash: false,
                backFocus: false,
                animationEffect: 'fade',
                buttons: ['close'],
                afterShow: function(instance, current) {
                  current.opts.$orig
                    .closest('.slick-initialized')
                    .slick('slickGoTo', parseInt(current.index), true);
                }
              });
            }
          );
        } else {
          $('.loop-room__carousel', this).each(function() {
            const id = $(this).attr('id');
            // Skip cloned elements
            $().fancybox({
              selector: `#${id} .loop-room__slide:not(.slick-cloned)`,
              hash: false,
              backFocus: false,
              animationEffect: 'fade',
              buttons: ['close'],
              afterShow: function(instance, current) {
                current.opts.$orig
                  .closest('.slick-initialized')
                  .slick('slickGoTo', parseInt(current.index), true);
              }
            });
          });
        }
        $('.loop-room__carousel', this).each(function() {
          $(this).on('init reInit afterChange', event => {
            event.stopPropagation();
          });
          $(this).slick({
            arrows: false,
            dots: false,
            // autoplay: true,
            autoplaySpeed: 5000,
            pauseOnHover: false
          });
        });
      });
      $('.rooms-grid').each(function() {
        $('.loop-room__carousel', this).each(function() {
          const id = $(this).attr('id');
          // Skip cloned elements
          $().fancybox({
            selector: `#${id} .loop-room__slide:not(.slick-cloned)`,
            hash: false,
            backFocus: false,
            animationEffect: 'fade',
            buttons: ['close'],
            afterShow: function(instance, current) {
              current.opts.$orig
                .closest('.slick-initialized')
                .slick('slickGoTo', parseInt(current.index), true);
            }
          });
          $(this).on('init reInit afterChange', event => {
            event.stopPropagation();
          });
          $(this).slick({
            arrows: false,
            dots: false,
            // autoplay: true,
            autoplaySpeed: 5000,
            pauseOnHover: false
          });
        });
      });
    },
    /**
     * init gallery grid
     */
    initGalleryGrid() {
      function ajaxGallery(pid) {
        const $parent = $('.gallery-grid');
        $.ajax({
          url: ajaxurl,
          type: 'POST',
          data: {
            action: 'loadAjaxGallery',
            pid
          },
          beforeSend: function() {
            $parent.html(
              '<div class="lds-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>'
            );
          },
          success: function(res) {
            let json = $.parseJSON(res);
            let strHTML = json.output;
            $parent.html(strHTML);
          },
          complete: function() {}
        });
      }
      // ajax call when click filter button on brand site
      $('.gallery-category').on('click', function() {
        const category = $(this).attr('data-target');
        if ($(this).hasClass('is-active')) return;
        $('.gallery-category.is-active').removeClass('is-active');
        $(this).addClass('is-active');
        ajaxGallery(category);
        return false;
      });
    },
    /**
     * init related rooms
     */
    initRoomRelated() {
      $('.loop-room__carousel').each(function() {
        const id = $(this).attr('id');
        // Skip cloned elements
        $().fancybox({
          selector: `#${id} .loop-room__slide:not(.slick-cloned)`,
          hash: false,
          backFocus: false,
          animationEffect: 'fade',
          buttons: ['close'],
          afterShow: function(instance, current) {
            current.opts.$orig
              .closest('.slick-initialized')
              .slick('slickGoTo', parseInt(current.index), true);
          }
        });
        $(this).on('init reInit afterChange', event => {
          event.stopPropagation();
        });
        $(this).slick({
          arrows: false,
          dots: false,
          // autoplay: true,
          autoplaySpeed: 5000,
          pauseOnHover: false
        });
      });
    }
  };

  // Initialize Theme
  theme.init();
  $('dd a[target="_self"]').attr('target', '_blank')
})(jQuery);
