<?php /* Smarty version 2.6.16, created on 2012-08-27 15:12:42
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/reporting/views/Reports/dates.tpl */ ?>
<div style="width:400px;display:block;float:left;margin-top:10px;">
	<form method="post">
		<input type="text" class="daterange low" name="lowdate" value="<?php echo $this->_tpl_vars['low']; ?>
"/>
		<input type="text" class="daterange high" name="highdate" value="<?php echo $this->_tpl_vars['high']; ?>
"/>
		<input style="width:100px;" type="submit" value="Set Range"/>
	</form>
</div>
<script>
<?php echo '
$(document).ready(function(){
	$(".daterange").datePicker();
	$(".daterange").dpSetStartDate(\'01/01/2000\');
});
'; ?>

</script>