$(function(){
	$('#assignments').dataTable({
		sPaginationType: 'full_numbers',
	});
	$('#assignments .edit').click(function(){
		var user_id=$(this).parents('tr').data('user-id');
		
		$(this).html('Loading...');
		window.location.href='users/'+user_id;
	});
});