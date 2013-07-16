$(function(){
	$('.phone').mask('(999) 999-9999');

	$('input[name="role"]').change(function(){
		if($(this).val()=='client_admin')
			$('#client-administrator-options').show();
		else
			$('#client-administrator-options').hide();
	});
});