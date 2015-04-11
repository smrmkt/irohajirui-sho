<?php
class SearchResultHelper extends Helper {
	function getItaiji($data, $num) {
		$description = $data["IrohaData"]["itaiji${num}"];
		$img_num = $data["IrohaData"]["itaiji${num}_no"];
		if ($this->exists($description)) {
			return array('description', $description);
		} else if ($this->exists($img_num)) {
			$img_num = sprintf('%06d', $img_num);
			return array('img', "MojikyoSVG/MojikyoM_SVG_${img_num}.svg");
		} else {
			return array(null, null);
		}
	}
	
	function getChar($num) {
		return chr($num + 64);
	}
	
	private function exists($value) {
		if ($value === null) return false;
		else if ($value === '') return false;
		else return true;
	}
}