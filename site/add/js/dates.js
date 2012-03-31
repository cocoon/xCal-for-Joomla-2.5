jQuery(function($){

	$( ".data" ).live('focus', function(){
		$(this).datepicker({ dateFormat: 'yy-mm-dd'});
	});

	$('#add').live('click', function(e){
		e.preventDefault();
		$('#dTable').append('<tr><td><input class="data" type="text" name="d"/></td><td><a class="del" href="#">Delete</a></td></tr>');
	});

	$( ".ui-state-default" ).live('click', function(){
		$array=$('#dTable input').serialize();
		$('input.date').attr('value', $array);
	});

	$('.del').live('click', function(e){
		e.preventDefault();
		$(this).parent().parent('tr').remove();
		$array=$('#dTable input').serialize();
		$('input.date').attr('value', $array);
	});

});