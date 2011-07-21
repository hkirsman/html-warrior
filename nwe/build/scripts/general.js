// Nicer margins for content images based on their position
$(".textpage img").each(function() { 
  if ( $(this).css("float") == "left" ) {
    $(this).css("margin-left", "0px");
  } else if ( $(this).css("float") == "right" ) { 
    $(this).css("margin-right", 0);
  }
});

// Hide search input text on click
$("input.placeholder").each(function() {
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
});

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
  makeMenuWork("#nav li");
  makeMenuWork("#splash-menu li");
})(jQuery); 

// Disable empty links
$("a").each(function() {
  if (!$(this).attr('href')) {
    $(this).click(function() {
      return false;
    });
  }
});



jQuery(document).ready(function() { 

  /*
    Nav popup
  */
  (function($) {

    var popup_html = ''+
      '<div id="nav-popup" class="daxregular">'+
      '  <ul id="nav-popup-inner">'+
      '    <li><a href="">Ajalugu</a></li>'+
      '    <li><a class="active" href="">Missioon</a></li>'+
      '    <li><a href="">Visioon</a></li>'+
      '    <li><a href="">Usaldus</a></li>'+
      '  </ul>'+
      '</div>';

    var popup = jQuery(popup_html);
    var hoveringOnNav = false;
    var hoveringOnNavPopup = false;
    var timer;
    var closeTimeout = 100;
    var currentActiveNav;

    jQuery("#nav > ul > li.cat-item > a").bind({
      mouseenter: function() { 
        hoveringOnNav = true;
        hoveringOnNavPopup = false;
        
        popup.remove();

        if ( jQuery(".children", jQuery(this).parent()).length ) {
          var offsets = getOffsets( this );
          jQuery(".a", popup).html("");
          jQuery(".children .cat-item a", jQuery(this).parent()).each(function(i) { 
            a = jQuery(this).clone();
            jQuery(".a", popup).append(a);
          });
          popup.css({"left": offsets.x-87+"px", "top": offsets.y+50+"px"});

          popup.bind({
            mouseenter: function() { 
              hoveringOnNavPopup = true;
            },
            mouseleave: function() {
              hoveringOnNavPopup = false;
              timer = setTimeout(__close, closeTimeout);

              function __close() { 
                if (!hoveringOnNav && !hoveringOnNavPopup) {
                  popup.remove()
                }
              }
            }
          }); 
          jQuery("body").append(popup);
        }
      },
      mouseleave: function() {
        hoveringOnNav = false;
        timer = setTimeout(__close, closeTimeout);

        function __close() { 
          if (!hoveringOnNav && !hoveringOnNavPopup) {
            popup.remove();
          }
        }
      }
    });
  })(jQuery); 

  /*
    Nav popup
  */
  (function($) {
    var
      stepHeight = 346,
      stepCount = false,
      splash_content_wrapper = $("#splash-content-wrapper");

    $("#splash-menu a").bind({
      "click" : function() {
        var index = $(this).data("index");
        slideTo(index);

        var li = $(this).parent();
        var all_lis = li.siblings();
        all_lis.removeClass("active");
        li.addClass("active");

        return false;
      }
    }).each(function(i) {
      $(this).data("index", i);
    });

    function slideTo(index) {
      splash_content_wrapper.animate({
        top: index*stepHeight*(-1)
      }, 300, 'swing', function() {
        // Animation complete.
      });
    }

  })(jQuery); 
});

