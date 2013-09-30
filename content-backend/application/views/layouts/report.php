<?php echo doctype('html5') ?>
<head>
	<title><?php echo $title ?></title>
	<?php echo meta(array(
		array('name'=>'Content-type','content'=>'text/html; charset=utf-8','type'=>'equiv'),
		array('name'=>'X-UA-Compatible','content'=>'IE=edge,chrome=1','type'=>'equiv'),
		array('name'=>'viewport','content'=>'width=device-width'),
		array('name'=>'title','content'=>$meta['title']),
		array('name'=>'description','content'=>$meta['description']),
		array('name'=>'copyright','content'=>$meta['copyright']),
		array('name'=>'author','content'=>'Nick Niebaum (nickniebaum@gmail.com)'),
	)) ?>
	<?php echo css($css) ?>
	<?php echo js($js) ?>
</head>
<body>
<? if(!empty($_SERVER['HTTP_REFERER'])){ ?>
<script>
function show_print(){
	$("#button-container").css('display','none');
	window.print();
	$("#button-container").css('display','block');
}
setTimeout(function(){
	$("#button-container").css('display','block');
},1000);
</script>
<div id="button-container" style="display:none">
	<a href="http://www.web2pdfconvert.com/convert" target="_blank">Save to PDF</a>
	<a href="javascript:show_print()">Print</a>
</div>
<? } ?>
<?php echo $yield ?>
</body>
</html>