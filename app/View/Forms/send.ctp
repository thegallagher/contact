<script>
window.parent.postMessage(<?php echo json_encode(json_encode(array(
	'uniqueId'		=> $uniqueId,
	'event'			=> 'result',
	'parameters'	=> compact('errors', 'result', 'message')
))); ?>, '*');
</script>