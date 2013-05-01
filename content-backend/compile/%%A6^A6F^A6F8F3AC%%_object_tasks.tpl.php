<?php /* Smarty version 2.6.16, created on 2012-08-30 11:37:05
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_tasks.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_tasks.tpl', 2, false),array('function', 'mobile_access_get_task_toggle_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_tasks.tpl', 6, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_tasks.tpl', 6, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_tasks.tpl', 6, false),)), $this); ?>
<?php if (is_foreachable ( $this->_tpl_vars['_mobile_access_object_tasks_active'] )): ?>
  <h2 class="label"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Active tasks<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
  <div class="box">
    <ul class="menu">
    <?php $_from = $this->_tpl_vars['_mobile_access_object_tasks_active']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_task']):
?>
        <li><a href="<?php echo smarty_function_mobile_access_get_task_toggle_url(array('object' => $this->_tpl_vars['_task']), $this);?>
"><img src="<?php echo smarty_function_image_url(array('name' => "icons/not-checked.gif"), $this);?>
" alt="" /> <?php echo ((is_array($_tmp=$this->_tpl_vars['_task']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></li>
    <?php endforeach; endif; unset($_from); ?>
    </ul>
  </div>
<?php endif; ?>

<?php if (is_foreachable ( $this->_tpl_vars['_mobile_access_object_tasks_completed'] )): ?>
  <h2 class="label"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Completed tasks<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
  <div class="box">
    <ul class="menu">
    <?php $_from = $this->_tpl_vars['_mobile_access_object_tasks_completed']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_task']):
?>
        <li><a href="<?php echo smarty_function_mobile_access_get_task_toggle_url(array('object' => $this->_tpl_vars['_task']), $this);?>
"><img src="<?php echo smarty_function_image_url(array('name' => "icons/checked.gif"), $this);?>
" alt="" /> <?php echo ((is_array($_tmp=$this->_tpl_vars['_task']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></li>
    <?php endforeach; endif; unset($_from); ?>
    </ul>
  </div>
<?php endif; ?>