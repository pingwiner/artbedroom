var template = '';

function title(text) {
  var id = $('#fancybox-img').attr('src').split('/')[4];  
  var txt = template.replace('ID', id);
  return txt.replace('(TITLE)', 'Купить "' + text + '"');
}

$(document).ready(function() {
  template = $('#fancy-title').html();
  $('#fancy-title').html('');
  $("a.product_preview").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
    'titleFormat': title,
    'overlayShow': true,
    'overlayOpacity': 0.8,
    'overlayColor': '#000'
	});
});