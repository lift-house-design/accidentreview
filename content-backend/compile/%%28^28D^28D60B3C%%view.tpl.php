<?php /* Smarty version 2.6.16, created on 2012-08-30 11:37:05
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/mobile_access_project_tickets/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/mobile_access_project_tickets/view.tpl', 4, false),array('function', 'mobile_access_object_properties', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/mobile_access_project_tickets/view.tpl', 6, false),array('function', 'mobile_access_object_tasks', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/mobile_access_project_tickets/view.tpl', 8, false),array('function', 'mobile_access_object_comments', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/mobile_access_project_tickets/view.tpl', 10, false),array('function', 'mobile_access_add_comment_form', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/mobile_access_project_tickets/view.tpl', 11, false),array('function', 'ticket_changes', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/mobile_access_project_tickets/view.tpl', 15, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/mobile_access_project_tickets/view.tpl', 13, false),)), $this); ?>
<div class="wrapper">
  <div class="box">
    <div class="object_main_info">
       <h1 class="object_name"><?php echo ((is_array($_tmp=$this->_tpl_vars['active_ticket']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</h1>
    </div>
    <?php echo smarty_function_mobile_access_object_properties(array('object' => $this->_tpl_vars['active_ticket'],'show_completed_status' => true,'show_tags' => true,'show_body' => true,'show_milestone' => true,'show_priority' => true,'show_total_time' => true,'show_milestone_day_info' => true,'show_assignees' => true), $this);?>

  </div>
  <?php echo smarty_function_mobile_access_object_tasks(array('object' => $this->_tpl_vars['active_ticket']), $this);?>
 
  
  <?php echo smarty_function_mobile_access_object_comments(array('object' => $this->_tpl_vars['active_ticket'],'user' => $this->_tpl_vars['logged_user']), $this);?>

  <?php echo smarty_function_mobile_access_add_comment_form(array('parent' => $this->_tpl_vars['active_ticket'],'comment_data' => $this->_tpl_vars['comment_data']), $this);?>

  
  <h2 class="label"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>History<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
  <div class="box">
    <?php echo smarty_function_ticket_changes(array('ticket' => $this->_tpl_vars['active_ticket']), $this);?>

  </div>  
</div>