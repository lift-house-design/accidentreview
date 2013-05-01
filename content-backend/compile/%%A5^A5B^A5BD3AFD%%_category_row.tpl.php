<?php /* Smarty version 2.6.16, created on 2012-08-09 18:33:58
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/categories/_category_row.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/categories/_category_row.tpl', 1, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/categories/_category_row.tpl', 5, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/categories/_category_row.tpl', 2, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/categories/_category_row.tpl', 5, false),)), $this); ?>
<tr category_id="<?php echo $this->_tpl_vars['category']->getId(); ?>
" class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
  <td class="name"><a href="<?php echo $this->_tpl_vars['category']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['category']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></td>
  <td class="options">
  <?php if ($this->_tpl_vars['category']->canEdit($this->_tpl_vars['logged_user'])): ?>
    <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['category']->getEditUrl(),'title' => 'Rename','class' => 'rename_category')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-edit.gif"), $this);?>
" alt="edit" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
  <?php endif; ?>
  <?php if ($this->_tpl_vars['category']->canDelete($this->_tpl_vars['logged_user'])): ?>
    <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['category']->getDeleteUrl(),'class' => 'move_category_to_trash')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php endif; ?>
  </td>
</tr>