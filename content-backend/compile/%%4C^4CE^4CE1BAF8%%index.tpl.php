<?php /* Smarty version 2.6.16, created on 2013-01-08 17:29:06
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/languages_admin/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/languages_admin/index.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/languages_admin/index.tpl', 2, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/languages_admin/index.tpl', 7, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/languages_admin/index.tpl', 16, false),array('block', 'form', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/languages_admin/index.tpl', 34, false),array('block', 'wrap_buttons', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/languages_admin/index.tpl', 36, false),array('block', 'submit', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/languages_admin/index.tpl', 37, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/languages_admin/index.tpl', 12, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/languages_admin/index.tpl', 16, false),array('function', 'include_template', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/languages_admin/index.tpl', 35, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/languages_admin/index.tpl', 14, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Languages<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="languages_administration">
  <div id="languages">
    <div class="col_wide">
      <h2 class="section_name"><span class="section_name_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Available Languages<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></h2>
      <div class="section_container">
      <?php if (is_foreachable ( $this->_tpl_vars['languages'] )): ?>
        <table class="common_table">
        <?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
          <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
            <td class="checkbox"><input type="checkbox" class="auto input_checkbox" set_as_default_url="<?php echo $this->_tpl_vars['language']->getSetAsDefaultUrl(); ?>
" title="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Default Language?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" <?php if ($this->_tpl_vars['default_language_id'] == $this->_tpl_vars['language']->getId()): ?>checked="checked"<?php endif; ?> /></td>
            <td class="name"><a href="<?php echo $this->_tpl_vars['language']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['language']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></td>
            <td class="options">
              <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['language']->getExportUrl())); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-export.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
              <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['language']->getEditUrl())); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-edit.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
              <?php if ($this->_tpl_vars['language']->canDelete($this->_tpl_vars['logged_user'])):  $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['language']->getDeleteUrl(),'method' => 'post','confirm' => 'This will permanently remove this language. Are you sure?')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  endif; ?>
            </td>
          </tr>
          </tr>
        <?php endforeach; endif; unset($_from); ?>
        </table>
      <?php else: ?>
        <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no languages installed in the system<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
      <?php endif; ?>
    </div>
  </div>
  
  <div class="col_wide2">
    <div id="add_language">
      <h2 class="section_name"><span class="section_name_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New Language<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></h2>
      <div class="section_container">
        <?php $this->_tag_stack[] = array('form', array('action' => '?route=admin_languages_add','method' => 'post','autofocus' => false)); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
          <?php echo smarty_function_include_template(array('name' => '_language_form','controller' => 'languages_admin','module' => 'system'), $this);?>

          <?php $this->_tag_stack[] = array('wrap_buttons', array()); $_block_repeat=true;smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('submit', array()); $_block_repeat=true;smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </div>
    </div>
  </div>
    
  <div class="clear"></div>
</div>