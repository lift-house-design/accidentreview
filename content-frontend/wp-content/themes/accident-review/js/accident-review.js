//Javascript!


(function($,undefined){
    
    $(document).ready(function() {
        if($('.search-box').length){
            $('.search-box input[name="reset_assignments_image"]').bind('click',function(event){
                event.preventDefault();
                $('table.get_jobs_table > tbody > tr').show();
            });
            
            $('.search-box input[name="search_assignments_image"]').bind('click',function(event){
                event.preventDefault();
                var search_val = $('.search-box input[type="text"]').val();
                $('table.get_jobs_table > tbody > tr').show();
                $('table.get_jobs_table > tbody > tr').each(function(i){
                    var show = false,
                        file_num = $(this).find('td:eq(0)').text().trim(),
                        insured_name = $(this).find('td:eq(2)').text().trim(),
                        date_of_loss = $(this).find('td:eq(3)').text().trim();
                        
                    if(stristr(file_num,search_val) !== false) show = true;
                    if(stristr(insured_name,search_val) !== false) show = true;
                    if(stristr(date_of_loss,search_val) !== false) show = true;
                    
                    if(!show) $(this).hide();
                });
            });

            $('.search-box').keypress(function(e) {
                if(e.which == 13) {
                    $('.search-box input[name="search_assignments_image"]').click();
                }
            });
        }
    });
    
    if($('#get_jobs_page').length){
               
    }
    var form_show=0;

    function show_forms(){
        if (form_show==0){
            $('.extra_field').show();
            $('#show_hide').find('span').text('Hide Extra Fields');
            form_show=1;
        }else{
            $('.extra_field').hide();
            $('#show_hide').find('span').text('Show Extra Fields');
            form_show=0;
        }
    }
    
    $(document).ready(function() {
        
        $('.get_jobs_table').tablesorter({
            debug: false
        });//.tablesorterPager({container: $("#pager")});
        
        $('.extra_field').hide();
        $('#show_hide').bind('click',show_forms);
        
        $('div.buttongroup').buttonset();
        
        $('.accident_clear_file').live('click',function(event){
            $(this).parent().parent().find('input').val('');
            event.preventDefault();
        });
       
        $('.accident_remove_file').live('click',function(event){
            if($(this).parent().parent().siblings('div').length){
                $(this).parent().parent().fadeOut('fast',function(){
                   $(this).remove(); 
                });
            }
            event.preventDefault();
        });
        
        $('#accident_add_file').bind('click',function(event){
           $(this).parent().before($(this).parent().siblings('div:eq(0)').clone());
           event.preventDefault(); 
        });
        
        $( '.datepicker' ).datepicker({
			changeMonth: true,
			changeYear: true });
            
            
            
            
    });
     $(document).ready(function() {

        var warned = false;
        var changed = false;
        
        $('.accident-upload-files').bind('click',function(event){
            $('#accident_files').uploadifyUpload();
            event.preventDefault(); 
        });
        
        $('.accident-upload-clear').bind('click',function(event){
            $('#accident_files').uploadifyClearQueue();
        });

        $('a.vinchoice').bind('click',function(event){
            event.preventDefault();
            var the_value = $(this).val(),
                the_claimant = '',
                the_name = $(this).attr('name'),
                the_input = $(this);

            if(the_name == 'vin_yes_a' || the_name == 'vin_no_a') the_claimant = 'a';
            if(the_name == 'vin_yes_b' || the_name == 'vin_no_b') the_claimant = 'b';
            if(the_name == 'vin_yes_c' || the_name == 'vin_no_c') the_claimant = 'c';

            if(the_name == 'vin_yes_' + the_claimant){
                $('#input_method_' + the_claimant).val('VIN');
                $('#input_method_' + the_claimant).change();
            }

            if(the_name == 'vin_no_' + the_claimant){
                $('#input_method_' + the_claimant).val('Info');
                $('#input_method_' + the_claimant).change();
                if(changed){
                    $('.yeartext_'+the_claimant).replaceWith(
                            '<select class="field yeartext_'+ the_claimant + '" name="claimant_'+ the_claimant + '_year" value="" placeholder="Year of the Vehicle"></select>'
                        );
                    $('.maketext_'+the_claimant).replaceWith(
                            '<select class="field maketext_'+ the_claimant + '" name="claimant_'+ the_claimant + '_make" value="" placeholder="Make of the Vehicle"></select>'
                        );
                    $('.modeltext_'+the_claimant).replaceWith(
                            '<select class="field modeltext_'+ the_claimant + '" name="claimant_'+ the_claimant + '_model" value="" placeholder="Model of the Vehicle"></select>'
                        );
                }
                
                setVehicleIdentControls(the_claimant);
            }

            // $('#vinbuttons_'+the_claimant).hide();
        });

        $('a.vinput').bind('click',function(event){
            event.preventDefault();
            var the_claimant = '',
                the_name = $(this).attr('name'),
                the_input = $(this);

            if(the_name == 'vin_select_a') the_claimant = 'a';
            if(the_name == 'vin_select_b') the_claimant = 'b';
            if(the_name == 'vin_select_c') the_claimant = 'c';

            var vin_field = $('#claimant_'+the_claimant+'_vin');
            vinselect(vin_field);
            changed = true;

        });

        
        $('.input_method').bind('change',function(event){            
            var the_value = $(this).val(),
                the_claimant = '',
                the_name = $(this).attr('name'),
                the_input = $(this);

            if(the_name == 'input_method_a') the_claimant = 'a';
            if(the_name == 'input_method_b') the_claimant = 'b';
            if(the_name == 'input_method_c') the_claimant = 'c';

            if(the_value == 'VIN'){
                $('#vininfo_'+the_claimant).hide();
                $('#vininput_'+the_claimant).show('fast');
            } else if(the_value == 'Info'){
                $('#vininput_'+the_claimant).hide();
                $('#vininfo_'+the_claimant).show('fast');
                
                //second and third vehicle                
                if (the_claimant == 'b' || the_claimant == 'c') setVehicleIdentControls(the_claimant);                
            } else{
                $('#vininput_'+the_claimant).hide();
                $('#vininfo_'+the_claimant).hide();                
            }
        });

        function vinselect(thevin){
            var the_value = $(thevin).val();
            if(the_value.length != 17 && !warned){
                warned = true;
                alert('Most current vehicles will have a 17-digit VIN. Are you sure this is the correct VIN?');
                the_name = $(thevin).attr('name');
                if(the_name == 'claimant_a_vin') the_claimant = 'a';
                if(the_name == 'claimant_b_vin') the_claimant = 'b';
                if(the_name == 'claimant_c_vin') the_claimant = 'c';
                $('#vininfo_'+the_claimant).show('slow');
            } else {

                    var the_value = $(thevin).val().toUpperCase(),
                    the_claimant = '',
                    the_name = $(thevin).attr('name'),
                    the_input = $(thevin);
                
                if($(thevin).val() != the_value){
                    $(thevin).val(the_value);
                }

                if(the_name == 'claimant_a_vin') the_claimant = 'a';
                if(the_name == 'claimant_b_vin') the_claimant = 'b';
                if(the_name == 'claimant_c_vin') the_claimant = 'c';
                
                if(the_value.length == 17){
                    //console.log('Value: '+the_value);
                    $(thevin).siblings('.vin_progress').fadeIn();
                    
                    $.ajax({
                        url: '/wp-admin/admin-ajax.php',
                        type: 'POST',
                        data: {
                            action: 'vehicle-vin-decode',
                            vin: the_value,
                            job_id: $('input[name*="job_id"]').val(),
                            claimant: the_claimant
                        },
                        dataType: 'json',
                        success: function(data){
                            if(data.success){
                                the_input.siblings('.vin_progress').fadeOut();
                                if($('.vin_error:visible').length) $('.vin_error').fadeOut();
                                // $('.yeartext_'+the_claimant).val(data.results.year);
                                // $('.maketext_'+the_claimant).val(data.results.make);
                                // $('.modeltext_'+the_claimant).val(data.results.model);
                                $('.yeartext_'+the_claimant).replaceWith(
                                        '<input class="field yeartext_' + the_claimant + '" name="claimant_' + the_claimant + '_year" value="' + data.results.year + '" placeholder="Year of the Vehicle" readonly="readonly" >'
                                    );
                                $('.maketext_'+the_claimant).replaceWith(
                                        '<input class="field maketext_' + the_claimant + '" name="claimant_' + the_claimant + '_make" value="' + data.results.make + '" placeholder="Make of the Vehicle" readonly="readonly" >'
                                    );
                                $('.modeltext_'+the_claimant).replaceWith(
                                        '<input class="field modeltext_' + the_claimant + '" name="claimant_' + the_claimant + '_model" value="' + data.results.model + '" placeholder="Model of the Vehicle" readonly="readonly" >'
                                    );

                            // console.log(data.results.make);
                            // console.log(data.results.model);
                            // console.log(data.results.year);
                                $('#vininfo_'+the_claimant).show('slow');
                            } else {
                                //console.log('error = '+data.error_message);
                                the_input.siblings('.vin_progress').fadeOut();
                                the_input.siblings('.vin_error').attr('title',data.error_message).fadeIn();
                            }
                        }
                    })
                } else {
                    if($('.vin_error:visible').length) $('.vin_error').fadeOut();
                    if($('.vin_progress:visible').length) $('.vin_progress').fadeOut();
                }



            }

        }
        
        $('.accident-form textarea').autoResize({
            // On resize:
            onResize : function() {
                $(this).css({opacity:0.8});
            },
            // After resize:
            animateCallback : function() {
                $(this).css({opacity:1});
            },
            // Quite slow animation:
            animateDuration : 300,
            // More extra space:
            extraSpace : 40
        });
        
        if($('input[name="job_id"]').length) job_id = $('input[name="job_id"]').val();
        else job_id = 0;
        
        if($('input[name="session_id"]').length) session_id = $('input[name="session_id"]').val();
        else session_id = 0;
        
        $('#accident_files').uploadify({
            'uploader'  : '/wp-content/themes/accident-review/lib/uploadify/uploadify.swf',
            'script'    : '/wp-content/themes/accident-review/custom/file-upload.php',
            'scriptData': {
                'action': 'agent-file-upload',
                'job_id': job_id,
                'session_id': session_id
            },
            'cancelImg'     : '/wp-content/themes/accident-review/lib/uploadify/cancel.png',
            'buttonImg'     : '/wp-content/themes/accident-review/lib/uploadify/button.jpg',
            'width'         : 178,
            'auto'          : true,
            'multi'         : true,
            'queueID'       : 'file_upload_queue',
            'onError'       : function(event,ID,fileObj,errorObj) {
                alert(errorObj.info);
            },
            'removeCompleted'   : false,
            'onCancel'  : function(event,ID,fileObj,data) {
                
                name_with_size = $('#accident_files'+ID).find('.fileName').text();
                name = name_with_size.substr(0,name_with_size.indexOf('(')-1);
                
                $.post('/wp-content/themes/accident-review/custom/file-upload.php',{
                    'job_id' : job_id, 
                    'session_id' : session_id, 
                    'name' : name, 
                    'delete_action' : 1
                },function(data, textStatus, jqXHR){
                    
                });
                return true;
            },
			'onOpen':		function(event,ID,fileObj){
				$('input[name="submit_job"]').attr({disabled:'disabled'});
				$('.waiting-for-files').fadeIn();
			},
			'onAllComplete':	function(event,data){
				$('input[name="submit_job"]').removeAttr('disabled');
				$('.waiting-for-files').fadeOut();
			},
            'onComplete'   : function(event, ID, fileObj, response, data) {
                        alert('test');
                var attaid = response.substr(0,response.indexOf(':'));
                //console.log('Inserted ID: '+attaid);
                $('.accident-form').append('<input type="hidden" name="uploaded_files[]" value="'+attaid+'" />');
                $.ajax({
                    type: 'POST',
                    url: '/wp-admin/admin-ajax.php',
                    data: {
                        action: 'agent-file-info',
                        attid: attaid
                    },
                    dataType: 'json',
                    success: function(data){
                        if(data.success){
                            $('table.files_table > tbody').append('<tr class="{attaid:'+attaid+'"><td>'+data.name+'</td><td>'+data.size+'</td><td><a href="/files/'+data.location+'">Download</a>&nbsp;<a href="#" class="remove-existing-file">Delete</a></td></tr>');
                        }
                        
                        $('#accident_files').uploadifyCancel(ID);
                    }
                });
            }
            });
        });

})(jQuery);

