$(function(){
	$('#tabs').tabs();
	$(document)
		.on('click','.change_status.button',function(){
			var assignment_id=$('#assignment-options').data('assignment-id');
			var status=$('select[name="status"]').val();
			window.location.href='/assignments/update_status/'+assignment_id+'/'+status;
		})
		.on('click','.assign_tech.button',function(){
			var assignment_id=$('#assignment-options').data('assignment-id');
			var tech_assigned=$('input[name="tech_assigned"]').val();
			window.location.href='/assignments/update_tech/'+assignment_id+'/'+tech_assigned;
		});
	$('#final-report-editor').redactor({
		minHeight: 250,
	});
	$('.attachment .image').fancybox();
});
