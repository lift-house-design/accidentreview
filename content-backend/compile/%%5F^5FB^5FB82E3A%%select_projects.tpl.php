<?php /* Smarty version 2.6.16, created on 2012-08-01 21:57:20
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/widgets/select_projects.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/widgets/select_projects.tpl', 5, false),array('function', 'project_icon', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/widgets/select_projects.tpl', 7, false),array('function', 'assemble', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/widgets/select_projects.tpl', 8, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/widgets/select_projects.tpl', 8, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/widgets/select_projects.tpl', 13, false),)), $this); ?>
<div id="<?php echo $this->_tpl_vars['widget_id']; ?>
_popup" class="select_projects_widget_popup">
<?php if (is_foreachable ( $this->_tpl_vars['projects'] )): ?>
  <table>
  <?php $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['project_id'] => $this->_tpl_vars['project_name']):
?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even','name' => 'active_projects'), $this);?>
">
      <td class="checkbox"><input type="checkbox" value="<?php echo $this->_tpl_vars['project_id']; ?>
" class="auto input_checkbox" <?php if (in_array ( $this->_tpl_vars['project_id'] , $this->_tpl_vars['selected_project_ids'] )): ?>checked="checked"<?php endif; ?> /></td>
      <td class="icon"><img src="<?php echo smarty_function_project_icon(array('project' => $this->_tpl_vars['project_id'],'large' => false), $this);?>
" alt="" /></td>
      <td class="name"><a href="<?php echo smarty_function_assemble(array('route' => 'project_overview','project_id' => $this->_tpl_vars['project_id']), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['project_name'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
  </table>
<?php else: ?>
  <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no projects to select from<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php endif; ?>
</div>