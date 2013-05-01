<div class="form_left_col">
  {wrap field=name}
    {label for=projectName required=1}Client Name{/label}
    {text_field name='project[name]' value=$project_data.name id=projectName class=title}
  {/wrap}
  
  {wrap field=overview}
    {label for=projectOverview}Client Notes{/label}
    {editor_field name='project[overview]' id=projectOverview inline_attachments=$project_data.inline_attachments}{$project_data.overview}{/editor_field}
  {/wrap}
{wrap field=office_address}
  {label for=companyAddress}Address{/label}
  {textarea_field name='company[office_address]' id=companyAddress}{$company_data.office_address}{/textarea_field}
{/wrap}

{wrap field=office_phone}
  {label for=companyName}Phone Number{/label}
  {text_field name='company[office_phone]' value=$company_data.office_phone id=companyName}
{/wrap}

{wrap field=office_fax}
  {label for=companyFax}Fax Number{/label}
  {text_field name='company[office_fax]' value=$company_data.office_fax id=companyFax}
{/wrap}

{wrap field=office_homepage}
  {label for=companyHomepage}Homepage{/label}
  {text_field name='company[office_homepage]' value=$company_data.office_homepage id=companyHomepage}
{/wrap}
{if $logged_user->canSeePrivate()}
  {assign_var name=project_visibility_normal_caption}{lang}Normal &mdash; <span class="details">Visible to everyone involved with the project</span>{/lang}{/assign_var}
  {assign_var name=project_visibility_private_caption}{lang}Private &mdash; <span class="details">Visible only to people with can_see_private_objects role permission</span>{/lang}{/assign_var}

  {wrap field=default_visibility}
    {label for=projectVisibility}Default Visibility{/label}
    {select_visibility name='project[default_visibility]' value=$project_data.default_visibility id=projectVisibility normal_caption=$project_visibility_normal_caption private_caption=$project_visibility_private_caption}
  {/wrap}
{else}
  <input type="hidden" name="project[default_visibility]" value="{$project_data.default_visibility}" />
{/if}

    <br />
    <div class="company_user_options">
        <h3>Client Users</h3>
        {foreach item=company_user from=$company_users name=comp_user_loop}
        <div class="accident_user_block" id="company_user_{$smarty.foreach.comp_user_loop.index}">
            <div>
                <label for="company_user_email">Email Address</label>
                <input type="text" name="company_user_email[]" value="{$company_user.email}" class="full"/>
            </div>
            <div>
                <label for="company_user_first">First Name</label>
                <input type="text" name="company_user_first[]" value="{$company_user.first_name}" class="full" />
            </div>
            <div>
                <label for="company_user_last">Last Name</label>
                <input type="text" name="company_user_last[]" value="{$company_user.last_name}" class="full" />
            </div>
            <div>
                <label for="company_user_password">User Password</label>
                <input type="text" name="company_user_password[]" value="{$company_user.password_plain}" class="full" />
            </div>
            <div>
                <label for="company_admin_admin">Is Admin</label>
                <input type="checkbox" name="company_user_admin[]" value="{$smarty.foreach.comp_user_loop.index}" class="short" {if $company_user.admin == 1}checked="checked"{/if}/>
            </div>
            <br class="clear" />
            <a class="remove_company_user" href="#">Remove User</a>
            <br class="clear" />
        </div>
        {foreachelse}
        <div class="accident_user_block" id="company_user_1">
            <div>
                <label for="company_user_email">Email Address</label>
                <input type="text" name="company_user_email[]" value="" class="full"/>
            </div>
            <div>
                <label for="company_user_first">First Name</label>
                <input type="text" name="company_user_first[]" value="" class="full" />
            </div>
            <div>
                <label for="company_user_last">Last Name</label>
                <input type="text" name="company_user_last[]" value="" class="full" />
            </div>
            <div>
                <label for="company_user_password">User Password</label>
                <input type="text" name="company_user_password[]" value="" class="full" />
            </div>
            <div>
                <label for="company_admin_admin">Is Admin</label>
                <input type="checkbox" name="company_user_admin[]" value="1" class="short" />
            </div>
            <br class="clear" />
            <a class="remove_company_user" href="#">Remove User</a>
            <br class="clear" />
        </div>
        {/foreach}
        <a href="#" class="add_company_user">Add another User</a>
        {literal}
        <script type="text/javascript">
            
            $(function(){
                
                $('select[name="project[company_id]"]').parents('.ctrlHolder:eq(0)').hide();
                $('select[name="project[group_id]"]').parents('.ctrlHolder:eq(0)').hide();
                $('input[name="project[starts_on]"]').parents('.ctrlHolder:eq(0)').hide();
                $('select[name="project[project_template_id]"]').parents('.ctrlHolder:eq(0)').hide();
                
                $('#projectVisibility_1').trigger('click');
                
                var total_users = 1;
				var user_block_html = $(".accident_user_block").html();
                
                $(user_block_html).find('input[type="text"]').val('');
                $(user_block_html).find('input[type="checkbox"]').attr({ 'checked': ''});
                
                $('.remove_company_user').bind('click',function(event){
                    if($('.accident_user_block').length > 1){
                        $('<div>Are you sure you want to remove this user?</div>').dialog({
                           buttons: {
                                'Yes' : function(){
                                    $(this).dialog('close');
                                    $(event.target).parents('.accident_user_block').fadeOut('slow',function(){
                                        $(this).remove(); 
                                    });
                                    total_users = total_users - 1;
                                },
                                'Cancel': function(){
                                    $(this).dialog('close');
                                }
                           } 
                        });
                    } else {
                        $('<div>At least one Company user is required</div>').dialog({
                            buttons: {
                                'Okay' : function(){
                                    $(this).dialog('close');
                                }
                            }
                        });
                    }
                });
                
                $('.add_company_user').bind('click',function(event){
                    
                    
                    total_users = total_users + 1;
                    
                    new_block = $('<div />').addClass('accident_user_block')
                                    .attr({
                                        'id': 'company_user_'+total_users
                                    })
                                    .append(user_block_html);
                    
                    $(new_block).find('input[type="checkbox"]').val(total_users);
                    $(new_block).css('display','none');
                    
                    $(new_block).find('.remove_company_user').bind('click',function(event){
                    if($('.accident_user_block').length > 1){
                        $('<div>Are you sure you want to remove this user?</div>').dialog({
                           buttons: {
                                'Yes' : function(){
                                    $(this).dialog('close');
                                    $(event.target).parents('.accident_user_block').fadeOut('slow',function(){
                                        $(this).remove(); 
                                    });
                                    total_users = total_users - 1;
                                },
                                'Cancel': function(){
                                    $(this).dialog('close');
                                }
                           } 
                        });
                    } else {
                        $('<div>At least one Company user is required</div>').dialog({
                            buttons: {
                                'Okay' : function(){
                                    $(this).dialog('close');
                                }
                            }
                        });
                    }
                });
                    
                    $('.accident_user_block:last').after(new_block);
                    $('#company_user_'+total_users).fadeIn('slow');
                    event.preventDefault();
                });
                
                
            });
        </script>
        {/literal}
    </div>
