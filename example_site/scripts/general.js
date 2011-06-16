// Nicer margins for content images based on their position
$("#content img").each(function() {
  if ( $(this).css("float") == "left" ) {
    $(this).css("margin-left", "0px");
  } else if ( $(this).css("float") == "right" ) { 
    $(this).css("margin-right", 0);
  }
});