{title id=$active_ticket->getTicketId() name=$active_ticket->getName()}Ticket #:id: :name{/title}
{page_object object=$active_ticket}
{add_bread_crumb}Details{/add_bread_crumb}

{object_quick_options object=$active_ticket user=$logged_user}
<div class="ticket main_object" id="ticket{$active_ticket->getId()}">
  <div class="body">
    <dl class="properties">
      <dt>{lang}Status{/lang}</dt>
    {if $active_ticket->isCompleted()}
      <dd>{action_on_by user=$active_ticket->getCompletedBy() datetime=$active_ticket->getCompletedOn() action=Completed}</dd>
    {else}
      <dd>{lang}Open{/lang}</dd>
    {/if}
    
      <dt>{lang}Priority{/lang}</dt>
      <dd>{$active_ticket->getFormattedPriority()}</dd>
      
    {if $active_ticket->getDueOn()}
      <dt>{lang}Due on{/lang}</dt>
      <dd>{$active_ticket->getDueOn()|date:0}</dd>
    {/if}
      
    {if $active_ticket->hasAssignees()}
      <dt>{lang}Assignees{/lang}</dt>
      <dd>{object_assignees object=$active_ticket}</dd>
    {/if}
    
    {if $logged_user->canSeeMilestones($active_project) && $active_ticket->getMilestoneId()}
      <dt>{lang}Milestone{/lang}</dt>
      <dd>{milestone_link object=$active_ticket}</dd>
    {/if}
      
    {if module_loaded('timetracking') && $logged_user->getProjectPermission('timerecord', $active_project)}
      <dt>{lang}Time{/lang}</dt>
      <dd>{object_time object=$active_ticket}</dd>
    {/if}
    
    {if $active_ticket->hasTags()}
      <dt>{lang}Tags{/lang}</dt>
      <dd>{object_tags object=$active_ticket}</dd>
    {/if}
    </dl>
  
  {if $active_ticket->getBody()}
    <div class="body content" id="ticket_body_{$active_ticket->getId()}">{$active_ticket->getFormattedBody()}</div>
    {if $active_ticket->getSource() == $smarty.const.OBJECT_SOURCE_EMAIL}
      <script type="text/javascript">
        App.EmailObject.init('ticket_body_{$active_ticket->getId()}');
      </script>
    {/if}
  {else}
    
  {/if}


  
  {if $active_ticket->get_ticket_accident_job_id() != false}
  {if $collection_found == true}
  <input type="hidden" name="accident_collection_id" id="accident_collection_id" value="{$collection_id}" />
  <input type="hidden" name="accident_project_id" id="accident_project_id" value="{$project_id}" />
  {/if}

    
    <div class="general_information">
    <h2 class="section_name"><span class="section_name_span">
        <span class="section_name_span_span">General Information</span><div class="clear"></div></span></h2>
    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{$active_ticket->get_ticket_accident_question('job_type')}</td>
                <td>{$active_ticket->get_ticket_accident_data('job_type')}</td>
           </tr>
            <tr>
                <td>{$active_ticket->get_ticket_accident_question('date_of_loss')}</td>
                <td>{$active_ticket->get_ticket_accident_data('date_of_loss')}</td>
           </tr>
           {if $active_ticket->get_ticket_accident_data('job_type') == 'Vehicle Theft Analysis'}
            <tr>
                <td>{$active_ticket->get_ticket_accident_question('date_of_recovery')}</td>
                <td>{$active_ticket->get_ticket_accident_data('date_of_recovery')}</td>
           </tr>
            <tr>
                <td>{$active_ticket->get_ticket_accident_question('location_of_loss')}</td>
                <td>{$active_ticket->get_ticket_accident_data('location_of_loss')}</td>
           </tr>
           {/if}
            <tr>
                <td>{$active_ticket->get_ticket_accident_question('loss_description')}</td>
                <td>{$active_ticket->get_ticket_accident_data('loss_description')}</td>
           </tr>
            <tr>
                <td>{$active_ticket->get_ticket_accident_question('services_requested')}</td>
                <td>{$active_ticket->get_ticket_accident_data('services_requested')}</td>
           </tr>
       </tbody>
    </table>
    </div>
    <div class="claimant_a">
        <h2 class="section_name"><span class="section_name_span">
            <span class="section_name_span_span">Vehicle Information</span><div class="clear"></div></span></h2>
        <table>
            <thead>
                <tr>
                   <th>Question</th>
                   <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Owner's Name</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_a_owner_name')}</td>
                </tr>
                <tr>
                    <td>Owner Type</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_a_owner_type')}</td>
                </tr>
{if $active_ticket->get_ticket_accident_data('claimant_a_owner_type')  == 'Other' }
                 <tr>
                    <td>Owner Type - Other</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_a_owner_type_other')}</td>
                </tr>
{/if}
                <tr>
                    <td>Year</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_a_year')}</td>
                </tr>
                <tr>
                    <td>Make</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_a_make')}</td>
                </tr>
                <tr>
                    <td>Model</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_a_model')}</td>
                </tr>
                <tr>
                    <td>Color</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_a_color')}</td>
                </tr>
                <tr>
                    <td>VIN&nbsp;<a href="" class="update-claimant-vin-data claimant-a-vin-link" style="font-size:0.8em;cursor:pointer;color:#0000EE;">(Decode Vin)</a></td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_a_vin')}</td>
                </tr>
                <tr>
                    <td>License Plate</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_a_plate')}</td>
                </tr>
                <tr>
                    <td>Aftermarket Modifications</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_a_aftermarket')}</td>
                </tr>
                <tr>
                    <td>Additional Information</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_a_additional')}</td>
                </tr>
            </tbody>
        </table>
    </div>
    {assign var="claimant_b_year" value=$active_ticket->get_ticket_accident_data('claimant_b_year') }
    {assign var="claimant_b_make" value=$active_ticket->get_ticket_accident_data('claimant_b_make') }
    {assign var="claimant_b_model" value=$active_ticket->get_ticket_accident_data('claimant_b_model') }
    {if $claimant_b_year != '' && $claimant_b_make != '' && $claimant_b_model != '' }
    <div class="claimant_b">
        <h2 class="section_name"><span class="section_name_span">
            <span class="section_name_span_span">Second Vehicle Information</span><div class="clear"></div></span></h2>
        <table>
            <thead>
                <tr>
                   <th>Question</th>
                   <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Owner's Name</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_b_owner_name')}</td>
                </tr>
                <tr>
                    <td>Owner Type</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_b_owner_type')}</td>
                </tr>
{if $active_ticket->get_ticket_accident_data('claimant_b_owner_type')  == 'Other' }
                 <tr>
                    <td>Owner Type - Other</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_b_owner_type_other')}</td>
                </tr>
{/if}
                <tr>
                    <td>Year</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_b_year')}</td>
                </tr>
                <tr>
                    <td>Make</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_b_make')}</td>
                </tr>
                <tr>
                    <td>Model</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_b_model')}</td>
                </tr>
                <tr>
                    <td>Color</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_b_color')}</td>
                </tr>
                <tr>
                    <td>VIN&nbsp;<a href="" class="update-claimant-vin-data claimant-b-vin-link" style="font-size:0.8em;cursor:pointer;color:#0000EE;">(Decode Vin)</a></td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_b_vin')}</td>
                </tr>
                <tr>
                    <td>License Plate</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_b_plate')}</td>
                </tr>
                <tr>
                    <td>Aftermarket Modifications</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_b_aftermarket')}</td>
                </tr>
                <tr>
                    <td>Additional Information</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_b_additional')}</td>
                </tr>
            </tbody>
        </table>
    </div>    
    {/if}
    {assign var="claimant_c_year" value=$active_ticket->get_ticket_accident_data('claimant_c_year') }
    {assign var="claimant_c_make" value=$active_ticket->get_ticket_accident_data('claimant_c_make') }
    {assign var="claimant_c_model" value=$active_ticket->get_ticket_accident_data('claimant_c_model') }
    {if $claimant_c_year != '' && $claimant_c_make != '' && $claimant_c_model != '' }
    <div class="claimant_c">
        <h2 class="section_name"><span class="section_name_span">
            <span class="section_name_span_span">Third Vehicle Information</span><div class="clear"></div></span></h2>
        <table>
            <thead>
                <tr>
                   <th>Question</th>
                   <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Owner's Name</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_c_owner_name')}</td>
                </tr>
                <tr>
                    <td>Owner Type</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_c_owner_type')}</td>
                </tr>
{if $active_ticket->get_ticket_accident_data('claimant_c_owner_type') == 'Other' }
                 <tr>
                    <td>Owner Type - Other</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_c_owner_type_other')}</td>
                </tr>
{/if}
                <tr>
                    <td>Year</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_c_year')}</td>
                </tr>
                <tr>
                    <td>Make</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_c_make')}</td>
                </tr>
                <tr>
                    <td>Model</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_c_model')}</td>
                </tr>
                <tr>
                    <td>Color</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_c_color')}</td>
                </tr>
                <tr>
                    <td>VIN&nbsp;<a href="" class="update-claimant-vin-data claimant-c-vin-link" style="font-size:0.8em;cursor:pointer;color:#0000EE;">(Decode Vin)</a></td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_c_vin')}</td>
                </tr>
                <tr>
                    <td>License Plate</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_c_plate')}</td>
                </tr>
                <tr>
                    <td>Aftermarket Modifications</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_c_aftermarket')}</td>
                </tr>
                <tr>
                    <td>Additional Information</td>
                    <td>{$active_ticket->get_ticket_accident_data('claimant_c_additional')}</td>
                </tr>
            </tbody>
        </table>
    </div>   
    {/if}    
    <div class="job_specific_details">
     {if $active_ticket->get_ticket_accident_data('job_type') == 'Vehicle Theft Analysis'}
    <div class="vehicle_theft">
    <h2 class="section_name"><span class="section_name_span">
        <span class="section_name_span_span">Vehicle Theft Analysis</span><div class="clear"></div></span></h2>
    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{$active_ticket->get_ticket_accident_question('vehicle_theft_security_system')}</td>
                <td>{$active_ticket->get_ticket_accident_data('vehicle_theft_security_system')}</td>
            </tr>
            <tr>
                <td>{$active_ticket->get_ticket_accident_question('vehicle_theft_security_system_after')}</td>
                <td>{$active_ticket->get_ticket_accident_data('vehicle_theft_security_system_after')}</td>
            </tr>
            <tr>
                <td>{$active_ticket->get_ticket_accident_question('vehicle_theft_remote')}</td>
                <td>{$active_ticket->get_ticket_accident_data('vehicle_theft_remote')}</td>
            </tr>
            <tr>
                <td>{$active_ticket->get_ticket_accident_question('vehicle_theft_remote_after')}</td>
                <td>{$active_ticket->get_ticket_accident_data('vehicle_theft_remote_after')}</td>
            </tr>
        </tbody>
    </table>
    </div>
    {/if}
    {/if}
  </div>
  </div>


  
<div class="resources">
    {object_attachments object=$active_ticket}
    {object_subscriptions object=$active_ticket}
    {object_tasks object=$active_ticket}
    
    <div class="resource object_comments" id="comments">
      <div class="body">
      {if $pagination->getLastPage() > 1}
        <p class="pagination top"><span class="inner_pagination">{lang}Page{/lang}: {pagination pager=$pagination}{$active_ticket->getViewUrl('-PAGE-')}{/pagination}</span></p>
        <div class="clear"></div>
        {/if}
        
        {if $pagination->getLastPage() > $pagination->getCurrentPage()}
          {object_comments object=$active_ticket comments=$comments show_header=no count_from=$count_start next_page=$active_ticket->getViewUrl($pagination->getNextPage())}
        {else}
          {object_comments object=$active_ticket comments=$comments show_header=no count_from=$count_start}
        {/if}
      </div>
    </div>
    
    {ticket_changes ticket=$active_ticket}
  </div>
</div>