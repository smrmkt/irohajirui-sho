<?php
class SearchComponent extends Object {
	// 見出し語・読み双方の検索に引っかからないようにする文字・記号のリスト
	private $search_exceptions = array(
			'A', 'B', '【', '】', '／', '・', '（', '）', '（', '）');
	
	// 読み検索を行わないようにする文字のリスト
	private $search_yomi_exceptions = array(
			'同', '上', '平', '去', '入', '濁', '軽', '又', '俗', '伝', '己');
	
	// 検索結果表示用の項目リスト
	private $result_columns = array(
			'onnyomi'			=> '音読み',
			'kunnyomi'			=> '訓読み',
			'tyuubun'			=> '注文',
			'seiten'			=> '声点',
			'syozokuhen'		=> '所属篇',
			'syozokubu'			=> '所属部',
			'maedahonshozai'	=> '前田本所在',
			'kurokawahonshozai'	=> '黒川本所在');
	
	// いろは文字のリスト
	private $iroha_chars = array(
			'イ', 'ロ', 'ハ', 'ニ', 'ホ', 'ヘ', 'ト', 'チ', 'リ', 'ヌ',
			'ル', 'ヲ', 'ワ', 'カ', 'ヨ', 'タ', 'レ', 'ソ', 'ツ', 'ネ',
			'ナ', 'ラ', 'ム', 'ウ', 'ヰ', 'ノ', 'オ', 'ク', 'ヤ', 'マ',
			'ケ', 'フ', 'コ', 'エ', 'テ', 'ア', 'サ', 'キ', 'ユ', 'メ',
			'ミ', 'シ', 'ヱ', 'ヒ', 'モ', 'セ', 'ス');
	
	// 所属部のリスト
	private $syozokubus = array(
			'天象', '地儀', '植物', '動物', '人倫', '人体', '人事', '飲食', '雑物', '光彩',
			'方角', '員数', '辞字', '重点', '畳字', '諸社', '諸寺', '国郡', '官職', '姓氏',
			'名字');
	
	/**
	 * ゲッタ
	 */
	function getSearchExceptions() { return $this->search_exceptions; }
	function getSearchYomiExceptions() { return $this->search_yomi_exceptions; }
	function getResultColumns() { return $this->result_columns; }
	function getIrohaChars() { return $this->iroha_chars; }	
	function getSyozokubus() { return $this->syozokubus; }
	
	/**
	 * 検索クエリの前処理
	 * @param array $params
	 */
	function preprocess($params) {
		$search_params = array(
				'query' =>		'',
				'syozokuhen' =>	'',
				'syozokubu' =>	'',
				'mojisuu' =>	''
		);

		foreach ($search_params as $key => $value) {
			mysql_set_charset('utf8'); // Sanitize::clean()の\混入対策
			$value = $params['form'][$key];
			$value = Sanitize::clean($value); // SQLインジェクション対策
			$value = mb_convert_kana($value, 'C'); // 全角かな→全角カタカナ
			$value = mb_convert_kana($value, 'K'); // 半角カタカナ→全角カタカナ
			if ($key === 'query') { // 無効ワードをクエリから除去
				foreach ($this->search_exceptions as $invalid_all_char) {
					$value = str_replace($invalid_all_char, '', $value);
				}
			}
			$search_params[$key] = $value;
		}
		return $search_params;
	}
	
	/**
	 * 読み検索をするか
	 * @param array $params
	 */
	public function requireYomiSearch($params) {
		foreach ($this->search_yomi_exceptions as $exception) {
			if (preg_match("/${exception}/", $params['query'])) {
				return false;
			}
		}
		return true;
	}
	
	/**
	 * 完全一致→部分一致の順に当てはまる読みデータを取得
	 * @param array $params
	 */
	public function searchYomi($params) {
		App::import('Model', 'IrohaData');
		$this->IrohaData = new IrohaData();
		$full_ids = $this->IrohaData->getIdsMatchingYomiFully($params);
		$partial_ids = $this->IrohaData->getIdsMatchingYomiPartially($params, $full_ids);
		$full_data = $this->IrohaData->getByIds($full_ids);
		$partial_data = $this->IrohaData->getByIds($partial_ids);
		return array_merge_recursive($full_data, $partial_data);
	}
	
	/**
	 * 完全一致→部分一致の順に当てはまる見出しデータを取得
	 * @param array $params
	 */
	public function searchMidashi($params) {
		App::import('Model', 'IrohaData');
		$this->IrohaData = new IrohaData();
		$full_ids = $this->IrohaData->getIdsMatchingMidashiFully($params);
		$partial_ids = $this->IrohaData->getIdsMatchingMidashiPartially($params, $full_ids);
		$full_data = $this->IrohaData->getByIds($full_ids);
		$partial_data = $this->IrohaData->getByIds($partial_ids);
		return array_merge_recursive($full_data, $partial_data);
	}

}
