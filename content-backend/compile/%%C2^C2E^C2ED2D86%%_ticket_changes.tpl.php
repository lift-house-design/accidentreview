<?php /* Smarty version 2.6.16, created on 2012-07-31 17:05:59
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_changes.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_changes.tpl', 4, false),array('function', 'action_on_by', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_changes.tpl', 10, false),)), $this); ?>
<?php if (is_foreachable ( $this->_tpl_vars['_changes'] )): ?>
<div id="ticket_changes" class="resource object_section">
  <div class="head">
    <h2 class="section_name"><span class="section_name_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>History<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></h2>
  </div>
  <div class="body">
    <div id="ticket_changes_wrapper">
    <?php $_from = $this->_tpl_vars['_changes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['ticket_changes'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['ticket_changes']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['_change']):
        $this->_foreach['ticket_changes']['iteration']++;
?>
      <div class="ticket_change">
        <h3><?php echo smarty_function_action_on_by(array('user' => $this->_tpl_vars['_change']->getCreatedBy(),'datetime' => $this->_tpl_vars['_change']->getCreatedOn(),'action' => 'Updated'), $this);?>
</h3>
        <ul>
        <?php $_from = $this->_tpl_vars['_change']->getVerboseChanges(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_field_change']):
?>
          <li><?php echo $this->_tpl_vars['_field_change']; ?>
</li>
        <?php endforeach; endif; unset($_from); ?>
        </ul>
      </div>
    <?php endforeach; endif; unset($_from); ?>
    </div>
  
  <?php if ($this->_tpl_vars['_total_changes'] > 3): ?>
    <p id="show_all_ticket_changes"><a href="<?php echo $this->_tpl_vars['active_ticket']->getChangesUrl(); ?>
"><?php $this->_tag_stack[] = array('lang', array('total' => $this->_tpl_vars['_total_changes'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show all :total changes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
  <?php endif; ?>
  </div>
</div>
<?php endif; ?>