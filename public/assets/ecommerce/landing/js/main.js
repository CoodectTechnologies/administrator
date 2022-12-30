/**
 * Coodect Core Javascript File
 */
'use strict';

/**
 * Coodect Object
 */
window.Coodect = {};

/**
 * Coodect Base
 */
(function ($) {

    Coodect.$window = $(window);
    Coodect.$body = $(document.body);
    Coodect.status = '';

    // Detect Browsers
    Coodect.isIE = navigator.userAgent.indexOf('Trident') >= 0;
    Coodect.isEdge = navigator.userAgent.indexOf('Edge') >= 0;
    Coodect.isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

    /**
     * Make a macro task
     *
     * @param {function} fn
     * @param {number} delay
     */
    Coodect.call = function (fn, delay) {
        setTimeout(fn, delay);
    }

    /**
     * Parse options string to object
     * @param {string} options
     * @return {object} options
     */
    Coodect.parseOptions = function (options) {
        return 'string' == typeof options ?
            JSON.parse(options.replace(/'/g, '"').replace(';', '')) :
            {};
    }

    //     /**
    //      * Parse html template with variables.
    //      * @param {string} template
    //      * @param {object} vars
    //      * @return {string} parsed template
    //      */
    //     Coodect.parseTemplate = function (template, vars) {
    //         return template.replace(/\{\{(\w+)\}\}/g, function () {
    //             return vars[arguments[1]];
    //         });
    //     }

    /**
     * Get dom element by id
     * @param {string} id
     * @return {HTMLElement} element
     */
    Coodect.byId = function (id) {
        return document.getElementById(id);
    }

    //     /**
    //      * Get dom elements by tagName
    //      * @param {string} tagName
    //      * @param {HTMLElement} element this can be omitted.
    //      * @return {HTMLCollection}
    //      */
    //     Coodect.byTag = function (tagName, element) {
    //         return element ?
    //             element.getElementsByTagName(tagName) :
    //             document.getElementsByTagName(tagName);
    //     }

    /**
     * Get dom elements by className
     * @param {string} className
     * @param {HTMLElement} element this can be omitted.
     * @return {HTMLCollection}
     */
    Coodect.byClass = function (className, element) {
        return element ?
            element.getElementsByClassName(className) :
            document.getElementsByClassName(className);
    }


    //     /**
    //      * Set cookie
    //      * @param {string} name Cookie name
    //      * @param {string} value Cookie value
    //      * @param {number} exdays Expire period
    //      */
    //     Coodect.setCookie = function (name, value, exdays) {
    //         var date = new Date();
    //         date.setTime(date.getTime() + (exdays * 24 * 60 * 60 * 1000));
    //         document.cookie = name + "=" + value + ";expires=" + date.toUTCString() + ";path=/";
    //     }

    //     /**
    //      * Get cookie
    //      * @param {string} name Cookie name
    //      * @return {string} Cookie value
    //      */
    //     Coodect.getCookie = function (name) {
    //         var n = name + "=";
    //         var ca = document.cookie.split(';');
    //         for (var i = 0; i < ca.length; ++i) {
    //             var c = ca[i];
    //             while (c.charAt(0) == ' ') {
    //                 c = c.substring(1);
    //             }
    //             if (c.indexOf(n) == 0) {
    //                 return c.substring(n.length, c.length);
    //             }
    //         }
    //         return "";
    //     }

    /**
     * Get jQuery object
     * @param {string|jQuery} selector
     * @return {jQuery|Object} jQuery Object or {each: $.noop}
     */
    Coodect.$ = function (selector) {
        if (selector instanceof jQuery) {
            return selector;
        }
        return $(selector);
    }

    /**
     * @function isInViewport
     * @param {HTMLElement} el
     * @param {number} dx
     * @param {number} dy
     */
    Coodect.isInViewport = function (el, dx, dy) {
        // var o = el.getBoundingClientRect(),
        //     x = o.left,
        //     y = o.top,
        //     ax = typeof dx == 'undefined' ? 0 : dx,
        //     ay = typeof dy == 'undefined' ? 0 : dy;

        // return y + ay >= 0 && y + o.height + ay <= window.innerHeight &&
        //     x + ax >= 0 && x + o.width + ax <= window.innerWidth;

        var a = window.pageXOffset,
            b = window.pageYOffset,
            o = el.getBoundingClientRect(),
            x = o.left + a,
            y = o.top + b,
            ax = typeof dx == 'undefined' ? 0 : dx,
            ay = typeof dy == 'undefined' ? 0 : dy;

        return y + o.height + ay >= b &&
            y <= b + window.innerHeight + ay &&
            x + o.width + ax >= a &&
            x <= a + window.innerWidth + ax;
    }


    /**
     * @function appear
     * @param {HTMLElement} el
     * @param {function} fn
     * @param {object} options
     */
    // Coodect.appear = (function () {
    //     var checks = [],
    //         timerId = false,
    //         one;

    //     var checkAll = function () {
    //         for (var i = checks.length; i--;) {
    //             one = checks[i];

    //             if (Coodect.isInViewport(one.el, one.options.accX, one.options.accY)) {
    //                 one.fn && one.fn.call(one.el, one.data);
    //                 checks.splice(i, 1);
    //             }
    //         }
    //     };

    //     window.addEventListener('scroll', checkAll, { passive: true });
    //     window.addEventListener('resize', checkAll, { passive: true });
    //     $(window).on('appear.check', checkAll);

    //     return function (el, fn, options) {
    //         var settings = {
    //             data: undefined,
    //             accX: 0,
    //             accY: 0
    //         };

    //         if (options) {
    //             options.data && (settings.data = options.data);
    //             options.accX && (settings.accX = options.accX);
    //             options.accY && (settings.accY = options.accY);
    //         }

    //         checks.push({ el: el, fn: fn, options: settings });
    //         if (!timerId) {
    //             timerId = Coodect.requestTimeout(checkAll, 100);
    //         }
    //     }
    // })();

    Coodect.appear = function (el, fn, intObsOptions) {
		var interSectionObserverOptions = {
			rootMargin: '0px 0px 200px 0px',
			threshold: 0,
			alwaysObserve: true
		};

		if (intObsOptions && Object.keys(intObsOptions).length) {
		 $.extend(intersectionObserverOptions, intObsOptions);
		}

		var observer = new IntersectionObserver(function (entries) {
			for (var i = 0; i < entries.length; i++) {
				var entry = entries[i];

				if (entry.intersectionRatio > 0) {
					if (typeof fn === 'string') {
						var func = Function('return ' + functionName)();
					} else {
						var callback = fn;

						callback.call(entry.target);
					}
				}
			}
		}, interSectionObserverOptions);

		observer.observe(el);

		return this;
	}

    // })(jQuery);
    // /**
    //  * Coodect Depeneded Plugins
    //  */

    // (function ($) {
    //     'use strict';


    /**
     * @function requestTimeout
     *
     * @param {function} fn
     * @param {number} delay
     */
    Coodect.requestTimeout = function (fn, delay) {
        var handler = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame;
        if (!handler) {
            return setTimeout(fn, delay);
        }

        var start, rt = new Object();

        function loop(timestamp) {
            if (!start) {
                start = timestamp;
            }
            var progress = timestamp - start;
            progress >= delay ? fn() : rt.val = handler(loop);
        };

        rt.val = handler(loop);
        return rt;
    }


    //     /**
    //      * @function requestInterval
    //      * @param {function} fn
    //      * @param {number} step
    //      * @param {number} timeOut
    //      */
    //     Coodect.requestInterval = function (fn, step, timeOut) {
    //         var handler = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame;
    //         if (!handler) {
    //             if (!timeOut)
    //                 return setTimeout(fn, timeOut);
    //             else
    //                 return setInterval(fn, step);
    //         }
    //         var start, last, rt = new Object();
    //         function loop(timestamp) {
    //             if (!start) {
    //                 start = last = timestamp;
    //             }
    //             var progress = timestamp - start;
    //             var delta = timestamp - last;
    //             if (!timeOut || progress < timeOut) {
    //                 if (delta > step) {
    //                     fn();
    //                     rt.val = handler(loop);
    //                     last = timestamp;
    //                 } else {
    //                     rt.val = handler(loop);
    //                 }
    //             } else {
    //                 fn();
    //             }
    //         };
    //         rt.val = handler(loop);
    //         return rt;
    //     }


    //     /**
    //      * @function deleteTimeout
    //      * @param {number} timerId
    //      */
    //     Coodect.deleteTimeout = function (timerId) {
    //         if (!timerId) {
    //             return;
    //         }
    //         var handler = window.cancelAnimationFrame || window.webkitCancelAnimationFrame || window.mozCancelAnimationFrame;
    //         if (!handler) {
    //             return clearTimeout(timerId);
    //         }
    //         if (timerId.val) {
    //             return handler(timerId.val);
    //         }
    //     }


    //     /**
    //      * @function setTab
    //      * Register event for tab click
    //      *
    //      * @param {string} selector
    //      */
    //     Coodect.setTab = function (selector) {

    //         Coodect.$body
    //             // tab nav link
    //             .on('click', '.tab .nav-link', function (e) {
    //                 var $this = $(this);
    //                 e.preventDefault();

    //                 if (!$this.hasClass("active")) {
    //                     var $panel = $($this.attr('href'));
    //                     $panel.parent().find('.active').removeClass('in active');
    //                     $panel.addClass('active in');

    //                     $this.parent().parent().find('.active').removeClass('active');
    //                     $this.addClass('active');
    //                 }
    //             })

    //             // link to tab
    //             .on('click', '.link-to-tab', function (e) {
    //                 var selector = $(e.currentTarget).attr('href'),
    //                     $tab = $(selector),
    //                     $nav = $tab.parent().siblings('.nav');
    //                 e.preventDefault();

    //                 $tab.siblings().removeClass('active in');
    //                 $tab.addClass('active in');
    //                 $nav.find('.nav-link').removeClass('active');
    //                 $nav.find('[href="' + selector + '"]').addClass('active');

    //                 $('html').animate({
    //                     scrollTop: $tab.offset().top - 150
    //                 });
    //             });
    //     }


    /**
     * @function initScrollTopButton
     */
    Coodect.initScrollTopButton = function () {
        // register scroll top button
        var domScrollTop = Coodect.byId('scroll-top');

        domScrollTop.addEventListener('click', function (e) {
            $('html, body').animate({ scrollTop: 0 }, 600);
            e.preventDefault();
        });

        var refreshScrollTop = function () {
            if (window.pageYOffset > 400) {
                domScrollTop.classList.add('show');
            } else {
                domScrollTop.classList.remove('show');
            }
        }

        Coodect.call(refreshScrollTop, 500);
        window.addEventListener('scroll', refreshScrollTop, { passive: true });
    }

    /**
     * Sticky Default Options
     */
    Coodect.stickyDefaultOptions = {
        minWidth: 992,
        maxWidth: 20000,
        top: false,
        hide: false
    }

    /**
     * @function setStickyContent
     * Set sticky content
     *
     * @param {string} selector
     */
    Coodect.setStickyContent = function (selector, settings) {
        var $stickyContents = Coodect.$(selector),
            options = $.extend({}, Coodect.stickyDefaultOptions, settings);

        if (0 == $stickyContents.length) return;

        var setTopOffset = function ($item) {
            var offset = 0,
                index = 0;
            $('.sticky-content.fixed.fix-top').each(function () {
                offset += $(this)[0].offsetHeight;
                index++;
            });
            $item.data('offset-top', offset);
            $item.data('z-index', options.max_index - index);
        }

        var setBottomOffset = function ($item) {
            var offset = 0,
                index = 0;
            $('.sticky-content.fixed.fix-bottom').each(function () {
                offset += $(this)[0].offsetHeight;
                index++;
            });
            $item.data('offset-bottom', offset);
            $item.data('z-index', options.max_index - index);
        }

        var wrapStickyContent = function ($item, height) {
            if (window.innerWidth >= options.minWidth && window.innerWidth <= options.maxWidth) {
                $item.wrap('<div class="sticky-content-wrapper" style="height:' + height + 'px;"></div>');
                $item.data('is-wrap', true);
            }
        }

        var initStickyContent = function () {
            $stickyContents.each(function (index) {
                var $item = $(this);
                if (!$item.data('is-wrap')) {
                    var height = $item.removeClass('fixed').outerHeight(true), top;
                    top = $item.offset().top + height;

                    // if sticky header has category dropdown, increase top
                    if ($item.hasClass('has-dropdown')) {
                        var $box = $item.find('.category-dropdown .dropdown-box');

                        if ($box.length) {
                            top += $box[0].offsetHeight;
                        }
                    }

                    $item.data('top', top);
                    wrapStickyContent($item, height);
                } else {
                    if (window.innerWidth < options.minWidth || window.innerWidth >= options.maxWidth) {
                        $item.unwrap('.sticky-content-wrapper');
                        $item.data('is-wrap', false);
                    }
                }
            });
        }

        var refreshStickyContent = function (e) {
            if (e && !e.isTrusted) return;
            $stickyContents.each(function (index) {
                var $item = $(this);

                if (window.pageYOffset > (false == options.top ? $item.data('top') : options.top) && window.innerWidth >= options.minWidth && window.innerWidth <= options.maxWidth) {
                    if ($item.hasClass('fix-top')) {
                        $item.data('offset-top') && setTopOffset($item);
                        $item.css('margin-top', $item.data('offset-top') + 'px');
                    } else if ($item.hasClass('fix-bottom')) {
                        $item.data('offset-bottom') && setBottomOffset($item);
                        $item.css('margin-bottom', $item.data('offset-bottom') + 'px');
                    }
                    $item.css('z-index', $item.data('z-index'));
                    $item.addClass('fixed');
                    options.hide && $item.parent('.sticky-content-wrapper').css('display', '');
                } else {
                    $item.removeClass('fixed');
                    $item.css('margin-top', '');
                    $item.css('margin-bottom', '');
                    options.hide && $item.parent('.sticky-content-wrapper').css('display', 'none');
                }
            });
        }

        Coodect.call(initStickyContent, 550);
        Coodect.call(refreshStickyContent, 660);

        Coodect.call(function () {
            window.addEventListener('scroll', refreshStickyContent, { passive: true });
            Coodect.$window.on('resize', initStickyContent);
            Coodect.$window.on('resize', refreshStickyContent);
        }, 700);
    }

    /**
     * @function parallax
     * Set parallax background
     *
     * @requires themePluginParallax
     * @param {string} selector
     */
    Coodect.parallax = function (selector, options) {
        if ($.fn.themePluginParallax) {
            Coodect.$(selector).each(function () {
                var $this = $(this);
                $this.themePluginParallax(
                    $.extend(true, Coodect.parseOptions($this.attr('data-parallax-options')), options)
                );
            });
        }
    }


    //     Coodect.isotopeOptions = {
    //         itemsSelector: '.grid-item',
    //         layoutMode: 'masonry',
    //         percentPosition: true,
    //         masonry: {
    //             columnWidth: '.grid-space'
    //         }
    //     }
    //     /**
    //      * @function isotopes
    //      *
    //      * @requires isotope,imagesLoaded
    //      * @param {string} selector,
    //      * @param {object} options
    //      */
    //     Coodect.isotopes = function (selector, options) {
    //         if (typeof imagesLoaded === 'function' && $.fn.isotope) {
    //             var self = this;

    //             Coodect.$(selector).each(function () {
    //                 var $this = $(this),
    //                     settings = $.extend(true, {},
    //                         self.isotopeOptions,
    //                         Coodect.parseOptions($this.attr('data-grid-options')),
    //                         options ? options : {}
    //                     );
    //                 Coodect.lazyLoad($this);

    //                 $this.imagesLoaded(function () {
    //                     settings.customInitHeight && $this.height($this.height());
    //                     settings.customDelay && Coodect.call(function () {
    //                         $this.isotope(settings);
    //                     }, parseInt(settings.customDelay));

    //                     $this.isotope(settings);
    //                 });
    //             });
    //         }
    //     }


    //     /**
    //      * @function initNavFilter
    //      *
    //      * @requires isotope
    //      * @param {string} selector
    //      */
    //     Coodect.initNavFilter = function (selector) {
    //         if ($.fn.isotope) {
    //             Coodect.$(selector).on('click', function (e) {
    //                 var $this = $(this),
    //                     filterValue = $this.attr('data-filter'),
    //                     filterTarget = $this.parent().parent().attr('data-target');

    //                 (filterTarget ? $(filterTarget) : $('.grid'))
    //                     .isotope({ filter: filterValue })
    //                     .isotope('on', 'arrangeComplete', function () {
    //                         Coodect.$window.trigger('appear.check');
    //                     });

    //                 $this.parent().siblings().children().removeClass('active');
    //                 $this.addClass('active');
    //                 e.preventDefault();
    //             })
    //         }
    //     }


    //     /**
    //      * @function ratingTooltip
    //      *
    //      * Find all .ratings-full from root, and initialized tooltip.
    //      * @param {HTMLElement} root
    //      */
    //     Coodect.ratingTooltip = function (root) {
    //         var els = Coodect.byClass('ratings-full', root ? root : document.body),
    //             len = els.length;
    //         var ratingHandler = function () {
    //             var res = this.firstElementChild.clientWidth / this.clientWidth * 5;
    //             this.lastElementChild.innerText = res ? res.toFixed(2) : res;
    //         }
    //         for (var i = 0; i < len; ++i) {
    //             els[i].addEventListener('mouseover', ratingHandler);
    //             els[i].addEventListener('touchstart', ratingHandler, { passive: true });
    //         }
    //     }


    //     /**
    //      * @function setProgressBar
    //      *
    //      * Find all .progress-bar and set its value
    //      * @param { String } selector
    //      */
    //     Coodect.setProgressBar = function (selector) {
    //         Coodect.$(selector).each(function () {
    //             var $this = $(this),
    //                 sales_count = $this.parent().find('mark')[0].innerHTML,
    //                 percent = '';
    //             if (-1 != sales_count.indexOf('%')) {
    //                 percent = sales_count;
    //             } else if (-1 != sales_count.indexOf('/')) {
    //                 percent = parseInt(sales_count.split('/')[0]) / parseInt(sales_count.split('/')[1]) * 100;
    //                 percent = percent.toFixed(2).toString() + '%';
    //             }

    //             $this.find('span').css('width', percent);
    //         });
    //     }


    //     /**
    //      * @Function alert
    //      * Register events for alert
    //      *
    //      * @param {string} selector
    //      */
    //     Coodect.alert = function (selector) {
    //         Coodect.$body.on('click', selector + ' .btn-close', function (e) {
    //             $(this).closest(selector).fadeOut(function () {
    //                 $(this).remove();
    //             });
    //         });
    //     }


    //     /**
    //      * @function accordion
    //      * Register events for accordion
    //      *
    //      * @param {String} selector
    //      */
    //     Coodect.accordion = function (selector) {
    //         Coodect.$body.on('click', selector, function (e) {
    //             var $this = $(this),
    //                 $body = $this.closest('.card').find($this.attr('href')),
    //                 $parent = $this.closest('.accordion');

    //             e.preventDefault();

    //             if (0 === $parent.find(".collapsing").length && 0 === $parent.find(".expanding").length) {
    //                 if ($body.hasClass('expanded')) {
    //                     if (!$parent.hasClass('radio-type'))
    //                         toggleSlide($body);
    //                 } else if ($body.hasClass('collapsed')) {
    //                     if ($parent.find('.expanded').length > 0) {
    //                         if (Coodect.isIE) {
    //                             toggleSlide($parent.find('.expanded'), function () {
    //                                 toggleSlide($body);
    //                             });

    //                         } else {
    //                             toggleSlide($parent.find('.expanded'));
    //                             toggleSlide($body);
    //                         }
    //                     } else {
    //                         toggleSlide($body);
    //                     }
    //                 }
    //             }
    //         });

    //         var toggleSlide = function ($wrap, cb) {
    //             var $header = $wrap.closest('.card').find(selector);
    //             if ($wrap.hasClass('expanded')) {
    //                 $header.removeClass('collapse').addClass('expand');
    //                 $wrap.addClass('collapsing').slideUp(300, function () {
    //                     $wrap.removeClass('expanded collapsing').addClass('collapsed');
    //                     cb && cb();
    //                 });
    //             } else if ($wrap.hasClass("collapsed")) {
    //                 $header.removeClass("expand").addClass("collapse");
    //                 $wrap.addClass("expanding").slideDown(300, function () {
    //                     $wrap.removeClass("collapsed expanding").addClass("expanded");
    //                     cb && cb();
    //                 });
    //             }
    //         };
    //     }


    Coodect.animationOptions = {
        name: 'fadeIn',
        duration: '.9s',
        delay: '.2s'
    }
    /**
     * @function appearAnimate
     *
     * @param {String} selector
     */
    Coodect.appearAnimate = function (selector) {
        Coodect.$(selector).each(function () {
            var el = this;

            Coodect.appear(el, function () {
                if (el.classList.contains('appear-animate')) {
                    var settings = $.extend({}, Coodect.animationOptions, Coodect.parseOptions(el.getAttribute('data-animation-options')));

                    setTimeout(function () {
                        el.style['animation-duration'] = settings.duration;
                        el.classList.add(settings.name);
                        el.classList.add('appear-animation-visible');

                        setTimeout(function () {
                            typeof $(el).data('appear-callback') == 'function' &&
                                $(el).data('appear-callback').call(el);
                        }, settings.duration ? Number(settings.duration.slice(0, -1)) * 1000 : 0);
                    }, settings.delay ? Number(settings.delay.slice(0, -1)) * 1000 : 0);
                }
            });
        });
    }


    //     /**
    //      * @function countDown
    //      *
    //      * @param {String} selector
    //      */
    //     Coodect.countDown = function (selector) {
    //         if ($.fn.countdown) {
    //             Coodect.$(selector).each(function () {
    //                 var $this = $(this),
    //                     untilDate = $this.data('until'),
    //                     compact = $this.data('compact'),
    //                     dateFormat = (!$this.data('format')) ? 'DHMS' : $this.data('format'),
    //                     newLabels = (!$this.data('labels-short')) ?
    //                         ['Years', 'Months', 'Weeks', 'Days', 'Hours', 'Minutes', 'Seconds'] :
    //                         ['Years', 'Months', 'Weeks', 'Days', 'Hours', 'Mins', 'Secs'],
    //                     newLabels1 = (!$this.data('labels-short')) ?
    //                         ['Year', 'Month', 'Week', 'Day', 'Hour', 'Minute', 'Second'] :
    //                         ['Year', 'Month', 'Week', 'Day', 'Hour', 'Min', 'Sec'];

    //                 var newDate;

    //                 // Split and created again for ie and edge
    //                 if (!$this.data('relative')) {
    //                     var untilDateArr = untilDate.split(", "), // data-until 2019, 10, 8 - yy,mm,dd
    //                         newDate = new Date(untilDateArr[0], untilDateArr[1] - 1, untilDateArr[2]);
    //                 } else {
    //                     newDate = untilDate;
    //                 }

    //                 $this.countdown({
    //                     until: newDate,
    //                     format: dateFormat,
    //                     padZeroes: true,
    //                     compact: compact,
    //                     compactLabels: [' y', ' m', ' w', ' days, '],
    //                     timeSeparator: ' : ',
    //                     labels: newLabels,
    //                     labels1: newLabels1
    //                 });
    //             });
    //         }
    //     }

    //     /**
    //      * @function priceSlider
    //      * Create Price Slider
    //      *
    //      * @requires noUiSlider
    //      * @param {string} selector
    //      * @param {object} option
    //      */
    //     Coodect.priceSlider = function (selector, option) {
    //         if (typeof noUiSlider === 'object') {
    //             Coodect.$(selector).each(function () {
    //                 var self = this;

    //                 noUiSlider.create(self, $.extend(true, {
    //                     start: [0, 400],
    //                     connect: true,
    //                     step: 1,
    //                     range: {
    //                         min: 0,
    //                         max: 635
    //                     }
    //                 }, option));

    //                 // Update Price Value
    //                 self.noUiSlider.on('update', function (values, handle) {
    //                     var values = values.map(function (value) {
    //                         return '$' + parseInt(value);
    //                     });

    //                     $(self).parent().find('.filter-price-range').text(values.join(' - '));
    //                 });
    //             });
    //         }
    //     }


    //     /**
    //      * Coodect Stickysidebar Options
    //      */
    //     Coodect.stickySidebarOptions = {
    //         autoInit: true,
    //         minWidth: 991,
    //         containerSelector: '.sticky-sidebar-wrapper',
    //         autoFit: true,
    //         activeClass: 'sticky-sidebar-fixed',
    //         top: 93,
    //         bottom: 0
    //     };

    //     /**
    //      * @function stickySidebar
    //      *
    //      * @requires themeSticky
    //      * @param {string} selector
    //      */
    //     Coodect.stickySidebar = function (selector) {
    //         if ($.fn.themeSticky) {
    //             Coodect.$(selector).each(function () {
    //                 var $this = $(this);
    //                 $this.themeSticky($.extend(Coodect.stickySidebarOptions, Coodect.parseOptions($this.attr('data-sticky-options'))));
    //                 $this.trigger('recalc.pin');
    //             });

    //             setTimeout(function () {
    //                 $(window).trigger('appear.check');
    //             });
    //         }
    //     }

    //     /**
    //      * Coodect Image Zoom Options
    //      */
    //     Coodect.zoomImageOptions = {
    //         responsive: true,
    //         zoomWindowFadeIn: 750,
    //         zoomWindowFadeOut: 500,
    //         borderSize: 0,
    //         zoomType: 'inner',
    //         cursor: 'crosshair'
    //     };
    //     Coodect.zoomImageObjects = [];

    //     /**
    //      * @function zoomImageOptions
    //      *
    //      * @requires elevateZoom
    //      * @param {jQuery} $el
    //      */
    //     Coodect.zoomImage = function ($el) {
    //         if ($.fn.elevateZoom && $el) {
    //             (('string' === typeof $el) ? $($el) : $el)
    //                 .find('img').each(function () {
    //                     var $this = $(this);
    //                     Coodect.zoomImageOptions.zoomContainer = $this.parent();
    //                     $this.elevateZoom(Coodect.zoomImageOptions);
    //                     Coodect.zoomImageObjects.push($this);
    //                 });
    //         }
    //     }

    //     /**
    //      * @function zoomImageOnResize
    //      */
    //     Coodect.zoomImageOnResize = function () {
    //         Coodect.zoomImageObjects.forEach(function ($img) {
    //             $img.each(function () {
    //                 var elevateZoom = $(this).data('elevateZoom');
    //                 elevateZoom && elevateZoom.refresh();
    //             })
    //         });
    //     }

    //     /**
    //      * @function playVideo
    //      *
    //      * play videos
    //      * @param {string} selector
    //      */
    //     Coodect.playVideo = function (selector) {
    //         $(selector + ' .btn-play-video').on('click', function (e) {
    //             var $video = $(this).closest(selector);
    //             if ($video.hasClass('playing')) {
    //                 $video.removeClass('playing')
    //                     .addClass('paused')
    //                     .find('video')[0].pause();
    //             } else {
    //                 $video.removeClass('paused')
    //                     .addClass('playing')
    //                     .find('video')[0].play();
    //             }
    //             e.preventDefault();
    //         });
    //         $(selector + ' video').on('ended', function () {
    //             $(this).closest('.banner-video').removeClass('playing');
    //         });
    //     }


    /**
     * @function lazyLoad
     *
     * lazyload element
     * @param {string} selector
     * @param {boolean} force
     */
    Coodect.lazyLoad = function (selector, force) {
        function load() {
            this.setAttribute('src', this.getAttribute('data-src'));
            this.addEventListener('load', function () {
                this.style['padding-top'] = '';
                this.classList.remove('lazy-img');
            });
        }

        // Lazyload Images
        Coodect.$(selector).find('.lazy-img').each(function () {
            if ('undefined' != typeof force && force) {
                load.call(this);
            } else {
                Coodect.appear(this, load);
            }
        });
    }


    //     /**
    //      * @function initPopup
    //      */
    //     Coodect.initPopup = function (options, preset) {
    //         if (Coodect.$body.hasClass('home') && Coodect.getCookie('hideNewsletterPopup') !== 'true') {
    //             setTimeout(function () {
    //                 Coodect.popup({
    //                     items: {
    //                         src: 'assets/ajax/newsletter.html'
    //                     },
    //                     type: 'ajax',
    //                     tLoading: '',
    //                     mainClass: 'mfp-newsletter mfp-fadein-popup',
    //                     callbacks: {
    //                         beforeClose: function () {
    //                             // if "do not show" is checked
    //                             $('#hide-newsletter-popup')[0].checked && Coodect.setCookie('hideNewsletterPopup', true, 7);
    //                         }
    //                     },
    //                 });
    //             }, 7500);
    //         }
    //     }

    //     /**
    //      * @function initNotificationAlert
    //      */
    //     Coodect.initNotificationAlert = function () {
    //         if (Coodect.$body.hasClass('has-notification')) {
    //             setTimeout(function () {
    //                 Coodect.$body.addClass('show-notification');
    //             }, 5000);
    //         }
    //     }

    /**
     * @function countTo
     *
     * @requires jQuery.countTo
     * @param {String} selector
     */
    Coodect.countTo = function (selector) {
        if ($.fn.countTo) {
            Coodect.$(selector).each(function () {
                Coodect.appear(this, function () {
                    var $this = $(this);
                    setTimeout(function () {
                        $this.countTo({
                            onComplete: function () {
                                $this.addClass('complete');
                            }
                        })
                    }, 300);
                })
            });
        }
    }
    // })(jQuery);

    // (function ($) {
    /**
     * Coodect Menu Plugins
     */

    // Private members
    var showMobileMenu = function () {
        Coodect.$body.addClass('mmenu-active');;
    };
    var hideMobileMenu = function () {
        Coodect.$body.removeClass('mmenu-active');
    };

    /**
     * Init Menu
     */
    var Menu = {
        init: function () {
            // this.initMenu();
            // this.initCategoryMenu();
            this.initMobileMenu();
            // this.initFilterMenu();
            // this.initCollapsibleWidget();
        },
        // initMenu: function () {
        //     // setup menu
        //     $('.menu li').each(function () {
        //         if (this.lastElementChild && (
        //             this.lastElementChild.tagName === 'UL' ||
        //             this.lastElementChild.classList.contains('megamenu')) &&
        //             !$(this).parent().hasClass('megamenu')
        //         ) {
        //             this.classList.add('has-submenu');
        //             !this.lastElementChild.classList.contains('megamenu') && this.lastElementChild.classList.add('submenu');
        //         }
        //     });

        //     // calc megamenu position
        //     Coodect.$window.on('resize', function () {
        //         $('.main-nav megamenu').each(function () {
        //             var $this = $(this),
        //                 left = $this.offset().left,
        //                 outerWidth = $this.outerWidth(),
        //                 offset = (left + outerWidth) - (window.innerWidth - 20);
        //             if (offset > 0 && left > 20) {
        //                 $this.css('margin-left', -offset);
        //             }
        //         });
        //     });
        // },
        // initCategoryMenu: function () {
        //     // category dropdown menu
        //     var $menu = $('.category-dropdown');
        //     if ($menu.length) {
        //         var $box = $menu.find('.dropdown-box');

        //         if ($box.length) {
        //             var top = $('.main').offset().top + $box[0].offsetHeight;

        //             if (window.pageYOffset <= top || window.innerWidth < 992) {
        //                 $menu.removeClass('show');
        //             }

        //             window.addEventListener('scroll', function () {
        //                 if (window.pageYOffset <= top && window.innerWidth >= 992) {
        //                     $menu.removeClass('show');
        //                 }
        //             }, { passive: true });

        //             $('.category-toggle').on("click", function (e) {
        //                 e.preventDefault();
        //             });

        //             $menu.on("mouseover", function (e) {
        //                 if ($menu.hasClass('menu-fixed') && window.pageYOffset > top && window.innerWidth >= 992) {
        //                     $menu.addClass('show');
        //                 } else if (!$menu.hasClass('menu-fixed') && window.innerWidth >= 992) {
        //                     $menu.addClass('show');
        //                 }
        //             })

        //             $menu.on("mouseleave", function (e) {
        //                 if ($menu.hasClass('menu-fixed') && window.pageYOffset > top && window.innerWidth >= 992) {
        //                     $menu.removeClass('show');
        //                 } else if (!$menu.hasClass('menu-fixed') && window.innerWidth >= 992) {
        //                     $menu.removeClass('show');
        //                 }
        //             })
        //         }
        //         if ($menu.hasClass('with-sidebar')) {
        //             var sidebar = Coodect.byClass('sidebar');
        //             if (sidebar.length) {
        //                 $menu.find('.dropdown-box').css('width', sidebar[0].offsetWidth - 20);

        //                 // set category menu's width same as sidebar.
        //                 Coodect.$window.on('resize', function () {
        //                     $menu.find('.dropdown-box').css('width', (sidebar[0].offsetWidth - 20));
        //                 });
        //             }
        //         }
        //     }
        // },
        initMobileMenu: function () {
            $('.mobile-menu li, .toggle-menu li').each(function () {
                if (this.lastElementChild && (
                    this.lastElementChild.tagName === 'UL' ||
                    this.lastElementChild.classList.contains('megamenu'))
                ) {
                    var span = document.createElement('span');
                    span.className = "toggle-btn";
                    this.firstElementChild.appendChild(span);
                    // this.firstElementChild.insertAdjacentHTML('beforeend', '<span class="toggle-btn"></span>' );
                }
            });
            $('.mobile-menu-toggle').on('click', showMobileMenu);
            $('.mobile-menu-overlay').on('click', hideMobileMenu);
            $('.mobile-menu-close').on('click', hideMobileMenu);
            Coodect.$window.on('resize', hideMobileMenu);
        },
        // initFilterMenu: function () {
        //     $('.search-ul li').each(function () {
        //         if (this.lastElementChild && this.lastElementChild.tagName === 'UL') {
        //             var i = document.createElement('i');
        //             i.className = "la la-angle-down";
        //             this.classList.add('with-ul');
        //             this.firstElementChild.appendChild(i);
        //         }
        //     });
        //     $('.with-ul > a i, .toggle-btn').on('click', function (e) {
        //         $(this).parent().next().slideToggle(300).parent().toggleClass("show");
        //         e.preventDefault();
        //     });
        // },
        // initCollapsibleWidget: function () {
        //     // Add toggle span
        //     $('.widget-collapsible .widget-title').each(function () {
        //         var span = document.createElement('span');
        //         span.className = 'toggle-btn';
        //         this.appendChild(span);
        //     });

        //     // Slide Toggle
        //     $('.widget-collapsible .widget-title').on('click', function (e) {
        //         var $this = $(this),
        //             $body = $this.siblings('.widget-body');

        //         $this.hasClass('collapsed') || $body.css('display', 'block');

        //         $body.stop().slideToggle(300);
        //         $this.toggleClass('collapsed');

        //         // if collapsible widget exists in sticky sidebar
        //         setTimeout(function () {
        //             $('.sticky-sidebar').trigger('recalc.pin');
        //         }, 300);
        //     });
        // }
    }

    Coodect.menu = Menu;
    // })(jQuery);
    /**
     * Coodect Dependent Plugin - Slider
     *
     * @requires OwlCarousel
     * @instance multiple
     */

    function Slider($el, options) {
        return this.init($el, options);
    }

    (function ($) {

        // Private Properties
        var onInitialize = function (e) {
            var i, j, breaks = ['', '-xs', '-sm', '-md', '-lg', '-xl'];
            this.classList.remove('row');
            for (i = 0; i < 6; ++i) {
                for (j = 1; j <= 12; ++j) {
                    this.classList.remove('cols' + breaks[i] + '-' + j);
                }
            }
            this.classList.remove('gutter-no');
            this.classList.remove('gutter-sm');
            this.classList.remove('gutter-lg');
            if (this.classList.contains("animation-slider")) {
                var els = this.children,
                    len = els.length;
                for (var i = 0; i < len; ++i) {
                    els[i].setAttribute('data-index', i + 1);
                }
            }
        }
        var onInitialized = function (e) {
            var els = this.firstElementChild.firstElementChild.children,
                i,
                len = els.length;
            for (i = 0; i < len; ++i) {
                if (!els[i].classList.contains('active')) {
                    var animates = Coodect.byClass('appear-animate', els[i]),
                        j;
                    for (j = animates.length - 1; j >= 0; --j) {
                        animates[j].classList.remove('appear-animate');
                    }
                }
            }
        }
        var onSliderInitialized = function (e) {
            var self = this,
                $el = $(e.currentTarget);


            // carousel content animation
            $el.find('.owl-item.active .slide-animate').each(function () {
                var $animation_item = $(this),
                    settings = $.extend(true, {},
                        Coodect.animationOptions,
                        Coodect.parseOptions($animation_item.data('animation-options'))
                    ),
                    duration = settings.duration,
                    delay = settings.delay,
                    aniName = settings.name;

                setTimeout(function () {
                    $animation_item.css('animation-duration', duration);
                    $animation_item.css('animation-delay', delay);
                    $animation_item.addClass(aniName);

                    if ($animation_item.hasClass('maskLeft')) {
                        $animation_item.css('width', 'fit-content');
                        var width = $animation_item.width();
                        $animation_item.css('width', 0).css(
                            'transition',
                            'width ' + (duration ? duration : '0.75s') + ' linear ' + (delay ? delay : '0s'));
                        $animation_item.css('width', width);
                    }
                    duration = duration ? duration : '0.75s';
                    var temp = Coodect.requestTimeout(function () {
                        $animation_item.addClass('show-content');
                    }, (delay ? Number((delay).slice(0, -1)) * 1000 + 200 : 200));

                    self.timers.push(temp);
                }, 300);
            });
        }
        var onSliderResized = function (e) {
            $(e.currentTarget).find('.owl-item.active .slide-animate').each(function () {
                var $animation_item = $(this);
                $animation_item.addClass('show-content');
                $animation_item.attr('style', '');
            });
        }
        var onSliderTranslate = function (e) {
            var self = this,
                $el = $(e.currentTarget);
            self.translateFlag = 1;
            self.prev = self.next;
            $el.find('.owl-item .slide-animate').each(function () {
                var $animation_item = $(this),
                    settings = $.extend(true, {}, Coodect.animationOptions, Coodect.parseOptions($animation_item.data('animation-options')));
                $animation_item.removeClass(settings.name);
            });
        }
        var onSliderTranslated = function (e) {
            var self = this,
                $el = $(e.currentTarget);
            if (1 == self.translateFlag) {
                self.next = $el.find('.owl-item').eq(e.item.index).children().attr('data-index');
                $el.find('.show-content').removeClass('show-content');
                if (self.prev != self.next) {
                    $el.find('.show-content').removeClass('show-content');
                    /* clear all animations that are running. */
                    if ($el.hasClass("animation-slider")) {
                        for (var i = 0; i < self.timers.length; i++) {
                            Coodect.deleteTimeout(self.timers[i]);
                        }
                        self.timers = [];
                    }
                    $el.find('.owl-item.active .slide-animate').each(function () {
                        var $animation_item = $(this),
                            settings = $.extend(true, {}, Coodect.animationOptions, Coodect.parseOptions($animation_item.data('animation-options'))),
                            duration = settings.duration,
                            delay = settings.delay,
                            aniName = settings.name;

                        $animation_item.css('animation-duration', duration);
                        $animation_item.css('animation-delay', delay);
                        $animation_item.addClass(aniName);

                        if ($animation_item.hasClass('maskLeft')) {
                            $animation_item.css('width', 'fit-content');
                            var width = $animation_item.width();
                            $animation_item.css('width', 0).css(
                                'transition',
                                'width ' + (duration ? duration : '0.75s') + ' linear ' + (delay ? delay : '0s'));
                            $animation_item.css('width', width);
                        }
                        //$this.addClass('show-content');
                        duration = duration ? duration : '0.75s';
                        var temp = Coodect.requestTimeout(function () {
                            $animation_item.addClass('show-content');
                            self.timers.splice(self.timers.indexOf(temp), 1)
                        }, (delay ? Number((delay).slice(0, -1)) * 1000 + Number((duration).slice(0, -1)) * 500 : Number((duration).slice(0, -1)) * 500));
                        self.timers.push(temp);
                    });
                } else {
                    $el.find('.owl-item').eq(e.item.index).find('.slide-animate').addClass('show-content');
                }
                self.translateFlag = 0;
            }
            $(window).trigger('appear.check');
        }

        // Public Properties
        Slider.defaults = {
            responsiveClass: true,
            navText: ['<i class="icon-angle-left">', '<i class="icon-angle-right">'],
            checkVisible: false,
            items: 1,
            smartSpeed: navigator.userAgent.indexOf("Edge") > -1 ? 200 : 700,
            autoplaySpeed: navigator.userAgent.indexOf("Edge") > -1 ? 200 : 1000,
            autoplayTimeout: 10000
        }

        // Slider.zoomImage = function () {
        //     Coodect.zoomImage(this.$element);
        // }

        // Slider.zoomImageRefresh = function () {
        //     this.$element.find('img').each(function () {
        //         var $this = $(this);

        //         if ($.fn.elevateZoom) {
        //             var elevateZoom = $this.data('elevateZoom');
        //             if (typeof elevateZoom !== 'undefined') {
        //                 elevateZoom.refresh();
        //             } else {
        //                 Coodect.zoomImageOptions.zoomContainer = $this.parent();
        //                 $this.elevateZoom(Coodect.zoomImageOptions);
        //             }
        //         }
        //     });
        // }

        Slider.presets = {
            'intro-slider': {
                animateIn: 'fadeIn',
                animateOut: 'fadeOut'
            },
            'product-single-carousel': {
                dots: false,
                nav: true,
                onInitialize: Slider.zoomImage,
                onRefreshed: Slider.zoomImageRefresh
            }
        }

        Slider.addPreset = function (className, options) {
            this.presets[className] = options;
            return this;
        }

        Slider.prototype.init = function ($el, options) {
            this.timers = [];
            this.translateFlag = 0;
            this.prev = 1;
            this.next = 1;

            var self = this,
                classes = $el.attr('class').split(' '),
                settings = $.extend(true, {}, Slider.defaults);

            // extend preset options
            classes.forEach(function (className) {
                var preset = Slider.presets[className];
                preset && $.extend(true, settings, preset);
            });

            // extend user options
            $.extend(true, settings, Coodect.parseOptions($el.attr('data-owl-options')), options);

            onSliderInitialized = onSliderInitialized.bind(this);
            onSliderTranslate = onSliderTranslate.bind(this);
            onSliderTranslated = onSliderTranslated.bind(this);

            // init
            $el.on('initialize.owl.carousel', onInitialize)
                .on('initialized.owl.carousel', onInitialized)
                .on('translated.owl.carousel', onSliderTranslated);

            // if animation slider
            $el.hasClass('animation-slider') &&
                $el.on('initialized.owl.carousel', onSliderInitialized)
                    .on('resized.owl.carousel', onSliderResized)
                    .on('translate.owl.carousel', onSliderTranslate)
                    .on('translated.owl.carousel', onSliderTranslated);

            $el.owlCarousel(settings);

            // if slider has custom dots container
            if (settings.dotsContainer) {
                var $dots = $(settings.dotsContainer);
                $dots.find('a').on('click', function (e) {
                    e.preventDefault();

                    var $this = $(this);

                    if (!$this.hasClass('active')) {
                        var index = $this.index(),
                            $carousel = $dots.parent().find('.owl-carousel');

                        $carousel.trigger('to.owl.carousel', [index]);
                        $this.addClass('active').siblings().removeClass('active');
                    }
                })
            }
        }

        Coodect.slider = function (selector, options) {
            Coodect.$(selector).each(function () {
                var $this = $(this);

                Coodect.call(function () {
                    new Slider($this, options);
                });
            });
        }
    })(jQuery);
    // /**
    //  * Coodect Plugin - Sidebar
    //  *
    //  * @instance multiple
    //  *
    //  * sidebar active class will be added to body tag: "sidebar class" + "-active"
    //  */

    // function Sidebar(name) {
    //     return this.init(name);
    // }

    // (function ($) {
    //     'use strict';

    //     var onResizeNavigationStyle = function () {
    //         if (window.innerWidth < 992) {
    //             this.$sidebar.find('.sidebar-content').removeAttr('style');
    //             this.$sidebar.find('.sidebar-content').attr('style', '');
    //             this.$sidebar.find('.toolbox').children(':not(:first-child)').removeAttr('style');
    //         }
    //     }

    //     Sidebar.prototype.init = function (name) {
    //         var self = this;

    //         self.name = name;
    //         self.$sidebar = $('.' + name);
    //         self.isNavigation = false;

    //         // If sidebar exists
    //         if (self.$sidebar.length) {

    //             // check if navigation style
    //             self.isNavigation = self.$sidebar.hasClass('sidebar-fixed') && self.$sidebar.parent().hasClass('toolbox-wrap');

    //             if (self.isNavigation) {
    //                 onResizeNavigationStyle = onResizeNavigationStyle.bind(this);
    //                 Coodect.$window.on('resize', onResizeNavigationStyle);
    //             }

    //             Coodect.$window.on('resize', function () {
    //                 Coodect.$body.removeClass(name + '-active');
    //             });

    //             // Register toggle event
    //             self.$sidebar.find('.sidebar-toggle, .sidebar-toggle-btn')
    //                 .add(name === 'sidebar' ? '.left-sidebar-toggle' : '.' + name + '-toggle')
    //                 .on('click', function (e) {
    //                     self.toggle();
    //                     $(this).blur();
    //                     e.preventDefault();
    //                 });

    //             // Register close event
    //             self.$sidebar.find('.sidebar-overlay, .sidebar-close')
    //                 .on('click', function (e) {
    //                     Coodect.$body.removeClass(name + '-active');
    //                     e.preventDefault();
    //                 });
    //         }
    //         return false;
    //     }

    //     Sidebar.prototype.toggle = function () {
    //         var self = this;

    //         // if fixed sidebar
    //         if (window.innerWidth >= 992 && self.$sidebar.hasClass('sidebar-fixed')) {

    //             // is closed ?
    //             var isClosed = self.$sidebar.hasClass('closed');

    //             // if navigation style's sidebar
    //             if (self.isNavigation) {

    //                 isClosed || self.$sidebar.find('.filter-clean').hide();

    //                 self.$sidebar.siblings('.toolbox').children(':not(:first-child)').fadeToggle('fast');

    //                 self.$sidebar
    //                     .find('.sidebar-content')
    //                     .stop()
    //                     .animate(
    //                         {
    //                             'height': 'toggle',
    //                             'margin-bottom': isClosed ? 'toggle' : -6
    //                         }, function () {
    //                             $(this).css('margin-bottom', '');
    //                             isClosed && self.$sidebar.find('.filter-clean').fadeIn('fast');
    //                         }
    //                     );
    //             }

    //             // If shop sidebar
    //             if (self.$sidebar.hasClass('shop-sidebar')) {

    //                 // change column
    //                 var $wrapper = $('.main-content .product-wrapper');
    //                 if ($wrapper.length) {
    //                     if ($wrapper.hasClass('product-lists')) {

    //                         // if list type, toggle 2 cols or 1 col
    //                         $wrapper.toggleClass('row cols-xl-2', !isClosed);
    //                     } else {

    //                     }
    //                 }
    //             }
    //         } else {
    //             self.$sidebar.find('.sidebar-overlay .sidebar-close').css('margin-left', - (window.innerWidth - document.body.clientWidth));

    //             // activate sidebar
    //             Coodect.$body
    //                 .toggleClass(self.name + '-active')
    //                 .removeClass('closed');
    //         }

    //         setTimeout(function () {
    //             $(window).trigger('appear.check');
    //         }, 400);
    //     }

    //     Coodect.sidebar = function (name) {
    //         return new Sidebar().init(name);
    //     }
    // })(jQuery);
    // /**
    //  * Coodect Dependent Plugin - Shop
    //  *
    //  * @requires
    //  */

    // (function ($) {

    //     var initSelectMenu = function () {

    //         var selector = '.select-menu';

    //         // show or hide select menu
    //         Coodect.$body.on('mousedown', '.select-menu', function (e) {
    //             var $selectMenu = $(e.currentTarget),
    //                 $target = $(e.target),
    //                 isOpened = $selectMenu.hasClass('opened');

    //             // close all select menu
    //             $('.select-menu').removeClass('opened');

    //             if ($selectMenu.is($target.parent())) { // if select menu toggle is clicked
    //                 !isOpened && $selectMenu.addClass('opened');

    //                 e.stopPropagation();
    //             } else { // if select menu item is clicked

    //                 $target.parent().toggleClass('active'); // add active class to li tag

    //                 if ($target.parent().hasClass('active')) {

    //                     // if only clean all button remains
    //                     if ($('.selected-items').children().length < 2) {
    //                         // show selected items
    //                         $('.selected-items').show();
    //                     }

    //                     // add selected item
    //                     $('<a href="#" class="selected-item">' + $target.text().split('(')[0] + '<i class="la la-close"></i></a>')
    //                         .insertBefore('.selected-items .filter-clean')
    //                         .hide().fadeIn()  // hide and show item with effect - fadeIn
    //                         .data('link', $target.parent());
    //                 } else {
    //                     // remove selected item from selected items
    //                     $('.selected-items > .selected-item').filter(function (i, el) {
    //                         return el.innerText == $target.text().split('(')[0];
    //                     }).fadeOut(function () {
    //                         $(this).remove();

    //                         // if only clean all buttpn remains
    //                         if ($('.selected-items').children().length < 2) {
    //                             // then hide selected items
    //                             $('.selected-items').hide();
    //                         }
    //                     })
    //                 }
    //             }
    //         });

    //         // Clean selected items
    //         $('.selected-items .filter-clean').on('click', function (e) {
    //             var $clean = $(this);
    //             $clean.siblings().each(function () {
    //                 var $link = $(this).data('link');
    //                 $link && $link.removeClass('active');
    //             });
    //             $clean.parent().fadeOut(function () {
    //                 $clean.siblings().remove();
    //             });
    //             e.preventDefault();
    //         });

    //         $('.filter-clean').on('click', function (e) {
    //             $('.shop-sidebar .filter-items .active').removeClass('active');
    //             e.preventDefault();
    //         });

    //         Coodect.$body.on('click', '.select-menu a', function (e) {
    //             e.preventDefault();
    //         });

    //         Coodect.$body.on('click', '.selected-item i', function (e) {
    //             $(e.currentTarget).parent().fadeOut(function () {
    //                 var $this = $(this),
    //                     $link = $this.data('link');

    //                 $link && $link.toggleClass('active');
    //                 $this.remove();

    //                 // if only clean all button remains
    //                 if ($('.select-items').children().length < 2) {
    //                     // then hide select-items
    //                     $('.select-items').hide();
    //                 }
    //             });

    //             e.preventDefault();
    //         });

    //         // if click outside of select menu, hide select menu
    //         Coodect.$body.on('mousedown', function (e) {
    //             $('.select-menu').removeClass('opened');
    //         });

    //         Coodect.$body.on('click', '.filter-items a', function (e) {
    //             var $ul = $(this).closest('.filter-items');
    //             if (!$ul.hasClass('search-ul') && !$ul.parent().hasClass('select-menu')) {
    //                 $(this).parent().toggleClass('active');
    //                 e.preventDefault();
    //             }
    //         });
    //     }

    //     var initProductQuickview = function () {
    //         Coodect.$body.on('click', '.btn-quickview', function (e) {
    //             e.preventDefault();
    //             Coodect.popup({
    //                 items: {
    //                     src: "assets/ajax/quickview.html"
    //                 },
    //                 callbacks: {
    //                     ajaxContentAdded: function () {
    //                         this.wrap.imagesLoaded(function () {
    //                             Coodect.productSingle($('.mfp-product .product-single'));
    //                         });
    //                     }
    //                 }
    //             }, 'quickview');
    //         });
    //     }

    //     // Public Properties
    //     var Shop = {
    //         init: function () {
    //             Coodect.call(Coodect.ratingTooltip, 500);
    //             Coodect.call(Coodect.setProgressBar('.progress-bar'), 500);
    //             this.initProductType('slideup');
    //             this.initVariation();

    //             // Functions for shop page
    //             initSelectMenu();
    //             initProductQuickview();
    //             Coodect.priceSlider('.filter-price-slider');
    //         },

    //         initProductType: function (type) {

    //             // "slideup"
    //             if (type == 'slideup') {
    //                 $('.product-slideup-content .product-details').each(function (e) {
    //                     var $this = $(this),
    //                         elem = $this.find('.product-hidden-details'),
    //                         hidden_height = $this.find('.product-hidden-details').outerHeight(true);

    //                     $this.height($this.height() - hidden_height);
    //                 });

    //                 $(Coodect.byClass('product-slideup-content'))
    //                     .on('mouseenter touchstart', function (e) {
    //                         var $this = $(this),
    //                             hidden_height = $this.find('.product-hidden-details').outerHeight(true);

    //                         $this.find('.product-details').css('transform', 'translateY(' + (-hidden_height) + 'px)');
    //                         $this.find('.product-hidden-details').css('transform', 'translateY(' + (-hidden_height) + 'px)');
    //                     })
    //                     .on('mouseleave touchleave', function (e) {
    //                         var $this = $(this),
    //                             hidden_height = $this.find('.product-hidden-details').outerHeight(true);

    //                         $this.find('.product-details').css('transform', 'translateY(0)');
    //                         $this.find('.product-hidden-details').css('transform', 'translateY(0)');
    //                     });
    //             }
    //         },

    //         initVariation: function (type) {
    //             $('.product:not(.product-single) .product-variations > a').on('click', function (e) {
    //                 var $this = $(this),
    //                     $image = $this.closest('.product').find('.product-media img');

    //                 if (!$image.data('image-src'))
    //                     $image.data('image-src', $image.attr('src'));

    //                 $this.toggleClass('active').siblings().removeClass('active');

    //                 if ($this.hasClass('active')) {
    //                     $image.attr('src', $this.data('src'));
    //                 } else {
    //                     $image.attr('src', $image.data('image-src'));
    //                     $this.blur();
    //                 }
    //                 e.preventDefault();
    //             })
    //         }
    //     }

    //     Coodect.shop = Shop;
    // })(jQuery);
    // /**
    //  * Coodect Plugin - QuantityInput
    //  *
    //  * @instance multiple
    //  */

    // function QuantityInput($el) {
    //     return this.init($el);
    // }

    // (function ($) {

    //     // Public Members
    //     QuantityInput.min = 1;
    //     QuantityInput.max = 1000000;
    //     QuantityInput.value = 1;

    //     QuantityInput.prototype.init = function ($el) {
    //         var self = this;

    //         self.$minus = false;
    //         self.$plus = false;
    //         self.$value = false;
    //         self.value = false;

    //         // Bind Events
    //         self.startIncrease = self.startIncrease.bind(self);
    //         self.startDecrease = self.startDecrease.bind(self);
    //         self.stop = self.stop.bind(self);

    //         // Variables
    //         self.min = parseInt($el.attr('min'));
    //         self.max = parseInt($el.attr('max'));

    //         self.min || ($el.attr('min', self.min = QuantityInput.min));
    //         self.max || ($el.attr('max', self.max = QuantityInput.max));

    //         // Add DOM elements and event listeners
    //         self.$value = $el.val(self.value = QuantityInput.value);

    //         self.$minus = $el.parent().find('.quantity-minus')
    //             .on('mousedown', function (e) {
    //                 e.preventDefault();
    //                 self.startDecrease();
    //             })
    //             .on('touchstart', function (e) {
    //                 if (e.cancelable) {
    //                     e.preventDefault();
    //                 }
    //                 self.startDecrease();
    //             })
    //             .on('mouseup', self.stop);

    //         self.$plus = $el.parent().find('.quantity-plus')
    //             .on('mousedown', function (e) {
    //                 e.preventDefault();
    //                 self.startIncrease();
    //             })
    //             .on('touchstart', function (e) {
    //                 if (e.cancelable) {
    //                     e.preventDefault();
    //                 }
    //                 self.startIncrease();
    //             })
    //             .on('mouseup', self.stop);

    //         Coodect.$body.on('mouseup', self.stop)
    //             .on('touchend', self.stop)
    //             .on('touchcancel', self.stop);
    //     }

    //     QuantityInput.prototype.startIncrease = function (e) {
    //         e && e.preventDefault();

    //         var self = this;
    //         self.value = self.$value.val();

    //         self.value < self.max && self.$value.val(++self.value);
    //         self.increaseTimer = Coodect.requestTimeout(function () {
    //             self.speed = 1;
    //             self.increaseTimer = Coodect.requestInterval(function () {
    //                 self.$value.val(self.value = Math.min(self.value + Math.floor(self.speed *= 1.05), self.max));
    //             }, 50);
    //         }, 400);
    //     }

    //     QuantityInput.prototype.startDecrease = function (e) {
    //         e && e.preventDefault();

    //         var self = this;
    //         self.value = self.$value.val();
    //         self.value > self.min && self.$value.val(--self.value);

    //         self.decreaseTimer = Coodect.requestTimeout(function () {
    //             self.speed = 1;
    //             self.decreaseTimer = Coodect.requestInterval(function () {
    //                 self.$value.val(self.value = Math.max(self.value - Math.floor(self.speed *= 1.05), self.min))
    //             }, 50);
    //         }, 400);
    //     }

    //     QuantityInput.prototype.stop = function (e) {
    //         Coodect.deleteTimeout(this.increaseTimer);
    //         Coodect.deleteTimeout(this.decreaseTimer);
    //     }

    //     Coodect.initQtyInput = function (selector) {
    //         Coodect.$(selector).each(function () {
    //             var $this = $(this);

    //             // if not initialized
    //             $this.data('quantityInput') ||
    //                 $this.data('quantityInput', new QuantityInput($this));
    //         })
    //     }
    // })(jQuery)
    // /**
    //  * Coodect Plugin - Popup
    //  *
    //  * @requires magnificPopup
    //  * @instance multiple
    //  */
    // function Popup(options, preset) {
    //     return this.init(options, preset);
    // }

    // (function ($) {
    //     'use strict';

    //     Popup.defaults = {
    //         removalDelay: 300,
    //         callbacks: {
    //             open: function () {
    //                 $('html').css('overflow-y', 'hidden');
    //                 $('body').css('overflow-x', 'visible');
    //                 $('.mfp-wrap').css('overflow', 'hidden auto');
    //                 $('.sticky-header.fixed').css('padding-right', window.innerWidth - document.body.clientWidth);
    //             },
    //             close: function () {
    //                 $('html').css('overflow-y', '');
    //                 $('body').css('overflow-x', 'hidden');
    //                 $('.mfp-wrap').css('overflow', '');
    //                 $('.sticky-header.fixed').css('padding-right', '');
    //             }
    //         }
    //     }


    //     Popup.presets = {
    //         'quickview': {
    //             type: 'ajax',
    //             mainClass: 'mfp-product mfp-fade',
    //             tLoading: 'Loading...'
    //         }
    //     }

    //     Popup.prototype.init = function (options, preset) {
    //         var mpIns = $.magnificPopup.instance;

    //         if (mpIns.isOpen && mpIns.content && !mpIns.content.hasClass('login-popup')) {
    //             // close current
    //             mpIns.close();

    //             // open a new one after a few moment
    //             setTimeout(function () {
    //                 $.magnificPopup.open(
    //                     $.extend(true, {},
    //                         Popup.defaults,
    //                         preset ? Popup.presets[preset] : {},
    //                         options
    //                     )
    //                 )
    //             }, 500);
    //         } else {
    //             $.magnificPopup.open(
    //                 $.extend(true, {},
    //                     Popup.defaults,
    //                     preset ? Popup.presets[preset] : {},
    //                     options
    //                 )
    //             );
    //         }
    //     }

    //     Coodect.popup = function (options, preset) {
    //         return new Popup(options, preset);
    //     }
    // })(jQuery);
    // /**
    //  * Coodect Plugin - Product Single
    //  *
    //  * @requires OwlCarousel
    //  * @requires elevateZoom
    //  * @instance multiple
    //  */

    // function ProductSingle($el) {
    //     return this.init($el);
    // }

    // (function ($) {

    //     // Private Properties
    //     var thumbsSliderOptions = {
    //         margin: 0,
    //         items: 4,
    //         dots: false,
    //         nav: true,
    //         navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>']
    //     }

    //     var thumbsInit = function (self) {
    //         // properties for thumbnails
    //         self.$thumbs = self.$wrapper.find('.product-thumbs');
    //         self.$thumbsWrap = self.$thumbs.parent();
    //         self.$thumbUp = self.$thumbsWrap.find('.thumb-up');
    //         self.$thumbDown = self.$thumbsWrap.find('.thumb-down');
    //         self.$thumbsDots = self.$thumbs.children();
    //         self.thumbsCount = self.$thumbsDots.length;
    //         self.$productThumb = self.$thumbsDots.eq(0);
    //         self._isPgVertical = self.$thumbsWrap.parent().hasClass('product-gallery-vertical');
    //         self.thumbsIsVertical = self._isPgVertical && window.innerWidth >= 992;

    //         // Register Events
    //         self.$thumbDown.on('click', function (e) {
    //             self.thumbsIsVertical && thumbsDown(self);
    //         });

    //         self.$thumbUp.on('click', function (e) {
    //             self.thumbsIsVertical && thumbsUp(self);
    //         });

    //         self.$thumbsDots.on('click', function (e) {
    //             var $this = $(this),
    //                 index = ($this.parent().filter(self.$thumbs).length ? $this : $this.parent()).index();
    //             self.$wrapper.find('.product-single-carousel').trigger('to.owl.carousel', index);
    //         });

    //         // refresh thumbs
    //         thumbsRefresh(self);
    //         Coodect.$window.on('resize', function () {
    //             self.thumbsIsVertical = self._isPgVertical && window.innerWidth >= 992;
    //             thumbsRefresh(self);
    //         });
    //     }

    //     var thumbsDown = function (self) {
    //         var thumbsWrapBottom = self.$thumbsWrap.offset().top + self.$thumbsWrap[0].offsetHeight,
    //             curBottom = self.$thumbs.offset().top + self.thumbsHeight;

    //         if (curBottom >= thumbsWrapBottom + self.$productThumb[0].offsetHeight) {
    //             self.$thumbs.css('top', parseInt(self.$thumbs.css('top')) - self.$productThumb[0].offsetHeight);
    //             self.$thumbUp.removeClass('disabled');
    //         } else if (curBottom > thumbsWrapBottom) {
    //             self.$thumbs.css('top', parseInt(self.$thumbs.css('top')) - Math.ceil(curBottom - thumbsWrapBottom));
    //             self.$thumbUp.removeClass('disabled');
    //             self.$thumbDown.addClass('disabled');
    //         } else {
    //             self.$thumbDown.addClass('disabled');
    //         }
    //     }

    //     var thumbsUp = function (self) {
    //         var thumbsWrapTop = self.$thumbsWrap.offset().top,
    //             curTop = self.$thumbs.offset().top;

    //         if (curTop <= thumbsWrapTop - self.$productThumb[0].offsetHeight) {
    //             self.$thumbs.css('top', parseInt(self.$thumbs.css('top')) + self.$productThumb[0].offsetHeight);
    //             self.$thumbDown.removeClass('disabled');
    //         } else if (curTop < thumbsWrapTop) {
    //             self.$thumbs.css('top', parseInt(self.$thumbs.css('top')) - Math.ceil(curTop - thumbsWrapTop));
    //             self.$thumbDown.removeClass('disabled');
    //             self.$thumbUp.addClass('disabled');
    //         } else {
    //             self.$thumbUp.addClass('disabled');
    //         }
    //     }

    //     var thumbsRefresh = function (self) {
    //         if (self.thumbsIsVertical) { // enable vertical product gallery thumbs.
    //             // disable thumbs carousel
    //             self.$thumbs.hasClass('owl-carousel') &&
    //                 self.$thumbs
    //                     .trigger('destroy.owl.carousel')
    //                     .removeClass('owl-carousel');

    //             // enable thumbs vertical nav
    //             self.thumbsHeight = self.$productThumb[0].offsetHeight * self.thumbsCount + parseInt(self.$productThumb.css('margin-bottom')) * (self.thumbsCount - 1);
    //             self.$thumbUp.addClass('disabled');
    //             self.$thumbDown.toggleClass('disabled', self.thumbsHeight <= self.$thumbsWrap[0].offsetHeight);
    //         } else {
    //             // enable thumbs carousel
    //             self.$thumbs.removeAttr('style');
    //             self.$thumbs.hasClass('owl-carousel') || self.$thumbs.addClass('owl-carousel').owlCarousel(
    //                 $.extend(
    //                     true,
    //                     self.isQuickView ? {
    //                         onInitialized: recalcDetailsHeight,
    //                         onResized: recalcDetailsHeight
    //                     } : {},
    //                     thumbsSliderOptions
    //                 )
    //             );
    //         }
    //     }

    //     var variationInit = function (self) {
    //         self.$selects = self.$wrapper.find('.product-variations select');
    //         self.$items = self.$wrapper.find('.product-variations');
    //         self.$sizeItems = self.$wrapper.find('.product-size-swatch');
    //         self.$colorItems = self.$wrapper.find('.product-color-swatch');
    //         self.$priceWrap = self.$wrapper.find('.product-variation-price');
    //         self.$btnCart = self.$wrapper.find('.btn-cart');

    //         // check
    //         self.checkVariation();
    //         self.$selects.on('change', function (e) {
    //             self.checkVariation();
    //         });
    //         self.$items.find('a').on('click', function (e) {
    //             $(this).toggleClass('active').siblings().removeClass('active');
    //             e.preventDefault();
    //             self.checkVariation();
    //         });
    //     }

    //     // For only Quickview
    //     var recalcDetailsHeight = function () {
    //         var self = this;
    //         self.$wrapper.find('.product-details').css(
    //             'height',
    //             window.innerWidth > 767 ? self.$wrapper.find('.product-gallery')[0].clientHeight : ''
    //         );
    //     }

    //     // Public Properties
    //     ProductSingle.prototype.init = function ($el) {
    //         var self = this,
    //             $slider = $el.find('.product-single-carousel');

    //         // members
    //         self.$wrapper = $el;
    //         self.isQuickView = !!$el.closest('.mfp-content').length;
    //         self._isPgVertical = false;

    //         // bind
    //         if (self.isQuickView) {
    //             recalcDetailsHeight = recalcDetailsHeight.bind(this);
    //             Coodect.ratingTooltip();
    //         }

    //         // init thumbs
    //         $slider.on('initialized.owl.carousel', function (e) {

    //             // if not quickview, make full image toggle
    //             self.isQuickView || $slider.append('<a href="#" class="product-image-full"><i class="icon-magnifier"></i></a>');

    //             // init thumbnails
    //             thumbsInit(self);
    //         }).on('translate.owl.carousel', function (e) {
    //             var currentIndex = (e.item.index - $(e.currentTarget).find('.cloned').length / 2 + e.item.count) % e.item.count;
    //             self.setThumbsActive(currentIndex);
    //         });

    //         // if this is created after document ready, init plugins
    //         if ('complete' === Coodect.status) {
    //             Coodect.slider($slider);
    //             Coodect.initQtyInput($el.find('.quantity'));
    //         }

    //         variationInit(this);
    //     }

    //     ProductSingle.prototype.setThumbsActive = function (index) {
    //         var self = this,
    //             $curThumb = self.$thumbsDots.eq(index);

    //         self.$thumbsDots.filter('.active').removeClass('active');
    //         $curThumb.addClass('active');

    //         // show current thumb
    //         if (self.thumbsIsVertical) { // if vertical
    //             var offset = parseInt(self.$thumbs.css('top')) + index * self.thumbsHeight;

    //             if (offset < 0) { // if thumb is above ?
    //                 self.$thumbs.css('top', parseInt(self.$thumbs.css('top')) - offset);
    //             } else {
    //                 offset = self.$thumbs.offset().top + self.$thumbs[0].offsetHeight - $curThumb.offset().top - $curThumb[0].offsetHeight;

    //                 if (offset < 0) {
    //                     // if below
    //                     self.$thumbs.css('top', parseInt(self.$thumbs.css('top')) + offset);
    //                 }
    //             }
    //         } else { // if thumb carousel
    //             self.$thumbs.trigger('to.owl.carousel', index, 100);
    //         }
    //     }

    //     ProductSingle.prototype.checkVariation = function () {
    //         var self = this,
    //             isAllSelected = true;

    //         // check all select variations are selected
    //         self.$selects.each(function () {
    //             return this.value || (isAllSelected = false);
    //         });

    //         // check all item variations are selected
    //         self.$items.each(function () {
    //             var $this = $(this);
    //             if ($this.find('a:not(.size-guide)').length) {
    //                 return $this.find('.active').length || (isAllSelected = false);
    //             }
    //         });

    //         // check color swatch
    //         self.$colorItems.each(function () {
    //             var $this = $(this);
    //             if ($this.find('a').length) {
    //                 return $this.find('.active').length || (isAllSelected = false);
    //             }
    //         });

    //         // check image swatch
    //         self.$sizeItems.each(function () {
    //             var $this = $(this);
    //             if ($this.find('a:not(.size-guide)').length) {
    //                 return $this.find('.active').length || (isAllSelected = false);
    //             }
    //         })

    //         isAllSelected ?
    //             self.variationMatch() : self.variationClean();
    //     }

    //     ProductSingle.prototype.variationMatch = function () {
    //         var self = this;
    //         self.$priceWrap.find('span').text('$' + (Math.round(Math.random() * 50) + 200) + '.00');
    //         self.$priceWrap.slideDown();
    //         self.$btnCart.removeAttr('disabled');
    //     }

    //     ProductSingle.prototype.variationClean = function (reset) {
    //         reset && this.$selects.val('');
    //         reset && this.$items.children('active').removeClass('active');
    //         this.$priceWrap.slideUp();
    //         this.$btnCart.attr('disabled', 'disabled');
    //     }

    //     Coodect.productSingle = function ($el, options) {
    //         if ($el && $el.length === 1) {
    //             return new ProductSingle($el.eq(0), options);
    //         }
    //         return null;
    //     }
    // })(jQuery);
    // /**
    //  * Coodect Plugin - Product Single Page
    //  *
    //  * @requires Slider
    //  * @requires ProductSingle
    //  * @requires PhotoSwipe
    //  * @instance single
    //  */

    // (function ($) {

    //     // Private Properties
    //     var $product;

    //     // Open Image Gallery
    //     var openImageGallery = function (e) {
    //         e.preventDefault();


    //         var $this = $(e.currentTarget),
    //             $images, images;

    //         if ($product.find('.product-single-carousel').length) { // single carousel
    //             $images = $product.find('.product-single-carousel .owl-item:not(.cloned) img');
    //         } else if ($product.find('.product-gallery-carousel').length) { // gallery carousel
    //             $images = $product.find('.product-gallery-carousel .owl-item:not(.cloned) img');
    //         } else { // simple gallery
    //             $images = $product.find('.product-gallery img');
    //         }

    //         if ($images.length) {
    //             images = $images.map(function () {
    //                 var $this = $(this);

    //                 return {
    //                     src: $this.attr('data-zoom-image'),
    //                     w: 800,
    //                     h: 900,
    //                     title: $this.attr('alt')
    //                 };
    //             }).get();

    //             var carousel = $product.find('.product-single-carousel, .product-gallery-carousel').data('owl.carousel'),
    //                 curIndex = carousel ?
    //                     // Carousel Type
    //                     ((carousel.current() - carousel.clones().length / 2 + images.length) % images.length) :
    //                     // Gallery Type
    //                     ($product.find('.product-gallery > *').index());

    //             if (typeof PhotoSwipe !== 'undefined') {
    //                 var pswpElement = $('.pswp')[0];

    //                 var photoSwipe = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, images, {
    //                     index: curIndex,
    //                     closeOnScroll: false
    //                 });
    //                 photoSwipe.init();
    //                 Coodect.photoSwipe = photoSwipe;
    //             }
    //         }
    //     }

    //     // Rating Form
    //     var setRatingForm = function () {
    //         $('body').on('click', '.rating-form .rating-stars > a', function (e) {
    //             var $star = $(this);
    //             $star.addClass('active').siblings().removeClass('active');
    //             $star.parent().addClass('selected');
    //             $star.closest('.rating-form').find('select').val($star.text());
    //             e.preventDefault();
    //         });
    //     }

    //     var ProductSinglePage = {

    //         init: function () {

    //             $product = $('.product-single');

    //             if ($product.length) {
    //                 // if home page, init single products
    //                 $product.each(function () {
    //                     Coodect.productSingle($(this));
    //                     return null;
    //                 });
    //             } else {
    //                 // if no single product exists, return
    //                 return null;
    //             }

    //             // Zoom Image for slider type
    //             Slider.presets['product-gallery-carousel'] = {
    //                 dots: false,
    //                 nav: true,
    //                 margin: 30,
    //                 items: 1,
    //                 responsive: {
    //                     576: {
    //                         items: 2
    //                     }
    //                 },
    //                 onInitialized: Slider.zoomImage,
    //                 onRefreshed: Slider.zoomImageRefresh
    //             }

    //             // Zoom Image for grid type
    //             Coodect.zoomImage('.product-gallery.row');

    //             // Register events
    //             $product.on('click', '.product-image-full', openImageGallery);

    //             // init rating form
    //             setRatingForm();
    //         }
    //     }

    //     Coodect.productSinglePage = ProductSinglePage;
    // })(jQuery);
    // /**
    //  * Womart Plugin - Calendar
    //  *
    //  * @instance multiple
    //  */

    // function Calendar(el, options) {
    //     return this.init(el, options);
    // }

    // (function ($) {

    //     // Private Members
    //     var updateHeader = function (date) {
    //         var self = this;
    //         var mt = self.settings.months[date.getMonth()];
    //         mt += self.settings.displayYear ? ' ' + date.getFullYear() : '';

    //         self.element.find('.calendar-title').html(mt);
    //     }

    //     // Public Members
    //     Calendar.defaultOptions = {
    //         months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    //         days: ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'],
    //         displayYear: true,      // Display year in header
    //         fixedStartDay: true,    // Week always begins with Sunday or Monday by setting number 0 or 1. If startDay is false, week always begin with firstday of month
    //         dayNumber: 0,           // Week always begins with Sunday
    //         dayExcerpt: 3,          // length of abbreviation of day. If it is equal to 3, the day will be "Sun", "Mon", etc
    //     }

    //     Calendar.prototype.init = function ($el, options) {
    //         var self = this;
    //         console.log($el);
    //         self.element = $el;    // calendar container element
    //         self.settings = $.extend({}, true,
    //             Calendar.defaultOptions,
    //             Coodect.parseOptions($el.attr('data-calendar-options')),
    //             options
    //         ); // extend default options with user defined options
    //         self.today = new Date();

    //         // Bind this to update header
    //         updateHeader = updateHeader.bind(this);

    //         var $calendar = $('<div class="calendar"></div>'),
    //             $header = $('<div class="calendar-header">' +
    //                 '<a href="#" class="btn-calendar btn-calendar-prev"><i class="la la-angle-left"></i></a>' +
    //                 '<span class="calendar-title"></span>' +
    //                 '<a href="#" class="btn-calendar btn-calendar-next"><i class="la la-angle-right"></i></a>' +
    //                 '</div>');

    //         $calendar.append($header);
    //         $el.append($calendar);

    //         // update Calendar header
    //         updateHeader(self.today);

    //         self.render(self.today, $calendar);

    //         self.bindEvents();
    //     }

    //     /**
    //      * @function render
    //      *
    //      * Render Calendar
    //      * @param {Date} fd
    //      * @param {HTMLElement} $calendar
    //      */
    //     Calendar.prototype.render = function (fd, $calendar) {
    //         var self = this;

    //         // if calendar table already exists, remove it
    //         $calendar.find('table') &&
    //             $calendar.find('table').remove();

    //         var $table = $('<table></table>'),
    //             $thead = $('<thead></thead>'),
    //             $tbody = $('<tbody></tbody'),
    //             y = fd.getFullYear(),
    //             m = fd.getMonth();

    //         var firstDay = new Date(y, m, 1),         // get the first day of the month
    //             lastDay = new Date(y, m + 1, 0),      // get the last day of the month
    //             startDayOfWeek = firstDay.getDay();     // get the first day of the week

    //         if (self.settings.fixedStartDay) {
    //             startDayOfWeek = self.settings.dayNumber;

    //             // If the first day of the month is different with start of week, get more days of prev month to fill calendar
    //             while (firstDay.getDay() != startDayOfWeek) {
    //                 firstDay.setDate(firstDay.getDate() - 1);
    //             }

    //             // If the last day of the month is difference with end of week, get more days of next month to be displayed in calendar
    //             while (lastDay.getDay() != (startDayOfWeek + 7) % 7) {
    //                 lastDay.setDate(lastDay.getDate() + 1);
    //             }
    //         }

    //         // Get days in week
    //         for (var i = startDayOfWeek; i < startDayOfWeek + 7; i++) {
    //             var th = $('<th>' + self.settings.days[i % 7].substring(0, self.settings.dayExcerpt) + '</th>');

    //             i % 7 == 0 && th.addClass('holiday');

    //             $thead.append(th);
    //         }

    //         // Displays days from fristday to lastday in calendar

    //         for (var day = firstDay; day < lastDay; day.setDate(day.getDate())) {
    //             var tr = $('<tr></tr>');

    //             // Make each row of calendar
    //             for (var i = 0; i < 7; i++) {
    //                 var td = $('<td><span class="day" data-date="' + day.toISOString() + '">' + day.getDate() + '</span></td>');

    //                 // If the day is equal to today
    //                 (day.toDateString() == (new Date).toDateString()) &&
    //                     td.find('.day').addClass('today');

    //                 // If the day is out of current month
    //                 (day.getMonth() != fd.getMonth()) &&
    //                     td.find('.day').addClass('disabled');

    //                 tr.append(td);
    //                 day.setDate(day.getDate() + 1);
    //             }
    //             $tbody.append(tr);
    //         };

    //         $table.append($thead);
    //         $table.append($tbody);
    //         $calendar.append($table);
    //     }

    //     /**
    //      * @function changeMonth
    //      *
    //      * Change Month
    //      * @param {Number} dm - increment of month
    //      */
    //     Calendar.prototype.changeMonth = function (dm) {
    //         this.today.setMonth(this.today.getMonth() + dm, 1);
    //         this.render(this.today, $(this.element).find('.calendar'));
    //         updateHeader(this.today);
    //     }


    //     /**
    //      * @function bindEvents
    //      *
    //      * Bind events to prev & next button
    //      */
    //     Calendar.prototype.bindEvents = function () {
    //         var self = this;

    //         // Register event to prev btn
    //         $(self.element).find('.btn-calendar-prev').on('click', function (e) {
    //             self.changeMonth(-1);
    //             e.preventDefault();
    //         });

    //         // Register event to next btn
    //         $(self.element).find('.btn-calendar-next').on('click', function (e) {
    //             self.changeMonth(1);
    //             e.preventDefault();
    //         });
    //     }


    //     Coodect.calendar = function (selector, options) {
    //         Coodect.$(selector).each(function () {
    //             var $this = $(this);

    //             Coodect.call(function () {
    //                 new Calendar($this, options);
    //             });
    //         });
    //     }
})(jQuery);
/**
 * Coodect Theme
 */
(function ($) {

    // Initialize Method while document is being loaded
    Coodect.prepare = function () {
        Coodect.$body.hasClass('with-flex-container') && window.innerWidth >= 1200 &&
            Coodect.$body.addClass('sidebar-active');
    };

    // // Initialize Method while document is interactive
    // Coodect.initLayout = function () {
    //     // do something later...
    //     Coodect.isotopes('.grid:not(.grid-float)');
    //     Coodect.stickySidebar('.sticky-sidebar');
    // };

    // Initialize Method after document has been loaded
    Coodect.init = function () {
        // do something later...
        Coodect.appearAnimate('.appear-animate');             // Run appear animation
        Coodect.slider('.owl-carousel');                      // Initialize Slider
        // Coodect.setTab('.nav-tabs');                          // Initialize Tab
        Coodect.setStickyContent('.sticky-header');          // Initialize Sticky Content
        Coodect.setStickyContent('.sticky-footer', {
            minWidth: 0,
            maxWidth: 767,
            top: 150,
            hide: true,
            max_index: 2100
        }); // Initialize Sticky Footer
        Coodect.parallax('.parallax');                        // Initialize Parallax
        Coodect.menu.init();                                    // Initialize Menu
        Coodect.initScrollTopButton();                          // Initialize scroll top button
        // Coodect.shop.init();                                    // Initialize Shop
        // Coodect.alert('.alert')                               // Initialize Alert
        // Coodect.accordion('.card-header > a')                 // Initialize Accordion
        // Coodect.sidebar('sidebar');                           // Initialize Sidebar
        // Coodect.sidebar('right-sidebar');                     // Initialize Right Sidebar
        // Coodect.productSinglePage.init();                       // Initialize Single Product Page
        // Coodect.playVideo('.banner-video');                   // Initialize Video Banner
        // Coodect.initQtyInput('.quantity');                    // Initialize Quantity Input
        // Coodect.initNavFilter('.nav-filters .nav-filter')     // Initialize Isotope Navigation Filters
        // Coodect.calendar('.calendar-container');              // Initialize Calendar
        // Coodect.countDown('.product-countdown, .countdown');  // Initialize CountDown
        // Coodect.initPopup();                                    // Initialize Popup
        // Coodect.initNotificationAlert();                        // Initialize Notification Alert
        Coodect.countTo('.count-to');                         // Initialize CountTo
    };
})(jQuery);


/**
 * Coodect Theme Initializer
 */
(function ($) {
    'use strict';

    // Prepare Coodect Theme
    Coodect.prepare();

    // Initialize Coodect Theme
    document.onreadystatechange = function () {
        if (document.readyState === "complete") {
        }
    }

    window.onload = function () {
        // loaded
        Coodect.status = 'loaded';
        document.body.classList.add('loaded');

        Coodect.call(Coodect.initLayout);
        Coodect.call(Coodect.init);
        Coodect.status = 'complete';
        Coodect.$window.trigger('Coodect_complete');
    }
})(jQuery);
