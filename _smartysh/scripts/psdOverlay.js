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
 * Partial edit links
 */
if (smartysh_config["show_partial_edit_links"]) {
    $(document).ready(function() {
        var partial_placeholder_prefix = smartysh_config["smartysh_prefix"]+"_placeholder";
        var partial_placeholders = new Array;
        var overlays_active = false;

        var start_placeholder, end_placeholder;
        var i = 0;
        $("body [id^="+partial_placeholder_prefix+"]").each(function(f) {
            var placeholder_id = this.id.split("__")[1];
            if (typeof partial_placeholders[placeholder_id] == "undefined") {
                partial_placeholders[placeholder_id] = new Array();
            }
            if(this.id.indexOf(partial_placeholder_prefix+"_begin")===0) {
                partial_placeholders[placeholder_id]["begin"] = $(this);
            } else if(this.id.indexOf(partial_placeholder_prefix+"_end")===0) {
                partial_placeholders[placeholder_id]["end"] = $(this);
                i++;
            }
        });

        $(document).keydown(function(e) {
            if (e.ctrlKey && e.shiftKey) {
                if (!overlays_active) {
                    draw_partial_overlays();
                }
            }
        });
        $(document).keyup(function(e) {
            if (e.ctrlKey || e.shiftKey) {
                if (overlays_active) {
                    remove_partial_overlays();
                }
            }
        });

        function draw_partial_overlays() {
            var partial_overlay_class = smartysh_config["smartysh_prefix"]+"_partial_overlay";
            var zIndex = 99999;
            for(key in partial_placeholders) {
                var partial_start = partial_placeholders[key]["begin"];
                var id = partial_start.attr("id").split("__")[1];
                var partial_end = partial_placeholders[key]["end"];
                var next_from_partial_start = partial_start.next(":visible");
                var prev_from_partial_end = partial_end.prev(":visible");
                var next_from_partial_start_offsets = next_from_partial_start.offset();
                var prev_from_partial_end_offsets = prev_from_partial_end.offset();
                // skip hidden layers
                if ( next_from_partial_start_offsets === null || prev_from_partial_end_offsets === null ) {
                    continue;
                }
                var top = next_from_partial_start_offsets.top;
                var left = next_from_partial_start_offsets.left;
                // width and height calc we'll have to better i think
                var width = next_from_partial_start.width();
                //var height = prev_from_partial_end.top-top + prev_from_partial_end.height();
                var height = prev_from_partial_end_offsets.top-top+prev_from_partial_end.height()-1;
                var partial_overlay = $('<a href="'+smartysh_partial_edit_links[id].path_edit+'" class="'+partial_overlay_class+'" style="position:absolute;top:'+top+'px;left:'+left+'px;width:'+width+'px;height:'+height+'px;background:red;z-index:'+zIndex+';opacity:0.8;">'+smartysh_partial_edit_links[id].name+'</a>');
                $("body").append(partial_overlay);
                zIndex++;
            }
            overlays_active = true;
        }

        function remove_partial_overlays() {
            $(".smartysh_partial_overlay").remove();
            overlays_active = false;
        }

    });
}