</div>

<div class="form_right_col">
{if $logged_user->isOwner()}
  {wrap field=leader_id}
    {label for=projectLader required=yes}Leader{/label}
    {select_user name='project[leader_id]' value=$project_data.leader_id id="projectLader" optional=no}
  {/wrap}

  {wrap field=company_id}
    {label for=projectCompany}Company{/label}
    {select_company name='project[company_id]' value=$project_data.company_id id=projectCompany optional=yes exclude=$owner_company->getId()}
  {/wrap}
{else}
  {wrap field=leader_id}
    {label for=projectLader required=yes}Leader{/label}
    {select_user name='project[leader_id]' value=$project_data.leader_id id="projectLader" users=$logged_user->visibleUserIds() optional=no}
  {/wrap}

  {wrap field=company_id}
    {label for=projectCompany}Company{/label}
    {select_company name='project[company_id]' value=$project_data.company_id id=projectCompany companies=$logged_user->visibleCompanyIds() optional=yes exclude=$owner_company->getId()}
  {/wrap}
{/if}

  {wrap field=group_id}
    {label for=projectGroup}Group{/label}
    {select_project_group name='project[group_id]' value=$project_data.group_id id="projectGroup" optional=yes}
  {/wrap}
  
  {wrap field=starts_on}
    {label for=projectStartsOn}Starts On{/label}
    {select_date name='project[starts_on]' value=$project_data.starts_on id="projectStartsOn"}
  {/wrap}
</div>
<div class="clear"></div>