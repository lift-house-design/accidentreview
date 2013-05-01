<?php /* Smarty version 2.6.16, created on 2012-07-31 18:22:28
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_frontend/_incoming_mail_row.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_frontend/_incoming_mail_row.tpl', 3, false),array('modifier', 'excerpt', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_frontend/_incoming_mail_row.tpl', 3, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_frontend/_incoming_mail_row.tpl', 4, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_frontend/_incoming_mail_row.tpl', 8, false),array('function', 'incoming_mail_status_description', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_frontend/_incoming_mail_row.tpl', 6, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_frontend/_incoming_mail_row.tpl', 8, false),)), $this); ?>
<tr>
  <td>
    <a href="<?php echo $this->_tpl_vars['incoming_mail']->getImportUrl(); ?>
" class="block"><strong><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['incoming_mail']->getSubject())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)))) ? $this->_run_mod_handler('excerpt', true, $_tmp, 45) : smarty_modifier_excerpt($_tmp, 45)); ?>
</strong></a>
    <span class="details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>From<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <a href="mailto:<?php echo ((is_array($_tmp=$this->_tpl_vars['incoming_mail']->getCreatedByEmail())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['incoming_mail']->getCreatedByEmail())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></span>
  </td>
  <td><?php echo smarty_function_incoming_mail_status_description(array('code' => $this->_tpl_vars['incoming_mail']->getState()), $this);?>
</td>
  <td class="options">
      <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['incoming_mail']->getImportUrl(),'title' => 'Solve Conflict','class' => 'import_button')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "arrow-right-small.gif"), $this);?>
' alt='' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['incoming_mail']->getDeleteUrl(),'title' => 'delete','method' => 'post')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
' alt='' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </td>
  <td class="checkbox"><input type="checkbox" name="conflicts[]" value="<?php echo $this->_tpl_vars['incoming_mail']->getId(); ?>
" class="auto slave_checkbox input_checkbox" /></td>
</tr>