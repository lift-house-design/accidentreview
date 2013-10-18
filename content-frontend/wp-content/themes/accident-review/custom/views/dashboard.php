<script src="/wp-content/themes/accident-review/js/jquery-1.9.1.min.js"></script>
<script src="/wp-content/themes/accident-review/js/jquery-ui-1.10.2.min.js"></script>
<script src="/wp-content/themes/accident-review/js/fancybox/jquery.fancybox.js"></script>
<script src="/wp-content/themes/accident-review/js/jquery.ui.widget.js"></script>
<script src="/wp-content/themes/accident-review/js/jquery.iframe-transport.js"></script>
<script src="/wp-content/themes/accident-review/js/jquery.fileupload.js"></script>
<!--script src="/wp-content/themes/accident-review/js/assignment-panel.js"></script-->
<link rel="stylesheet" href="/wp-content/themes/accident-review/jquery-ui-base.css" />
<link rel="stylesheet" href="/wp-content/themes/accident-review/jquery-ui-accordion.css" />
<link rel="stylesheet" href="/wp-content/themes/accident-review/jquery-ui-datepicker.css" />
<link rel="stylesheet" href="/wp-content/themes/accident-review/jquery-ui-button.css" />
<link rel="stylesheet" href="/wp-content/themes/accident-review/js/fancybox/jquery.fancybox.css" />
<div style="display: none;" id="assignment-updates">
	<table>
		<tbody>
		<?php foreach($assignment_updates as $update): ?>
			<tr>
				<td><a class="update" data-assignment-id="<?php echo $update['job_id'] ?>"><?php echo $update['message'] ?></a></td>
				<td class="arn">AR #<?php echo $update['job_id'] ?></td>
				<td><a class="remove button" data-update-id="<?php echo $update['id'] ?>">Remove</a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
