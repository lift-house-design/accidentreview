<?php /* Smarty version 2.6.16, created on 2012-12-28 16:52:30
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl', 2, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl', 7, false),array('block', 'pagination', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl', 7, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl', 27, false),array('function', 'assemble', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl', 7, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl', 13, false),array('function', 'object_star', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl', 14, false),array('function', 'object_complete', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl', 15, false),array('function', 'object_priority', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl', 16, false),array('function', 'object_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl', 18, false),array('function', 'project_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl', 19, false),array('function', 'object_assignees', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl', 19, false),array('function', 'due', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl', 21, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/late_today.tpl', 18, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Late or Scheduled for Today<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Late / Today<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="late_today">
<?php if (is_foreachable ( $this->_tpl_vars['objects'] )): ?>
  <?php if ($this->_tpl_vars['pagination']->getLastPage() > 1): ?>
  <p class="pagination top"><span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'late_today','page' => '-PAGE-'), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></p>
  <div class="clear"></div>
  <?php endif; ?>
  
  <table>
  <?php $_from = $this->_tpl_vars['objects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['object']):
?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
      <td class="star"><?php echo smarty_function_object_star(array('object' => $this->_tpl_vars['object'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</td>
      <td class="checkbox"><?php echo smarty_function_object_complete(array('object' => $this->_tpl_vars['object'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</td>
      <td class="priority"><?php echo smarty_function_object_priority(array('object' => $this->_tpl_vars['object']), $this);?>
</td>
      <td class="name">
        <?php echo ((is_array($_tmp=$this->_tpl_vars['object']->getVerboseType())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
: <?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['object']), $this);?>

        <span class="details block"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>In<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo smarty_function_project_link(array('project' => $this->_tpl_vars['object']->getProject()), $this);?>
 <?php if ($this->_tpl_vars['object']->hasAssignees()): ?>| <?php echo smarty_function_object_assignees(array('object' => $this->_tpl_vars['object']), $this); endif; ?></span>
      </td>
      <td class="due"><?php echo smarty_function_due(array('object' => $this->_tpl_vars['object']), $this);?>
</td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
  </table>
  
  <?php if ($this->_tpl_vars['request']->isAsyncCall()): ?>
  <p id="open_in_separate_page"><?php $this->_tag_stack[] = array('link', array('href' => '?route=late_today')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Open in Separate Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <?php endif;  else: ?>
  <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no tasks that are late or scheduled for today<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php endif; ?>
</div>