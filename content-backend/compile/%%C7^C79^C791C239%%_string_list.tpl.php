<?php /* Smarty version 2.6.16, created on 2012-08-02 21:09:08
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_string_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_string_list.tpl', 4, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_string_list.tpl', 7, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_string_list.tpl', 13, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_string_list.tpl', 10, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_string_list.tpl', 18, false),)), $this); ?>
<div id="<?php echo $this->_tpl_vars['_string_list_id']; ?>
" class="string_list">
  <table>
<?php if (is_foreachable ( $this->_tpl_vars['_string_list_value'] )): ?>
  <?php echo smarty_function_counter(array('start' => 0,'name' => 'string_list_num','assign' => '_string_list_num'), $this);?>

  
  <?php $_from = $this->_tpl_vars['_string_list_value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_string_list_item']):
?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
 item">
      <td class="num">#<?php echo smarty_function_counter(array('name' => 'string_list_num'), $this); echo $this->_tpl_vars['_string_list_num']; ?>
</td>
      <td class="value">
        <span><?php echo ((is_array($_tmp=$this->_tpl_vars['_string_list_item'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</span>
        <input type="hidden" name="<?php echo $this->_tpl_vars['_string_list_name']; ?>
[]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['_string_list_item'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
" />
      </td>
      <td class="remove"><a href="javascript: return false;"><img src="<?php echo smarty_function_image_url(array('name' => 'gray-delete.gif'), $this);?>
" alt="" /></a></td>
    </tr>
  <?php endforeach; endif; unset($_from);  else: ?>
    <tr class="odd empty">
      <td colspan="2"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>List is Empty<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
    </tr>
<?php endif; ?>
  </table>
  
  <div class="add_list_item">
    <input type="text" name="add_list_item_name" class="add_list_item_name" value="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add...<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /> <input type="image" src="<?php echo smarty_function_image_url(array('name' => 'plus-small.gif'), $this);?>
" class="add_list_item_button" />
  </div>
</div>
<script type="text/javascript">
  App.system.StringList.init('<?php echo $this->_tpl_vars['_string_list_id']; ?>
', '<?php echo $this->_tpl_vars['_string_list_name']; ?>
');
</script>