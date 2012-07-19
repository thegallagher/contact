<?php
$json = json_encode(compact('result', 'message', 'errors'));
if ($callback) {
	$json = $callback . '(' . $json . ');';
}
echo $json;