<?php /* Smarty version 2.6.16, created on 2012-08-10 14:38:54
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_task_opened_row.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_task_opened_row.tpl', 1, false),array('function', 'object_star', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_task_opened_row.tpl', 4, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_task_opened_row.tpl', 7, false),array('function', 'object_priority', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_task_opened_row.tpl', 12, false),array('function', 'object_subscription', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_task_opened_row.tpl', 15, false),array('function', 'object_time', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_task_opened_row.tpl', 17, false),array('function', 'object_assignees', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_task_opened_row.tpl', 30, false),array('function', 'due', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_task_opened_row.tpl', 30, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_task_opened_row.tpl', 7, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_task_opened_row.tpl', 28, false),array('modifier', 'clickable', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/tasks/_task_opened_row.tpl', 28, false),)), $this); ?>
                <li class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
 sort"id="task<?php echo $this->_tpl_vars['_object_task']->getId(); ?>
">
                  <span class="task">
                    <span class="left_options">
                      <span class="option star"><?php echo smarty_function_object_star(array('object' => $this->_tpl_vars['_object_task'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</span>
                      <span class="option checkbox">
                        <?php if ($this->_tpl_vars['_object_task']->canChangeCompleteStatus($this->_tpl_vars['logged_user'])): ?>
                          <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['_object_task']->getCompleteUrl(true),'class' => 'complete_task')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "icons/not-checked.gif"), $this);?>
" alt="toggle" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                        <?php else: ?>
                          <img src="<?php echo smarty_function_image_url(array('name' => "icons/not-checked.gif"), $this);?>
" alt="toggle" />
                        <?php endif; ?>
                      </span>
                      <span class="option"><?php echo smarty_function_object_priority(array('object' => $this->_tpl_vars['_object_task']), $this);?>
</span>
                    </span>
                    <span class="right_options">
                        <span class="option"><?php echo smarty_function_object_subscription(array('object' => $this->_tpl_vars['_object_task'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</span>
                      <?php if (module_loaded ( 'timetracking' ) && $this->_tpl_vars['logged_user']->getProjectPermission('timerecord',$this->_tpl_vars['_object_task']->getProject())): ?>
                        <span class="option"><?php echo smarty_function_object_time(array('object' => $this->_tpl_vars['_object_task'],'show_time' => false), $this);?>
</span>
                      <?php endif; ?>
                      <?php if ($this->_tpl_vars['_object_task']->canEdit($this->_tpl_vars['logged_user'])): ?>
                        <span class="option"><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['_object_task']->getEditUrl(),'title' => 'Edit...')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "gray-edit.gif"), $this);?>
' alt='' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                      <?php endif; ?>
                      <?php if ($this->_tpl_vars['_object_task']->canDelete($this->_tpl_vars['logged_user'])): ?>
                        <span class="option"><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['_object_task']->getTrashUrl(),'title' => 'Move to Trash','class' => 'remove_task')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
' alt='' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                      <?php endif; ?>
                    </span>
                    <span class="main_data">
                      <input type="hidden" name="task[<?php echo $this->_tpl_vars['_object_task']->getId(true); ?>
]" />
                      <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['_object_task']->getBody())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)))) ? $this->_run_mod_handler('clickable', true, $_tmp) : smarty_modifier_clickable($_tmp)); ?>

                    <?php if ($this->_tpl_vars['_object_task']->hasAssignees(true) && $this->_tpl_vars['_object_task']->getDueOn()): ?>
                      <span class="details block"><?php echo smarty_function_object_assignees(array('object' => $this->_tpl_vars['_object_task']), $this);?>
 | <?php echo smarty_function_due(array('object' => $this->_tpl_vars['_object_task']), $this);?>
</span>
                    <?php elseif ($this->_tpl_vars['_object_task']->hasAssignees(true)): ?>
                      <span class="details block"><?php echo smarty_function_object_assignees(array('object' => $this->_tpl_vars['_object_task']), $this);?>
</span>
                    <?php elseif ($this->_tpl_vars['_object_task']->getDueOn()): ?>
                      <span class="details block"><?php echo smarty_function_due(array('object' => $this->_tpl_vars['_object_task']), $this);?>
</span>
                    <?php endif; ?>
                    </span>
                  </span>
                </li>