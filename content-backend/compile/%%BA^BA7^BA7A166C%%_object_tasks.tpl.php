<?php /* Smarty version 2.6.16, created on 2012-07-27 16:10:06
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_object_tasks.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'assign_var', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_object_tasks.tpl', 7, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_object_tasks.tpl', 7, false),array('block', 'form', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_object_tasks.tpl', 21, false),array('block', 'wrap', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_object_tasks.tpl', 37, false),array('block', 'label', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_object_tasks.tpl', 38, false),array('block', 'wrap_buttons', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_object_tasks.tpl', 69, false),array('block', 'submit', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_object_tasks.tpl', 70, false),array('function', 'include_template', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_object_tasks.tpl', 25, false),array('function', 'text_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_object_tasks.tpl', 39, false),array('function', 'select_priority', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_object_tasks.tpl', 48, false),array('function', 'select_date', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_object_tasks.tpl', 55, false),array('function', 'select_assignees', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_object_tasks.tpl', 65, false),array('function', 'assemble', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_object_tasks.tpl', 85, false),)), $this); ?>
<?php if (! $this->_tpl_vars['_object_tasks_skip_wrapper']): ?>
<div class="resource object_tasks object_section" id="object_tasks_for_<?php echo $this->_tpl_vars['_object_tasks_object']->getId(); ?>
" <?php if (! $this->_tpl_vars['_object_tasks_force_show'] && ! ( is_foreachable ( $this->_tpl_vars['_object_tasks_open'] ) || is_foreachable ( $this->_tpl_vars['_object_tasks_completed'] ) )): ?>style="display: none"<?php endif; ?>>
<?php endif; ?>

  <?php if ($this->_tpl_vars['_object_tasks_skip_head'] == false): ?>
    <div class="head">
      <?php $this->_tag_stack[] = array('assign_var', array('name' => 'section_title')); $_block_repeat=true;smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php if ($this->_tpl_vars['_object_tasks_object']->canSubtask($this->_tpl_vars['logged_user'])): ?>
        <h2 class="section_name"><span class="section_name_span">
          <span class="section_name_span_span"><?php echo $this->_tpl_vars['section_title']; ?>
</span>
          <div class="clear"></div>
        </span></h2>
      <?php else: ?>
        <h2 class="section_name"><span class="section_name_span">
          <span class="section_name_span_span"><?php echo $this->_tpl_vars['section_title']; ?>
</span>
        </span></h2>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <div class="body">
  <?php $this->_tag_stack[] = array('form', array('method' => 'POST','action' => $this->_tpl_vars['_object_tasks_object']->getReorderTasksUrl(true),'class' => 'sort_form visible_overflow')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
  <ul class="tasks_table common_table_list highlight_priority open_tasks_table">
    <?php if (is_foreachable ( $this->_tpl_vars['_object_tasks_open'] )): ?>
      <?php $_from = $this->_tpl_vars['_object_tasks_open']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_object_task']):
?>
        <?php echo smarty_function_include_template(array('module' => 'resources','controller' => 'tasks','name' => '_task_opened_row'), $this);?>

      <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>
    <li class="empty_row" style="<?php if (is_foreachable ( $this->_tpl_vars['_object_tasks_open'] )): ?>display: none<?php endif; ?>"><?php $this->_tag_stack[] = array('lang', array('object_type' => $this->_tpl_vars['_object_tasks_object']->getVerboseType())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no active Tasks in this :object_type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
  </ul>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php if ($this->_tpl_vars['_object_tasks_object']->canSubtask($this->_tpl_vars['logged_user'])): ?>
    <div class="hidden_overflow">
      <div class="add_task_form" style="display: none">
        <?php $this->_tag_stack[] = array('form', array('action' => $this->_tpl_vars['_object_tasks_object']->getPostTaskUrl(),'method' => 'post')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
          <div class="columns">
            <div class="form_left_col">
              <?php $this->_tag_stack[] = array('wrap', array('field' => 'body')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                <?php $this->_tag_stack[] = array('label', array('for' => 'taskSummary','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                <?php echo smarty_function_text_field(array('name' => 'task[body]','class' => 'long required','id' => 'taskSummary'), $this);?>

              <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
              
              <p class="show_due_date_and_priority"><a class="additional_form_links" href="#"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set priority and due date...<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
              
              <div class="due_date_and_priority">
                <div class="col_wide">
                <?php $this->_tag_stack[] = array('wrap', array('field' => 'priority')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                  <?php $this->_tag_stack[] = array('label', array('for' => 'taskPriority')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                  <?php echo smarty_function_select_priority(array('name' => 'task[priority]','id' => 'taskPriority'), $this);?>

                <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                </div>
                
                <div class="col_wide2">
                <?php $this->_tag_stack[] = array('wrap', array('field' => 'due_on')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                  <?php $this->_tag_stack[] = array('label', array('for' => 'taskDueOn')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Due on<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                  <?php echo smarty_function_select_date(array('name' => 'task[due_on]','id' => 'taskDueOn'), $this);?>

                <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                </div>
              </div>
              <div class="clear"></div>
            </div>
            
            <div class="form_right_col">
              <?php $this->_tag_stack[] = array('wrap', array('field' => 'assignees')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                <?php $this->_tag_stack[] = array('label', array('for' => 'taskAssignees')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignees<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                <?php echo smarty_function_select_assignees(array('name' => 'task[assignees]','object' => $this->_tpl_vars['_object_tasks_object'],'project' => $this->_tpl_vars['active_project']), $this);?>

              <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </div>
          </div>
          <?php $this->_tag_stack[] = array('wrap_buttons', array()); $_block_repeat=true;smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('submit', array()); $_block_repeat=true;smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <a href="#" class="text_button cancel_button"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Done adding tasks?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </div>
      <a href="<?php echo $this->_tpl_vars['_object_tasks_object']->getPostTaskUrl(); ?>
" class="add_task_link button_add dont_print"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Another Task<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a>
    </div>
  <?php endif; ?>

  <ul class="tasks_table common_table_list completed_tasks_table">
  <?php if (is_foreachable ( $this->_tpl_vars['_object_tasks_completed'] )): ?>
    <?php $_from = $this->_tpl_vars['_object_tasks_completed']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_object_task']):
?>
      <?php echo smarty_function_include_template(array('module' => 'resources','controller' => 'tasks','name' => '_task_completed_row'), $this);?>

    <?php endforeach; endif; unset($_from); ?>
    <?php if ($this->_tpl_vars['_object_tasks_completed_remaining'] > 0): ?>
      <li class="list_all_completed"><a href="<?php echo smarty_function_assemble(array('route' => 'project_tasks_list_completed','project_id' => $this->_tpl_vars['active_project']->getId(),'parent_id' => $this->_tpl_vars['_object_tasks_object']->getId()), $this);?>
"><?php $this->_tag_stack[] = array('lang', array('remaining_count' => $this->_tpl_vars['_object_tasks_completed_remaining'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show :remaining_count remaining completed tasks<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
    <?php endif; ?>
  <?php endif; ?>
  </ul>
  </div>
  
<?php if (! $this->_tpl_vars['_object_tasks_skip_wrapper']): ?>
</div>
<script type="text/javascript">
  App.layout.init_object_tasks('object_tasks_for_<?php echo $this->_tpl_vars['_object_tasks_object']->getId(); ?>
', '<?php echo $this->_tpl_vars['_object_tasks_can_reorder']; ?>
');
</script>
<?php endif; ?>