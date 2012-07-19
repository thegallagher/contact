<?php
App::uses('Contact', 'Admin.Model');

/**
 * Contact Test Case
 *
 */
class ContactTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.contact', 'app.form', 'plugin.admin.api_key');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Contact = ClassRegistry::init('Contact');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Contact);

		parent::tearDown();
	}

}
