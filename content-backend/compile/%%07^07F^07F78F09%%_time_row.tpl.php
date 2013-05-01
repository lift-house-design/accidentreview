<?php /* Smarty version 2.6.16, created on 2012-08-01 20:25:51
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/_time_row.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/_time_row.tpl', 1, false),array('function', 'user_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/_time_row.tpl', 3, false),array('function', 'object_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/_time_row.tpl', 7, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/_time_row.tpl', 25, false),array('modifier', 'date', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/_time_row.tpl', 2, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/_time_row.tpl', 17, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/_time_row.tpl', 25, false),)), $this); ?>
<tr class="time_record <?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
 <?php if ($this->_tpl_vars['timerecord']->isBilled()): ?>billed<?php endif; ?>">
  <td class="date"><?php echo ((is_array($_tmp=$this->_tpl_vars['timerecord']->getRecordDate())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>
</td>
  <td class="user"><?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['timerecord']->getUser()), $this);?>
</td>
  <td class="hours"><b><?php echo $this->_tpl_vars['timerecord']->getValue(); ?>
</b></td>
  <td class="desc">
  <?php if (instance_of ( $this->_tpl_vars['timerecord']->getParent() , 'ProjectObject' )): ?>
    <?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['timerecord']->getParent()), $this);?>
 
    <?php if ($this->_tpl_vars['timerecord']->getBody()): ?>
      &mdash; <?php echo $this->_tpl_vars['timerecord']->getBody(); ?>

    <?php endif; ?>
  <?php else: ?>
    <?php echo $this->_tpl_vars['timerecord']->getBody(); ?>

  <?php endif; ?>
  </td>
  <td class="billable">
  <?php if ($this->_tpl_vars['timerecord']->isBillable()): ?>
    <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php else: ?>
    <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php endif; ?>
  </td>
  <td class="actions">
  <?php if ($this->_tpl_vars['timerecord']->canChangeBillableStatus($this->_tpl_vars['logged_user'])): ?>
    <?php if ($this->_tpl_vars['timerecord']->getBillableStatus() == BILLABLE_STATUS_BILLED): ?>
      <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['timerecord']->getUpdateBilledStateUrl(false),'title' => 'Billed...','class' => 'mark_time_record_as_billed')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "dollar-small.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
    <?php elseif ($this->_tpl_vars['timerecord']->getBillableStatus() == BILLABLE_STATUS_BILLABLE): ?>
      <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['timerecord']->getUpdateBilledStateUrl(true),'title' => 'Not billed...','class' => 'mark_time_record_as_billed')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-dollar-small.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
    <?php endif; ?>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['timerecord']->canEdit($this->_tpl_vars['logged_user'])): ?>
    <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['timerecord']->getEditUrl(),'title' => 'Edit...','class' => 'edit_time_record')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-edit.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
  <?php endif; ?>
  </td>
  
  <td class="checkbox">
  <?php if ($this->_tpl_vars['can_manage']): ?>
    <input type="checkbox" name="time_record_ids[]" value="<?php echo $this->_tpl_vars['timerecord']->getId(); ?>
" class="auto slave_checkbox input_checkbox" />
  <?php endif; ?>
  </td>
</tr>