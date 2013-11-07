$(function(){
	$('#tabs').tabs({
		active:activeTab
	});
	$('.image').fancybox();
	console.log($('.image').html());

	var confirmLeave=false;
	var initialChange=false;

	$(document)
		.on('click','.change_status.button',function(){
			var assignment_id=$('#assignment-options').data('assignment-id');
			var status=$('select[name="status"]').val();
			window.location.href='/assignments/update_status/'+assignment_id+'/'+status;
		})
		.on('click','.assign_tech.button',function(){
			var assignment_id=$('#assignment-options').data('assignment-id');
			var tech_assigned=$('input[name="tech_assigned"]:checked').val();
			window.location.href='/assignments/update_tech/'+assignment_id+'/'+tech_assigned;
		})
		.on('submit','#findings form',function(e){
			if(confirm('Are you sure you want to save your findings?'))
			{
				confirmLeave=false;
				return true;
			}
			else
			{
				e.preventDefault();
				return false;
			}
		})
		.on('change','#findings select[name="findings_version"]',function(){
			$('#findings-version')
				.after(
					$('<p>')
						.css('font-style','italic')
						.html('Loading version, please wait...')
				);
			$(this).attr('disabled','disabled');
			window.location.href=window.location.pathname+'?v='+$(this).val()+'&t=5';
		});
	
	$('#final-report-editor').redactor({
		minHeight: 250,
		changeCallback: function(html){
			if(initialChange===false)
				initialChange=true;
			else
				confirmLeave=true;
		},
	});

	$(window).bind('beforeunload',function(){
		if(confirmLeave)
		{
			return 'You have unsaved changes to the final report. Are you sure you want to continue without saving?';
		}
	});	
});