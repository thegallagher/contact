<?php

class AdminAppController extends AppController {

	public $components = array(
		'Auth' => array(
			'all' => array(
				'scope' => array('User.is_active' => 1),
			),
			'authenticate' => array('Form'),
			'loginAction' => array('plugin' => 'admin', 'controller' => 'users', 'action' => 'login'),
		)
	);
}

