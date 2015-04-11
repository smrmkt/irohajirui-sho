<?php
class ControlsController extends AppController {
	public $name = "Controls";
	public $use = array("IrohaData", "Control");
	public $autoRender = true;
	public $layout = "control";
	public $autoLayout = true;
	var $helpers = array("Javascript");
	var $components = array("RequestHandler", "Auth");
	var $IrohaData;
	var $items;
	var $item_types;
	
	function beforeFilter() {	
		// ページ情報のセット
		$this->set("header", "三巻本「色葉字類抄」収録語彙データベース");
		$this->set("content_header", "三巻本「色葉字類抄」収録語彙データベース");
		$this->set("footer", "Copyright (C) Akari Fujimoto. All rights reserved.");
				
		// 管理者かどうかを取得
		$user_data = $this->Auth->user();
		$authority = $user_data["User"]["authority"];
		if ($authority === "administrator") $this->set("is_admin", true);
		else $this->set("is_admin", false);
		
		// サニタイズ用ライブラリの読み込み
		App::import("sanitize");
		
		// データオブジェクトの読み込み
		App::import("Model", "IrohaData");
		$this->IrohaData = new IrohaData();
		
		// 行一覧の配列を作成
		$this->items = array(
				"midashigo"            => "見出し語",
				"itaiji1"              => "異体字1",
				"itaiji1_no"           => "異体字1 画像番号",
				"itaiji2"              => "異体字2",
				"itaiji2_no"           => "異体字2 画像番号",
				"itaiji3"              => "異体字3",
				"itaiji3_no"           => "異体字3 画像番号",
				"seiten"               => "声点",
				"syozokuhen"           => "所属篇",
				"syozokubu"            => "所属部",
				"maedahonshozai"       => "前田本所在",
				"kurokawahonshozai"    => "黒川本所在",
				"henbetsububetsu_no"   => "篇別部別通し番号",
				"gaitouhen_sougosuu"   => "該当篇相互数",
				"tsuu_no"              => "通し番号",
				"bubetsu_tsuu_no"      => "部別通し番号",
				"bubetsu_onnkunn_no"   => "部別音訓番号",
				"onnkunn"              => "音訓",
				"onnkunnbetsu_tsuu_no" => "音訓別通し番号",
				"mojisuu"              => "文字数",
				"onnyomi"              => "音読み",
				"onnyomi_kanzen"       => "音読み完全",
				"onnyomi_gendai"       => "音読み現代",
				"kunnyomi"             => "訓読み",
				"kunnyomi_kanzen"      => "訓読み完全",
				"kunnyomi_gendai"      => "訓読み現代",
				"tyuubun"              => "注文",
				"sakuseisya_chuu"      => "作成者注",
		);
		$this->set("items", $this->items);
		
		// 行の変数タイプ一覧
		$this->item_types = array(
				"midashigo"            => "varchar",
				"itaiji1"              => "varchar",
				"itaiji1_no"           => "varchar",
				"itaiji2"              => "varchar",
				"itaiji2_no"           => "varchar",
				"itaiji3"              => "varchar",
				"itaiji3_no"           => "varchar",
				"seiten"               => "varchar",
				"syozokuhen"           => "varchar",
				"syozokubu"            => "varchar",
				"maedahonshozai"       => "varchar",
				"kurokawahonshozai"    => "varchar",
				"henbetsububetsu_no"   => "int",
				"gaitouhen_sougosuu"   => "int",
				"tsuu_no"              => "int",
				"bubetsu_tsuu_no"      => "int",
				"bubetsu_onnkunn_no"   => "int",
				"onnkunn"              => "varchar",
				"onnkunnbetsu_tsuu_no" => "int",
				"mojisuu"              => "int",
				"onnyomi"              => "varchar",
				"onnyomi_kanzen"       => "varchar",
				"onnyomi_gendai"       => "varchar",
				"kunnyomi"             => "varchar",
				"kunnyomi_kanzen"      => "varchar",
				"kunnyomi_gendai"      => "varchar",
				"tyuubun"              => "varchar",
				"sakuseisya_chuu"      => "varchar",
		);
	}
	
	function index() {
		// データの件数を取得
		$sql = "SELECT COUNT(*) FROM iroha_datas;";
		$result = $this->IrohaData->query($sql);
		$this->set("count", $result[0][0]["COUNT(*)"]);
		
		// データの中身を取得
		$sql = "SELECT * FROM iroha_datas;";
		$results = $this->IrohaData->query($sql);
		if (count($results) > 0) {
			$csv = "";
			foreach ($results as $result) {
				foreach ($result["iroha_datas"] as $key => $value) {
					if ($key !== "id") $csv .= $value . ",";
				}
				$csv = substr($csv, 0, strlen($csv) - 1) . "\n";
			}
			$this->set("csv", $csv);
		} else {
			$this->set("csv", "");
		}
	}
	
