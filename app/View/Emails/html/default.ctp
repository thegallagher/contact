<h1><?php echo $title_for_layout; ?></h1>
<p>
	<?php foreach ($this->viewVars as $key => $var): ?>
		<?php if (!in_array($key, array('title_for_layout', 'content'))): ?>
			<b><?php echo h(Inflector::humanize($key)); ?></b>: <?php echo nl2br(h($var)); ?><br>
		<?php endif; ?>
	<?php endforeach; ?>
</p>