<?php /* Smarty version 2.6.16, created on 2012-10-04 15:47:22
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoices/_invoice_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'wrap', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoices/_invoice_form.tpl', 3, false),array('block', 'label', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoices/_invoice_form.tpl', 4, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoices/_invoice_form.tpl', 9, false),array('block', 'textarea_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoices/_invoice_form.tpl', 47, false),array('function', 'text_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoices/_invoice_form.tpl', 6, false),array('function', 'select_date', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoices/_invoice_form.tpl', 20, false),array('function', 'select_currency', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoices/_invoice_form.tpl', 31, false),array('function', 'select_language', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoices/_invoice_form.tpl', 36, false),array('function', 'select_company', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoices/_invoice_form.tpl', 42, false),array('function', 'select_project', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoices/_invoice_form.tpl', 52, false),array('function', 'include_template', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoices/_invoice_form.tpl', 77, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoices/_invoice_form.tpl', 90, false),array('modifier', 'json', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/invoicing/views/invoices/_invoice_form.tpl', 150, false),)), $this); ?>
  <div id="invoice_form_head">
    <div class="col_wide" id="invoice_settings">
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'number','id' => 'invoiceNumberGenerator')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <?php $this->_tag_stack[] = array('label', array('for' => 'invoiceNumber')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Invoice ID<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php if ($this->_tpl_vars['active_invoice']->getStatus() == @INVOICE_STATUS_ISSUED): ?>
          <?php echo smarty_function_text_field(array('name' => "invoice[number]",'value' => $this->_tpl_vars['invoice_data']['number'],'class' => '','id' => 'invoiceNumber','disabled' => 'disabled'), $this);?>

        <?php else: ?>
          <div id="autogenerateID" style="<?php if ($this->_tpl_vars['invoice_data']['number']): ?>display:none<?php endif; ?>">
            <div class="field_wrapper"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Automatically generate on issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><a href="#">(<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Specify<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</a></div>
          </div>
          <div id="manuallyID" style="<?php if (! $this->_tpl_vars['invoice_data']['number']): ?>display:none<?php endif; ?>">
            <div class="field_wrapper"><?php echo smarty_function_text_field(array('name' => "invoice[number]",'value' => $this->_tpl_vars['invoice_data']['number'],'class' => '','id' => 'invoiceNumber'), $this);?>
<a href="#">(<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Generate<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</a></div>
          </div>        
        <?php endif; ?>
      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      
      <?php if ($this->_tpl_vars['active_invoice']->getStatus() == @INVOICE_STATUS_ISSUED): ?>
        <?php $this->_tag_stack[] = array('wrap', array('field' => 'issued_on')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
          <?php $this->_tag_stack[] = array('label', array('for' => 'issueFormIssuedOn','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Issued On<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <div class="field_wrapper"><?php echo smarty_function_select_date(array('name' => "invoice[issued_on]",'value' => $this->_tpl_vars['invoice_data']['issued_on'],'id' => 'issueFormIssuedOn','class' => 'required'), $this);?>
</div>
        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      
        <?php $this->_tag_stack[] = array('wrap', array('field' => 'issued_on')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
          <?php $this->_tag_stack[] = array('label', array('for' => 'issueFormDueOn','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Due On<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <div class="field_wrapper"><?php echo smarty_function_select_date(array('name' => "invoice[due_on]",'value' => $this->_tpl_vars['invoice_data']['due_on'],'id' => 'issueFormDueOn','class' => 'required'), $this);?>
</div>
        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php endif; ?>

      <?php $this->_tag_stack[] = array('wrap', array('field' => 'currencyId')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <?php $this->_tag_stack[] = array('label', array('for' => 'currencyId','required' => false)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Currency<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <div class="field_wrapper"><?php echo smarty_function_select_currency(array('name' => "invoice[currency_id]",'value' => $this->_tpl_vars['invoice_data']['currency_id'],'class' => 'short','id' => 'currencyId'), $this);?>
</div>
      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'language')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <?php $this->_tag_stack[] = array('label', array('for' => 'userLanguage')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Language<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <div class="field_wrapper"><?php echo smarty_function_select_language(array('name' => 'invoice[language_id]','value' => $this->_tpl_vars['invoice_data']['language_id'],'optional' => true,'id' => 'InvoiceLanguage'), $this);?>
</div>
      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </div>    
    <div class="col_wide" id="invoice_client">
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'company_id')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <?php $this->_tag_stack[] = array('label', array('for' => 'companyId','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Client<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <div class="field_wrapper"><?php echo smarty_function_select_company(array('name' => "invoice[company_id]",'value' => $this->_tpl_vars['invoice_data']['company_id'],'class' => 'required','id' => 'companyId','can_create_new' => false), $this);?>
</div>
      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'company_address')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <?php $this->_tag_stack[] = array('label', array('for' => 'companyAddress','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Client Address<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <div class="field_wrapper"><?php $this->_tag_stack[] = array('textarea_field', array('name' => "invoice[company_address]",'id' => 'companyAddress','class' => 'required long')); $_block_repeat=true;smarty_block_textarea_field($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['invoice_data']['company_address'];  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_textarea_field($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'project_id')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <?php $this->_tag_stack[] = array('label', array('for' => 'ProjectId','required' => false)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <div class="field_wrapper"><?php echo smarty_function_select_project(array('name' => "invoice[project_id]",'value' => $this->_tpl_vars['invoice_data']['project_id'],'user' => $this->_tpl_vars['logged_user'],'optional' => true,'class' => 'long'), $this);?>
</div>
      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>      
    </div>
    <div class="clear">&nbsp;</div>
  </div>


<div class="items_wrapper">
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'items','id' => 'invoice_items')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <table class="validate_callback validate_invoice_items">
      <tr class="header">
        <th class="num">
          <input type="hidden" name="invoice_sub_total" id="invoice_sub_total" />
          <input type="hidden" name="invoice_total" id="invoice_total" />
        </th>
        <th class="description"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="unit_cost"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Unit Cost<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="quantity"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Quantity<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="tax_rate"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tax<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="subtotal" style="display: none"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subtotal<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="total"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Total<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="options"></th>
      </tr>
    <?php if (is_foreachable ( $this->_tpl_vars['invoice_data']['items'] )): ?>
      <?php $_from = $this->_tpl_vars['invoice_data']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['invoice_items'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['invoice_items']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['iteration'] => $this->_tpl_vars['invoice_item']):
        $this->_foreach['invoice_items']['iteration']++;
?>
        <?php echo smarty_function_include_template(array('name' => '_invoice_item_row','controller' => 'invoices','module' => 'invoicing'), $this);?>

      <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>
      <tr class="invoice_totals">
        <td></td>
        <td>
          <a href="#" class="button_add" id="add_new"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add New Item<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a>
          <?php if (is_foreachable ( $this->_tpl_vars['invoice_item_templates'] )): ?>
          <span href="#" class="button_dropdown" id="add_from_template">
            <span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add From Template<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
            <div class="dropdown_container">
              <ul>
                <?php $_from = $this->_tpl_vars['invoice_item_templates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['invoice_item_template']):
?>
                  <li><a href="<?php echo $this->_tpl_vars['invoice_item_template']->getId(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoice_item_template']->getDescription())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></li>
                <?php endforeach; endif; unset($_from); ?>
              </ul>
            </div>
          </span>
          <?php endif; ?>
        </td>
        <td colspan="4" class="total">
        
        </td>
        <td></td>
      </tr>
      </tr>
    </table>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>

<?php if ($this->_tpl_vars['active_invoice']->isNew() && is_foreachable ( $this->_tpl_vars['invoice_data']['time_record_ids'] )): ?>
  <?php $_from = $this->_tpl_vars['invoice_data']['time_record_ids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['time_record_id']):
?>
  <input type="hidden" name="invoice[time_record_ids][]" value="<?php echo $this->_tpl_vars['time_record_id']; ?>
" />
  <?php endforeach; endif; unset($_from);  endif; ?>

<div class="invoice_note_wrapper">
    <?php if (is_foreachable ( $this->_tpl_vars['invoice_notes'] )): ?>
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'predefined_note')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <?php $this->_tag_stack[] = array('label', array('for' => 'note','required' => false)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Predefined Note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <div class="field_wrapper">
          <select name="predefined_notes" id="predefined_notes">
            <?php if ($this->_tpl_vars['original_note']): ?>
            <option value='original'>-- <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Original Note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> --</option>
            <?php endif; ?>
            <option value='empty'>-- <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Empty Note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> --</option>
            <option value='custom'>-- <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Custom Note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> --</option>
            <option value="empty"></div>
            <?php $_from = $this->_tpl_vars['invoice_notes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['invoice_note_id'] => $this->_tpl_vars['invoice_note']):
?>
              <option value="<?php echo $this->_tpl_vars['invoice_note']->getId(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoice_note']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
          </select><br />
          <?php $this->_tag_stack[] = array('textarea_field', array('name' => "invoice[note]",'class' => 'long','id' => 'invoice_note')); $_block_repeat=true;smarty_block_textarea_field($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['invoice_data']['note'];  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_textarea_field($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </div>
      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php else: ?>
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'predefined_note')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <?php $this->_tag_stack[] = array('label', array('for' => 'note','required' => false)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Invoice Note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php $this->_tag_stack[] = array('textarea_field', array('name' => "invoice[note]",'class' => 'long','id' => 'invoice_note')); $_block_repeat=true;smarty_block_textarea_field($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['invoice_data']['note'];  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_textarea_field($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php endif; ?>
    
    <?php $this->_tag_stack[] = array('wrap', array('field' => 'comment')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
      <?php $this->_tag_stack[] = array('label', array('for' => 'invoiceOurComment')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Our Comment<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php echo smarty_function_text_field(array('name' => "invoice[comment]",'value' => $this->_tpl_vars['invoice_data']['comment'],'id' => 'invoiceOurComment','class' => 'invoice_private_note'), $this);?>

      <p class="details boxless"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This comment is NEVER displayed to client or included in the final invoice<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <div class="clear"></div>
</div>

<?php if (is_foreachable ( $this->_tpl_vars['tax_rates'] )): ?>
<script type="text/javascript">
<?php $_from = $this->_tpl_vars['tax_rates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax_rate']):
?>
  App.invoicing.InvoiceForm.register_tax_rate(<?php echo ((is_array($_tmp=$this->_tpl_vars['tax_rate']->getId())) ? $this->_run_mod_handler('json', true, $_tmp) : smarty_modifier_json($_tmp)); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tax_rate']->getName())) ? $this->_run_mod_handler('json', true, $_tmp) : smarty_modifier_json($_tmp)); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tax_rate']->getPercentage())) ? $this->_run_mod_handler('json', true, $_tmp) : smarty_modifier_json($_tmp)); ?>
);
<?php endforeach; endif; unset($_from); ?>
</script>
<?php endif; ?>