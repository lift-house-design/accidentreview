<?php /* Smarty version 2.6.16, created on 2012-08-09 18:51:58
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/quick_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'assign_var', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/quick_add.tpl', 3, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/quick_add.tpl', 4, false),array('block', 'form', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/quick_add.tpl', 7, false),array('block', 'wrap', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/quick_add.tpl', 9, false),array('block', 'label', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/quick_add.tpl', 10, false),array('block', 'submit', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/quick_add.tpl', 33, false),array('function', 'assemble', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/quick_add.tpl', 3, false),array('function', 'text_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/quick_add.tpl', 11, false),array('function', 'select_date', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/quick_add.tpl', 16, false),array('function', 'yes_no', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/quick_add.tpl', 23, false),)), $this); ?>
<div class="form_wrapper">
  <?php if (isset ( $this->_tpl_vars['active_time_record'] ) && $this->_tpl_vars['active_time_record']->isLoaded()): ?>
    <?php $this->_tag_stack[] = array('assign_var', array('name' => 'project_time_url')); $_block_repeat=true;smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'project_time','project_id' => $this->_tpl_vars['active_project']->getId()), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <p class="flash" id="success"><span class="flash_inner"><?php $this->_tag_stack[] = array('lang', array('name' => $this->_tpl_vars['active_project']->getName(),'url' => $this->_tpl_vars['project_time_url'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time record has been created in <a href=":url">:name</a> project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></p>
  <?php endif; ?>
  
  <?php $this->_tag_stack[] = array('form', array('method' => 'post','id' => 'quick_add_time_record','action' => $this->_tpl_vars['quick_add_url'])); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <div id="wrap_hours_date">
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'value','class' => 'left_record_field')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <?php $this->_tag_stack[] = array('label', array('for' => 'quick_add_time_record_value','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Hours<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php echo smarty_function_text_field(array('name' => 'time_record[value]','value' => $this->_tpl_vars['time_record_data']['value'],'id' => 'quick_add_time_record_value','class' => 'required'), $this);?>

      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'record_date','class' => 'right_record_field')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <?php $this->_tag_stack[] = array('label', array('for' => 'quick_add_time_record_date','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php echo smarty_function_select_date(array('name' => 'time_record[record_date]','value' => $this->_tpl_vars['time_record_data']['record_date'],'show_timezone' => false,'id' => 'quick_add_time_record_date','class' => 'required'), $this);?>

      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </div>
    
    <div id="wrap_billable_summary">
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'value','class' => 'left_record_field')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <?php $this->_tag_stack[] = array('label', array('for' => 'quick_add_time_record_billable_status')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Is Billable<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php echo smarty_function_yes_no(array('name' => 'time_record[billable_status]','value' => $this->_tpl_vars['time_record_data']['billable_status'],'id' => 'quick_add_time_record_billable_status'), $this);?>

      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'body','class' => 'right_record_field')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <?php $this->_tag_stack[] = array('label', array('for' => 'quick_add_time_record_summary')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php echo smarty_function_text_field(array('name' => 'time_record[body]','value' => $this->_tpl_vars['time_record_data']['body'],'id' => 'quick_add_time_record_summary'), $this);?>

      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </div>
    
    <div class="wizardbar">
      <?php $this->_tag_stack[] = array('submit', array('accesskey' => false,'class' => 'submit')); $_block_repeat=true;smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><a href="#" class="wizzard_back"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
    </div>
    <input type="hidden" name="time_record[project_id]" value="<?php if ($this->_tpl_vars['project_id']):  echo $this->_tpl_vars['project_id'];  else:  echo $this->_tpl_vars['time_record_data']['project_id'];  endif; ?>" />
    <input type="hidden" name="time_record[user_id]" value="<?php echo $this->_tpl_vars['logged_user']->getId(); ?>
" />
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>
<script type="text/javascript">
<?php echo '
  if (App.ModalDialog.isOpen) {
    App.ModalDialog.setWidth(500);
  } // if
'; ?>

</script>