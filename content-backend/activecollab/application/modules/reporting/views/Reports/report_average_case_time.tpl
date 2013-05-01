{title}Average Case Time{/title}
{add_bread_crumb}Average Case Time{/add_bread_crumb}

<div class="list_view" id="invoices">
  <div class="object_list">

  	<div id="global_time">

  			
  <div class="hidden_overflow">
    {include_template name=dates controller=Reports module=reporting}
    <p class="pagination top filter_group">
          <span class="inner_pagination">
            <a href="{assemble route=report_average_case_time status=Investigator}" class="{if $status=='Investigator'}active{/if}">{lang}Investigator{/lang}</a> |
            <a href="{assemble route=report_average_case_time status=Company}" class="{if $status=='Company'}active{/if}">{lang}Company{/lang}</a>
          </span>
        </p>
      <br class="clear" />
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

              // Create the data table.
              var data = new google.visualization.DataTable();
              data.addColumn('string', '{/literal}{$status}{literal}');
              data.addColumn('number', 'Hours');
              data.addRows([
                {/literal}
                {foreach from=$data item=a_tech}
                {if $status == "Investigator"}
                ['{$a_tech.first_name} {$a_tech.last_name}', {$a_tech.avg_time}],
                {else}
                ['{$a_tech.name}', {$a_tech.avg_time}],
                {/if}
                {/foreach}
                {literal}
              ]);
              
              // Set chart options
              var options = {'title':'Average Case Time by {/literal}{$status}{literal}',
                             'width':728,
                             'height':546};


              // Instantiate and draw our chart, passing in some options.
              data.sort({column:1, desc:true});
              var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
              chart.draw(data, options);
              var table = new google.visualization.Table(document.getElementById('table_div'));
              table.draw(data);
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