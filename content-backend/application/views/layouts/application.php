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
			Welcome, <a href="#" class="username">Nick Niebaum</a>
		</div>
	</div>
	<div class="wrapper">
		<div id="header">
			<a id="logo" href="#">
				<h1>Accident Review</h1>
			</a>
			<div id="nav">
				<a href="/#services">Services</a>	
				<a href="/#about-us">About Us</a>	
				<a href="/#customer-support">Customer Support</a>
			</div>
			<div id="account-options">
				<a href="/reps#new-assignment">New Assignment</a>
				<a href="/reps#assignments">Assignments</a>
				<a href="/reps#account-info">Manage Account</a>
				<a href="/reps/login?do=logout">Logout</a>
			</div>
		</div>
		<div id="content">
			<?php if(!empty($page_title)): ?>
			<div class="heading box">
				<h2><?php echo $page_title ?></h2>
			</div>
			<?php endif; ?>
			<div class="content box">
				<?php echo $yield ?>
			</div>
		</div>
	</div>
	</div>
	<div id="footer">
		<div class="wrapper">
			<a href="/faq">FAQ</a>
			<a href="/terms-conditions">Terms &amp; Conditions</a>
			<a href="/contact-us">Contact Us</a>
		</div>
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