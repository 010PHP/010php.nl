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

    /**
     * Initialize the countdown timer in the meetup block. Will retrieve the timestamp from the hidden
     * span element below the the meetup block.
     */
    $('#finalCountdownTimer').countdown($('#finalCountdownTimerTimeytime').html(), function (event) {
        $(this).html(event.strftime('Starts in %w weeks, %d days, %H hours, %M minutes, and %S seconds'));
    });
});