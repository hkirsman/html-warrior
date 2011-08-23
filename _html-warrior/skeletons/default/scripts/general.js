// Nicer margins for content images based on their position
$(".textpage img").each(function() { 
  if ( $(this).css("float") == "left" ) {
    $(this).css("margin-left", "0px");
  } else if ( $(this).css("float") == "right" ) { 
    $(this).css("margin-right", 0);
  }
});

// Hide search input text on click
$.fn.placeholder = function() {
    return $(this).each(function(){
        var value = $(this).val();
        var input = $(this).prev();
        input
        .focus(function() {
            if ($(this).val() == value) {
                $(this).val('');
            }
        })
        .blur(function() {
            if($(this).val() == '') {
                $(this).val(value);
            }
        })
        .closest('form').submit(function() {
            if (input.val() == value) {
                input.val('');
            }
        });
        if(input.val() == '') {
            input.val(value);
        }
    })
}
$("input.placeholder").placeholder();

// IE Safari detect ( for button fixes )
(function($) {
 var userAgent = navigator.userAgent.toString().toLowerCase();
 if ((userAgent.indexOf('safari') != -1) && !(userAgent.indexOf('chrome') != -1) && (navigator.platform=="Win32" || navigator.platform=="Win64")) {
  $("body").addClass("safari");
 }
})(jQuery); 

// Test menu .active class
(function($) {
  function makeMenuWork(clickableSelector) { 
    var root = $(clickableSelector.split(" ")[0]);
    var items = $(clickableSelector);
    items.click(function() {
      $(".active", root).removeClass("active");
      $(this).addClass("active");
    });
  }
  //makeMenuWork(".catlist .item");
})(jQuery); 

// Disable empty links
$("a").each(function() {
  if (!$(this).attr('href')) {
    $(this).click(function() {
      return false;
    });
  }
});

/**
 * Get url property
 * @param string name parameter name to get from url
 */
function gup( name ) {
    name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
    var regexS = "[\\?&]"+name+"=([^&#]*)";
    var regex = new RegExp( regexS );
    var results = regex.exec( window.location.href );
    if( results == null )
        return "";
    else
        return results[1];
}

// change to print.css when ?print=1 in url
(function($) {
    if (gup('print')=='1') {
        $('link[media=print]').attr('media', 'all')
    }
})(jQuery);