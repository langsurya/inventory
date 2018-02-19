/**
 * Bootkit v1.0.0 (http://bootkit.themebucket.net/)
 * Copyright 2017 ThemeBucket
 * Licensed under the ISC license
 */
+function ($) {

    'use strict';

    $(function(){

        $('[data-toggle="ui-nav"]').on('click', function(e){
            e.preventDefault();
            $('#ui').toggleClass('ui-aside-compact');
        });

        $('[data-toggle="ui-aside-right"]').on('click', function(e){
            e.preventDefault();
            $('#content').toggleClass('ui-content-compact');
        });

        $('[ui-nav]').on('click', 'a', function(e) {

            // locate href
            // if there is no submenu
            var href = $(this).attr('href');
            if(href){
                window.location.href = href;
            }

            // Open submenu
            var $this = $(e.target), $active;
            $this.is('a') || ($this = $this.closest('a'));

            $active = $this.parent().siblings( ".active" );
            $active && $active.toggleClass('active').find('> ul:visible').stop().slideUp(200);

            ($this.parent().hasClass('active') && $this.next().stop().slideUp(200)) || $this.next().stop().slideDown(200);
            $this.parent().toggleClass('active');

            $this.next().is('ul') && e.preventDefault();
        });

        if($('#ui').hasClass('ui-aside-compact')) {
            var uiHasCompact = true;
        }
        if($('#content').hasClass('ui-content-compact')) {
            var uiContentHasCompact = true;
        }

        function doneResizing() {
            if (Modernizr.mq('screen and (min-width:768px)')) {
                // action for screen widths including and above 768 pixels

                if(uiHasCompact === true) {
                    $('#ui').addClass('ui-aside-compact')
                }
                if(uiContentHasCompact === true) {
                    $('#content').addClass('ui-content-compact')
                }

            } else if (Modernizr.mq('screen and (max-width:767px)')) {
                // action for screen widths below 768 pixels
                // console.log('Moblie');

                if(uiHasCompact === true) {
                    $('#ui').removeClass('ui-aside-compact')
                }
                if(uiContentHasCompact === true) {
                    $('#content').removeClass('ui-content-compact')
                }

                $('[data-toggle="ui-nav"]').on('click', function(e){
                    e.preventDefault();

                    var hasAsideCompact = $('#ui').hasClass('ui-aside-compact'),
                    hasContentCompact = $('#content').hasClass('ui-content-compact');

                    if(hasAsideCompact) {
                        if(hasContentCompact) {
                            $('#content').removeClass('ui-content-compact');
                        }
                    }

                });

                $('[data-toggle="ui-aside-right"]').on('click', function(e){
                    e.preventDefault();

                    var hasAsideCompact = $('#ui').hasClass('ui-aside-compact'),
                    hasContentCompact = $('#content').hasClass('ui-content-compact');

                    if(hasContentCompact) {
                        if(hasAsideCompact) {
                            $('#ui').removeClass('ui-aside-compact');
                        }
                    }
                });
            }
        }

        var id;
        $(window).resize(function () {
            clearTimeout(id);
            id = setTimeout(doneResizing, 0);
        });

        doneResizing();

    });
    
}(jQuery);

