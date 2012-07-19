<?php
App::uses('SqliteSequence', 'Model');

/**
 * SqliteSequence Test Case
 *
 */
class SqliteSequenceTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.sqlite_sequence');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SqliteSequence = ClassRegistry::init('SqliteSequence');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SqliteSequence);

		parent::tearDown();
	}

}
