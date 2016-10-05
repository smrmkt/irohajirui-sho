<?php
class IrohaData extends AppModel {
	var $name = 'IrohaData';
	
	public function getByIds($ids) {
		$conditions = array('IrohaData.id' => $ids);
		return $this->find('all', array('conditions' =>$conditions));
	}
	
	/**
	 * 読み検索の完全一致のidを返す
	 * @param array $params
	 * @return multitype:
	 */
	public function getIdsMatchingYomiFully($params) {
		// クエリ条件
		$conditions = array('OR' => array(
				'IrohaData.onnyomi'					=> $params['query'],
				'IrohaData.onnyomi_gendai'			=> $params['query'],
				'IrohaData.kunnyomi'				=> $params['query'],
				'IrohaData.kunnyomi'				=> "同（{$params['query']}）",
				'IrohaData.kunnyomi_gendai'			=> $params['query'],
		));
		return $this->__getIdsMatchingYomi($params, $conditions);
	}
	
	/**
	 * 読み検索の部分一致結果を返す
	 * 完全一致結果を渡すことで，それを除外した結果を取得できる
	 * @param array $params
	 * @param array $full_ids
	 * @return multitype:
	 */
	public function getIdsMatchingYomiPartially($params, $full_ids = null) {
		// クエリ条件
		$conditions = array('OR' => array(
				'IrohaData.onnyomi LIKE'			=> "%{$params['query']}%",
				'IrohaData.onnyomi_gendai LIKE'		=> "%{$params['query']}%",
				'IrohaData.kunnyomi LIKE'			=> "%{$params['query']}%",
				'IrohaData.kunnyomi_gendai LIKE'	=> "%{$params['query']}%",
		));
		return $this->__getIdsMatchingYomi($params, $conditions, $full_ids);
	}
	
	/**
	 * 見出し検索の完全一致のidを返す
	 * @param array $params
	 * @return multitype:
	 */
	public function getIdsMatchingMidashiFully($params) {
		$conditions = array('IrohaData.midashigo LIKE' => $params['query']);
		return $this->__getIdsMatchingMidashi($params, $conditions);
	}
	
	/**
	 * 見出し検索の部分一致結果を返す
	 * 完全一致結果を渡すことで，それを除外した結果を取得できる
	 * @param array $params
	 * @param array $full_ids
	 * @return multitype:
	 */
	public function getIdsMatchingMidashiPartially($params, $full_ids = null) {
		$conditions = array('IrohaData.midashigo LIKE' => "%{$params['query']}%");
		return $this->__getIdsMatchingMidashi($params, $conditions, $full_ids);
	}

	private function __getIdsMatchingYomi($params, $conditions, $full_ids = null) {
		// クエリが"マ"か"ママ"のとき
		if ($params['query'] === 'ママ' || $params['query'] === 'マ') {
			$conditions['AND'] = array(
					'IrohaData.onnyomi NOT LIKE'			=> '%（ママ）%',
					'IrohaData.onnyomi_gendai NOT LIKE'		=> '%（ママ）%',
					'IrohaData.kunnyomi NOT LIKE'			=> '%（ママ）%',
					'IrohaData.kunnyomi_gendai NOT LIKE'	=> '%（ママ）%',
			);
		}
		
		// オプション条件
		if (strlen($params['syozokuhen'])) $conditions['syozokuhen LIKE'] = "%{$params['syozokuhen']}%";
		if (strlen($params['syozokubu'])) $conditions['syozokubu LIKE'] = "%{$params['syozokubu']}%";
		if (strlen($params['mojisuu'])) $conditions['mojisuu'] = intval($params['mojisuu']);
		if ($full_ids !== null) { $conditions['NOT'] = array('IrohaData.id' =>$full_ids); };
		
		// パラメタをセットしてデータを取得
		$params = array(
				'fields'		=> array('IrohaData.id'),
				'conditions'	=> $conditions,
		);
		$result = $this->find('all', $params);
		
		// データをidのみの配列に整形
		$ids = array();
		foreach ($result as $key => $value) array_push($ids, $value['IrohaData']['id']);
		return $ids;
	}
	
	private function __getIdsMatchingMidashi($params, $conditions, $full_ids = null) {
		// クエリが"マ"か"ママ"のとき
		if ($params['query'] === 'ママ' || $params['query'] === 'マ') {
			$conditions['midashigo NOT LIKE'] =  '%（ママ）%';
		}
		
		// オプション条件
		if (strlen($params['syozokuhen'])) $conditions['syozokuhen LIKE'] = "%{$params['syozokuhen']}%";
		if (strlen($params['syozokubu'])) $conditions['syozokubu LIKE'] = "%{$params['syozokubu']}%";
		if (strlen($params['mojisuu'])) $conditions['mojisuu'] = intval($params['mojisuu']);
		if ($full_ids !== null) { $conditions['NOT'] = array('IrohaData.id' =>$full_ids); };
		
		// パラメタをセットしてデータを取得
		$params = array(
				'fields'		=> array('IrohaData.id'),
				'conditions'	=> $conditions,
		);
		$result = $this->find('all', $params);
		
		// データをidのみの配列に整形
		$ids = array();
		foreach ($result as $key => $value) array_push($ids, $value['IrohaData']['id']);
		return $ids;
	}	
}