function processVehicleRequest(actionName, ctlParams, resultControl)
{
	var parameters = {};
	parameters['action'] = actionName;
	
	for (paramKey in ctlParams)
	{
		var paramValue = getSelectedValue(ctlParams[paramKey], 'optionvalue');
		if (paramKey && paramValue) parameters[paramKey] = paramValue;        		
	}
	
	$.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        data: parameters,
        dataType: 'json',
        success: function(data)
        {
            if(data.success && resultControl)
            {
            	var select = $('select[name="' + resultControl + '"]');
            	select.empty();
            		 
            	$.each(data.result, function(val, text) 
            	{
            		select.append("<option value='" + text + "' optionvalue='" + val + "'>" + text + "</option>");
            	});
            }
        }
    });
}
function vehicleMakeSelect(yearControl, makeControl)
{
	ctrlParams = {};
	ctrlParams['year'] = yearControl;
	processVehicleRequest('vehicle-make-list', ctrlParams, makeControl);
}
function vehicleYearSelect(yearControl)
{
	ctrlParams = {};
	processVehicleRequest('vehicle-year-list', ctrlParams, yearControl);
}
function vehicleModelSelect(yearControl, makeControl, modelControl)
{
	ctrlParams = {};
	ctrlParams['year'] = yearControl;
	ctrlParams['make'] = makeControl;
	processVehicleRequest('vehicle-model-list', ctrlParams, modelControl);
}

