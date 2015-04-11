<?php
class IrohaDatasController extends AppController {
	var $name = 'IrohaDatas';
	var $use = array('IrohaData', 'Control');
	var $autoRender = true;
	var $layout = 'iroha_data';
	var $autoLayout = true;
	var $components = array('RequestHandler', 'Search');
	var $helpers = array('Javascript', 'SearchResult');
	var $Control;
	var $search_exceptions;
	
	function beforeFilter() {
		App::import('sanitize');
		$this->search_exceptions = $this->Search->getSearchExceptions();
		$this->set('columns', $this->Search->getResultColumns());
		$this->set('iroha_chars', $this->Search->getIrohaChars());
		$this->set('syozokubus', $this->Search->getSyozokubus());
	}
	
	function about() {}

	function index() {
		App::import('Model', 'Control');
		$this->Control = new Control();
		$this->set('change_logs', $this->Control->getChangeLog());
	}
	
	function search() {
		$this->set('yomis', null);
		$this->set('midashis', null);
		$this->set('ycount', 0);
		$this->set('mcount', 0);
	
		if ($this->RequestHandler->isPost()) {
			// 前処理
			$params = $this->Search->preprocess($this->params);
			$require_yomi_search = $this->Search->requireYomiSearch($params);
			if (strlen($params['query']) === 0) $this->redirect('./');
			
			// 検索パラメタのセット
			$this->set('query', $params['query']);
			$this->set('syozokuhen', $params['syozokuhen']);
			$this->set('syozokubu', $params['syozokubu']);
			$this->set('mojisuu', intval($params['mojisuu']));
				
			// 検索結果を取得
			if ($require_yomi_search) {
				$this->set('yomis', $yomis = $this->Search->searchYomi($params));
				$this->set('ycount', count($yomis));
			}
			$this->set('midashis', $midashis = $this->Search->searchMidashi($params));
			$this->set('mcount', count($midashis));
		} else {
			$this->redirect('/');
		}
	}
}
