<?php /* Smarty version 2.6.16, created on 2013-02-13 16:49:29
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 3, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 9, false),array('block', 'pagination', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 342, false),array('function', 'page_object', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 2, false),array('function', 'object_quick_options', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 5, false),array('function', 'action_on_by', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 11, false),array('function', 'object_assignees', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 26, false),array('function', 'milestone_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 31, false),array('function', 'object_time', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 36, false),array('function', 'object_tags', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 41, false),array('function', 'object_attachments', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 335, false),array('function', 'object_subscriptions', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 336, false),array('function', 'object_tasks', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 337, false),array('function', 'object_comments', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 347, false),array('function', 'ticket_changes', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 354, false),array('modifier', 'date', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/view.tpl', 21, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array('id' => $this->_tpl_vars['active_ticket']->getTicketId(),'name' => $this->_tpl_vars['active_ticket']->getName())); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Ticket #:id: :name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  echo smarty_function_page_object(array('object' => $this->_tpl_vars['active_ticket']), $this);?>

<?php $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php echo smarty_function_object_quick_options(array('object' => $this->_tpl_vars['active_ticket'],'user' => $this->_tpl_vars['logged_user']), $this);?>

<div class="ticket main_object" id="ticket<?php echo $this->_tpl_vars['active_ticket']->getId(); ?>
">
  <div class="body">
    <dl class="properties">
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
    <?php if ($this->_tpl_vars['active_ticket']->isCompleted()): ?>
      <dd><?php echo smarty_function_action_on_by(array('user' => $this->_tpl_vars['active_ticket']->getCompletedBy(),'datetime' => $this->_tpl_vars['active_ticket']->getCompletedOn(),'action' => 'Completed'), $this);?>
</dd>
    <?php else: ?>
      <dd><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Open<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dd>
    <?php endif; ?>
    
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo $this->_tpl_vars['active_ticket']->getFormattedPriority(); ?>
</dd>
      
    <?php if ($this->_tpl_vars['active_ticket']->getDueOn()): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Due on<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['active_ticket']->getDueOn())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>
</dd>
    <?php endif; ?>
      
    <?php if ($this->_tpl_vars['active_ticket']->hasAssignees()): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignees<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo smarty_function_object_assignees(array('object' => $this->_tpl_vars['active_ticket']), $this);?>
</dd>
    <?php endif; ?>
    
    <?php if ($this->_tpl_vars['logged_user']->canSeeMilestones($this->_tpl_vars['active_project']) && $this->_tpl_vars['active_ticket']->getMilestoneId()): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Milestone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo smarty_function_milestone_link(array('object' => $this->_tpl_vars['active_ticket']), $this);?>
</dd>
    <?php endif; ?>
      
    <?php if (module_loaded ( 'timetracking' ) && $this->_tpl_vars['logged_user']->getProjectPermission('timerecord',$this->_tpl_vars['active_project'])): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo smarty_function_object_time(array('object' => $this->_tpl_vars['active_ticket']), $this);?>
</dd>
    <?php endif; ?>
    
    <?php if ($this->_tpl_vars['active_ticket']->hasTags()): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tags<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo smarty_function_object_tags(array('object' => $this->_tpl_vars['active_ticket']), $this);?>
</dd>
    <?php endif; ?>
    </dl>
  
  <?php if ($this->_tpl_vars['active_ticket']->getBody()): ?>
    <div class="body content" id="ticket_body_<?php echo $this->_tpl_vars['active_ticket']->getId(); ?>
"><?php echo $this->_tpl_vars['active_ticket']->getFormattedBody(); ?>
</div>
    <?php if ($this->_tpl_vars['active_ticket']->getSource() == @OBJECT_SOURCE_EMAIL): ?>
      <script type="text/javascript">
        App.EmailObject.init('ticket_body_<?php echo $this->_tpl_vars['active_ticket']->getId(); ?>
');
      </script>
    <?php endif; ?>
  <?php else: ?>
    
  <?php endif; ?>


  
  <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_job_id() != false): ?>
  <?php if ($this->_tpl_vars['collection_found'] == true): ?>
  <input type="hidden" name="accident_collection_id" id="accident_collection_id" value="<?php echo $this->_tpl_vars['collection_id']; ?>
" />
  <input type="hidden" name="accident_project_id" id="accident_project_id" value="<?php echo $this->_tpl_vars['project_id']; ?>
" />
  <?php endif; ?>

    
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
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_question('job_type'); ?>
</td>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('job_type'); ?>
</td>
           </tr>
            <tr>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_question('date_of_loss'); ?>
</td>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('date_of_loss'); ?>
</td>
           </tr>
           <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('job_type') == 'Vehicle Theft Analysis'): ?>
            <tr>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_question('date_of_recovery'); ?>
</td>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('date_of_recovery'); ?>
</td>
           </tr>
            <tr>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_question('location_of_loss'); ?>
</td>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('location_of_loss'); ?>
</td>
           </tr>
           <?php endif; ?>
            <tr>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_question('loss_description'); ?>
</td>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('loss_description'); ?>
</td>
           </tr>
            <tr>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_question('services_requested'); ?>
</td>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('services_requested'); ?>
</td>
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
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_owner_name'); ?>
</td>
                </tr>
                <tr>
                    <td>Owner Type</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_owner_type'); ?>
</td>
                </tr>
<?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_owner_type') == 'Other'): ?>
                 <tr>
                    <td>Owner Type - Other</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_owner_type_other'); ?>
</td>
                </tr>
<?php endif; ?>
                <tr>
                    <td>Year</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_year'); ?>
</td>
                </tr>
                <tr>
                    <td>Make</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_make'); ?>
</td>
                </tr>
                <tr>
                    <td>Model</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_model'); ?>
</td>
                </tr>
                <tr>
                    <td>Color</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_color'); ?>
</td>
                </tr>
                <tr>
                    <td>VIN&nbsp;<a href="" class="update-claimant-vin-data claimant-a-vin-link" style="font-size:0.8em;cursor:pointer;color:#0000EE;">(Decode Vin)</a></td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_vin'); ?>
</td>
                </tr>
                <tr>
                    <td>License Plate</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_plate'); ?>
</td>
                </tr>
                <tr>
                    <td>Aftermarket Modifications</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_aftermarket'); ?>
</td>
                </tr>
                <tr>
                    <td>Additional Information</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_additional'); ?>
</td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php $this->assign('claimant_b_year', $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_year')); ?>
    <?php $this->assign('claimant_b_make', $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_make')); ?>
    <?php $this->assign('claimant_b_model', $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_model')); ?>
    <?php if ($this->_tpl_vars['claimant_b_year'] != '' && $this->_tpl_vars['claimant_b_make'] != '' && $this->_tpl_vars['claimant_b_model'] != ''): ?>
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
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_owner_name'); ?>
</td>
                </tr>
                <tr>
                    <td>Owner Type</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_owner_type'); ?>
</td>
                </tr>
<?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_owner_type') == 'Other'): ?>
                 <tr>
                    <td>Owner Type - Other</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_owner_type_other'); ?>
</td>
                </tr>
<?php endif; ?>
                <tr>
                    <td>Year</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_year'); ?>
</td>
                </tr>
                <tr>
                    <td>Make</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_make'); ?>
</td>
                </tr>
                <tr>
                    <td>Model</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_model'); ?>
</td>
                </tr>
                <tr>
                    <td>Color</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_color'); ?>
</td>
                </tr>
                <tr>
                    <td>VIN&nbsp;<a href="" class="update-claimant-vin-data claimant-b-vin-link" style="font-size:0.8em;cursor:pointer;color:#0000EE;">(Decode Vin)</a></td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_vin'); ?>
</td>
                </tr>
                <tr>
                    <td>License Plate</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_plate'); ?>
</td>
                </tr>
                <tr>
                    <td>Aftermarket Modifications</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_aftermarket'); ?>
</td>
                </tr>
                <tr>
                    <td>Additional Information</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_additional'); ?>
</td>
                </tr>
            </tbody>
        </table>
    </div>    
    <?php endif; ?>
    <?php $this->assign('claimant_c_year', $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_year')); ?>
    <?php $this->assign('claimant_c_make', $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_make')); ?>
    <?php $this->assign('claimant_c_model', $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_model')); ?>
    <?php if ($this->_tpl_vars['claimant_c_year'] != '' && $this->_tpl_vars['claimant_c_make'] != '' && $this->_tpl_vars['claimant_c_model'] != ''): ?>
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
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_owner_name'); ?>
</td>
                </tr>
                <tr>
                    <td>Owner Type</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_owner_type'); ?>
</td>
                </tr>
<?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_owner_type') == 'Other'): ?>
                 <tr>
                    <td>Owner Type - Other</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_owner_type_other'); ?>
</td>
                </tr>
<?php endif; ?>
                <tr>
                    <td>Year</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_year'); ?>
</td>
                </tr>
                <tr>
                    <td>Make</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_make'); ?>
</td>
                </tr>
                <tr>
                    <td>Model</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_model'); ?>
</td>
                </tr>
                <tr>
                    <td>Color</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_color'); ?>
</td>
                </tr>
                <tr>
                    <td>VIN&nbsp;<a href="" class="update-claimant-vin-data claimant-c-vin-link" style="font-size:0.8em;cursor:pointer;color:#0000EE;">(Decode Vin)</a></td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_vin'); ?>
</td>
                </tr>
                <tr>
                    <td>License Plate</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_plate'); ?>
</td>
                </tr>
                <tr>
                    <td>Aftermarket Modifications</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_aftermarket'); ?>
</td>
                </tr>
                <tr>
                    <td>Additional Information</td>
                    <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_additional'); ?>
</td>
                </tr>
            </tbody>
        </table>
    </div>   
    <?php endif; ?>    
    <div class="job_specific_details">
     <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('job_type') == 'Vehicle Theft Analysis'): ?>
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
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_question('vehicle_theft_security_system'); ?>
</td>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_security_system'); ?>
</td>
            </tr>
            <tr>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_question('vehicle_theft_security_system_after'); ?>
</td>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_security_system_after'); ?>
</td>
            </tr>
            <tr>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_question('vehicle_theft_remote'); ?>
</td>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_remote'); ?>
</td>
            </tr>
            <tr>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_question('vehicle_theft_remote_after'); ?>
</td>
                <td><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_remote_after'); ?>
</td>
            </tr>
        </tbody>
    </table>
    </div>
    <?php endif; ?>
    <?php endif; ?>
  </div>
  </div>


  
<div class="resources">
    <?php echo smarty_function_object_attachments(array('object' => $this->_tpl_vars['active_ticket']), $this);?>

    <?php echo smarty_function_object_subscriptions(array('object' => $this->_tpl_vars['active_ticket']), $this);?>

    <?php echo smarty_function_object_tasks(array('object' => $this->_tpl_vars['active_ticket']), $this);?>

    
    <div class="resource object_comments" id="comments">
      <div class="body">
      <?php if ($this->_tpl_vars['pagination']->getLastPage() > 1): ?>
        <p class="pagination top"><span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['active_ticket']->getViewUrl('-PAGE-');  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></p>
        <div class="clear"></div>
        <?php endif; ?>
        
        <?php if ($this->_tpl_vars['pagination']->getLastPage() > $this->_tpl_vars['pagination']->getCurrentPage()): ?>
          <?php echo smarty_function_object_comments(array('object' => $this->_tpl_vars['active_ticket'],'comments' => $this->_tpl_vars['comments'],'show_header' => false,'count_from' => $this->_tpl_vars['count_start'],'next_page' => $this->_tpl_vars['active_ticket']->getViewUrl($this->_tpl_vars['pagination']->getNextPage())), $this);?>

        <?php else: ?>
          <?php echo smarty_function_object_comments(array('object' => $this->_tpl_vars['active_ticket'],'comments' => $this->_tpl_vars['comments'],'show_header' => false,'count_from' => $this->_tpl_vars['count_start']), $this);?>

        <?php endif; ?>
      </div>
    </div>
    
    <?php echo smarty_function_ticket_changes(array('ticket' => $this->_tpl_vars['active_ticket']), $this);?>

  </div>
</div>