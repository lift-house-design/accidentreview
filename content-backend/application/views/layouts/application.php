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
</head>
<body>
	<div id="top-panel">
		<div class="wrapper">
		<?php if($logged_in): ?>
			Welcome, <?php echo anchor('account',$user['first_name'].' '.$user['last_name'],array('class'=>'username')) ?>
		<?php else: ?>
			&nbsp;
		<?php endif; ?>
		</div>
	</div>
	<div class="wrapper">
		<div id="header">
			<a id="logo" href="/">
				<h1>Accident Review</h1>
			</a>
			<div id="nav">
				<?php echo anchor('assignments','Assignments') ?>
			</div>
			<?php if($logged_in): ?>
			<div id="account-options">
				<?php echo anchor('users','User Administration') ?>
				<?php echo anchor('logout','Logout') ?>
			</div>
			<?php endif; ?>
		</div>
		<div id="content">
			<?php if(!empty($page_title)): ?>
			<div class="heading box">
				<h2><?php echo $page_title ?></h2>
			</div>
			<?php endif; ?>
			<div id="<?php echo $slug_id_string ?>" class="content box">
				<?php echo $yield ?>
			</div>
		</div>
	</div>
	</div>
	<div id="footer">
		
	</div>
	<?php echo js($js) ?>
	<?php if($ga_code!==false): ?>
	<script>
		var _gaq=[['_setAccount','<?php echo $ga_code ?>'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		g.src='//www.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>
	<?php endif; ?>
</body>
</html>