	function insert() {
		$comment = null;
		if (!empty($this->data)) {
			if( is_uploaded_file($this->data['Control']['file_name']['tmp_name'])) {
				if(strlen($this->data['Control']['file_name']['name']) == mb_strlen($this->data['Control']['file_name']['name'])) {
					//アップロードするファイルの場所
					$upload_dir = "/tmp";
					$upload_file = $upload_dir.DS.basename($this->data['Control']['file_name']['name']);
	
					//画像をテンポラリーの場所から、正式な置き場所へ移動
					if (move_uploaded_file($this->data['Control']['file_name']['tmp_name'], $upload_file)) {
						chmod($upload_file, 0777);
						$this->Session->setFlash("ファイルのアップロードに成功しました。");
						$comment = $this->_insert($upload_file);
					} else {
						$comment = "ファイルのアップロードに失敗しました。";
					}
				}else{
					$comment = "ファイル名に全角文字は使用できません。";
				}
			} else {
				$comment = "ファイルをアップロードしてください。";
			}
		}
		$this->set("comment", $comment);
	}
	
	function update() {
		// 検索クエリの取得
		if ($this->RequestHandler->isPost()) {
			$type = $this->params["form"]["type"];
			$id = (int)$this->params["form"]["id"];
			foreach ($this->items as $eng => $jap) {
				if ($this->item_types[$eng] === "int") {
					$querys[$eng] = Sanitize::clean($this->params["form"][$eng]);
					if (strlen($querys[$eng]) > 0) {
						$querys[$eng] = (int)$querys[$eng];
					}
				} else if ($this->item_types[$eng] === "varchar") {
					$querys[$eng] = Sanitize::clean($this->params["form"][$eng]);
				}
			}

			// クエリのタイプ別の処理
			if ($type === "search") { // データの検索
				// 当てはまるデータの個数を算出
				$sql = "SELECT COUNT(*) FROM iroha_datas WHERE ";
				foreach ($querys as $key => $value) {
					if (strlen($value) > 0) $sql .= $key . " LIKE '%$value%' AND ";
				}
				if (substr($sql, strlen($sql) - 4, 4) === "AND ") {
					$sql = substr($sql, 0, strlen($sql) - 4) . ";";
					$count = $this->IrohaData->query($sql);
					$count = $count[0][0]["COUNT(*)"];
				} else {
					$count = 0;
				}
				$this->set("count", $count);
				
				// データ個数が1件以上なら，当てはまるデータの抽出
				if ($count > 0) {
					$sql = "SELECT * FROM iroha_datas WHERE ";
					foreach ($querys as $key => $value) {
						if (strlen($value) > 0) $sql .= $key . " LIKE '%$value%' AND ";
					}
	 				$sql = substr($sql, 0, strlen($sql) - 4);
	 				if ($count > 10) $sql .= "LIMIT 10";
	 				$sql .= ";";
					$results = $this->IrohaData->query($sql);
					$this->set("results", $results);
				}
			} else if ($type === "update") { // データの更新
				$sql = "UPDATE iroha_datas SET ";
				foreach ($querys as $key => $value) {
					if ($this->item_types[$key] === "int") {
						$sql .= "$key=$value, ";
					} else if ($this->item_types[$key] === "varchar") {
						$sql .= "$key='$value', ";
					}
				}
				$sql = substr($sql, 0, strlen($sql) - 2);
				$sql .= " WHERE id = $id;";
				$return = $this->IrohaData->query($sql);
				
				// セット
				if ($return == 1) $this->set("count", -1);
				else $this->set("count", -2);
			}
		} else {
			$this->set("count", null);
		}
	}
	
