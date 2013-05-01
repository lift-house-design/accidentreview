{title}Most Active Customers{/title}
{add_bread_crumb}Most Active Customers{/add_bread_crumb}

<div class="list_view" id="invoices">
  	<div class="object_list">
  		<div id="global_time">
  		</div>
	  	<div class="hidden_overflow">
        {include_template name=dates controller=Reports module=reporting}
        <p class="pagination top filter_group">
          <span class="inner_pagination">
            <a href="{assemble route=report_most_active_customers status=siu}" class="{if $status=='SIU'}active{/if}">{lang}SIU{/lang}</a> |
            <a href="{assemble route=report_most_active_customers status=company}" class="{if $status=='company'}active{/if}">{lang}Company{/lang}</a>
          </span>
        </p>

        <br class="clear"/>

        <script type="text/javascript">
          {literal}
            google.load('visualization', '1.0', {'packages':['corechart', 'table']});

            google.setOnLoadCallback(drawChart);

            {/literal}
            {if $status == 'company'}
              {assign var='chartTitle' value='Companies'}
              {assign var='tableTitle' value='Company'}
            {else}
              {assign var='chartTitle' value='Customers'}
              {assign var='tableTitle' value='Customer'}
            {/if}
            {literal}

            function drawChart(){
              var data = new google.visualization.DataTable();
              data.addColumn('string', '{/literal}{$tableTitle}{literal}');
              data.addColumn('number', 'Claims');
              data.addRows([
          {/literal}
        {if $status == 'company'}
          {foreach from=$data item=a_company}
                ['{$a_company.info.name}', {$a_company.numJobs}],
          {/foreach}
        {else}
          {foreach from=$data item=a_user}
                ['{$a_user.info.first_name} {$a_user.info.last_name}', {$a_user.numJobs}],
          {/foreach}
        {/if}
        {literal}
              ]);

              var options = {
                'title': 'Most Active {/literal}{$chartTitle}{literal}',
                'width': 728,
                'height': 546
              };

              var chart = new google.visualization.PieChart(document.getElementById('chartDiv'));
              var table = new google.visualization.Table(document.getElementById('tableDiv'));

              data.sort([{column: 1, desc: true}]);

              chart.draw(data, options);
              table.draw(data);

            }
          {/literal}
        </script>

        <div id='chartDiv'></div>
        <div id='tableDiv'></div>

		</div>
	</div>
  	{include_template name=tabs controller=Reports module=reporting}
</div>