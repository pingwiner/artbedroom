$(document).ready(function() {
  if ($('#color option').length == 0) {
    $('.field-color').hide();    
  }
  if ($('#size option').length == 0) {
    $('.field-size').hide();    
  }
  
  $('#submit-order').click(function() {
    var id = $('#product-id').val();
    var color = $('#color').val();
    var size = $('#size').val();
    var phone = $('#phone').val();
    var username = $('#username').val();
    var message = $('#message').val();
    
    if (phone == '') {
      alert('Пожалуйста укажите Ваш контактый телефон.');
      return;
    }
    $.post('/buy', {
      id: id,
      color: color,
      size: size,
      phone: phone,
      username: username,
      message: message
    }, function(data) {
      
    });
    $('#myModal').modal('hide');
    $('#modalOk').modal('show');      
  })
  
});