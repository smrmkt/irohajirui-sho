<?php  
class ControlsFixture extends CakeTestFixture { 
	var $name = 'Control';
	
	var $fields = array(
			'id' => array('type' => 'integer', 'key' => 'primary'),
			'changelog' => array('text'),
	);
	
	var $records = array(
			'id' => 1,
			'cnahgelog' => "2012/2/10,レイアウトを変更しました。\n2012/01/30,現在の検索可能範囲は「イ篇天象部」です。<br>随時更新予定です。\n2012/01/01,サイトを作成しました",
	);
} 
