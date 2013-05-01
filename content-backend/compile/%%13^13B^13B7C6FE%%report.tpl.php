<?php /* Smarty version 2.6.16, created on 2012-08-03 20:54:44
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/global_timetracking/report.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/global_timetracking/report.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/global_timetracking/report.tpl', 2, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/global_timetracking/report.tpl', 9, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/global_timetracking/report.tpl', 32, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/global_timetracking/report.tpl', 14, false),array('modifier', 'date', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/global_timetracking/report.tpl', 125, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/global_timetracking/report.tpl', 26, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/global_timetracking/report.tpl', 98, false),array('function', 'user_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/global_timetracking/report.tpl', 99, false),array('function', 'object_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/global_timetracking/report.tpl', 130, false),array('function', 'project_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/global_timetracking/report.tpl', 148, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array('not_lang' => true)); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['active_report']->getName();  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="global_time">
  <div id="time_report">
    <table class="report dont_print">
      <tr>
        <td id="time_report_select">
          <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Report<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <select name="report">
          <?php $_from = $this->_tpl_vars['grouped_reports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group_name'] => $this->_tpl_vars['reports']):
?>
            <optgroup label="<?php echo $this->_tpl_vars['group_name']; ?>
">
            <?php $_from = $this->_tpl_vars['reports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['report']):
?>
            <?php if (isset ( $this->_tpl_vars['active_project'] ) && instance_of ( $this->_tpl_vars['active_project'] , 'Project' )): ?>
              <option value="<?php echo $this->_tpl_vars['report']->getUrl($this->_tpl_vars['active_project']); ?>
" <?php if ($this->_tpl_vars['active_report']->getId() == $this->_tpl_vars['report']->getId()): ?>selected="selected" class="current"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['report']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</option>
            <?php else: ?>
              <option value="<?php echo $this->_tpl_vars['report']->getUrl(); ?>
" <?php if ($this->_tpl_vars['active_report']->getId() == $this->_tpl_vars['report']->getId()): ?>selected="selected" class="current"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['report']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</option>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
            </optgroup>
          <?php endforeach; endif; unset($_from); ?>
          </select> 
        </td>
        <td id="time_report_options">
          <span class="tooltip"></span> 
        <?php if (isset ( $this->_tpl_vars['active_project'] ) && instance_of ( $this->_tpl_vars['active_project'] , 'Project' )): ?>
          <a href="<?php echo $this->_tpl_vars['report']->getUrl($this->_tpl_vars['active_project']); ?>
" title="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Toggle Report Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" id="toggle_report_details"><img src="<?php echo smarty_function_image_url(array('name' => 'info-gray.gif'), $this);?>
" alt="" /></a> 
          <a href="<?php echo $this->_tpl_vars['active_report']->getEditUrl($this->_tpl_vars['active_project']); ?>
" title="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Report<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><img src="<?php echo smarty_function_image_url(array('name' => "gray-edit.gif"), $this);?>
" alt="" /></a> 
        <?php else: ?>
          <a href="<?php echo $this->_tpl_vars['report']->getUrl(); ?>
" title="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Toggle Report Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" id="toggle_report_details"><img src="<?php echo smarty_function_image_url(array('name' => 'info-gray.gif'), $this);?>
" alt="" /></a> 
          <a href="<?php echo $this->_tpl_vars['active_report']->getEditUrl(); ?>
" title="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Report<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><img src="<?php echo smarty_function_image_url(array('name' => "gray-edit.gif"), $this);?>
" alt="" /></a> 
        <?php endif; ?>
          <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['active_report']->getDeleteUrl(),'title' => 'Delete Report','method' => 'post','confirm' => "Are you sure that you want to delete this report?")); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
        </td>
      </tr>
    </table>
  </div>
  
  <div id="time_report_details" class="dont_print" style="display: none">
    <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This report displays<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</p>
    <ul>
      <li>
      <?php if ($this->_tpl_vars['active_report']->getUserFilter() == 'company'): ?>
        <?php $this->_tag_stack[] = array('lang', array('company' => $this->_tpl_vars['active_report']->getVerboseUserFilterData())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time records assigned to members of :company company<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
      <?php else: ?>
        <?php $this->_tag_stack[] = array('lang', array('to' => $this->_tpl_vars['active_report']->getVerboseUserFilterData())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time records assigned to :to<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
      <?php endif; ?>
      </li>

      <?php if ($this->_tpl_vars['active_report']->getDateFilter() == 'today'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time records for today<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</li>
      <?php elseif ($this->_tpl_vars['active_report']->getDateFilter() == 'last_week'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time records for the last week<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</li>
      <?php elseif ($this->_tpl_vars['active_report']->getDateFilter() == 'this_week'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time records for this week<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</li>
      <?php elseif ($this->_tpl_vars['active_report']->getDateFilter() == 'last_month'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time records for the last month<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</li>
      <?php elseif ($this->_tpl_vars['active_report']->getDateFilter() == 'this_month'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time records for this month<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</li>
      <?php elseif ($this->_tpl_vars['active_report']->getDateFilter() == 'selected_date'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array('from' => $this->_tpl_vars['active_report']->getDateFrom())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time records for :from<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</li>
      <?php elseif ($this->_tpl_vars['active_report']->getDateFilter() == 'selected_range'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array('from' => $this->_tpl_vars['active_report']->getDateFrom(),'to' => $this->_tpl_vars['active_report']->getDateTo())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time records for :from &mdash; :to<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</li>
      <?php endif; ?>
      
      <?php if ($this->_tpl_vars['active_report']->getBillableFilter() == 'billable'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Only billable records<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</li>
      <?php elseif ($this->_tpl_vars['active_report']->getBillableFilter() == 'not_billable'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Only non-billable records<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</li>
      <?php elseif ($this->_tpl_vars['active_report']->getBillableFilter() == 'billable_billed'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Billable records that have been already billed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</li>
      <?php elseif ($this->_tpl_vars['active_report']->getBillableFilter() == 'billable_not_billed'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Billable records that have not yet been billed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</li>
      <?php elseif ($this->_tpl_vars['active_report']->getBillableFilter() == 'pending_payment'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Billable records that are pending payment<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</li>
      <?php endif; ?>
      
      <?php if (isset ( $this->_tpl_vars['active_project'] ) && instance_of ( $this->_tpl_vars['active_project'] , 'Project' )): ?>
        <li><?php $this->_tag_stack[] = array('lang', array('url' => $this->_tpl_vars['active_project']->getOverviewUrl(),'name' => $this->_tpl_vars['active_project']->getName())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time records in <a href=":url">:name</a> project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</li>
      <?php endif; ?>
    </ul>
    <?php if ($this->_tpl_vars['active_report']->getSumByUser()): ?>
      <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time data will be summarized by user<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</p>
    <?php else: ?>
      <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All time records will be displayed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</p>
    <?php endif; ?>
  </div>
  
<?php if (is_foreachable ( $this->_tpl_vars['report_records'] )):  if ($this->_tpl_vars['active_report']->getSumByUser()): ?>
  <table id="time_report_summarized_by_user">
    <thead>
      <tr>
        <th class="name"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>User<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="hours"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Hours<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      </tr>
    </thead>
  <?php $_from = $this->_tpl_vars['report_records']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['report_record']):
?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
      <td class="name"><?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['report_record']['user']), $this);?>
</td>
      <td class="hours"><?php echo $this->_tpl_vars['report_record']['total_time']; ?>
</td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
    <tfoot>
      <tr>
        <td></td>
        <td class="total"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Total<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php echo $this->_tpl_vars['total_time']; ?>
</td>
      </tr>
    </tfoot>
  </table>
<?php else: ?>
  <table id="time_report_records">
    <thead>
      <th class="date"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <th class="user"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Person<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <th class="hours"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Hours<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <th class="desc"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <th class="billed"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
    <?php if ($this->_tpl_vars['show_project']): ?>
      <th class="project"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
    <?php endif; ?>
    </thead>
    <tbody>
    <?php $_from = $this->_tpl_vars['report_records']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['timerecord']):
?>
      <tr class="time_record <?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
 <?php if ($this->_tpl_vars['timerecord']->isBilled()): ?>billed<?php endif; ?>">
        <td class="date"><?php echo ((is_array($_tmp=$this->_tpl_vars['timerecord']->getRecordDate())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>
</td>
        <td class="user"><?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['timerecord']->getUser()), $this);?>
</td>
        <td class="hours"><?php echo $this->_tpl_vars['timerecord']->getValue(); ?>
</td>
        <td class="description">
        <?php if (instance_of ( $this->_tpl_vars['timerecord']->getParent() , 'ProjectObject' )): ?>
          <?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['timerecord']->getParent()), $this);?>
 
          <?php if ($this->_tpl_vars['timerecord']->getBody()): ?>
            &mdash; <?php echo $this->_tpl_vars['timerecord']->getBody(); ?>

          <?php endif; ?>
        <?php else: ?>
          <?php echo $this->_tpl_vars['timerecord']->getBody(); ?>

        <?php endif; ?>
        </td>
      <?php if ($this->_tpl_vars['timerecord']->getBillableStatus() == BILLABLE_STATUS_BILLABLE): ?>
        <td class="billed"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Billable<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
      <?php elseif ($this->_tpl_vars['timerecord']->getBillableStatus() == BILLABLE_STATUS_PENDING_PAYMENT): ?>
        <td class="billed"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Pending<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
      <?php elseif ($this->_tpl_vars['timerecord']->getBillableStatus() == BILLABLE_STATUS_BILLED): ?>
        <td class="billed"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Billed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
      <?php else: ?>
        <td class="billed details">--</td>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['show_project']): ?>
        <td class="project"><?php echo smarty_function_project_link(array('project' => $this->_tpl_vars['timerecord']->getProject()), $this);?>
</td>
      <?php endif; ?>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>
    <tfoot>
      <tr id="records_summary">
        <td colspan="3" class="total"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Total<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php echo $this->_tpl_vars['total_time']; ?>
</td>
        <td colspan="3"></td>
      </tr>
    </tfoot>
  </table>
<?php endif; ?>

  <p id="time_report_footer_options">
  <?php $_from = $this->_tpl_vars['active_report']->getFooterOptions($this->_tpl_vars['active_project'],$this->_tpl_vars['logged_user']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option']):
?>
    <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['option']['url'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
" style="background-image: url('<?php echo $this->_tpl_vars['option']['icon']; ?>
')"><?php echo ((is_array($_tmp=$this->_tpl_vars['option']['text'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a>
  <?php endforeach; endif; unset($_from); ?>
  </p>
<?php else: ?>
  <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This report is empty<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php endif; ?>
</div>
<script type="text/javascript">
  App.timetracking.TimeReport.init();
</script>