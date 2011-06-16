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
})(jQueryHTMLWarrior);

/**
 * Hide search input text on click
 */
(function($) {
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
})(jQueryHTMLWarrior);