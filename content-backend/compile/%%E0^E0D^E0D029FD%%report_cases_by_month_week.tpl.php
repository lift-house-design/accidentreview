<?php /* Smarty version 2.6.16, created on 2012-11-13 20:53:04
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/reporting/views/Reports/report_cases_by_month_week.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/reporting/views/Reports/report_cases_by_month_week.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/reporting/views/Reports/report_cases_by_month_week.tpl', 2, false),array('function', 'include_template', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/reporting/views/Reports/report_cases_by_month_week.tpl', 8, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Cases By Date Range<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Cases By Date Range<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="list_view" id="invoices">
  	<div class="object_list">
  		<div id="global_time">
	  		<div class="hidden_overflow">
          <?php echo smarty_function_include_template(array('name' => 'dates','controller' => 'Reports','module' => 'reporting'), $this);?>

		        <br class="clear"/>
		            <script type="text/javascript">
            // Load the Visualization API and the piechart package.
            <?php echo '
            google.load(\'visualization\', \'1.0\', {\'packages\':[\'corechart\', \'table\']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.setOnLoadCallback(drawChart);
            google.setOnLoadCallback(drawTable);

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {
              
              // Create the data table.
              var data = new google.visualization.DataTable();
              data.addColumn(\'string\', \'Company\');
              data.addColumn(\'number\', \'Cases\');
              data.addRows([
                '; ?>

                <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_company']):
?>
                ['<?php echo $this->_tpl_vars['a_company']['info']['name']; ?>
', <?php echo $this->_tpl_vars['a_company']['cases']; ?>
],
                <?php endforeach; endif; unset($_from); ?>
                <?php echo '
              ]);
              
              // Set chart options
              var options = {\'title\':\'Cases By Date Range\',
                             \'width\':728,
                             \'height\':546};

              // Instantiate and draw our chart, passing in some options.
              data.sort({column:1, desc:true});
              var chart = new google.visualization.PieChart(document.getElementById(\'chart_div\'));
              chart.draw(data, options);
              var table = new google.visualization.Table(document.getElementById(\'table_div\'));
              table.draw(data);
            }
            '; ?>


          </script>
          <div id="chart_div"></div>
          <div id="table_div"></div>
	  		</div>
		</div>
	</div>
  	<?php echo smarty_function_include_template(array('name' => 'tabs','controller' => 'Reports','module' => 'reporting'), $this);?>

</div>