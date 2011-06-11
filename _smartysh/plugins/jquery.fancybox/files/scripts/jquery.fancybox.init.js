/*
   Example:
   onclick="initFancybox(false,'example.fbox.html')"
*/
function initFancybox(selector,href, optsExtend) {
  var opts = {
    'type'            : 'ajax',
    'padding'		      : 0,
    'transitionIn'	  : 'none',
    'transitionOut'	  : 'none',
    "margin"	        : 0,
    "scrolling"       : "no",
    "autoScale"	      : false,
    "autoDimensions"  :  true,
    "overlayOpacity"  : 0.26,
    "overlayColor"    : "#000",
    "titleShow"       : false,
    "showCloseButton" : true,
    "showNavArrows"   : false,
    "overlayShow"     : false/*,
    "onComplete"      : function() {
      initFancybox(".fbox .fboxLink");
      $(".fboxDialogTabs").tabs("div.fboxDialogPanes > div", {tabs: 'li'});
    }*/
  };
  if (typeof selector == "undefined" ) {
    var selector = ".fboxLink";
  } else if ( selector == false) {
    var selector = ".fboxLink";
  }

  if ( typeof optsExtend !== "undefined" ) {
    
    if ( typeof optsExtend.width !== "undefined" ) {
      optsExtend.autoDimensions = false;
    }

    jQuery.extend( opts, optsExtend );
  }

  if (typeof href !== "undefined" ) {
    if ( href !== false ) {
      jQuery.extend(opts, {'href':href});
    } else { 
      delete(opts.type);
    }
    opts.href = false;
    $.fancybox(opts);
  } else {
    $(selector).fancybox(opts);
  }

  return false;
}
initFancybox();

/*
   Example:
   onclick="initFancyboxIframe('example.fbox.html')"
*/
function initFancyboxIframe(href, optsExtend) {
  var opts = {
    'type'            : 'iframe',
    'padding'		      : 0,
    'transitionIn'	  : 'none',
    'transitionOut'	  : 'none',
    "margin"	        : 0,
    "scrolling"       : "no",
    "autoScale"	      : false,
    "autoDimensions"  : false,
    "width"           : 700,
    "height"          : 390,
    "overlayOpacity"  : 0.26,
    "overlayColor"    : "#000",
    "titleShow"       : false,
    "showCloseButton" : true,
    "showNavArrows"   : false,
    "overlayShow"     : false/*,
    "onComplete"      : function() {
      $("#fancybox-frame")
        .css("height", "357px")
        .wrap('<div class="fbox fboxLarge"><div class="content"></div></div>');
      $("#fancybox-content .fbox").prepend('<div class="header"><div>'+this.title+'</div></div>');
    }*/
  };
  
  if ( typeof optsExtend !== "undefined" ) {
    jQuery.extend( opts, optsExtend );
  }

  if (typeof href != "undefined" ) {
    jQuery.extend(opts, {'href':href});
    $.fancybox(opts);
  } else {
    $(".fboxLinkIframe").fancybox(opts);
  }
  return false;
}
initFancyboxIframe();

$(document).ready(function() { 
  initFancybox(false,false, { 
    "width": 500,
    "height": "auto",
    "content": '<div class="msgFbox"><div class="title">Viga vormi täitmisel</div><div class="clear"></div><div class="content def"><p>Suspendisse vulputate.</p></div>'
  });
});