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

// Get element coordinates
function getOffsets(el) {        
    var o = {x : el.offsetLeft, y : el.offsetTop};        
    if (el.offsetParent != null) {
        var po = getOffsets(el.offsetParent);
        o.x += po.x;
        o.y += po.y;              
    }
    return o;
}

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