jQuery(function ($){
	$('.xcalendar .event a').live('click', function(e){
		e.preventDefault();
		$('#fin').remove();
		$parent=$(this).parent();
		$fin=$($parent).children('.spanEv').html();
		
		$left=$('.xcalendar').offset().left+$('.xcalendar').width()+10;
		$top=$('.xcalendar').offset().top -45;
		
		$('body').append('<div style="position:absolute; left:'+$left+'px; top:'+$top+'px;" id="fin">Veranstaltung am '+$(this).parent().children('.date').html()+'<a class="close" href="#">X</a><span class="clr"></span>'+$fin+'</div>');
		$('#fin .close').live('click', function (e){
			e.preventDefault();
			$('#fin').remove();
		});
	});
});