	function delete() {
		$this->set("type", null);
		if ($this->RequestHandler->isPost()) {
			// クエリタイプの取得
			$type = $this->params["form"]["type"];
			$this->set("type", $type);
				
			// クエリのタイプ別の処理
			if ($type === "search") { // データの検索
				// パラメタの取得
				foreach ($this->items as $eng => $jap) {
					if ($this->item_types[$eng] === "int") {
						$querys[$eng] = Sanitize::clean($this->params["form"][$eng]);
						if (strlen($querys[$eng]) > 0) {
							$querys[$eng] = (int)$querys[$eng];
						}
					} else if ($this->item_types[$eng] === "varchar") {
						$querys[$eng] = Sanitize::clean($this->params["form"][$eng]);
					}
				}
				
				// レコード総数を算出
				$sql = "SELECT COUNT(*) FROM iroha_datas;";
				$count = $this->IrohaData->query($sql);
				$count = $count[0][0]["COUNT(*)"];
				if ($count == 0) {
					$this->set("count", -1);
					return;
				}

				// 当てはまるデータの個数を算出（クエリに値が一つも入っていなければ，全データを対象とする）
				$sql = "SELECT COUNT(*) FROM iroha_datas WHERE ";
				foreach ($querys as $key => $value) {
					if (strlen($value) > 0) $sql .= $key . " LIKE '%$value%' AND ";
				}
				if (substr($sql, strlen($sql) - 4, 4) === "AND ") {
					$sql = substr($sql, 0, strlen($sql) - 4) . ";";
				} else {
					$sql = "SELECT COUNT(*) FROM iroha_datas;";
				}
				$count = $this->IrohaData->query($sql);
				$count = $count[0][0]["COUNT(*)"];
				$this->set("count", $count);
				
				// データ個数が1件以上なら，当てはまるデータの抽出
				if ($count > 0) {
					$sql = "SELECT * FROM iroha_datas WHERE ";
					foreach ($querys as $key => $value) {
						if (strlen($value) > 0) $sql .= $key . " LIKE '%$value%' AND ";
					}
					if (substr($sql, strlen($sql) - 4, 4) === "AND ") {
						$sql = substr($sql, 0, strlen($sql) - 4) . ";";
					} else {
						$sql = "SELECT * FROM iroha_datas;";
					}
					$results = $this->IrohaData->query($sql);
					$this->set("results", $results);
				}
			} else if ($type === "delete") { // データの削除
				// パラメタの取得
				$count = (int)$this->params["form"]["count"];
				//$max = (int)ini_get('max_input_vars');
				//if ($count > $max) $count = $max;
				$checked_ids = array();
				for ($i = 0; $i < $count; $i++) {
					if ($this->params["form"]["id"]["${i}"] !== "0") {
						array_push($checked_ids, $this->params["form"]["id"]["${i}"]);
					}
				}

				// 削除クエリの作成と実行
				$sql = "DELETE FROM iroha_datas WHERE ";
				foreach ($checked_ids as $checked_id) {
					$sql .= "id = ${checked_id} OR ";
				}
				if (substr($sql, strlen($sql) - 4, 4) === " OR ") {
					$sql = substr($sql, 0, strlen($sql) - 4) . ";";
					$results = $this->IrohaData->query($sql);
					if ($ret = 1) {
						$this->set("count", count($checked_ids));
					} else {
						$this->set("count", -(count($checked_ids)));
					}
				} else {
					$this->set("count", 0);
				}
				
				// DBにあるデータ数を取得
				$sql = "SELECT COUNT(*) FROM iroha_datas;";
				$count = $this->IrohaData->query($sql);
				$count = $count[0][0]["COUNT(*)"];
				if ($count == 0) {
					// Auto Incrementのリセット
					$sql = "ALTER TABLE iroha_datas AUTO_INCREMENT = 1;";
					$this->IrohaData->query($sql);
				}
			}
		} else {
			$this->set("count", null);
		}
	}
	
	function changelog() {
		if ($this->RequestHandler->isPost()) {
			$update_log = $this->params["form"]["update_log"];
			//$update_log = Sanitize::clean($this->params["form"]["update_log"]);
			$sql = "UPDATE controls SET changelog='$update_log';";
			$this->Control->query($sql);
		}
		
		$sql = "SELECT changelog FROM controls;";
		$changelog = $this->Control->query($sql);
		$this->set("changelog", $changelog[0]["controls"]["changelog"]);
	}
	
	function _insert($upload_file) {
		// アップロードしたファイルの読み込み
		$tmp = fopen($upload_file, "r");
		while ($contents[] = fgetcsv($tmp)) {}
		
		// トランザクション開始
		$sql = "START TRANSACTION";
		$result = $this->IrohaData->query($sql);
		if ($result == 0) {
			return "データの追加に失敗しました";
		}
		
		// インサート処理
		$sql = "INSERT INTO iroha_datas (id, ";
		foreach ($this->item_types as $key => $value) {
			$sql .= "${key}, ";
		}
		$sql = substr($sql, 0, strlen($sql) - 2) . ") VALUES ";
		array_pop($contents); #最終行のゴミを取り除く
		foreach ($contents as $content) {
			$sql .= "(NULL, ";
			$cnt = 1;
			foreach ($this->item_types as $key => $value) {
				if ($value === "varchar") {
					$sql .= "'" . $content[$cnt++] . "', ";
				} else if ($value === "int") {
					if (($item = strlen($content[$cnt++])) == 0) {
						$sql .= "0, ";
					} else {
						$sql .= $item . ", ";
					}
				}
			}
			$sql = substr($sql, 0, strlen($sql) - 2) . "), ";
		}
		$sql = substr($sql, 0, strlen($sql) - 2) . ";";
 		$result = $this->IrohaData->query($sql);
		
		// インサートの成功判定をしてトランザクションを終了する
		if ($result == 1) {
			$this->IrohaData->query("COMMIT");
			return "データベースに" . count($contents) . "件のデータを追加しました";
		} else {
			$this->IrohaData->query("ROLLBACK");
			return "データの追加に失敗しました";
		}
 	}
}
