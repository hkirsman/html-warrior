/**
 * PHP round for js
 */
function round (value, precision, mode) {
    // http://kevin.vanzonneveld.net
    // +   original by: Philip Peterson
    // +    revised by: Onno Marsman
    // +      input by: Greenseed
    // +    revised by: T.Wild
    // +      input by: meo
    // +      input by: William
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Josep Sanz (http://www.ws3.es/)
    // +    revised by: Rafał Kukawski (http://blog.kukawski.pl/)
    // %        note 1: Great work. Ideas for improvement:
    // %        note 1:  - code more compliant with developer guidelines
    // %        note 1:  - for implementing PHP constant arguments look at
    // %        note 1:  the pathinfo() function, it offers the greatest
    // %        note 1:  flexibility & compatibility possible
    // *     example 1: round(1241757, -3);
    // *     returns 1: 1242000
    // *     example 2: round(3.6);
    // *     returns 2: 4
    // *     example 3: round(2.835, 2);
    // *     returns 3: 2.84
    // *     example 4: round(1.1749999999999, 2);
    // *     returns 4: 1.17
    // *     example 5: round(58551.799999999996, 2);
    // *     returns 5: 58551.8
    var m, f, isHalf, sgn; // helper variables
    precision |= 0; // making sure precision is integer
    m = Math.pow(10, precision);
    value *= m;
    sgn = (value > 0) | -(value < 0); // sign of the number
    isHalf = value % 1 === 0.5 * sgn;
    f = Math.floor(value);

    if (isHalf) {
        switch (mode) {
            case 'PHP_ROUND_HALF_DOWN':
                value = f + (sgn < 0); // rounds .5 toward zero
                break;
            case 'PHP_ROUND_HALF_EVEN':
                value = f + (f % 2 * sgn); // rouds .5 towards the next even integer
                break;
            case 'PHP_ROUND_HALF_ODD':
                value = f + !(f % 2); // rounds .5 towards the next odd integer
                break;
            default:
                value = f + (sgn > 0); // rounds .5 away from zero
        }
    }

    return (isHalf ? value : Math.round(value)) / m;
}

/**
 * Show overlay on page
 */
(function($) {
    var page = (document.location+"").split("/")[4].split(".")[0].split("?")[0];
    if (page.length==0) {
        page = "index";
    }
    var file = page+".png";
    var site = (document.location+"").split("/")[3];
    var opacity = $.cookie("psdOverlayOpacity")?$.cookie("psdOverlayOpacity"):0.4, top = $.cookie("psdOverlayTop")?$.cookie("psdOverlayTop"):0, left = $.cookie("psdOverlayLeft")?$.cookie("psdOverlayLeft"):0;
    var lock = false;

    var overlay = $("<img id=\"overlayImg\" src=\"/"+site+"/overlays/"+file+"\" alt=\"\" />");
    overlay.css({
        "position": "absolute",
        "z-index" : 9999,
        "top"     : top+"px",
        "left"     : left+"px",
        "opacity" : opacity,
        "display" : "none"
    });
    overlay.draggable({
        drag: function(e, ui) {
            if (lock || !e.ctrlKey) {
                return false;
            }
            top = ui.position.top;
            left = ui.position.left;

            $.cookie("psdOverlayTop", top);
            $.cookie("psdOverlayLeft", left);
        }
    });

    var controlsHTML = "<div>";
    controlsHTML += "<label style=\"display: block; padding: 5px 0;\">Opacity: <input id=\"overlayOpacity\" style=\"width: 20px\" type=\"text\" value=\""+opacity+"\" /></label>";
    controlsHTML += "<label style=\"display: block; padding: 5px 0 ;\">File: <input id=\"overlayFile\" style=\"width: 80px\" type=\"text\" value=\""+file+"\" /></label>";
    controlsHTML += "<label style=\"display: block; padding: 5px 0 ;\">Lock pos: <input id=\"overlayLock\" type=\"checkbox\" name=\"\" /></label>";
    controlsHTML += "<div><button style=\"background: black; color: white; padding: 4px 10px; \" id=\"overlayToggle\">Toggle</button> <button style=\"background: black; color: white; padding: 4px 10px; \" id=\"resetToggle\">Reset Pos.</button></div>";
    controlsHTML += "</div>";

    var controls = $(controlsHTML);
    controls.css({
        "position": "fixed",
        "z-index" : 10000,
        "top"     : "10px",
        "right"   : "10px"
    });

    //$("body").css("overflow-y", "scroll");
    $("body").append(overlay).append(controls);

    $("#resetToggle").click(function() {
        top = left = 0;
        $.cookie("psdOverlayTop", top);
        $.cookie("psdOverlayLeft", left);
        overlay.css({
            "top"     : top+"px",
            "left"    : left+"px"
        });
    });

    $("#overlayToggle").click(function() {
        if (opacity != 0) {
            opacity = 0;
        } else {
            opacity = $("#overlayOpacity").val();
        }
        $("#overlayImg").toggle();
        $(this).blur();
    });

    $("#overlayOpacity").keyup( function(e) {
        if (e.keyCode==38) {
            if ( $("#overlayOpacity").val()*1.0 < 1 ) {
                opacity =  round (($("#overlayOpacity").val()*1.0 + 0.1), 1);
            }
        } else if ( e.keyCode==40) {
            if ( $("#overlayOpacity").val()*1.0 > 0 ) {
                opacity =  round (($("#overlayOpacity").val()*1.0 - 0.1), 1);
            }
        }
    
        $.cookie("psdOverlayOpacity", opacity);

        $("#overlayOpacity").val(opacity);
        $("#overlayImg").css({
            "opacity": opacity
        });
    });

    $(document).keyup( function(e) {
    
        if (lock) {
            return false;
        }

        if (e.ctrlKey ) {
            e.isDefaultPrevented();

            if (e.shiftKey) {
                var step = 10;
            } else {
                var step = 1;
            }

            if (e.keyCode==38) { // up
                top -=  step;
            } else if ( e.keyCode==40) { // down
                top +=  step;
            } else if ( e.keyCode==37) { // left
                left -= step;
            } else if ( e.keyCode==39) { // right
                left += step;
            }

            $.cookie("psdOverlayTop", top);
            $.cookie("psdOverlayLeft", left);

            if ( e.keyCode==38 || e.keyCode==40 ) { // up or down
                overlay.css({
                    "top"     : top+"px"
                });
            } else if ( e.keyCode==37 || e.keyCode==39 ) {
                overlay.css({
                    "left"     : left+"px"
                });
            }
            return false;
        }
    });
    /*
  $("#overlayTopLeft").keyup( function(e) { 
    if (lock) {
      return false;
    }

    if (e.keyCode==38) { // up
      top -=  1;
    } else if ( e.keyCode==40) { // down
      top +=  1;
    } else if ( e.keyCode==37) { // left
      left -= 1;
    } else if ( e.keyCode==39) { // right
      left += 1;
    }

    $.cookie("psdOverlayTop", top);
    $.cookie("psdOverlayLeft", left);

    if ( e.keyCode==38 || e.keyCode==40 ) { // up or down 
      overlay.css({
        "top"     : top+"px"
      });
    } else if ( e.keyCode==37 || e.keyCode==39 ) {
      overlay.css({
        "left"     : left+"px"
      });
    }
  });
     */

    $("#overlayFile").keyup( function(e) {
        if (lock) {
            return false;
        }

        file =  $("#overlayFile").val();
        $.cookie("psdOverlayFile", file);
        $("#overlayImg").attr("src", "/"+site+"/overlays/"+file);
    });

  
    $("#overlayLock").click(function(e) {
        if ( this.checked ) {
            lock = true;
        } else {
            lock = false;
        }
    });
  
})(jQuery);

/**
 * Show template listing on top left corner of the output. Not in built html
 */
(function($) {

    var filelist_html = "<div id=\"protoSmartyFilelist\" style=\"background: black; line-height: 16px; font-size: 11px; opacity: 0.5; font-family: Verdana; position: fixed;top:0;left:-2000px; z-index: 10000;\"> \
    <div style=\"padding: 5px 10px; opacity: 1;\"> \
     \
    </div> \
  </div>";
    var filelist = $(filelist_html);
    var hoveringFilelist = false;

    filelist.bind({
        mouseenter: function() {
            hoveringFilelist = true;
        },
        mouseleave: function() {
            hoveringFilelist = false;
        }
    });

    var site = (document.location+"").split("/")[3];
    var page = (document.location+"").split("/")[4];

    $.ajax({
        type: "GET",
        url: "/_smartysh/filelist.php",
        data: "site_dir="+site+"&page="+page,
        success: function(msg){
            $("div", filelist).append(msg);
            $("body").append(filelist);
            var filelistWidth = filelist.width();
            var filelistHeight = filelist.height();

            if (smartysh_gup("template_list_opened")==1) {
                filelist.css("left", 0);
            }
     
            $(document).mousemove(function(e){
                if ( ( e.pageX < 1 && e.pageY < $(window).height() /*100+$(window).scrollTop()*/ ) || hoveringFilelist) {
                    filelist.css("left", 0);
                } else {
                    filelist.css("left", "-2000px");
                }
            });
        }
    });



})(jQuery);

/**
 * Get url property
 * @param string name parameter name to get from url
 */
function smartysh_gup( name )
{
    name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
    var regexS = "[\\?&]"+name+"=([^&#]*)";
    var regex = new RegExp( regexS );
    var results = regex.exec( window.location.href );
    if( results == null )
        return "";
    else
        return results[1];
}

/**
 * Alias for console.log
 */
function log(attr) {
    console.log(attr);
}