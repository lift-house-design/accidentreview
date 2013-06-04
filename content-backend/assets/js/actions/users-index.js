$(function(){
	$('#assignments').dataTable({
		sPaginationType: 'full_numbers',
	});
	$(document)
		.on('click','#assignments .edit',function(){
			var user_id=$(this).parents('tr').data('user-id');
			
			$(this).html('Loading...');
			window.location.href='users/'+user_id;
		})
		.on('click','#assignments .delete',function(){
			if(confirm('Are you sure you want to remove that account?'))
			{
				var id=$(this).parents('tr').data('user-id');
				$(this).html('Loading...');
				window.location.href='/users/'+id+'/delete';
			}
		});
});