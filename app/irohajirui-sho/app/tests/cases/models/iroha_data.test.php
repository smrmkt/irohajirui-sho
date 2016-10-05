<?php
App::import('Model', 'IrohaData');

class IrohaDataTestCase extends CakeTestCase {
	var $fixtures = array('app.iroha_data');
	
	function startTest() {
		$this->IrohaData =& ClassRegistry::init('IrohaData');
	}

	function endTest() {
		unset($this->IrohaData);
		ClassRegistry::flush();
	}
	
	function testGetByIds() {
		$ids = array(657, 658, 659);
		$result = $this->IrohaData->getByIds($ids);
		$expected = count($ids);
		$this->assertEqual(count($result), $expected);
	}
		
	function testGetIdsMatchingYomiFully() {
		$params = array(
				'query' => 'ライ',
				'syozokuhen' =>	'',
				'syozokubu' =>	'',
				'mojisuu' =>	''
		);
		$result = $this->IrohaData->getIdsMatchingYomiFully($params);
		$expected = 1;
		$this->assertEqual(count($result), $expected);
	}
	
	function testGetIdsMatchingYomiPartially() {
		$params = array(
				'query' => 'ライ',
				'syozokuhen' =>	'',
				'syozokubu' =>	'',
				'mojisuu' =>	''
		);
		
		// 除外条件を付けない
		$result = $this->IrohaData->getIdsMatchingYomiPartially($params);
		$expected = 2;
		$this->assertEqual(count($result), $expected);
		
		// 除外条件をつける
		$ids = array(657);
		$result = $this->IrohaData->getIdsMatchingYomiPartially($params, $ids);
		$expected = 1;
		$this->assertEqual(count($result), $expected);
	}
	
	function testGetIdsMatchingMidashiFully() {
		$params = array(
				'query' => '雷',
				'syozokuhen' =>	'',
				'syozokubu' =>	'',
				'mojisuu' =>	''
		);
		$result = $this->IrohaData->getIdsMatchingMidashiFully($params);
		$expected = 1;
		$this->assertEqual(count($result), $expected);
	}
	
	function testGetIdsMatchingMidashiPartially() {
		$params = array(
				'query' => '雷',
				'syozokuhen' =>	'',
				'syozokubu' =>	'',
				'mojisuu' =>	''
		);
		
		// 除外条件を付けない
		$result = $this->IrohaData->getIdsMatchingMidashiPartially($params);
		$expected = 3;
		$this->assertEqual(count($result), $expected);
		
		// 除外条件を付ける
		$ids = array(657);
		$result = $this->IrohaData->getIdsMatchingMidashiPartially($params, $ids);
		$expected = 2;
		$this->assertEqual(count($result), $expected);
	}
}
?>