<div id="dashboard">
		<h3>Create New Assignment</h3>
		<div id="new-assignment">
			<p>Assignments are completed within 24 hours. Please select a job assignment type below:</p>
			<div class="assignment-list">
  				<a class="vehicle-theft-analysis">Vehicle Theft Analysis</a>
			    <a class="accident-reconstruction">Collision Analysis/Reconstruction</a>
			    <a class="fire-analysis">Vehicle Fire Analysis</a>
			    <a class="mechanical-analysis">Mechanical Analysis</a>
			    <!--a class="physical-damage-comparison">Physical Damage Analysis</a-->
			    <a class="report-review">Report Review</a>
			    <a class="other">Other</a></li>
			</div>
			<a class="show services">Learn more about assignment types &raquo;</a>
			<script>
				function close_new_assignments()
				{
					if(confirmLeave)
					{
						if(confirm('You have unsaved changes to your new assignment that will be lost. Are you sure you want to close it?')==false)
							return false;
						else
							confirmLeave=false;
					}

					$('input[type="text"].date').datepicker('destroy');
					$('.assignment-list a').removeClass('selected');
					$('.assignment-list > .new-assignment-panel').remove();

					return true;
				}
				
				$(function(){
					function open_new_assignment(a)
					{
						if(close_new_assignments())
						{
							var type=$(a).attr('class');
						
							var newAssignmentPanel=$('<div>')
								.addClass('new-assignment-panel')
								.html('Loading, please wait...')
								.load('/wp-admin/admin-ajax.php',{
									action: 'get-new-assignment-panel',
									assignment_type: type,
								},function(){
									var offset=$(a).offset();
									$('html, body').animate({
										scrollTop: offset['top']
									}, 'slow');
								});
								
							$(a)
								.addClass('selected')
								.after(newAssignmentPanel);
						}
					}
					
					$('.assignment-list > a')
						.click(function(){
							if($(this).hasClass('selected'))
							{
								close_new_assignments();
							}
							else
							{
								open_new_assignment(this);
							}
						});
				});
			</script>
		</div>
		<h3>Assignments</h3>
		<div>
		<?php
			global $wpdb;
			$userData=ar_user_data();
			
			if($userData['role']=='client_admin')
			{
				$sql=$wpdb->prepare('
					select
						client_rep_id
					from
						ar_admin_clients
					where
						client_admin_id = %d
				',$userData['id']);
				$user_ids=$wpdb->get_col($sql);
				$user_ids[]=$userData['id'];

				$sql=$wpdb->prepare('
					select
						*
					from
						ar_job
					where
						client_user_id in ('.implode(',',$user_ids).') and
						type IS NOT NULL and
						autosave = 0
				');
			}
			else
			{
				$sql=$wpdb->prepare('
					select
						*
					from
						ar_job
					where
						client_user_id = %d and
						type IS NOT NULL and
						autosave = 0
				',$userData['id']);
			}

			$jobs=$wpdb->get_results($sql,'ARRAY_A');
			
			if(empty($jobs))
			{
				?><p>You currently have no assignments to display.</p><?
			}
			else
			{
			?>
				<script src="<?php bloginfo('stylesheet_directory') ?>/js/jquery.dataTables.min.js"></script>
				<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/jquery.dataTables.css" />
				<script>
					$(function(){
						assignments_datatable=$('#assignments').dataTable({
							sPaginationType: 'full_numbers',
							/*iDisplayLength: 2,*/
						});
						
						function close_assignments()
						{
							$('#assignments tbody tr').removeClass('selected');
							$('#assignments tbody .assignment-panel').remove();
						}
						
						function open_assignment(row)
						{
							// Close any assignments currently open
							close_assignments();
							
							var cellCount=$(row).find('td').length;
							var assignmentID=$(row).data('assignment-id');
							var assignmentPanel=$('<tr>')
								.addClass('assignment-panel')
								.append(
									$('<td>')
										.attr('colspan',cellCount)
										.html('Loading, please wait...')
										.load('/wp-admin/admin-ajax.php',{
											action: 'get-assignment-panel',
											id: assignmentID
										})
								);
							
							$(row)
								.addClass('selected')
								.after(assignmentPanel);
						}
						
						function close_details()
						{
							$('#assignments .assignment-details > tbody > tr').removeClass('selected');
							$('#assignments .assignment-details .details-panel').hide();
						}
						
						function open_details(row)
						{
							close_details();
							
							$(row)
								.addClass('selected')
								.next('.details-panel')
								.show();
						}
						
						$(document)
							.on('click','#assignments > tbody > tr:not(.assignment-panel)',function(){
								if($(this).hasClass('selected'))
								{
									close_assignments();
								}
								else
								{
									open_assignment(this);
								}
							})
							.on('click','#assignments .assignment-details > tbody > tr:not(.details-panel)',function(){
								if($(this).hasClass('selected'))
								{
									close_details();
								}
								else
								{
									open_details(this);
								}
							});
					});
				</script>
				<table id="assignments">
					<thead>
						<tr>
							<th>File #</th>
							<th>Status</th>
							<th>Insured</th>
							<th>Date of Loss</th>
							<th>AR #</th>
							<th>Submitted</th>
							<th>Loss Type</th>
							<th>AR Tech</th>
							<?php if($userData['role']=='client_admin'): ?>
							<th>Rep</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody>
					<?php foreach($jobs as $job): ?>
						<?php
							$job['tech_name']='Unassigned';
							if(!empty($job['tech_user_id']))
							{
								$tech=ar_user_data($job['tech_user_id']);
								$job['tech_name']=$tech['first_name'].' '.$tech['last_name'];
							}
							
							$job['date_of_loss_displayed']='';
							if($job['date_of_loss']!='0000-00-00')
								$job['date_of_loss_displayed']=date('m/d/Y',strtotime($job['date_of_loss']));
								
							$job['submitted_displayed']=date('m/d/Y h:ia',strtotime($job['created_at']));

							if($userData['role']=='client_admin')
							{
								if($job['client_user_id']==$userData['id'])
								{
									$job['rep_name']='<strong>You</strong>';
								}
								else
								{
									$rep=ar_user_data($job['client_user_id']);
									$job['rep_name']=$rep['first_name'].' '.$rep['last_name'];
								}
							}
						?>
						<tr data-assignment-id="<?php echo $job['id'] ?>">
							<td><?php echo $job['file_number'] ?></td>
							<td><?php echo $job['status'] ?></td>
							<td><?php echo $job['insured_name'] ?></td>
							<td><?php echo $job['date_of_loss_displayed'] ?></td>
							<td><?php echo $job['id'] ?></td>
							<td><?php echo $job['submitted_displayed'] ?></td>
							<td><?php echo ar_get_assignment_type_name($job['type']) ?></td>
							<td><?php echo $job['tech_name'] ?></td>
							<?php if($userData['role']=='client_admin'): ?>
							<td><?php echo $job['rep_name'] ?></td>
							<?php endif; ?>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<?php
			}
		?>
		</div>
		<h3>Services</h3>
		<div>
			stuff
		</div> 
		<h3>User Guide</h3>
		<div>
			<h4>Make a New Assignment</h4>
			<ul>
				<li>Choose an assigment type from the list of assignment types on the <strong>Make New Assignment</strong> tab of the dashboard.</li>
				<li>Upload filedds and photos related to the case, and click the <strong>Submit Files</strong> button.</li>
				<li>Select the <strong>Date of Loss</strong>.</li>
				<li>Enter the <strong>Internal Claim ID</strong>.</li>
				<li>Describe the loss in chronological order.</li>
				<li>Describe the services requested.</li>
				<li>If you have the VIN number:
					<ul>
						<li>Click the <strong>VIN Available</strong> button.</li>
						<li>Enter the VIN number.</li>
					</ul>
				</li>
				<li>If you do not have the VIN number:
					<ul>
						<li>Click the <strong>VIN Not Available</strong> button.</li>
						<li>Choose the year, make and model from the dropdown options.</li>
						<li>Enter the owner's name, owner type, vehicle color and plate number.</li>
					</ul>
				</li>
				<li>List any modifications or aftermarket equipment.</li>
				<li>Enter any additional information about the vehicle.</li>
				<li>Read the terms of service thoroughly, then click the <strong>Submit</strong> button.</li>
			</ul>
			<h4>Edit an Existing Assignment</h4>
			<ul>
 				<li>Click the <strong>Assignments</strong> tab on the dashboard. A table will appear listing assignments you have submitted.</li>
				<li>Locate your assigmnent. It may either be in the <strong>Open</strong> or <strong>Pending</strong> tab, depending on your assignment's status.</li>
				<li>In the action column, you can choose to either <strong>View</strong> or <strong>Edit</strong> your assignment. You will also have the option to edit if you are simply viewing it.</li>
				<li>Refer to the <strong>Make a New Assignment</strong> instructions above for help with what information you should enter.</li>
			</ul>
		</div>
		<h3>FAQ</h3>
		<div>
		<?php for($i=0;$i<3;$i++): ?>
			<div class="question">Question 1</div>
			<p class="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque accumsan porttitor tristique.
			Aenean vel neque et risus pretium tincidunt. Etiam vestibulum blandit venenatis. Ut eget ante id
			libero ultricies vulputate. Pellentesque vehicula ultrices lorem eget mollis. Praesent varius, quam
			ac pharetra suscipit, nibh purus bibendum est, et porttitor nulla nibh at mauris. Maecenas eget
			cursus orci. In hac habitasse platea dictumst. Mauris ullamcorper sapien et est vehicula lacinia.
			Sed sodales, nulla quis fringilla lobortis, augue sapien vestibulum enim, volutpat mattis turpis
			erat a magna.</p>
		<?php endfor; ?>
		</div>
		<h3>Account Information</h3>
		<div>
		<?php
			$userData=ar_user_data();
			
			$userID = $userData['id'];
			
			$fn = $userData['first_name'];
			$ln = $userData['last_name'];
			$company = $userData['company_name'];
			$street = $userData['street_address'];
			$city = $userData['city'];
			$state = $userData['state'];
			$zip = $userData['zip'];
			$email = $userData['email'];
			$phone = $userData['phone'];
			$mobile = $userData['mobile'];
			$fax = $userData['fax'];
			
		?>
		
			<h4><a name="account-info"></a>General Information</h4>
			<div class="editable-field" data-name="first_name">
				<label>First Name</label>
				<span class="field"><?php echo $fn ?></span>
				<a class="edit">Edit</a>
			</div>
			<div class="editable-field" data-name="last_name">
				<label>Last Name</label>
				<span class="field"><?php echo $ln ?></span>
				<a class="edit">Edit</a>
			</div>
			<div class="editable-field" data-name="email">
				<label>E-mail</label>
				<span class="field"><?php echo $email ?></span>
				<a class="edit">Edit</a>
			</div>
			<div class="editable-field" data-name="company_name">
				<label>Insurance Company</label>
				<span class="field"><?php echo $company ?></span>
				<a class="edit">Edit</a>
			</div>
			<?php //if(!empty($street)): ?>
				<div class="editable-field" data-name="street_address">
					<label>Street Address</label>
					<span class="field"><?php echo $street ?></span>
					<a class="edit">Edit</a>
				</div>
			<?php //endif; ?>
			<?php //if(!empty($city)): ?>
				<div class="editable-field" data-name="city">
					<label>City</label>
					<span class="field"><?php echo $city ?></span>
					<a class="edit">Edit</a>
				</div>
			<?php //endif; ?>
			<?php //if(!empty($state)): ?>
				<div class="editable-field" data-name="state">
					<label>State</label>
					<span class="field"><?php echo $state ?></span>
					<a class="edit">Edit</a>
				</div>
			<?php //endif; ?>
			<?php //if(!empty($zip)): ?>
				<div class="editable-field" data-name="zip">
					<label>Zip Code</label>
					<span class="field"><?php echo $zip ?></span>
					<a class="edit">Edit</a>
				</div>
			<?php //endif; ?>
			<?php //if(!empty($phone)): ?>
				<div class="editable-field" data-name="phone">
					<label>Phone</label>
					<span class="field"><?php echo $phone ?></span>
					<a class="edit">Edit</a>
				</div>
			<?php //endif; ?>
			<?php //if(!empty($mobile)): ?>
				<div class="editable-field" data-name="mobile">
					<label>Mobile</label>
					<span class="field"><?php echo $mobile ?></span>
					<a class="edit">Edit</a>
				</div>
			<?php //endif; ?>
			<?php //if(!empty($fax)): ?>
				<div class="editable-field" data-name="fax">
					<label>Fax</label>
					<span class="field"><?php echo $fax ?></span>
					<a class="edit">Edit</a>
				</div>
			<?php //endif; ?>
			<h4>Change Password</h4>
			<form id="change-password" method="post">
				<div class="success message"></div>
				<div class="change-password-field">
					<label>New Password</label>
					<span class="field"><input type="password" name="new_password" /></span>
				</div>
				<div class="change-password-field">
					<label>Confirm Password</label>
					<span class="field"><input type="password" name="confirm_password" /></span>
				</div>
				<div class="change-password-field">
					<label></label>
					<span class="field"><input type="submit" value="Change Password" /></span>
				</div>
			</form>
		</div>
	</div>
<div id="auto-save-dialog" title="Notice">
  You have an assignment you did not save the last time you were logged in. Would you like to continue working on it?
</div>
<script>
	var confirmLeave=false;
	var assignments_datatable=false;

	$(window).bind('beforeunload',function(){
		if(confirmLeave)
			return 'You have unsaved changes to your new assignment that will be lost. Are you sure you want to continue?';
	});

	// Add assignments link in the heading
	$('.heading.box h2')
		.append(
			$('<a>')
				.attr({
					href: '#assignment-updates',
					id: 'assignment-updates-link'
				})
				.html('Assignment Updates (<?php echo count($assignment_updates) ?>)')
		);

	$('#assignment-updates-link').fancybox();
	
	$('#assignment-updates a.update').click(function(){
		var assignment_id=$(this).data('assignment-id');
		$.fancybox.close();
		$('#dashboard').accordion('option','active',1);

		var assignment_tr=$('#assignments tr[data-assignment-id="'+assignment_id+'"]');

		// If the assignment is not on the current page, we need to go to that page
		if(assignment_tr.length==0)
		{
			// Remove any currently open assignment panel
			$('#assignments .assignment-panel').remove();
			$('#assignments tr.selected').removeClass('selected');

			var settings=assignments_datatable.fnSettings();
			var perPage=settings._iDisplayLength;
			var data=assignments_datatable.fnGetData();
			var page=1;

			for(var i in data)
			{
				var row=data[i];
				if(assignment_id==row[4])
				{
					page=Math.ceil((parseFloat(i)+1)/perPage);
					break;
				}
			}

			assignments_datatable.fnPageChange(page-1); // 0-based page indices
			assignment_tr=$('#assignments tr[data-assignment-id="'+assignment_id+'"]');
		}
		
		if(assignment_tr.next('.assignment-panel').length==0)
			assignment_tr.click();
		var offset=assignment_tr.offset();

		$('html, body').animate({
			scrollTop: offset.top-10,
		},{
			duration: 500,
		});
	});
	$('#assignment-updates a.remove.button').click(function(){
		$(this).html('Removing...');

		var update_id=$(this).data('update-id');
		var remove_row=$(this).parents('tr');

		$.ajax({
			//url: 'http://www.accidentreview.com<?php echo $_SERVER['REQUEST_URI'] ?>',
			type: 'post',
			data: {
				ajaxRequest: {
					action: 'deleteUpdate',
					id: update_id,
				}
			},
			success: function(data){
				console.log(data);
			},
			complete: function(jqXHR,textStatus){
				remove_row.remove();
			},
		});
	});

	// Dashboard

	function get_open_tab()
	{
		var href=window.location.pathname;
		var untrimmed_segments=href.split('/');
		var segments=[];

		for(var i in untrimmed_segments)
		{
			if(untrimmed_segments[i]!='')
				segments.push(untrimmed_segments[i]);
		}

		if(segments.length > 1)
		{

			switch(segments[1])
			{
				case 'new-assignment':
						return 0;
					break;
				case 'assignments':
						return 1;
					break;
				case 'account-info':
						return 5;
					break;
			}
		}
		
		return false;
	}

	var active=get_open_tab();

	$('#dashboard').accordion({
		active: active,
		collapsible: true,
		heightStyle: 'content',
		icons: {}
	});
	
	$('a.show').click(function(){
		if($(this).hasClass('services'))
		{
			$('#dashboard').accordion('option','active',2);
		}
	});
	
	// FAQ
	$('.question').click(function(){
		$('.answer').slideUp(500);
		
		var answer=$(this).next('.answer');
		
		if(answer.is(':hidden'))
		{
			answer.slideDown(500);
			$('.question').removeClass('expanded');
			$(this).addClass('expanded');
		}
		else
		{
			answer.slideUp(500);
			$(this).removeClass('expanded');
		}
	});
	
	// Account Info
	function editable_field_save()
	{
		// Replace input element with span element
		var editable_field=$(this)
			.parents('.editable-field');
		var input=editable_field
			.find('.field');
		var field=$('<span>')
			.addClass('field')
			.html(input.val());
		input.replaceWith(field);
		
		// Replace save button with edit button
		var edit=$('<a>')
			.addClass('edit')
			.html('Edit');
		editable_field
			.find('.save')
			.replaceWith(edit);
		
		$.ajax({
			//url: 'http://www.accidentreview.com<?php echo $_SERVER['REQUEST_URI'] ?>',
			type: 'post',
			data: {
				ajaxRequest: {
					action: 'saveUserInfo',
					name: editable_field.data('name'),
					value: field.html()
				}
			},
			success: function(data){
				console.log(data);
			},
			complete: function(jqXHR,textStatus){
				// Display a success message
				var msg=$('<span>')
					.addClass('message')
					.html('Your information has been saved.');
				editable_field.append(msg);
				setTimeout(function(){
					msg.fadeOut(500,function(){
						$(this).remove();
					});
				}, 1500);
			},
		});
	}
	
	$(document)
		.on('click','.editable-field .edit',function(){
			// Replace span element with input element
			var field=$(this)
				.parents('.editable-field')
				.find('.field');
			var input=$('<input>')
				.attr({
					type: 'text'
				})
				.addClass('field')
				.val(field.html());
			field.replaceWith(input);
			input.focus();
			
			// Replace edit button with save button
			var save=$('<a>').addClass('save').html('Save');
			$(this).replaceWith(save);
		})
		.on('click','.editable-field .save',editable_field_save)
		.on('blur','.editable-field input',editable_field_save);
	
		
	// Change password form
	$('#change-password').submit(function(e){
		function showMessage(msg,error)
		{
			var el=$('#change-password .message');
			if(error)
				el.addClass('error');
			else
				el.removeClass('error');
			el.html(msg).show();
			
			setTimeout(function(){
				el.fadeOut(500);
			}, 1500);
		}
		var form=$(this);
		var password=$(this).find('input[name="new_password"]').val();
		var confirm_password=$(this).find('input[name="confirm_password"]').val();
		
		if(password=='')
		{
			showMessage('You did not enter a password. Enter a password and try again.',true);
			return false;
		}
		if(password != confirm_password)
		{
			showMessage('Your password and confirmation password did not match. Please make sure you typed the same password twice and try again.',true);
			return false;
		}
		
		$.ajax({
		     type: 'post',
		     data: {
		         ajaxRequest: {
				 	action: 'changeUserPass',
					value: password
				 }
		     },
		     complete: function(jqXHR,textStatus){
		         showMessage('Your password has successfully been updated.',false);
				 form.find('input[name="new_password"]').val('');
				 form.find('input[name="confirm_password"]').val('');
		     },
		});
		
		e.preventDefault();
	});

	function open_autosaved_assignment(id,type)
	{


		if(close_new_assignments())
		{
			$('#dashboard')
				.bind('accordionactivate',function(){
					var type_to_classname_map={
						'vehicle-theft':'vehicle-theft-analysis',
						'accident-reconstruction':'accident-reconstruction',
						'fire-analysis':'fire-analysis',
						'mechanical-analysis':'mechanical-analysis',
						'report-review':'report-review',
						'other':'other',
					};
					var anchor_class=type_to_classname_map[type];

					var newAssignmentPanel=$('<div>')
						.addClass('new-assignment-panel')
						.html('Loading, please wait...')
						.load('/wp-admin/admin-ajax.php',{
							action: 'get-assignment-panel',
							id: id
						},function(){
							var offset=$('#new-assignment a.'+anchor_class).offset();
							$('html, body').animate({
								scrollTop: offset['top']
							}, 'slow');
						});
						
					$('#new-assignment a.'+anchor_class)
						.addClass('selected')
						.after(newAssignmentPanel);
				})
				.accordion('option','active',0);
		}
	}

	<?php if(isset($_GET['check_autosave']) && $autosaved_assignment=ar_get_autosaved_assignment()): ?>
		/*$("#auto-save-dialog").dialog({
			buttons : {
				"Yes" : function() {
					console.log('Yes');
					var assignment_type='<?php echo $autosaved_assignment['type'] ?>';
					var assignment_id='<?php echo $autosaved_assignment['id'] ?>';

					open_autosaved_assignment(assignment_id,assignment_type);
					$(this).dialog("close");
				},
				"No" : function() {
					console.log('No');
					$.ajax({
						url: '/wp-admin/admin-ajax.php',
						type: 'post',
						data: {
		                    action: 'clear-autosaves',
						},
						dataType: 'json',
						success: function(data){
							console.log(data);
						}
					});
					$(this).dialog("close");
				}
			}
		});*/
		//$('.ui-dialog').attr('onclick','').unbind('click');
		/*
		if(confirm('You have an assignment you did not save the last time you were logged in. Would you like to continue working on it?'))
		{
		
			var assignment_type='<?php echo $autosaved_assignment['type'] ?>';
			var assignment_id='<?php echo $autosaved_assignment['id'] ?>';

			open_autosaved_assignment(assignment_id,assignment_type);
		
		}
		else
		{
			$.ajax({
				url: '/wp-admin/admin-ajax.php',
				type: 'post',
				data: {
                    action: 'clear-autosaves',
				},
				dataType: 'json',
				success: function(data){
					console.log(data);
				}
			});
		}
		*/
	<?php endif; ?>
		$(function(){
			$("#test-dialog").dialog({
				buttons : {
					"Yes" : function() {
						console.log('Yes');
						$(this).dialog("close");
					},
					"No" : function() {
						console.log('No');
						$(this).dialog("close");
					}
				}
			});
			$(this).dialog("open");
		});
		//$('.ui-dialog').attr
</script>
<div id="test-dialog" title="test">test tes t set se t set </div>