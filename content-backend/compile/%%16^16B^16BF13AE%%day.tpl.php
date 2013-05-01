<?php /* Smarty version 2.6.16, created on 2013-01-30 19:15:00
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/calendar/views/calendar/day.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/calendar/views/calendar/day.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/calendar/views/calendar/day.tpl', 2, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/calendar/views/calendar/day.tpl', 22, false),array('modifier', 'date', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/calendar/views/calendar/day.tpl', 1, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/calendar/views/calendar/day.tpl', 15, false),array('function', 'project_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/calendar/views/calendar/day.tpl', 7, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/calendar/views/calendar/day.tpl', 10, false),array('function', 'object_star', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/calendar/views/calendar/day.tpl', 11, false),array('function', 'object_complete', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/calendar/views/calendar/day.tpl', 12, false),array('function', 'object_priority', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/calendar/views/calendar/day.tpl', 13, false),array('function', 'object_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/calendar/views/calendar/day.tpl', 15, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo ((is_array($_tmp=$this->_tpl_vars['day'])) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0));  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['day']->getDay();  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="day_tasks" id="day_<?php echo $this->_tpl_vars['day']->toMySQL(); ?>
">
<?php if (is_foreachable ( $this->_tpl_vars['groupped_objects'] )):  $_from = $this->_tpl_vars['groupped_objects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data']):
?>
  <h2 class="section_name"><span class="section_name_span"><?php echo smarty_function_project_link(array('project' => $this->_tpl_vars['data']['project']), $this);?>
</span></h2>
  <table>
  <?php $_from = $this->_tpl_vars['data']['objects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['object']):
?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
      <td class="star"><?php echo smarty_function_object_star(array('object' => $this->_tpl_vars['object'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</td>
      <td class="checkbox"><?php echo smarty_function_object_complete(array('object' => $this->_tpl_vars['object'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</td>
      <td class="priority"><?php echo smarty_function_object_priority(array('object' => $this->_tpl_vars['object']), $this);?>
</td>
      <td class="name">
        <span class="type"><?php echo ((is_array($_tmp=$this->_tpl_vars['object']->getVerboseType())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</span>: <?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['object'],'del_completed' => false), $this);?>

      </td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
  </table>
<?php endforeach; endif; unset($_from);  else: ?>
  <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No tasks here<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php endif; ?>
</div>