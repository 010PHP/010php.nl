jQuery(function ($) {
    /**
     * Carousel slider
     */
    $(function () {
        $('#main-slider.carousel').carousel({
            interval: 5000,
            pause: false
        });
    });

    /**
     * smooth scroll
     */
    $('.navbar-nav > li').click(function (event) {
        event.preventDefault();
        var target = $(this).find('>a').prop('hash');
        $('html, body').animate({
            scrollTop: $(target).offset().top
        }, 500);
    });

    /**
     * scroll spy
     */
    $('[data-spy="scroll"]').each(function () {
        var $spy = $(this).scrollspy('refresh')
    });
});