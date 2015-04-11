<?php
class Control extends AppModel {
	var $name = "Control";
	
	public function getChangeLog() {
		$result = $this->find();
		$change_log = $result["Control"]["changelog"];
		$change_log = str_replace("\r\n", "\n", $change_log);
		return split("\n", $change_log);
	}
}
