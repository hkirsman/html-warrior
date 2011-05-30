(function($) { 
  var atags = $(".col a");

  $("#filter").keyup(function(e) { 
    var foundAtags = atags.not("a[project*="+this.value+"]");
    var foundAtagsCount = atags.length-foundAtags.length;

    atags.css({"display": "block"})
    if (foundAtagsCount) {
      foundAtags.css({"display": "none"});
    }    
  });

  $("#clearbutton").click(function() { 
    atags.css({"display": "block"})
  });
})(jQuerySmartysh);