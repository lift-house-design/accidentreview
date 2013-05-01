<?php /* Smarty version 2.6.16, created on 2012-07-31 17:01:46
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/quick_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/quick_add.tpl', 3, false),array('block', 'form', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/quick_add.tpl', 6, false),array('block', 'wrap', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/quick_add.tpl', 10, false),array('block', 'label', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/quick_add.tpl', 11, false),array('block', 'textarea_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/quick_add.tpl', 17, false),array('block', 'submit', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/quick_add.tpl', 89, false),array('function', 'text_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/quick_add.tpl', 12, false),array('function', 'select_milestone', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/quick_add.tpl', 31, false),array('function', 'select_category', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/quick_add.tpl', 38, false),array('function', 'attach_files', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/quick_add.tpl', 48, false),array('function', 'select_assignees_inline', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/quick_add.tpl', 57, false),array('function', 'select_date', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/quick_add.tpl', 66, false),array('function', 'select_visibility', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/quick_add.tpl', 77, false),)), $this); ?>
<div class="form_wrapper">
  <?php if (isset ( $this->_tpl_vars['active_ticket'] ) && $this->_tpl_vars['active_ticket']->isLoaded()): ?>
    <p class="flash" id="success"><span class="flash_inner"><?php $this->_tag_stack[] = array('lang', array('name' => $this->_tpl_vars['active_ticket']->getName(),'url' => $this->_tpl_vars['active_ticket']->getViewUrl())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Ticket <a href=":url">:name</a> has been created<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></p>
  <?php endif; ?>
  
  <?php $this->_tag_stack[] = array('form', array('method' => 'post','id' => 'quick_add_ticket','action' => $this->_tpl_vars['quick_add_url'],'enctype' => "multipart/form-data")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <div class="height_limited_popup">
      <div class="quick_add_columns_container">
        <div class="quick_add_left_column"><div class="quick_add_left_column_inner">
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'name','class' => 'first_quick_add_field')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('label', array('for' => 'quick_add_ticket_summary','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php echo smarty_function_text_field(array('name' => 'ticket[name]','value' => $this->_tpl_vars['ticket_data']['name'],'id' => 'quick_add_ticket_summary','class' => 'required title'), $this);?>

          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>   
          
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'body','id' => 'quick_add_ticket_body_wrapper')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('label', array('for' => 'quick_add_ticket_body')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Full description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php $this->_tag_stack[] = array('textarea_field', array('name' => 'ticket[body]','id' => 'quick_add_ticket_body')); $_block_repeat=true;smarty_block_textarea_field($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['ticket_data']['body'];  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_textarea_field($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          
          <div class="ctrlHolderContainer">
            <?php if ($this->_tpl_vars['logged_user']->canSeeMilestones($this->_tpl_vars['active_project'])): ?>
              <a href="#" class="ctrlHolderToggler"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set Milestone and Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>...</a>
            <?php else: ?>
              <a href="#" class="ctrlHolderToggler"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>...</a>
            <?php endif; ?>
            <div class="strlHolderToggled">
              <?php if ($this->_tpl_vars['logged_user']->canSeeMilestones($this->_tpl_vars['active_project'])): ?>
              <div class="col_wide">
                <?php $this->_tag_stack[] = array('wrap', array('field' => 'milestone_id')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                  <?php $this->_tag_stack[] = array('label', array('for' => 'ticketMilestone')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Milestone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                  <?php echo smarty_function_select_milestone(array('name' => 'ticket[milestone_id]','value' => $this->_tpl_vars['ticket_data']['milestone_id'],'project' => $this->_tpl_vars['active_project'],'id' => 'ticketMilestone'), $this);?>

                <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
              </div>
              <?php endif; ?>
              <div class="col_wide2">
                <?php $this->_tag_stack[] = array('wrap', array('field' => 'parent_id')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                  <?php $this->_tag_stack[] = array('label', array('for' => 'ticketParentPopup')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                  <?php echo smarty_function_select_category(array('name' => 'ticket[parent_id]','value' => $this->_tpl_vars['ticket_data']['parent_id'],'id' => 'ticketParentPopup','module' => 'tickets','controller' => 'tickets','project' => $this->_tpl_vars['active_project'],'user' => $this->_tpl_vars['logged_user']), $this);?>

                <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
              </div>
            </div>
          </div>
          <div class="ctrlHolderContainer">
            <a href="#" class="ctrlHolderToggler"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Attach Files<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>...</a>
            <div class="strlHolderToggled">
              <?php $this->_tag_stack[] = array('wrap', array('field' => 'popup_attachments')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                <?php $this->_tag_stack[] = array('label', array('for' => 'popup_attachments')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Attachments<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                <?php echo smarty_function_attach_files(array('id' => 'attach_files_popup','max_files' => 5), $this);?>

              <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </div>
          </div>
        </div></div>
        
        <div class="quick_add_right_column"><div class="quick_add_right_column_inner">
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'assignees')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('label', array('for' => 'ticketAssignees')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignees<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php echo smarty_function_select_assignees_inline(array('name' => 'ticket[assignees]','value' => $this->_tpl_vars['ticket_data']['assignees'],'object' => $this->_tpl_vars['active_ticket'],'project' => $this->_tpl_vars['active_project'],'choose_responsible' => true,'id' => 'select_asignees_popup','users_per_row' => 1), $this);?>

          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>      
        </div>
        
          <div class="ctrlHolderContainer">
            <a href="#" class="ctrlHolderToggler"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set Due On<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>...</a>
            <div class="strlHolderToggled">
              <?php $this->_tag_stack[] = array('wrap', array('field' => 'due_on')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                <?php $this->_tag_stack[] = array('label', array('for' => 'ticketVisibility')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Due On<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                <?php echo smarty_function_select_date(array('name' => 'ticket[due_on]','value' => $this->_tpl_vars['ticket_data']['due_on'],'id' => 'ticketDueOn'), $this);?>

              <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </div>
          </div>
        
          <?php if ($this->_tpl_vars['logged_user']->canSeePrivate()): ?>
          <div class="ctrlHolderContainer">
            <a href="#" class="ctrlHolderToggler"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set Visibility<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>...</a>
            <div class="strlHolderToggled">
              <?php $this->_tag_stack[] = array('wrap', array('field' => 'visibility')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                <?php $this->_tag_stack[] = array('label', array('for' => 'ticketVisibility')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Visibility<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                <?php echo smarty_function_select_visibility(array('name' => "ticket[visibility]",'value' => $this->_tpl_vars['ticket_data']['visibility'],'project' => $this->_tpl_vars['active_project'],'short_description' => true), $this);?>

              <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </div>
          </div>
          <?php else: ?>
            <input type="hidden" name="ticket[visibility]" value="1" />
          <?php endif; ?>
        </div>
      </div>
    </div>
    
    <div class="wizardbar">
      <?php $this->_tag_stack[] = array('submit', array('accesskey' => false,'class' => 'submit')); $_block_repeat=true;smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><a href="#" class="wizzard_back"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
    </div>
    <input type="hidden" name="ticket[project_id]" value="<?php if ($this->_tpl_vars['project_id']):  echo $this->_tpl_vars['project_id'];  else:  echo $this->_tpl_vars['ticket_data']['project_id'];  endif; ?>" />
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>


<script type="text/javascript">
<?php echo '
  if (App.ModalDialog.isOpen) {
    App.ModalDialog.setWidth(850);
  } // if
'; ?>

</script>