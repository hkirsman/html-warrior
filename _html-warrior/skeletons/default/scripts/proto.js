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