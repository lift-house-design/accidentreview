<ul class="category_list">
<li {if $request->getController() == 'reports' && $request->getAction() == 'report_most_active_customers'}class="selected"{/if}><a href="{assemble route=report_most_active_customers}"><span>{lang}Most Active Customers{/lang}</span></a></li>
<li {if $request->getController() == 'reports' && $request->getAction() == 'report_most_revenue'}class="selected"{/if}><a href="{assemble route=report_most_revenue}"><span>{lang}Most Revenue{/lang}</span></a></li>
<li {if $request->getController() == 'reports' && $request->getAction() == 'report_cases_by_month_week'}class="selected"{/if}><a href="{assemble route=report_cases_by_month_week}"><span>{lang}Cases By Date Range{/lang}</span></a></li>
  <li {if $request->getController() == 'reports' && $request->getAction() == 'index'}class="selected"{/if}><a href="{assemble route=reports}"><span>{lang}Cases By Investigator{/lang}</span></a></li>
  <li {if $request->getController() == 'reports' && $request->getAction() == 'report_time_by_investigator'}class="selected"{/if}><a href="{assemble route=report_time_by_investigator}"><span>{lang}Time By Investigator{/lang}</span></a></li>
  <li {if $request->getController() == 'reports' && $request->getAction() == 'report_average_case_time'}class="selected"{/if}><a href="{assemble route=report_average_case_time}"><span>{lang}Average Case Time{/lang}</span></a></li>
  <li {if $request->getController() == 'reports' && $request->getAction() == 'report_revenue_calculator'}class="selected"{/if}><a href="{assemble route=report_revenue_calculator}"><span>{lang}Revenue Calculator{/lang}</span></a></li>
</ul>
<div class="clear"></div>