(function($) {

    'use strict';

    $(document).ready(function() {

        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();

        // collapsible panel
        $('.panel .tools .collapse-box').click(function () {
            var el = $(this).parents(".panel").children(".panel-body");
            if ($(this).hasClass("fa-chevron-down")) {
                $(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
                el.slideUp(200);
            } else {
                $(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
                el.slideDown(200); }
        });

        // close panel
        $('.panel .tools .close-box').click(function () {
            $(this).parents(".panel").parent().remove();
        });

        // refresh panel

        $('.refresh-box').on('click', function(br) {
            br.preventDefault();
            $("<div class='refresh-block'><span class='refresh-loader'><i class='fa fa-spinner fa-spin'></i></span></div>").appendTo($(this).parents('.tools').parents('.panel-heading').parents('.panel'));

            setTimeout(function() {
                $('.refresh-block').remove();
            }, 1000);

        });

        // Auto size textarea
        autosize($('.autosize'));

        // searchCollapse
        $('.search-collapse').each(function() {
            var $searchInput = $('.form-control'),
            $searchBtn = $('.btn-search-collapse');

            $searchBtn.click(function(e) {
                e.preventDefault();
                $searchInput.toggleClass('form-control-open').focus();
            });

        });

        // niceScroll
        $(".niceScroll").niceScroll({
            cursorcolor : "#000000",
            cursoropacitymax : 0.3,
            cursorwidth : "8px",
            cursorborder : "2px solid transparent",
            cursordragontouch : true, // drag cursor in touch / touchbehavior mode also
            zindex : "10", // change z-index for scrollbar div
            cursorborderradius: "10px",
        });

    });

})(window.jQuery);

(function($) {

    $(document).ready(function() {

        'use strict';

        // Toggle Mail-nav
        // When click #toggle-mailbox-nav > .btn
        $('#toggle-mailbox-nav').click(function(e) {
            e.stopPropagation();
            $('.Mailbox-nav-aside').toggle();
        });

        // Return to Mail-list
        // when click .return-mail-list > a
        $('#return-mailbox-list > a').click(function(e) {
            e.preventDefault();
            $('.Mailbox-list').removeClass('Mailbox-list--slideLeft');
        });

        if ($(window).width() <= 767) {
            $('.Mail > a').click(function(e) {
                e.preventDefault();
                $('.Mailbox-list').addClass('Mailbox-list--slideLeft');
                $('.Mailbox-nav-aside').hide();
            });
        };
        $(window).resize(function() {
            if ($(window).width() <= 767) {
                $('.Mailbox-nav-aside').hide();
                $('.Mail > a').click(function(e) {
                    e.preventDefault();
                    $('.Mailbox-list').addClass('Mailbox-list--slideLeft');
                    $('.Mailbox-nav-aside').hide();
                });
            } else {
                $('.Mailbox-list').removeClass('Mailbox-list--slideLeft');
                $('.Mailbox-nav-aside').show();
                $('.Mail > a').click(function(e) {
                    $('.Mailbox-list').removeClass('Mailbox-list--slideLeft');
                    $('.Mailbox-nav-aside').show();
                });
            }
        });

        if ($(window).width() <= 1200) {
            $('.Mail > a').click(function(e) {
                e.preventDefault();
                $('.Mailbox-list').addClass('Mailbox-list--slideLeft');
            });
        };
        $(window).resize(function() {
            if ($(window).width() <= 1200) {
                $('.Mail > a').click(function(e) {
                    e.preventDefault();
                    $('.Mailbox-list').addClass('Mailbox-list--slideLeft');
                });
            } else {
                $('.Mailbox-list').removeClass('Mailbox-list--slideLeft');
                $('.Mail > a').click(function(e) {
                    $('.Mailbox-list').removeClass('Mailbox-list--slideLeft');
                });
            }
        });

    });

})(window.jQuery);

(function($) {
    
    $(document).ready(function() {

    'use strict';

    // Return to Mail-list
    // when click .return-mail-list > a
    $('.return-note-list').click(function(e) {
        e.preventDefault();
        $('.Note-aside').removeClass('Note-aside--slideleft');
    });

    if ($(window).width() <= 767) {
        $('.Note-list').on('click', '.Note', function(e){
            e.preventDefault();
            $('.Note-aside').addClass('Note-aside--slideleft');
        });
    };


    $(window).resize(function() {
        if ($(window).width() <= 767) {
            $('.Note-list').on('click', '.Note', function(e){
                e.preventDefault();
                $('.Note-aside').addClass('Note-aside--slideleft');
            });
        } else {
            $('.Note-aside').removeClass('Note-aside--slideleft');
            $('.Note-list').on('click', '.Note', function(e){
                e.preventDefault();
                $('.Note-aside').removeClass('Note-aside--slideleft');
            });
        }
    });

});

})(window.jQuery);