<?php
App::import('Model', 'Control');

class ControlTestCase extends CakeTestCase {
	var $fixtures = array('app.control');
	
	function startTest() {
		$this->Control =& ClassRegistry::init('Control');
	}

	function endTest() {
		unset($this->Control);
		ClassRegistry::flush();
	}
		

	function testGetChangeLog() {
		// 行数チェック
		$result = $this->Control->getChangeLog();
		$expected = 5;
  		$this->assertEqual(count($result), $expected);
	}
}
?>
