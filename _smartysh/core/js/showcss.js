google.setOnLoadCallback(function() {
  $.ajax({
    url: '/_smartysh/style/'+partialName+'.css',
    success: function(data) {
      alert(data);
    }
  });
});