<?php /* Smarty version 2.6.16, created on 2012-07-27 16:10:06
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/_select_assignees.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/_select_assignees.tpl', 3, false),array('function', 'var_export', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/_select_assignees.tpl', 11, false),)), $this); ?>
<div class="select_assignees_widget" id="<?php echo $this->_tpl_vars['_select_assignees_id']; ?>
">
  <div class="select_assignees_widget_users">
    <p class="details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No users selected<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  </div>
  <a href="#" class="assignees_button"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Change<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
</div>
<script type="text/javascript">
  App.widgets.SelectAssignees.init('<?php echo $this->_tpl_vars['_select_assignees_id']; ?>
', '<?php echo $this->_tpl_vars['_select_assignees_name']; ?>
', <?php echo $this->_tpl_vars['_select_assignees_company_id']; ?>
, <?php echo $this->_tpl_vars['_select_assignees_project_id']; ?>
, <?php echo $this->_tpl_vars['_select_assignees_exclude_ids']; ?>
);
<?php if (is_foreachable ( $this->_tpl_vars['_select_assignees_users'] )):  $_from = $this->_tpl_vars['_select_assignees_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_select_assignees_user']):
?>
  App.widgets.SelectAssignees.add_user('<?php echo $this->_tpl_vars['_select_assignees_id']; ?>
', '<?php echo $this->_tpl_vars['_select_assignees_name']; ?>
', <?php echo $this->_tpl_vars['_select_assignees_user']->getId(); ?>
, <?php echo smarty_function_var_export(array('var' => $this->_tpl_vars['_select_assignees_user']->getDisplayName()), $this);?>
, <?php if ($this->_tpl_vars['_select_assignees_user']->getId() == $this->_tpl_vars['_select_assignees_owner_id']): ?>true<?php else: ?>false<?php endif; ?>);
<?php endforeach; endif; unset($_from); ?>
  App.widgets.SelectAssignees.done_adding_users('<?php echo $this->_tpl_vars['_select_assignees_id']; ?>
', '<?php echo $this->_tpl_vars['_select_assignees_name']; ?>
');
<?php endif; ?>
</script>