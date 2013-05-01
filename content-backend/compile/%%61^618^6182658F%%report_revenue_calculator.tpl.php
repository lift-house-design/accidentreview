<?php /* Smarty version 2.6.16, created on 2012-10-08 16:08:08
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/reporting/views/Reports/report_revenue_calculator.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/reporting/views/Reports/report_revenue_calculator.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/reporting/views/Reports/report_revenue_calculator.tpl', 2, false),array('function', 'include_template', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/reporting/views/Reports/report_revenue_calculator.tpl', 7, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Revenue Calculator<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Revenue Calculator<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="list_view" id="invoices">
  	<div class="object_list">
	  	<div class="hidden_overflow">
        <?php echo smarty_function_include_template(array('name' => 'dates','controller' => 'Reports','module' => 'reporting'), $this);?>

    <br class="clear"/>
        
	  	<script type="text/javascript">
  				<?php echo '
  					google.load(\'visualization\', \'1.0\', {\'packages\':[\'corechart\', \'table\']});
  					google.setOnLoadCallback(drawChart);

  					function drawChart(){
  						var data = new google.visualization.DataTable();
  						var chartdata = new google.visualization.DataTable();
  						
  						data.addColumn(\'string\', \'Investigator\');
  						data.addColumn(\'number\', \'Revenue\');

  						data.addRows([
			                '; ?>

			                <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_tech']):
?>
  							['<?php echo $this->_tpl_vars['a_tech']['first_name']; ?>
 <?php echo $this->_tpl_vars['a_tech']['last_name']; ?>
', <?php echo '{v:'; ?>
 <?php echo $this->_tpl_vars['a_tech']['revenue']; ?>
, f: '$<?php echo $this->_tpl_vars['a_tech']['revenue']; ?>
'<?php echo '}'; ?>
],
			                <?php endforeach; endif; unset($_from); ?>
			                <?php echo '
  						]);

  						chartdata.addColumn(\'string\', \'Investigator\');
  						chartdata.addColumn(\'number\', \'Cases\');
  						chartdata.addColumn(\'number\', \'Revenue\');

  						chartdata.addRows([
			                '; ?>

			                <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_tech']):
?>
  							['<?php echo $this->_tpl_vars['a_tech']['first_name']; ?>
 <?php echo $this->_tpl_vars['a_tech']['last_name']; ?>
', <?php echo $this->_tpl_vars['a_tech']['tickets']; ?>
, <?php echo '{v:'; ?>
 <?php echo $this->_tpl_vars['a_tech']['revenue']; ?>
, f: '$<?php echo $this->_tpl_vars['a_tech']['revenue']; ?>
'<?php echo '}'; ?>
],
			                <?php endforeach; endif; unset($_from); ?>
			                <?php echo '
  						]);

  						var chartoptions = {
  							\'title\': \'Revenue By Investigator\',
  							\'width\': 728,
  							\'height\': 546
  						};

  						var tableoptions = {
  							\'sortColumn\': 1,
  							\'sortAscending\': false
  						}

  						var chart = new google.visualization.PieChart(document.getElementById(\'chartDiv\'));
  						var table = new google.visualization.Table(document.getElementById(\'tableDiv\'));

  						chart.draw(data, chartoptions);
  						table.draw(chartdata, tableoptions);
  					}
  				'; ?>

  			</script>

  			<div id='chartDiv'></div>
  			<div id='tableDiv'></div>
		</div>
	</div>
  	<?php echo smarty_function_include_template(array('name' => 'tabs','controller' => 'Reports','module' => 'reporting'), $this);?>

</div>