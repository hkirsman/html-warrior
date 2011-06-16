google.setOnLoadCallback(function() {
  $.ajax({
    url: +'/_html-warrior/style/'+partialName+'.css',
    success: function(data) {
      alert(data);
    }
  });
});