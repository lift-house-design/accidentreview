<?php /* Smarty version 2.6.16, created on 2012-08-01 21:56:28
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_select_projects.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_select_projects.tpl', 3, false),array('function', 'var_export', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_select_projects.tpl', 11, false),)), $this); ?>
<div class="select_projects_widget" id="<?php echo $this->_tpl_vars['_select_projects_id']; ?>
">
  <div class="select_projects_widget_projects">
    <p class="details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No projects selected<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  </div>
  <a href="#" class="projects_button"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Change<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
</div>
<script type="text/javascript">
  App.widgets.SelectProjects.init('<?php echo $this->_tpl_vars['_select_projects_id']; ?>
', '<?php echo $this->_tpl_vars['_select_projects_name']; ?>
', <?php if ($this->_tpl_vars['_select_projects_active_only']): ?>true<?php else: ?>false<?php endif; ?>, <?php if ($this->_tpl_vars['_select_projects_show_all']): ?>true<?php else: ?>false<?php endif; ?>, <?php echo $this->_tpl_vars['_select_projects_exclude_ids']; ?>
);
<?php if (is_foreachable ( $this->_tpl_vars['_select_projects_projects'] )):  $_from = $this->_tpl_vars['_select_projects_projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_select_projects_project']):
?>
  App.widgets.SelectProjects.add_project('<?php echo $this->_tpl_vars['_select_projects_id']; ?>
', '<?php echo $this->_tpl_vars['_select_projects_name']; ?>
', <?php echo $this->_tpl_vars['_select_projects_project']->getId(); ?>
, <?php echo smarty_function_var_export(array('var' => $this->_tpl_vars['_select_projects_project']->getName()), $this);?>
);
<?php endforeach; endif; unset($_from);  endif; ?>
</script>