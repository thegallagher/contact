<?php
App::uses('Form', 'Model');

/**
 * Form Test Case
 *
 */
class FormTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.form', 'app.api_key', 'app.contact');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Form = ClassRegistry::init('Form');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Form);

		parent::tearDown();
	}

}
