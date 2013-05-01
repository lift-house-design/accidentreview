{title}Revenue Calculator{/title}
{add_bread_crumb}Revenue Calculator{/add_bread_crumb}

<div class="list_view" id="invoices">
  	<div class="object_list">
	  	<div class="hidden_overflow">
        {include_template name=dates controller=Reports module=reporting}
    <br class="clear"/>
        
	  	<script type="text/javascript">
  				{literal}
  					google.load('visualization', '1.0', {'packages':['corechart', 'table']});
  					google.setOnLoadCallback(drawChart);

  					function drawChart(){
  						var data = new google.visualization.DataTable();
  						var chartdata = new google.visualization.DataTable();
  						
  						data.addColumn('string', 'Investigator');
  						data.addColumn('number', 'Revenue');

  						data.addRows([
			                {/literal}
			                {foreach from=$data item=a_tech}
  							['{$a_tech.first_name} {$a_tech.last_name}', {literal}{v:{/literal} {$a_tech.revenue}, f: '${$a_tech.revenue}'{literal}}{/literal}],
			                {/foreach}
			                {literal}
  						]);

  						chartdata.addColumn('string', 'Investigator');
  						chartdata.addColumn('number', 'Cases');
  						chartdata.addColumn('number', 'Revenue');

  						chartdata.addRows([
			                {/literal}
			                {foreach from=$data item=a_tech}
  							['{$a_tech.first_name} {$a_tech.last_name}', {$a_tech.tickets}, {literal}{v:{/literal} {$a_tech.revenue}, f: '${$a_tech.revenue}'{literal}}{/literal}],
			                {/foreach}
			                {literal}
  						]);

  						var chartoptions = {
  							'title': 'Revenue By Investigator',
  							'width': 728,
  							'height': 546
  						};

  						var tableoptions = {
  							'sortColumn': 1,
  							'sortAscending': false
  						}

  						var chart = new google.visualization.PieChart(document.getElementById('chartDiv'));
  						var table = new google.visualization.Table(document.getElementById('tableDiv'));

  						chart.draw(data, chartoptions);
  						table.draw(chartdata, tableoptions);
  					}
  				{/literal}
  			</script>

  			<div id='chartDiv'></div>
  			<div id='tableDiv'></div>
		</div>
	</div>
  	{include_template name=tabs controller=Reports module=reporting}
</div>