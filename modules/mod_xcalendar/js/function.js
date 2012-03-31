jQuery(function($){
	$('.xcalbtn').live('click', function(e){
		e.preventDefault();
		url=$(this).attr('href');
		$('div#mod_xcalendar').load(url+' div#mod_xcalendar');
	});
});