<?php /* Smarty version 2.6.16, created on 2012-08-10 13:52:44
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoice_item_templates_admin/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoice_item_templates_admin/index.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoice_item_templates_admin/index.tpl', 2, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoice_item_templates_admin/index.tpl', 10, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoice_item_templates_admin/index.tpl', 32, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoice_item_templates_admin/index.tpl', 17, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoice_item_templates_admin/index.tpl', 19, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoice_item_templates_admin/index.tpl', 22, false),array('modifier', 'number', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoice_item_templates_admin/index.tpl', 23, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Item Templates<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php if (is_foreachable ( $this->_tpl_vars['invoice_item_templates'] )): ?>
  <div id="invoice_item_templates_list">
    <form method="POST" action="<?php echo $this->_tpl_vars['reorder_item_templates_url']; ?>
">
      <table class="common_table">
        <tr>
          <th></th>
          <th><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
          <th><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Unit Cost<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
          <th><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Quantity<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
          <th><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tax<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
          <th></th>
        </tr>
        <?php $_from = $this->_tpl_vars['invoice_item_templates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['predefined_item']):
?>
          <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
 template" id="item_template_<?php echo $this->_tpl_vars['predefined_item']->getId(); ?>
">
            <td class="star move_handle">
              <img src="<?php echo smarty_function_image_url(array('name' => "move.gif"), $this);?>
" />
              <input type="hidden" name="reorder[]" value="<?php echo $this->_tpl_vars['predefined_item']->getId(); ?>
" />
            </td>
            <td class="description"><?php echo ((is_array($_tmp=$this->_tpl_vars['predefined_item']->getDescription())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</td>
            <td class="unit_cost"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['predefined_item']->getUnitCost())) ? $this->_run_mod_handler('number', true, $_tmp, @INVOICE_PRECISION) : smarty_modifier_number($_tmp, @INVOICE_PRECISION)))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</td>
            <td class="quantity"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['predefined_item']->getQuantity())) ? $this->_run_mod_handler('number', true, $_tmp, @INVOICE_PRECISION) : smarty_modifier_number($_tmp, @INVOICE_PRECISION)))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</td>       
            <td class="tax">
              <?php $this->assign('tax_rate', $this->_tpl_vars['predefined_item']->getTaxRate()); ?>
              <?php if (instance_of ( $this->_tpl_vars['tax_rate'] , 'TaxRate' )): ?>
                <?php echo ((is_array($_tmp=$this->_tpl_vars['tax_rate']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
 (<?php echo $this->_tpl_vars['tax_rate']->getPercentage(); ?>
%)
              <?php endif; ?>
            </td>
            <td class="options">
              <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['predefined_item']->getEditUrl(),'title' => 'Edit...')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "gray-edit.gif"), $this);?>
' alt='' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
              <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['predefined_item']->getDeleteUrl(),'title' => 'Move to Trash','method' => 'post')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
' alt='' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </td>
          </tr>
        <?php endforeach; endif; unset($_from); ?>
       </table>
      <input type="hidden" name="submitted" value="submitted" />
     </form>
   </div>
<?php else: ?>
  <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array('add_url' => $this->_tpl_vars['add_template_url'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No predefined items specified yet. <a href=":add_url">Create one now</a>.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php endif; ?>