<?php
/**
 * Template Name: Protected Page Template (NEW)
 */
?>
<?php get_header('protected-new'); ?>
<div class="heading box">
	<h1>Page Title Here</h1>
</div>
<div class="content box">
	<!---------------------------------------------------------------->
	<?php for($i=1;$i<=6;$i++): ?>
		<?php echo '<h'.$i.'>Header '.$i.'</h'.$i.'>'; ?>
	<?php endfor; ?>
	<p>Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Nunc mattis aliquam purus, quis facilisis diam aliquet vel. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed elementum dictum risus non volutpat. Sed vitae condimentum velit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas et mauris leo, feugiat consectetur eros. Cras sed mi mauris. Pellentesque interdum justo blandit nisi molestie porta. Donec mauris risus, varius sed iaculis blandit, viverra ut nulla. Etiam ornare vehicula gravida. Pellentesque sollicitudin ipsum nec felis adipiscing vitae malesuada diam imperdiet. Vestibulum ut lacus mi.</p>
	<ul>
		<li>Item 1</li>
		<li>Item 2</li>
		<li>Item 3
			<ul>
				<li>Subitem 1</li>
				<li>Subitem 2</li>
				<li>Subitem 3</li>
			</ul>
		</li>
		<li>Item 4</li>
	</ul>
	<!---------------------------------------------------------------->
</div>
<?php get_footer('protected-new'); ?>