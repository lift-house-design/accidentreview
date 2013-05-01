<?php /* Smarty version 2.6.16, created on 2012-07-27 16:10:05
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments.tpl', 6, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments.tpl', 6, false),array('block', 'assign_var', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments.tpl', 43, false),array('block', 'form', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments.tpl', 54, false),array('block', 'wrap', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments.tpl', 55, false),array('block', 'label', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments.tpl', 57, false),array('block', 'button', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments.tpl', 61, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments.tpl', 35, false),array('modifier', 'filesize', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments.tpl', 35, false),array('function', 'include_template', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments.tpl', 45, false),array('function', 'attach_files', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/attachments/_object_attachments.tpl', 59, false),)), $this); ?>
<div class="resource object_attachments object_section" id="object_attachments_<?php echo $this->_tpl_vars['_object_attachments_object']->getId(); ?>
" <?php if (! is_foreachable ( $this->_tpl_vars['_object_attachments'] ) && ! $this->_tpl_vars['_object_attachments_show_empty']): ?>style="display: none"<?php endif; ?>>
<?php if ($this->_tpl_vars['_object_attachments_show_header']): ?>
  <div class="head">
    <?php if ($this->_tpl_vars['_object_attachments_brief']): ?>
      <ul class="attachments_options">
        <li><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['_object_attachments_object']->getAttachmentsUrl(),'class' => 'show_file_details')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
        <?php if ($this->_tpl_vars['_object_attachments_object']->canEdit($this->_tpl_vars['logged_user'])): ?>
        <li><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['_object_attachments_object']->getAttachmentsUrl(),'class' => 'attach_another_file')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Attach Another File<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
        <?php endif; ?>
      </ul>
      <h4><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Attachments<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h4>
    <?php else: ?>
    <h2 class="section_name"><span class="section_name_span">
      <span class="section_name_span_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Attachments<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      <ul class="section_options">
        <li>&nbsp;</li>
      <?php if ($this->_tpl_vars['_object_attachments_object']->canEdit($this->_tpl_vars['logged_user'])): ?>
        <li><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['_object_attachments_object']->getAttachmentsUrl(),'class' => 'attach_another_file')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Attach Another File<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
      <?php endif; ?>
      </ul>
      <div class="clear"></div>
    </span></h2>
    <?php endif; ?>
  </div>
<?php endif; ?>

  <div class="body <?php if ($this->_tpl_vars['_object_attachments_brief']): ?>brief<?php else: ?>full<?php endif; ?>">
  <?php if (! is_foreachable ( $this->_tpl_vars['_object_attachments'] )): ?>
    <p class="details center files_moved_to_trash"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no files attached to this object<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <?php endif; ?>
    
    <div class="brief_files_view" style="display: <?php if ($this->_tpl_vars['_object_attachments_brief']): ?>block<?php else: ?>none<?php endif; ?>;">
      <ul>
      <?php $_from = $this->_tpl_vars['_object_attachments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_attachment']):
?>
        <li class="attachment_<?php echo $this->_tpl_vars['_attachment']->getId(); ?>
"><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['_attachment']->getViewUrl())); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo ((is_array($_tmp=$this->_tpl_vars['_attachment']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp));  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <span class="details">(<?php echo ((is_array($_tmp=$this->_tpl_vars['_attachment']->getSize())) ? $this->_run_mod_handler('filesize', true, $_tmp) : smarty_modifier_filesize($_tmp)); ?>
)</span></li>
      <?php endforeach; endif; unset($_from); ?>
      </ul>
    </div>
    
    <div class="full_files_view" style="display: <?php if ($this->_tpl_vars['_object_attachments_brief']): ?>none<?php else: ?>block<?php endif; ?>;">
      <table>
        <tbody>
        <?php $this->_tag_stack[] = array('assign_var', array('name' => '_object_attachments_cycle_name')); $_block_repeat=true;smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>object_attachments_cycle_<?php echo $this->_tpl_vars['_object_attachments_object']->getId();  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php $_from = $this->_tpl_vars['_object_attachments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_attachment']):
?>
          <?php echo smarty_function_include_template(array('name' => '_object_attachments_row','module' => 'resources','controller' => 'attachments'), $this);?>

        <?php endforeach; endif; unset($_from); ?>
        </tbody>
      </table>
    </div>
    
    <?php if ($this->_tpl_vars['_object_attachments_object']->canEdit($this->_tpl_vars['logged_user'])): ?>
      <div class="actions">
        <div class="attach_another_file" <?php if ($this->_tpl_vars['_object_attachments_show_header']): ?>style="display: none"<?php endif; ?>>
          <?php $this->_tag_stack[] = array('form', array('action' => $this->_tpl_vars['_object_attachments_object']->getAttachmentsUrl(),'method' => 'post','enctype' => "multipart/form-data",'class' => 'object_resource_form')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('wrap', array('field' => 'file')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php if (! $this->_tpl_vars['_object_attachments_show_header']): ?>
              <?php $this->_tag_stack[] = array('label', array()); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Attach a File<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php endif; ?>
              <?php echo smarty_function_attach_files(array(), $this);?>

            <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php $this->_tag_stack[] = array('button', array('type' => 'submit')); $_block_repeat=true;smarty_block_button($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_button($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </div>
      </div>
    <?php endif; ?>    
  </div>
</div>
<script type="text/javascript">
  App.resources.ObjectAttachments.init('object_attachments_<?php echo $this->_tpl_vars['_object_attachments_object']->getId(); ?>
');
</script>