if (!window.jQuery) {
	document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"><\/script>');
	document.write('<script>jQuery.noConflict();</script>');
}

if (!window.jQuery || !window.jQuery.ui) {
	document.write('<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"><\/script>');
}

if (!window.swfobject) {
	document.write(<?php echo json_encode($this->Html->script(Router::url('/js/swfobject/swfobject.js', true))); ?>);
}

if (!window.jQuery || !window.jQuery.fn.fileReader) {
	document.write(<?php echo json_encode($this->Html->script(Router::url('/js/filereader/jquery.FileReader.min.js', true))); ?>);
}

var _fileReaderOptions = <?php echo json_encode(array(
	'id'				=> $this->uuid('script', '/js/filereader/jquery.FileReader.min/js'),
	//'filereader'		=> Router::url('/js/filereader/filereader.swf', true),
	//'expressInstall'	=> Router::url('/js/swfobject/expressInstall.swf', true),
	'filereader'		=> '/js/filereader/filereader.swf',
	'expressInstall'	=> '/js/swfobject/expressInstall.swf',
	'callback'			=> 'function() {jQuery(window).trigger(\'filereaderready\');}'
)); ?>;

document.write(<?php echo json_encode($this->Html->script(Router::url('/js/contact.js', true))); ?>);