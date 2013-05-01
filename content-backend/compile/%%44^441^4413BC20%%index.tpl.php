<?php /* Smarty version 2.6.16, created on 2012-07-27 13:12:10
         compiled from /mnt/raid0/vhosts/accident-review/content-backend/activecollab/application/modules/reporting/views/Reports/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/mnt/raid0/vhosts/accident-review/content-backend/activecollab/application/modules/reporting/views/Reports/index.tpl', 1, false),array('block', 'add_bread_crumb', '/mnt/raid0/vhosts/accident-review/content-backend/activecollab/application/modules/reporting/views/Reports/index.tpl', 2, false),array('block', 'lang', '/mnt/raid0/vhosts/accident-review/content-backend/activecollab/application/modules/reporting/views/Reports/index.tpl', 10, false),array('function', 'assemble', '/mnt/raid0/vhosts/accident-review/content-backend/activecollab/application/modules/reporting/views/Reports/index.tpl', 10, false),array('function', 'counter', '/mnt/raid0/vhosts/accident-review/content-backend/activecollab/application/modules/reporting/views/Reports/index.tpl', 18, false),array('function', 'include_template', '/mnt/raid0/vhosts/accident-review/content-backend/activecollab/application/modules/reporting/views/Reports/index.tpl', 77, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Cases By Investigator<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Cases By Investigator<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="list_view" id="invoices">
  	<div class="object_list">
  		<div id="global_time">

  			<p class="pagination top filter_group">
		      <span class="inner_pagination">
		        <a href="<?php echo smarty_function_assemble(array('route' => 'reports','status' => 'all'), $this);?>
" class="<?php if ($this->_tpl_vars['status'] == 'all'): ?>active<?php endif; ?>"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All Investigators<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> |
		        <a href="<?php echo smarty_function_assemble(array('route' => 'reports','status' => 'avg_low'), $this);?>
" class="<?php if ($this->_tpl_vars['status'] == 'avg_low'): ?>active<?php endif; ?>"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Average Low<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> |
		        <a href="<?php echo smarty_function_assemble(array('route' => 'reports','status' => 'avg_high'), $this);?>
" class="<?php if ($this->_tpl_vars['status'] == 'avg_high'): ?>active<?php endif; ?>"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Average High<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
		      </span>
		    </p>
		    <br class="clear"/>
  			
	  	<div class="hidden_overflow">
	  		<?php echo smarty_function_counter(array('start' => 0,'assign' => 'chartnum','print' => false), $this);?>

  			<?php $_from = $this->_tpl_vars['techs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_tech']):
?>


  			<h2 class="section_name">
  				<span class="section_name_span">
        			<span class="section_name_span_span"><?php echo $this->_tpl_vars['a_tech']['first_name']; ?>
 <?php echo $this->_tpl_vars['a_tech']['last_name']; ?>
</span>
        			<div class="clear"></div>
        		</span>
        	</h2>

        	
  			<script type="text/javascript">
			      // Load the Visualization API and the piechart package.
			      <?php echo '
			      google.load(\'visualization\', \'1.0\', {\'packages\':[\'corechart\']});
			      '; ?>


			      // Set a callback to run when the Google Visualization API is loaded.
			      google.setOnLoadCallback(drawChart);

			      // Callback that creates and populates a data table,
			      // instantiates the pie chart, passes in the data and
			      // draws it.
			      <?php echo '
			      function drawChart() {
			      	'; ?>


			        // Create the data table.
			        var data = new google.visualization.DataTable();
			        data.addColumn('string', 'Ticket');
			        data.addColumn('number', 'Time');
			        data.addRows([
			        	<?php $_from = $this->_tpl_vars['a_tech']['tickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_ticket']):
?>
			        	['<?php echo $this->_tpl_vars['a_ticket']['name']; ?>
', <?php echo $this->_tpl_vars['a_ticket']['completed_time']; ?>
],
			        	<?php endforeach; endif; unset($_from); ?>
			        ]);
			        <?php echo '
			        // Set chart options
			        var options = {\'title\':\'Cases\',
			                       \'width\':400,
			                       \'height\':300};

			                       '; ?>


			        // Instantiate and draw our chart, passing in some options.
			        var chart = new google.visualization.PieChart(document.getElementById('chart_div<?php echo $this->_tpl_vars['chartnum']; ?>
'));
			        chart.draw(data, options);
			        <?php echo '
			      }
			      '; ?>

			    </script>
			    <div id="chart_div<?php echo $this->_tpl_vars['chartnum']; ?>
" style="width:400; height:300"></div>
  			<?php echo smarty_function_counter(array(), $this);?>

  			<?php endforeach; endif; unset($_from); ?>

  		</div>
		</div>
	</div>
  	<?php echo smarty_function_include_template(array('name' => 'tabs','controller' => 'Reports','module' => 'reporting'), $this);?>

</div>