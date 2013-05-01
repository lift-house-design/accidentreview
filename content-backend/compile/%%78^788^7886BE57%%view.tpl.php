<?php /* Smarty version 2.6.16, created on 2012-10-16 20:00:07
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/roles_admin/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/roles_admin/view.tpl', 1, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/roles_admin/view.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/roles_admin/view.tpl', 2, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/roles_admin/view.tpl', 15, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/roles_admin/view.tpl', 14, false),array('function', 'user_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/roles_admin/view.tpl', 16, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/roles_admin/view.tpl', 19, false),array('function', 'project_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/roles_admin/view.tpl', 39, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array('not_lang' => true)); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['active_role']->getName(); ?>
 <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Role<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="role">
<?php if ($this->_tpl_vars['active_role']->getType() == 'system'): ?>
  <p><?php $this->_tag_stack[] = array('lang', array('role' => $this->_tpl_vars['active_role']->getName())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>:role is a system role. It is used to define which sections of system users can access and use.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <?php if (is_foreachable ( $this->_tpl_vars['users'] )): ?>
    <table class="common_table">
      <tr>
        <th class="name" colspan="2"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>User<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="options"></th>
      </tr>
    <?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
      <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
        <td class="icon"><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['user']->getViewUrl())); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo $this->_tpl_vars['user']->getAvatarUrl(); ?>
" alt="avatar" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
        <td class="name"><?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['user']), $this);?>
</td>
        <td class="options">
        <?php if ($this->_tpl_vars['user']->canEdit($this->_tpl_vars['logged_user'])): ?>
          <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['user']->getEditCompanyAndRoleUrl())); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-edit.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
        <?php endif; ?>
        <?php if ($this->_tpl_vars['user']->canDelete($this->_tpl_vars['logged_user'])): ?>
          <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['user']->getDeleteUrl(),'confirm' => 'Are you sure that you want to delete this user account? There is no undo!','method' => 'post')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
  <?php else: ?>
    <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no users with this role<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <?php endif;  else: ?>
  <p><?php $this->_tag_stack[] = array('lang', array('role' => $this->_tpl_vars['active_role']->getName())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>:role is a project role. It is used to define which sections of a single project users can access and use.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <?php if (is_foreachable ( $this->_tpl_vars['users'] )): ?>
  <?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['details']):
?>
  <?php if (is_foreachable ( $this->_tpl_vars['details']['users'] )): ?>
  <table>
    <tr>
      <th><img src="<?php echo $this->_tpl_vars['details']['project']->getIconUrl(); ?>
" alt="" /></th>
      <th colspan="2"><?php echo smarty_function_project_link(array('project' => $this->_tpl_vars['details']['project']), $this);?>
</th>
    </tr>
    <?php $_from = $this->_tpl_vars['details']['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
      <td class="icon"><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['user']->getViewUrl())); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo $this->_tpl_vars['user']->getAvatarUrl(); ?>
" alt="avatar" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
      <td class="name"><?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['user']), $this);?>
</td>
      <td class="options">
      <?php if ($this->_tpl_vars['logged_user']->canChangeProjectPermissions($this->_tpl_vars['user'],$this->_tpl_vars['details']['project'])): ?>
        <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['details']['project']->getUserPermissionsUrl($this->_tpl_vars['user']),'title' => 'Change Permissions')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-permissions.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php endif; ?>
      
      <?php if ($this->_tpl_vars['logged_user']->canRemoveFromProject($this->_tpl_vars['user'],$this->_tpl_vars['details']['project'])): ?>
        <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['details']['project']->getRemoveUserUrl($this->_tpl_vars['user']),'method' => 'post','title' => 'Remove from Project')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
      <?php endif; ?>
      </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
  </table>
  <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
  <?php else: ?>
    <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no users with this role<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <?php endif;  endif; ?>
</div>