<div style="width:400px;display:block;float:left;margin-top:10px;">
	<form method="post">
		<input type="text" class="daterange low" name="lowdate" value="{$low}"/>
		<input type="text" class="daterange high" name="highdate" value="{$high}"/>
		<input style="width:100px;" type="submit" value="Set Range"/>
	</form>
</div>
<script>
{literal}
$(document).ready(function(){
	$(".daterange").datePicker();
	$(".daterange").dpSetStartDate('01/01/2000');
});
{/literal}
</script>