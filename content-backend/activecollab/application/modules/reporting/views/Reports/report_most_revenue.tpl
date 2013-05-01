{title}Most Revenue{/title}
{add_bread_crumb}Most Revenue{/add_bread_crumb}

<div class="list_view" id="invoices">
  	<div class="object_list">
  		<div id="global_time">

  			
	  	<div class="hidden_overflow">
        {include_template name=dates controller=Reports module=reporting}
        <br class="clear"/>
		    <script type="text/javascript">
  				{literal}
  					google.load('visualization', '1.0', {'packages':['corechart', 'table']});

  					google.setOnLoadCallback(drawChart);

  					function drawChart(){
  						var data = new google.visualization.DataTable();
  						data.addColumn('string', 'Company');
  						data.addColumn('number', 'Revenue');
  						data.addRows([
                {/literal}
                {foreach from=$data item=a_company}
  							['{$a_company.info.name}', {literal}{v:{/literal} {$a_company.totalRevenue}, f: '${$a_company.totalRevenue}'{literal}}{/literal}],
                {/foreach}
                {literal}
  						]);

  						var chartoptions = {
  							'title': 'Most Revenue',
  							'width': 728,
  							'height': 546
  						};

  						var tableoptions = {
  							'sortColumn': 1,
  							'sortAscending': false
  						}

  						var chart = new google.visualization.PieChart(document.getElementById('chartDiv'));
  						var table = new google.visualization.Table(document.getElementById('tableDiv'));

              data.sort({column:1, desc:true});

  						chart.draw(data, chartoptions);
  						table.draw(data, tableoptions);

  					}
  				{/literal}
  			</script>

  			<div id='chartDiv'></div>
  			<div id='tableDiv'></div>
  		</div>

		</div>
	</div>
  	{include_template name=tabs controller=Reports module=reporting}
</div>