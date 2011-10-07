// Nicer margins for content images based on their position
$(".textpage img").each(function() {
    if ( $(this).css("float") == "left" ) {
        $(this).css("margin-left", "0px");
    } else if ( $(this).css("float") == "right" ) {
        $(this).css("margin-right", 0);
    }
});

// Hide input text on click
$("input.placeholder").placeholder();

// IE Safari detect ( for button fixes )
(function($) {
    var userAgent = navigator.userAgent.toString().toLowerCase();
    if ((userAgent.indexOf('safari') != -1) && !(userAgent.indexOf('chrome') != -1) && (navigator.platform=="Win32" || navigator.platform=="Win64")) {
        $("body").addClass("safari");
    }
})(jQuery);