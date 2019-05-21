(function ($) {

    //custom scroll replacement to allow for interval-based 'polling'
    //rather than checking on every pixel.
    var uniqueCntr = 0;
    $.fn.oxiscrolled = function (waitTime, fn) {
        if (typeof waitTime === 'function') {
            fn = waitTime;
            waitTime = 200;
        }
        var tag = 'scrollTimer' + uniqueCntr++;
        this.scroll(function () {
            var self = $(this);
            clearTimeout(self.data(tag));
            self.data(tag, setTimeout(function () {
                self.removeData(tag);
                fn.call(self[0]);
            }, waitTime));
        });
    };

    $.fn.oxiAddonsAniView = function (options) {

        //some default settings. animateThreshold controls the trigger point
        //for animation and is subtracted from the bottom of the viewport.
        var settings = $.extend({
            animateThreshold: 0,
            scrollPollInterval: 20
        }, options);

        //keep the matched elements in a variable for easy reference
        var collection = this;

        //cycle through each matched element and wrap it in a block/div
        //and then proceed to fade out the inner contents of each matched element
        $(collection).each(function (index, element) {
            if ($(collection).attr('oxi-addons-animation') !== '') {
                $(element).addClass('oxi-addons-hidden');
            }
        });



        /**
         * returns boolean representing whether element's top is coming into bottom of viewport
         *
         * @param HTMLDOMElement element the current element to check
         */
        function oxiEnteringViewport(element) {
            var elementTop = $(element).offset().top;
            var viewportBottom = $(window).scrollTop() + $(window).height();
            return (elementTop < (viewportBottom - settings.animateThreshold)) ? true : false;
        }

        /**
         * cycle through each element in the collection to make sure that any
         * elements which should be animated into view, are...
         *
         * @param collection of elements to check
         */
        function oxiRenderElementsCurrentlyInViewport(collection) {
            $(collection).each(function (index, element) {
                if ($(element).is('[oxi-addons-animation]') && oxiEnteringViewport($(element))) {
                    setTimeout(function () {
                        $(element).addClass('oxi-addons-visible');
                        $(element).removeClass('oxi-addons-hidden');
                        if (!navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                            $(element).addClass($(element).attr('oxi-addons-animation'));
                        }
                    }, $(element).attr('oxi-addons-delay'));
                }
            });
        }

        //on page load, render any elements that are currently/already in view
        oxiRenderElementsCurrentlyInViewport(collection);

        //enable the oxiscrolled event timer to watch for elements coming into the viewport
        //from the bottom. default polling time is 20 ms. This can be changed using
        //'scrollPollInterval' from the user visible options
        $(window).oxiscrolled(settings.scrollPollInterval, function () {
            oxiRenderElementsCurrentlyInViewport(collection);
        });
    };

})(jQuery);

jQuery(document).ready(function () {
    jQuery('.oxi-addons-animation').oxiAddonsAniView();
});


jQuery("[oxi-addons-animation]").each(function (index, value) {
    jQuery(this).addClass("oxi-addons-animation");
});
jQuery("[oxi-addons-d-animation]").each(function (index, value) {
    jQuery(this).addClass(jQuery(this).attr("oxi-addons-d-animation"));
});

function OxiAddonsEqualHeightWidth(data) {
    var cw = jQuery(data).outerWidth();
    var ch = jQuery(data).outerHeight();
    if (cw > ch) {
        jQuery(data).css({"height": cw + "px"});
        jQuery(data).css({"width": cw + "px"});
    } else {
        jQuery(data).css({"height": ch + "px"});
        jQuery(data).css({"width": ch + "px"});
    }
}
setTimeout(function () {
    OxiAddonsEqualHeightWidth(jQuery(".OxiAddonsEqualHeightWidth"));
}, 1500);
function oxiequalHeight(group) {
    tallest = 0;
    group.each(function () {
        thisHeight = jQuery(this).height();
        if (thisHeight > tallest) {
            tallest = thisHeight;
        }
    });
    group.height(tallest);
}
setTimeout(function () {
    oxiequalHeight(jQuery(".oxiequalHeight"));
}, 1500);
jQuery('.oxi-addons-button-admin-style').each(function () {
    var data = jQuery(this).attr('oxidata');
    jQuery("#" + data).css("transition", "none");
    jQuery("#" + data).slideUp();
});
jQuery(".oxi-addons-button-flex-box .oxi-addons-button-admin-style:first-child").each(function () {
    jQuery(this).addClass("oxi-active");
    var firstchildclass = jQuery(this).attr("oxidata");
    jQuery("#" + firstchildclass).slideDown();
});

jQuery(".oxi-addons-button-admin-style").on("click", function () {
    jQuery(this).siblings().removeClass("oxi-active");
    jQuery(this).addClass("oxi-active");
    jQuery(this).siblings().each(function () {
        var idvalue = jQuery(this).attr("oxidata");
        jQuery("#" + idvalue).fadeOut();
    });
    var datavalue = jQuery(this).attr("oxidata");
    jQuery("#" + datavalue).fadeIn();
});


