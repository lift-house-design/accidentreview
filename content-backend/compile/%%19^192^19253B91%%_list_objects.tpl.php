<?php /* Smarty version 2.6.16, created on 2012-10-04 15:51:03
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_list_objects.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_list_objects.tpl', 12, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_list_objects.tpl', 21, false),array('function', 'object_star', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_list_objects.tpl', 23, false),array('function', 'object_priority', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_list_objects.tpl', 26, false),array('function', 'object_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_list_objects.tpl', 29, false),array('function', 'action_on_by', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_list_objects.tpl', 30, false),array('function', 'project_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_list_objects.tpl', 30, false),array('function', 'due', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_list_objects.tpl', 30, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_list_objects.tpl', 29, false),)), $this); ?>
<?php if (is_foreachable ( $this->_tpl_vars['_list_objects_objects'] )): ?>
<table class="common_table" id="<?php echo $this->_tpl_vars['_list_objects_id']; ?>
">
<?php if ($this->_tpl_vars['_list_objects_show_header']): ?>
  <thead>
    <tr>
    <?php if ($this->_tpl_vars['_list_objects_show_star']): ?>
      <th class="star"></th>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['_list_objects_show_priority']): ?>
      <th class="priority"></th>
    <?php endif; ?>
      <th class="name"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Object<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
    <?php if ($this->_tpl_vars['_list_objects_show_checkboxes']): ?>
      <th class="checkbox"><input type="checkbox" class="auto master_checkbox input_checkbox" /></th>
    <?php endif; ?>
    </tr>
  </thead>
<?php endif; ?>
  <tbody>
<?php $_from = $this->_tpl_vars['_list_objects_objects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_list_objects_object']):
?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
    <?php if ($this->_tpl_vars['_list_objects_show_star']): ?>
      <td class="star"><?php echo smarty_function_object_star(array('object' => $this->_tpl_vars['_list_objects_object'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['_list_objects_show_priority']): ?>
      <td class="priority"><?php echo smarty_function_object_priority(array('object' => $this->_tpl_vars['_list_objects_object']), $this);?>
</td>
    <?php endif; ?>
      <td class="name">
        <?php echo ((is_array($_tmp=$this->_tpl_vars['_list_objects_object']->getVerboseType())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
: <?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['_list_objects_object'],'del_completed' => $this->_tpl_vars['_list_objects_del_completed']), $this);?>

        <span class="details block"><?php echo smarty_function_action_on_by(array('user' => $this->_tpl_vars['_list_objects_object']->getCreatedBy(),'datetime' => $this->_tpl_vars['_list_objects_object']->getCreatedOn()), $this); if ($this->_tpl_vars['_list_objects_show_project']): ?> <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>in<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo smarty_function_project_link(array('project' => $this->_tpl_vars['_list_objects_object']->getProject()), $this); endif;  if ($this->_tpl_vars['_list_objects_object']->can_be_completed && $this->_tpl_vars['_list_objects_object']->isOpen() && $this->_tpl_vars['_list_objects_object']->getDueOn()): ?> | <?php echo smarty_function_due(array('object' => $this->_tpl_vars['_list_objects_object']), $this); endif; ?></span>
      </td>
    <?php if ($this->_tpl_vars['_list_objects_show_checkboxes']): ?>
      <td class="checkbox"><input type="checkbox" name="objects[]" value="<?php echo $this->_tpl_vars['_list_objects_object']->getId(); ?>
" class="auto slave_checkbox input_checkbox" /></td>
    <?php endif; ?>
    </tr>
<?php endforeach; endif; unset($_from); ?>
  </tbody>
</table>
<?php if ($this->_tpl_vars['_list_objects_show_checkboxes']): ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#<?php echo $this->_tpl_vars['_list_objects_id']; ?>
').checkboxes();
  });
</script>
<?php endif;  endif; ?>