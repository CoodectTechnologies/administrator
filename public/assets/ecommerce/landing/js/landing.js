'use strict';

window.Wolmart = Wolmart || {};

(function ($) {

    var requestAnimFrame =
        window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        function (callback) {
            window.setTimeout(callback, 1000 / 60);
        };

    //Floating Background
    function FloatBackground(el, options) {
        var updateFn = this.update.bind(this);

        this.el = el;
        this.options = $.extend({
            friction: .03
        }, options);
        this.x2 = this.y2 = this.x = this.y = 0;

        $(window).on('mousemove click', this.moveTo.bind(this));
        window.addEventListener('resize', updateFn, { passive: true });
        window.addEventListener('scroll', updateFn, { passive: true });
        this.update();
    }

    FloatBackground.prototype.update = function () {
        var self = this;
        if (Wolmart.isInViewport(this.el)) {
            requestAnimFrame(function () {
                self.move();
            });
        }
    }

    FloatBackground.prototype.moveTo = function (e) {
        this.x2 = -0.1 * e.clientX;
        this.y2 = -0.1 * e.clientY;
    }

    FloatBackground.prototype.move = function () {
        this.x += (this.x2 - this.x) * this.options.friction;
        this.y += (this.y2 - this.y) * this.options.friction;
        this.el.style['background-position'] = parseInt(this.x) + 'px ' + parseInt(this.y) + 'px';
        this.update();
    }

    Wolmart.floatBackground = function (selector, options) {
        Wolmart.$(selector).each(function () {
            new FloatBackground(this, options);
        })
    }

    // Floating element
    function FloatEl ( el, options ) {
        this.el = el;
        this.options = $.extend( {
            delta: 5,
            max: 30,
            delay: 1500
        }, options, Wolmart.parseOptions( el.getAttribute( 'data-float-options' ) ) );

        this._x = 0;
        this._y = 0;

        var self = this,
            runFloat = function () {
                Wolmart.call( self.update.bind( self ), self.options.delay );
            }

        if ( this.el.classList.contains( 'appear-animate' ) ) {
            $( this.el ).data( 'appear-callback', runFloat );
        } else {
            runFloat();
        }
    }

    FloatEl.prototype.update = function () {
        var self = this;
        setTimeout( function () {
            self.move();
        }, 1000 );
    }

    FloatEl.prototype.move = function () {
        var angle, dx, dy;
        do {
            angle = 2 * Math.PI * Math.random();
            dx = Math.cos( angle ) * this.options.delta;
            dy = Math.sin( angle ) * this.options.delta;
        } while ( ( this._x + dx ) * ( this._x + dx ) + ( this._y + dy ) * ( this._y + dy ) > this.options.max * this.options.max );
        this.el.style.transform = 'translate(' + ( this._x += dx ) + 'px,' + ( this._y += dy ) + 'px)';
        this.update();
    }

    Wolmart.floatEl = function ( selector, options ) {
        Wolmart.$( selector ).each( function () {
            new FloatEl( this, options );
        } )
    }

    //Wolmart Parallax
    function Parallaxbg(el, options) {
        this.options = $.extend({
            speed: 1,
            from: '100%',
            to: '70.5%',
            styleKey: 'width',
            animation: false,
        }, options, Wolmart.parseOptions(el.getAttribute('data-parallax-options')));
        this.el = el;
        this.flag = true;
        var self = this,
            updateFn = this.update.bind(this),
            runParallax = function () {
                self.update();
                window.addEventListener('resize', updateFn, { passive: true });
                window.addEventListener('scroll', updateFn, { passive: true });
            };

        runParallax();
    }

    Parallaxbg.prototype.update = function () {
        var self = this,
            top = window.pageYOffset,
            height = window.innerHeight,
            rect = self.el.getBoundingClientRect();

        var value = (height - rect.top) * 2 / (height + rect.height);
        if (self.options.animation) {
            if (0.4 < value && self.flag) {
                self.el.classList.add('animated');
                self.flag = false;
            }
            if (0.4 > value && !self.flag) {
                self.el.classList.remove('animated');
                self.flag = true;
            }
        } else {
            $(self.el).css(self.options.styleKey, 'calc(' + self.options.from + ' + (' + self.options.to + ' - ' + self.options.from + ') * ' + (value > 1 ? 1 : value) + ')');
        }
    }

    Wolmart.parallaxBg = function (selector, options) {
        Wolmart.$(selector).each(function () {
            new Parallaxbg(this, options);
        })
    }

    Wolmart.scrollTo = function (arg, duration) {
        var offset = 0;
        var _duration = typeof duration == 'undefined' ? 600 : duration;
        if (typeof arg == 'number') {
            offset = arg;
        } else {
            offset = Wolmart.$(arg).offset().top;
        }
        $('html,body').stop().animate({ scrollTop: offset }, _duration);
    }

    //Wolmart Filter
    Wolmart.demoFilter = function (selector) {
        Wolmart.$body.on('click', selector, function(e) {
            e.preventDefault();
            var $el = $(this);

            $el.closest('.demos-nav').find('.nav-filter').removeClass('active');
            $el.addClass('active');

            $el.closest('.demos-nav').find('.grid-item')
                .hide()
                .filter('.' + $el.data('filter')).show();
        })
        $('.demos-nav .nav-filter.active').trigger('click');
    }

    $(window).on('wolmart_complete', function () {
        Wolmart.floatBackground('.float-bg');
        Wolmart.floatEl('.float-el');

        Wolmart.$body
            .on('click', '.main-nav a, .mobile-menu a, .scroll-to', function (e) {
                var node = this,
                    $this = $(this),
                    link = node.hash ? node.hash : node.slice(node.lastIndexOf('#'));
                if (link.startsWith('#')) {
                    $('.mobile-menu-overlay').click();
                    $this.closest('ul').children().removeClass('active')
                    $this.closest('li').addClass('active');
                    Wolmart.scrollTo(link);
                    e.preventDefault();
                }
            });


        Wolmart.demoFilter('.demos-nav .nav-filter');
        $('.lazy-bg').removeClass('lazy-bg');

        Wolmart.parallaxBg('.parallax-effect');
        Wolmart.lazyLoad(document.body);
    })
})(jQuery);