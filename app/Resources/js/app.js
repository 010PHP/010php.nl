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
     * Initialize the countdown timer in the meetup block. Will retrieve the timestamp from the hidden
     * span element below the the meetup block.
     */
    $('#finalCountdownTimer').countdown($('#finalCountdownTimerTimeytime').html(), function (event) {
        $(this).html(event.strftime('Starts in %w weeks, %d days, %H hours, %M minutes, and %S seconds'));
    });
});