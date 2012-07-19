<?php App::uses('String', 'Utility'); ?>
if (!window.jQuery) {
	document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"><\/script>');
	document.write('<script>jQuery.noConflict();</script>');
}

var _contactSetup = <?php echo json_encode(array(
	'iframeSrc'	=> Router::url(array('controller' => 'forms', 'action' => 'load'), true),
	'uniqueId'	=> String::uuid(), // jQuery should have something like this
	'origin'	=> FULL_BASE_URL,
)); ?>;

document.write(<?php echo json_encode($this->Html->script(Router::url('/js/contact.js', true))); ?>);