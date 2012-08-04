$(document).ready(function() {
  $('#search').keydown(function(e) {
    if (e.which == 13) {
      $('#search-form').submit();
    }
  })
});