<?php /* Smarty version 2.6.16, created on 2012-08-01 20:25:51
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl', 2, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl', 2, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl', 7, false),array('block', 'pagination', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl', 13, false),array('block', 'form', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl', 21, false),array('block', 'wrap', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl', 38, false),array('block', 'submit', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl', 62, false),array('block', 'button', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl', 90, false),array('function', 'assemble', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl', 13, false),array('function', 'select_date', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl', 39, false),array('function', 'select_user', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl', 44, false),array('function', 'text_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl', 49, false),array('function', 'checkbox_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl', 59, false),array('function', 'include_template', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl', 67, false),array('function', 'empty_slate', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/timetracking/views/timetracking/index.tpl', 113, false),)), $this); ?>
<?php if (instance_of ( $this->_tpl_vars['active_object'] , 'ProjectObject' )): ?>
  <?php $this->_tag_stack[] = array('title', array('not_lang' => true)); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  $this->_tag_stack[] = array('lang', array('name' => $this->_tpl_vars['active_object']->getName())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>":name" Time Data<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  else: ?>
  <?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  endif; ?>

<?php $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Log<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="timerecords">
  <?php if ($this->_tpl_vars['pagination']->getLastPage() > 1): ?>
  <p class="pagination top">
  <?php if (instance_of ( $this->_tpl_vars['active_object'] , 'ProjectObject' )): ?>
    <span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'project_time','page' => '-PAGE-','project_id' => $this->_tpl_vars['active_project']->getId(),'for' => $this->_tpl_vars['active_object']->getId()), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
  <?php else: ?>
    <span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'project_time','page' => '-PAGE-','project_id' => $this->_tpl_vars['active_project']->getId()), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
  <?php endif; ?>
  </p>
  <div class="clear"></div>
  <?php endif; ?>
  
  <?php $this->_tag_stack[] = array('form', array('action' => $this->_tpl_vars['add_url'],'method' => 'post','id' => 'add_time_record_form','show_errors' => false)); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
      <table class="common_table timerecords">
        <thead>
          <tr>
            <th class="date"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th class="user"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Person<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th class="hours"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Hours<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th class="desc"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th class="billable"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Billable<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th class="actions"></th>
            <th class="checkbox"></th>
          </tr>
        </thead>
        <tbody>
        <?php if ($this->_tpl_vars['can_add']): ?>
          <tr id="new_record">
            <td class="date">
            <?php $this->_tag_stack[] = array('wrap', array('field' => 'record_date')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
              <?php echo smarty_function_select_date(array('name' => 'time[record_date]','value' => $this->_tpl_vars['timetracking_data']['record_date'],'id' => 'start_date','show_timezone' => false,'class' => 'auto required'), $this);?>

            <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </td>
            <td class="user">
            <?php $this->_tag_stack[] = array('wrap', array('field' => 'user_id')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
              <?php echo smarty_function_select_user(array('name' => 'time[user_id]','value' => $this->_tpl_vars['timetracking_data']['user_id'],'project' => $this->_tpl_vars['active_project'],'optional' => false,'id' => 'time_user','class' => 'auto required'), $this);?>

            <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </td>
            <td class="hours">
            <?php $this->_tag_stack[] = array('wrap', array('field' => 'value')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
              <?php echo smarty_function_text_field(array('name' => 'time[value]','value' => $this->_tpl_vars['timetracking_data']['value'],'id' => 'time_hours','class' => 'short required'), $this);?>

            <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </td>
            <td class="desc">
            <?php $this->_tag_stack[] = array('wrap', array('field' => 'body')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
              <?php echo smarty_function_text_field(array('name' => 'time[body]','value' => $this->_tpl_vars['timetracking_data']['body'],'id' => 'time_summary'), $this);?>

            <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </td>
            <td class="billable">
            <?php $this->_tag_stack[] = array('wrap', array('field' => 'billable_status')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
              <?php echo smarty_function_checkbox_field(array('name' => "time[billable_status]",'value' => $this->_tpl_vars['timetracking_data']['billable_status'],'title' => 'Billable...','checked' => true), $this);?>

            <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </td>
            <td class="actions" colspan="2"><?php $this->_tag_stack[] = array('submit', array('class' => 'grey_button')); $_block_repeat=true;smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
          </tr>
        <?php endif; ?>
        <?php if (is_foreachable ( $this->_tpl_vars['timerecords'] )): ?>
          <?php $_from = $this->_tpl_vars['timerecords']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['timerecord']):
?>
            <?php echo smarty_function_include_template(array('name' => '_time_row','controller' => 'timetracking','module' => 'timetracking'), $this);?>

          <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>
      </tbody>
    </table>
    
    <?php if ($this->_tpl_vars['can_manage']): ?>
    <div id="mass_edit">
      <select name="action" class="auto" id="records_action" disabled="disabled">
        <option value=""><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>With selected ...<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
        <option value=""></option>
        
        <option value="mark_as_billable"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Mark as Billable<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
        <option value="mark_as_not_billable"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Mark as Non-Billable<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
        <option value=""></option>
        
      <?php if ($this->_tpl_vars['logged_user']->getProjectPermission('timerecord',$this->_tpl_vars['active_project']) >= PROJECT_PERMISSION_MANAGE): ?>
        <option value="mark_as_billed"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Mark as Billed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
        <option value="mark_as_not_billed"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Mark as Not Billed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
        <option value=""></option>
      <?php endif; ?>
        <option value="move_to_trash"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Move to Trash<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
      </select>
      <?php $this->_tag_stack[] = array('button', array('type' => 'button','id' => 'records_submit','class' => 'button_disabled','disabled' => true)); $_block_repeat=true;smarty_block_button($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Go<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_button($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </div>
    <?php endif; ?>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  
  <div class="clear"></div>
  
  <?php if (( $this->_tpl_vars['pagination']->getLastPage() > 1 ) && ! $this->_tpl_vars['pagination']->isLast()): ?>
    <?php if (instance_of ( $this->_tpl_vars['active_object'] , 'ProjectObject' )): ?>
      <p class="next_page"><a href="<?php echo smarty_function_assemble(array('route' => 'project_time','page' => $this->_tpl_vars['pagination']->getNextPage(),'project_id' => $this->_tpl_vars['active_project']->getId(),'for' => $this->_tpl_vars['active_object']->getId()), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
    <?php else: ?>
      <p class="next_page"><a href="<?php echo smarty_function_assemble(array('route' => 'project_time','page' => $this->_tpl_vars['pagination']->getNextPage(),'project_id' => $this->_tpl_vars['active_project']->getId()), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
    <?php endif; ?>
  <?php endif; ?>
  
  
<?php if (! is_foreachable ( $this->_tpl_vars['timerecords'] )): ?>
  <script type="text/javascript">
    $('#mass_edit').hide();
  </script>
  
  <div id="no_records">
    <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No time records here<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>. <?php if ($this->_tpl_vars['can_add']):  $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Use the form above to create new ones<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.<?php endif; ?></p>
    <?php echo smarty_function_empty_slate(array('name' => 'time','module' => 'timetracking'), $this);?>

  </div>
<?php endif; ?>
</div>