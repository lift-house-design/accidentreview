{title}Cases By Investigator{/title}
{add_bread_crumb}Cases By Investigator{/add_bread_crumb}

<div class="list_view" id="invoices">
  	<div class="object_list">
  		<div id="global_time">
	  	<div class="hidden_overflow">
	  		{include_template name=dates controller=Reports module=reporting}
  			<br class="clear"/>
  			
  			<script type="text/javascript">
			      // Load the Visualization API and the piechart package.
			      {literal}
			      google.load('visualization', '1.0', {'packages':['corechart', 'table']});
			      {/literal}

			      // Set a callback to run when the Google Visualization API is loaded.
			      google.setOnLoadCallback(drawChart);

			      // Callback that creates and populates a data table,
			      // instantiates the pie chart, passes in the data and
			      // draws it.
			      {literal}
			      function drawChart() {
			      	{/literal}

			        // Create the data table.
			        var data = new google.visualization.DataTable();
			        data.addColumn('string', 'Investigator');	
			        data.addColumn('number', 'Time');
			        data.addRows([
			        {foreach from=$techs item=a_tech}
			        	['{$a_tech.first_name} {$a_tech.last_name}', {$a_tech.tickets}],
			        {/foreach}
			        ]);
			        {literal}
			        // Set chart options
			        var options = {'title':'Cases by Investigator',
			                       'width':728,
			                       'height':546};

			                       {/literal}

			        // Instantiate and draw our chart, passing in some options.
			        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
			        chart.draw(data, options);
			        var table = new google.visualization.Table(document.getElementById('table_div'));
              		table.draw(data);
			        {literal}
			      }
			      {/literal}
			    </script>
			    <div id="chart_div"></div>
			    <div id="table_div"></div>
  			
  		</div>
		</div>
	</div>
  	{include_template name=tabs controller=Reports module=reporting}
</div>