(function ($) {
    'use strict';

    var namespace = 'jquery-Oxiplate';

    function OxiPlate($element, options) {
        this.config(options);

        this.$container = $element;
        if (this.options.element) {
            if (typeof this.options.element === 'string') {
                this.$element = this.$container.find(this.options.element);
            } else {
                this.$element = $(this.options.element);
            }
        } else {
            this.$element = $element;
        }

        this.originalTransform = this.$element.css('transform');
        this.$container
                .on('mouseenter.' + namespace, this.onMouseEnter.bind(this))
                .on('mouseleave.' + namespace, this.onMouseLeave.bind(this))
                .on('mousemove.' + namespace, this.onMouseMove.bind(this));
    }

    OxiPlate.prototype.config = function (options) {
        this.options = $.extend({
            inverse: false,
            perspective: 500,
            maxRotation: 10,
            animationDuration: 200
        }, this.options, options);
    };

    OxiPlate.prototype.destroy = function () {
        this.$element.css('transform', this.originalTransform);
        this.$container.off('.' + namespace);
    };

    OxiPlate.prototype.update = function (offsetX, offsetY, duration) {
        var rotateX;
        var rotateY;

        if (offsetX || offsetX === 0) {
            var height = this.$container.outerHeight();
            var py = (offsetY - height / 2) / (height / 2);
            rotateX = this.round(this.options.maxRotation * -py);
        } else {
            rotateY = 0;
        }

        if (offsetY || offsetY === 0) {
            var width = this.$container.outerWidth();
            var px = (offsetX - width / 2) / (width / 2);
            rotateY = this.round(this.options.maxRotation * px);
        } else {
            rotateX = 0;
        }

        if (this.options.inverse) {
            rotateX *= -1;
            rotateY *= -1;
        }

        if (duration) {
            this.animate(rotateX, rotateY, duration);
        } else if (this.animation && this.animation.remaining) {
            this.animation.targetX = rotateX;
            this.animation.targetY = rotateY;
        } else {
            this.transform(rotateX, rotateY);
        }
    };

    OxiPlate.prototype.reset = function (duration) {
        this.update(null, null, duration);
    };

    OxiPlate.prototype.transform = function (rotateX, rotateY) {
        this.currentX = rotateX;
        this.currentY = rotateY;
        this.$element.css('transform',
                (this.originalTransform && this.originalTransform !== 'none' ? this.originalTransform + ' ' : '') +
                'perspective(' + this.options.perspective + 'px) ' +
                'rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg)'
                );
    };

    OxiPlate.prototype.animate = function (rotateX, rotateY, duration) {
        if (duration) {
            this.animation = this.animation || {};

            var remaining = this.animation.remaining;
            this.animation.time = performance.now();
            this.animation.remaining = duration || null;
            this.animation.targetX = rotateX;
            this.animation.targetY = rotateY;

            if (!remaining) {
                requestAnimationFrame(this.onAnimationFrame.bind(this));
            }
        } else {
            this.transform(rotateX, rotateY);
        }
    };

    OxiPlate.prototype.round = function (number) {
        return Math.round(number * 1000) / 1000;
    };

    OxiPlate.prototype.offsetCoords = function (event) {
        var offset = this.$container.offset();
        return {
            x: event.pageX - offset.left,
            y: event.pageY - offset.top
        };
    };

    OxiPlate.prototype.onAnimationFrame = function (timestamp) {
        this.animation = this.animation || {};

        var delta = timestamp - (this.animation.time || 0);
        this.animation.time = timestamp;

        var duration = this.animation.remaining || 0;
        var percent = Math.min(delta / duration, 1);
        var currentX = this.currentX || 0;
        var currentY = this.currentY || 0;
        var targetX = this.animation.targetX || 0;
        var targetY = this.animation.targetY || 0;
        var rotateX = this.round(currentX + (targetX - currentX) * percent);
        var rotateY = this.round(currentY + (targetY - currentY) * percent);
        this.transform(rotateX, rotateY);

        var remaining = duration - delta;
        this.animation.remaining = remaining > 0 ? remaining : null;
        if (remaining > 0) {
            requestAnimationFrame(this.onAnimationFrame.bind(this));
        }
    };

    OxiPlate.prototype.onMouseEnter = function (event) {
        var offset = this.offsetCoords(event);
        this.update(offset.x, offset.y, this.options.animationDuration);
    };

    OxiPlate.prototype.onMouseLeave = function (event) {
        this.reset(this.options.animationDuration);
    };

    OxiPlate.prototype.onMouseMove = function (event) {
        var offset = this.offsetCoords(event);
        this.update(offset.x, offset.y);
    };

    $.fn.Oxiplate = function (options) {
        return this.each(function () {
            var $element = $(this);
            var Oxiplate = $element.data(namespace);

            if (options === 'remove') {
                Oxiplate.destroy();
                $element.data(namespace, null);
            } else {
                if (!Oxiplate) {
                    Oxiplate = new OxiPlate($element, options);
                    $element.data(namespace, Oxiplate);
                    Oxiplate.reset();
                } else {
                    Oxiplate.config(options);
                }
            }
        });
    };

})(jQuery);

