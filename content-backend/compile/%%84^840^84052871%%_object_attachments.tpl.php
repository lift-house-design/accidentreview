<?php /* Smarty version 2.6.16, created on 2012-08-30 11:37:05
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_attachments.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_attachments.tpl', 5, false),array('modifier', 'filesize', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_attachments.tpl', 5, false),)), $this); ?>
<?php if (is_foreachable ( $this->_tpl_vars['_mobile_access_object_attachments'] )): ?>
<div class="attachments">
  <ul>
  <?php $_from = $this->_tpl_vars['_mobile_access_object_attachments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_attachment']):
?>
    <li><a href="<?php echo $this->_tpl_vars['_attachment']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['_attachment']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
 <span class="details">(<?php echo ((is_array($_tmp=$this->_tpl_vars['_attachment']->getSize())) ? $this->_run_mod_handler('filesize', true, $_tmp) : smarty_modifier_filesize($_tmp)); ?>
)</span></a></li>
  <?php endforeach; endif; unset($_from); ?>
  </ul>
</div>
<?php endif; ?>