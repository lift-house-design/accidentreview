<?php /* Smarty version 2.6.16, created on 2012-07-31 18:44:23
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 2, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 8, false),array('block', 'pagination', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 8, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 24, false),array('function', 'assemble', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 8, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 22, false),array('function', 'object_star', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 23, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 24, false),array('function', 'object_priority', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 25, false),array('function', 'object_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 27, false),array('function', 'object_assignees', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 28, false),array('function', 'due', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 28, false),array('function', 'project_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 30, false),array('function', 'object_subscription', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 32, false),array('function', 'object_time', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 34, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/user_tasks.tpl', 27, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Project Tasks<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>List My Tasks<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="assignments">
  <div id="assignments_list">
  <?php if (is_foreachable ( $this->_tpl_vars['assignments'] )): ?>
    <?php if ($this->_tpl_vars['pagination'] && ( $this->_tpl_vars['pagination']->getLastPage() > 1 )): ?>
    <p class="pagination top"><span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'project_user_tasks','project_id' => $this->_tpl_vars['active_project']->getId(),'page' => "-PAGE-"), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></p>
    <?php endif; ?>
    <div class="clear"></div>
    
    <table class="assignments">
      <tr>
        <th class="star"></th>
        <th class="checkbox"></th>
        <th class="priority"></th>
        <th class="name"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="project"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="option"></th>
      </tr>
    <?php $_from = $this->_tpl_vars['assignments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['assignment']):
?>
      <tr class="assignment_row <?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
        <td class="star"><?php echo smarty_function_object_star(array('object' => $this->_tpl_vars['assignment'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</td>
        <td class="checkbox"><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['assignment']->getCompleteUrl(true),'class' => 'complete_assignment')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "icons/not-checked.gif"), $this);?>
" alt="toggle" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
        <td class="priority"><?php echo smarty_function_object_priority(array('object' => $this->_tpl_vars['assignment']), $this);?>
</td>
        <td class="name">
          <?php echo ((is_array($_tmp=$this->_tpl_vars['assignment']->getVerboseType())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
: <?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['assignment']), $this);?>

          <span class="details block"><?php echo smarty_function_object_assignees(array('object' => $this->_tpl_vars['assignment']), $this); if ($this->_tpl_vars['assignment']->getDueOn()): ?> | <?php echo smarty_function_due(array('object' => $this->_tpl_vars['assignment']), $this);?>
.<?php endif; ?></span>
        </td>
        <td class="project"><?php echo smarty_function_project_link(array('project' => $this->_tpl_vars['assignment']->getProject()), $this);?>
</td>
        <td class="options">
        <?php echo smarty_function_object_subscription(array('object' => $this->_tpl_vars['assignment'],'user' => $this->_tpl_vars['logged_user']), $this);?>
 
        <?php if (module_loaded ( 'timetracking' ) && timetracking_can_add_for ( $this->_tpl_vars['logged_user'] , $this->_tpl_vars['assignment'] )): ?>
          <?php echo smarty_function_object_time(array('object' => $this->_tpl_vars['assignment'],'show_time' => false), $this);?>
 
        <?php endif; ?>
        <?php if ($this->_tpl_vars['assignment']->canEdit($this->_tpl_vars['logged_user'])): ?>
          <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['assignment']->getEditUrl(),'title' => 'Edit...')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "gray-edit.gif"), $this);?>
' alt='' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
        <?php endif; ?>
        <?php if ($this->_tpl_vars['assignment']->canDelete($this->_tpl_vars['logged_user'])): ?>
          <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['assignment']->getTrashUrl(),'title' => 'Move to Trash','class' => 'remove_assignment')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
' alt='' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
  <?php else: ?>
    <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no tasks assigned to you in this project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <?php endif; ?>
  </div>
</div>