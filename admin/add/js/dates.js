jQuery(function($){
	
	/*			
	$('#add').live('click', function(e){
		e.preventDefault();

		newdate=$('.data').attr('value')+', ';
		dates=$('.date').attr('value');
		$('.date').attr('value', dates+newdate);
		$('#dTable').append('<tr class="ddd"><td class="di">'+$('.data').attr('value')+'</td><td><a class="del" href="#">Delete</a></td></tr>');
		$('.data').attr('value', '');
	});

	

	$('.del').live('click', function(e){
		e.preventDefault();

		tr=$(this).parent('td').prev().html();
		$(this).parent('td').parent('tr').prev().html();
	});*/

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