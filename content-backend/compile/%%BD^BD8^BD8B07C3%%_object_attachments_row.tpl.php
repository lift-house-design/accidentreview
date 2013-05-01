<?php /* Smarty version 2.6.16, created on 2012-11-06 12:29:13
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments_row.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments_row.tpl', 2, false),array('function', 'action_on_by', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments_row.tpl', 20, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments_row.tpl', 23, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments_row.tpl', 6, false),array('modifier', 'filesize', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments_row.tpl', 17, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments_row.tpl', 11, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments_row.tpl', 13, false),)), $this); ?>
<?php if ($this->_tpl_vars['_object_attachments_cycle_name']): ?>
<tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even','name' => $this->_tpl_vars['_object_attachments_cycle_name']), $this);?>
" attachment_id="<?php echo $this->_tpl_vars['_attachment']->getId(); ?>
">
<?php else: ?>
<tr attachment_id="<?php echo $this->_tpl_vars['_attachment']->getId(); ?>
">
<?php endif; ?>
  <td class="thumbnail"><div><a href="<?php echo $this->_tpl_vars['_attachment']->getViewUrl(); ?>
" class="<?php if ($this->_tpl_vars['_attachment']->hasPreview()): ?>has_preview<?php endif; ?> b"  rel="lightbox[img]"><img src="<?php echo $this->_tpl_vars['_attachment']->getThumbnailUrl(); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['_attachment']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
" onload="javascript:createImgTip(this);" /></a></div>
  </td>
  <td class="name">
  
    <dl class="details_list">
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
	  
      <!--dd><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['_attachment']->getViewUrl(),'class' => 'filename','rel' => 'lightbox')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo ((is_array($_tmp=$this->_tpl_vars['_attachment']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp));  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dd-->
	  <dd><div><a href="<?php echo $this->_tpl_vars['_attachment']->getViewUrl(); ?>
" class="<?php if ($this->_tpl_vars['_attachment']->hasPreview()): ?>has_preview<?php endif; ?>"  rel="lightbox[link]"><?php echo ((is_array($_tmp=$this->_tpl_vars['_attachment']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
<img src="<?php echo $this->_tpl_vars['_attachment']->getThumbnailUrl(); ?>
" width="0" height="0" onload="javascript:createImgTip(this);" /></a></div></dd>
      
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Size and Type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd class="light"><span class="filesize"><?php echo ((is_array($_tmp=$this->_tpl_vars['_attachment']->getSize())) ? $this->_run_mod_handler('filesize', true, $_tmp) : smarty_modifier_filesize($_tmp)); ?>
</span>, <span class="mimetype"><?php echo $this->_tpl_vars['_attachment']->getMimeType(); ?>
</span></dd>
      
      <dt></dt>
      <dd class="light"><?php echo smarty_function_action_on_by(array('action' => 'Uploaded','user' => $this->_tpl_vars['_attachment']->getCreatedBy(),'datetime' => $this->_tpl_vars['_attachment']->getCreatedOn()), $this);?>
</dd>
    </dl>
  </td>
  <td class="options"><?php if ($this->_tpl_vars['_attachment']->canDelete($this->_tpl_vars['logged_user'])):  $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['_attachment']->getDeleteUrl(),'title' => 'Delete permanently')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
' alt='delete' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  endif; ?></td>
</tr>