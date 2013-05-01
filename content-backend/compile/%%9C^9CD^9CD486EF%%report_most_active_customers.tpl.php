<?php /* Smarty version 2.6.16, created on 2012-08-27 15:12:57
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/reporting/views/Reports/report_most_active_customers.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/reporting/views/Reports/report_most_active_customers.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/reporting/views/Reports/report_most_active_customers.tpl', 2, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/reporting/views/Reports/report_most_active_customers.tpl', 12, false),array('function', 'include_template', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/reporting/views/Reports/report_most_active_customers.tpl', 9, false),array('function', 'assemble', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/reporting/views/Reports/report_most_active_customers.tpl', 12, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Most Active Customers<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Most Active Customers<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="list_view" id="invoices">
  	<div class="object_list">
  		<div id="global_time">
  		</div>
	  	<div class="hidden_overflow">
        <?php echo smarty_function_include_template(array('name' => 'dates','controller' => 'Reports','module' => 'reporting'), $this);?>

        <p class="pagination top filter_group">
          <span class="inner_pagination">
            <a href="<?php echo smarty_function_assemble(array('route' => 'report_most_active_customers','status' => 'siu'), $this);?>
" class="<?php if ($this->_tpl_vars['status'] == 'SIU'): ?>active<?php endif; ?>"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>SIU<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> |
            <a href="<?php echo smarty_function_assemble(array('route' => 'report_most_active_customers','status' => 'company'), $this);?>
" class="<?php if ($this->_tpl_vars['status'] == 'company'): ?>active<?php endif; ?>"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
          </span>
        </p>

        <br class="clear"/>

        <script type="text/javascript">
          <?php echo '
            google.load(\'visualization\', \'1.0\', {\'packages\':[\'corechart\', \'table\']});

            google.setOnLoadCallback(drawChart);

            '; ?>

            <?php if ($this->_tpl_vars['status'] == 'company'): ?>
              <?php $this->assign('chartTitle', 'Companies'); ?>
              <?php $this->assign('tableTitle', 'Company'); ?>
            <?php else: ?>
              <?php $this->assign('chartTitle', 'Customers'); ?>
              <?php $this->assign('tableTitle', 'Customer'); ?>
            <?php endif; ?>
            <?php echo '

            function drawChart(){
              var data = new google.visualization.DataTable();
              data.addColumn(\'string\', \'';  echo $this->_tpl_vars['tableTitle'];  echo '\');
              data.addColumn(\'number\', \'Claims\');
              data.addRows([
          '; ?>

        <?php if ($this->_tpl_vars['status'] == 'company'): ?>
          <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_company']):
?>
                ['<?php echo $this->_tpl_vars['a_company']['info']['name']; ?>
', <?php echo $this->_tpl_vars['a_company']['numJobs']; ?>
],
          <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
          <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_user']):
?>
                ['<?php echo $this->_tpl_vars['a_user']['info']['first_name']; ?>
 <?php echo $this->_tpl_vars['a_user']['info']['last_name']; ?>
', <?php echo $this->_tpl_vars['a_user']['numJobs']; ?>
],
          <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>
        <?php echo '
              ]);

              var options = {
                \'title\': \'Most Active ';  echo $this->_tpl_vars['chartTitle'];  echo '\',
                \'width\': 728,
                \'height\': 546
              };

              var chart = new google.visualization.PieChart(document.getElementById(\'chartDiv\'));
              var table = new google.visualization.Table(document.getElementById(\'tableDiv\'));

              data.sort([{column: 1, desc: true}]);

              chart.draw(data, options);
              table.draw(data);

            }
          '; ?>

        </script>

        <div id='chartDiv'></div>
        <div id='tableDiv'></div>

		</div>
	</div>
  	<?php echo smarty_function_include_template(array('name' => 'tabs','controller' => 'Reports','module' => 'reporting'), $this);?>

</div>