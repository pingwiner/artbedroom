$(document).ready(function() {
  $('#catalog a').click(function(e) {
    var li = $(this).parent();
    var ul = li.find('> ul');
    if (ul.length > 0) {
      ul.toggle();
      e.preventDefault();
      e.stopPropagation();
      return false;
    }
  }); 
  $('#catalog ul').hide();
  $('#catalog > ul').show();
  
});