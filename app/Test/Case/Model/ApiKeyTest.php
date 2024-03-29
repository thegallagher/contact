<?php
App::uses('ApiKey', 'Model');

/**
 * ApiKey Test Case
 *
 */
class ApiKeyTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.api_key', 'app.form', 'app.contact');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ApiKey = ClassRegistry::init('ApiKey');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ApiKey);

		parent::tearDown();
	}

}