function setVehicleIdentControls(the_claimant)
{
	var year_select_name = 'claimant_'+the_claimant+'_year';

    var make_select_name = 'claimant_'+the_claimant+'_make';
    var make_select = $('select[name="' + make_select_name + '"]');
    var model_select_name = 'claimant_'+the_claimant+'_model';
    var model_select = $('select[name="' + model_select_name + '"]');
    
    make_select.empty();
	model_select.empty();
	
    vehicleYearSelect(year_select_name);
               	
    $('select[name="' + year_select_name + '"]').change(function() 
    {
    	make_select.empty();
    	model_select.empty();
    	vehicleMakeSelect(year_select_name, make_select_name);
		});
    $('select[name="' + make_select_name + '"]').change(function() 
    {
    	model_select.empty();
    	vehicleModelSelect(year_select_name, make_select_name, model_select_name);
    });
}

function getSelectedValue(elt, attr)
{
	result = null;
	if (elt && attr)
	{
		$("select[name='" + elt + "'] option:selected").each(function () 
	        	  {
						result = $(this).attr(attr);
						return false;
	              });	
	}
	
	return result;
}

function stristr (haystack, needle, bool) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfxied by: Onno Marsman
    // *     example 1: stristr('Kevin van Zonneveld', 'Van');
    // *     returns 1: 'van Zonneveld'
    // *     example 2: stristr('Kevin van Zonneveld', 'VAN', true);
    // *     returns 2: 'Kevin '
    var pos = 0;

    haystack += '';
    pos = haystack.toLowerCase().indexOf((needle + '').toLowerCase());
    if (pos == -1) {
        return false;
    } else {
        if (bool) {
            return haystack.substr(0, pos);
        } else {
            return haystack.slice(pos);
        }
    }
}
