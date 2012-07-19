<?php

class AssetsController extends AppController {
	
	public $uses = null;
	
	public function fetch($view) {
		$this->layout = false;
		$this->render($view);
	}
}