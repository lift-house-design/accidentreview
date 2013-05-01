<?php /* Smarty version 2.6.16, created on 2012-08-30 11:37:05
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_properties.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'assign_var', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_properties.tpl', 1, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_properties.tpl', 5, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_properties.tpl', 9, false),array('modifier', 'filesize', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_properties.tpl', 14, false),array('modifier', 'date', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_properties.tpl', 20, false),array('function', 'mobile_access_get_view_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_properties.tpl', 30, false),array('function', 'mobile_access_object_assignees', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_properties.tpl', 70, false),array('function', 'implode', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_properties.tpl', 76, false),)), $this); ?>
<?php $this->_tag_stack[] = array('assign_var', array('name' => '_object_details_block')); $_block_repeat=true;smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  if (! $this->_tpl_vars['_mobile_access_object_properties_only_show_body']): ?>
  <?php if ($this->_tpl_vars['_mobile_access_object_properties_show_name']): ?>
    <?php if (( instance_of ( $this->_tpl_vars['_mobile_access_object_properties_object'] , 'File' ) )): ?>
    <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>File Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
    <?php else: ?>
    <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
    <?php endif; ?>
    <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['_mobile_access_object_properties_object']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['_mobile_access_object_properties_show_file_details'] && instance_of ( $this->_tpl_vars['_mobile_access_object_properties_object'] , 'File' )): ?>
    <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>File Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
    <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['_mobile_access_object_properties_object']->getSize())) ? $this->_run_mod_handler('filesize', true, $_tmp) : smarty_modifier_filesize($_tmp)); ?>
 (<?php echo ((is_array($_tmp=$this->_tpl_vars['_mobile_access_object_properties_object']->getMimeType())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
)</dd>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['_mobile_access_object_properties_show_completed_status']): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
    <?php if ($this->_tpl_vars['_mobile_access_object_properties_object']->isCompleted()): ?>
      <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['_mobile_access_object_properties_object']->getCompletedByName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
 on <?php echo ((is_array($_tmp=$this->_tpl_vars['_mobile_access_object_properties_object']->getCompletedOn())) ? $this->_run_mod_handler('date', true, $_tmp) : smarty_modifier_date($_tmp)); ?>
</dd>
    <?php else: ?>
      <dd><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Open<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dd>
    <?php endif; ?>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['_mobile_access_object_properties_show_category']): ?>
    <?php if ($this->_tpl_vars['_mobile_access_object_properties_object']->getParentId()): ?>
      <?php $this->assign('category', $this->_tpl_vars['_mobile_access_object_properties_object']->getParent()); ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><a href="<?php echo smarty_function_mobile_access_get_view_url(array('object' => $this->_tpl_vars['category']), $this);?>
"><?php echo $this->_tpl_vars['category']->getName(); ?>
</a></dd>
    <?php endif; ?>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['_mobile_access_object_properties_show_milestone']): ?>
    <?php if ($this->_tpl_vars['_mobile_access_object_properties_object']->getMilestoneId()): ?>
      <?php $this->assign('milestone', $this->_tpl_vars['_mobile_access_object_properties_object']->getMilestone()); ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Milestone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><a href="<?php echo smarty_function_mobile_access_get_view_url(array('object' => $this->_tpl_vars['milestone']), $this);?>
"><?php echo $this->_tpl_vars['milestone']->getName(); ?>
</a></dd>
    <?php endif; ?>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['_mobile_access_object_properties_show_total_time']): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo $this->_tpl_vars['_mobile_access_object_properties_total_time']; ?>
 <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>hours<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dd>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['_mobile_access_object_properties_show_milestone_day_info']): ?>
    <?php if (instance_of ( $this->_tpl_vars['_mobile_access_object_properties_object'] , 'Milestone' )): ?>
      <?php if ($this->_tpl_vars['_mobile_access_object_properties_object']->isDayMilestone()): ?>
        <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Due On<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
        <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['_mobile_access_object_properties_object']->getDueOn())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>
</dd>
      <?php else: ?>
        <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>From / To<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
        <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['_mobile_access_object_properties_object']->getStartOn())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>
 &mdash; <?php echo ((is_array($_tmp=$this->_tpl_vars['_mobile_access_object_properties_object']->getDueOn())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>
</dd>
      <?php endif; ?>
    <?php elseif (instance_of ( $this->_tpl_vars['_mobile_access_object_properties_object'] , 'Ticket' )): ?>
        <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Due On<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
        <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['_mobile_access_object_properties_object']->getDueOn())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>
</dd>   
    <?php endif; ?>
  <?php endif; ?>

  
  <?php if ($this->_tpl_vars['_mobile_access_object_properties_show_priority']): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['_mobile_access_object_properties_object']->getFormattedPriority())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['_mobile_access_object_properties_show_assignees']): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignees<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo smarty_function_mobile_access_object_assignees(array('object' => $this->_tpl_vars['_mobile_access_object_properties_object']), $this);?>
</dd>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['_mobile_access_object_properties_show_tags']): ?>
    <?php if ($this->_tpl_vars['_mobile_access_object_properties_object']->hasTags()): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tags<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo smarty_function_implode(array('separator' => ", ",'values' => $this->_tpl_vars['_mobile_access_object_properties_object']->getTags()), $this);?>
</dd>
    <?php endif; ?>
  <?php endif;  endif;  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  if (trim ( $this->_tpl_vars['_object_details_block'] )): ?>
  <dl class="object_details">
    <?php echo $this->_tpl_vars['_object_details_block']; ?>

  </dl>
<?php endif; ?>
    
  <?php if ($this->_tpl_vars['_mobile_access_object_properties_show_body'] || $this->_tpl_vars['_mobile_access_object_properties_only_show_body']): ?>
    <?php if ($this->_tpl_vars['_mobile_access_object_properties_object']->getBody()): ?>
      <div class="object_details"><?php echo $this->_tpl_vars['_mobile_access_object_properties_object']->getFormattedBody(); ?>
</div>
    <?php else: ?>
      <div class="object_details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No notes for this object<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
    <?php endif; ?>
  <?php endif; ?>