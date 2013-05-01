<?php /* Smarty version 2.6.16, created on 2012-08-01 18:08:54
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/calendar/views/cell.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/calendar/views/cell.tpl', 8, false),array('function', 'object_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/calendar/views/cell.tpl', 8, false),)), $this); ?>
<td class="day_cell <?php if ($this->_tpl_vars['day']->isToday ( get_user_gmt_offset ( ) )): ?>today<?php endif; ?> <?php if ($this->_tpl_vars['day']->isWeekend()): ?>weekend<?php else: ?>weekday<?php endif; ?> <?php if (is_foreachable ( $this->_tpl_vars['day_data'] )): ?>not_empty_day<?php else: ?>empty_day<?php endif; ?>" id="day-<?php echo $this->_tpl_vars['day']->getYear(); ?>
-<?php echo $this->_tpl_vars['day']->getMonth(); ?>
-<?php echo $this->_tpl_vars['day']->getDay(); ?>
">
  <div class="inner">
    <div class="day_num"><a href="<?php echo $this->_tpl_vars['day_url']; ?>
"><?php echo $this->_tpl_vars['day']->getDay(); ?>
</a></div>
    <div class="day_brief">
    <?php if (is_foreachable ( $this->_tpl_vars['day_data'] )): ?>
      <ul>
      <?php $_from = $this->_tpl_vars['day_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['object']):
?>
        <li><?php echo ((is_array($_tmp=$this->_tpl_vars['object']->getVerboseType())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
: <?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['object']), $this);?>
</li>
      <?php endforeach; endif; unset($_from); ?>
      </ul>
    <?php endif; ?>
    </div>
    <div class="day_details"></div>
  </div>
</td>