<?php

class UsersController extends AppController
{
	public $name = "Users";
	public $use = "User";
	public $autoRender = true;
	public $layout = "users";
	public $autoLayout = true;
	var $helpers = array("Javascript");
	var $components = array("RequestHandler", "Auth");
	
	function beforeFilter() {
		// ユーザを追加するときにはこのコメントアウトを外す
		$this->Auth->allow("add");
		
		// ログイン・ログアウト時のリダイレクト
		$this->Auth->loginRedirect = "/controls/";
		$this->Auth->logoutRedirect = "/";

		// ログイン画面以外はヘッダ・フッタを表示
		$this->set("show_header", true);
		$this->set("show_footer", true);
		
		// 管理者かどうかを取得
		$user_data = $this->Auth->user();
		$authority = $user_data["User"]["authority"];
		if ($authority === "administrator") $this->set("is_admin", true);
		else $this->set("is_admin", false);
		
		// ページ情報のセット
		$this->set("header", "三巻本「色葉字類抄」収録語彙データベース");
		$this->set("content_header", "三巻本「色葉字類抄」収録語彙データベース");
		$this->set("footer", "Copyright (C) Akari Fujimoto. All rights reserved.");
	}
	
	function index() {
//		$this->redirect("/controls/");
	}
	
	function login() {
		// ヘッダ・フッタを表示しない
		$this->set("show_header", false);
		$this->set("show_footer", false);

		// 認証&リダイレクト処理
		if($this->Auth->login($this->data)){
			$this->redirect("/");
		}
	}

	function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	function change() {
		// 管理者情報の取得
		$user_data = $this->Auth->user();
		$user_id = $user_data["User"]["id"];
		$user_name = $user_data["User"]["username"];

		// エラーメッセージのセット
		$this->set("error_msg", "");
		
		// change password
		App::import("sanitize");
		if ($this->RequestHandler->isPost()) {
			// get params
			$pwd = $this->params["form"]["password"];
			$pwd_cfr = $this->params["form"]["password_cfr"];
			
			// compare params
			if ($pwd_cfr !== "") {
				if ($pwd === $pwd_cfr) {
					$this->data["User"]["id"] = $user_id;
					$this->data["User"]["username"] = $user_name;
					$this->data["User"]["password"] = $this->Auth->password($pwd);
					if ($this->User->save($this->data)) {
						$this->Session->setFlash(__("The user has been saved", true));
						$this->redirect($this->Auth->logout());
					} else {
						$this->Session->setFlash(
							__("The user could not be saved. Please, try again.", true));
					}
				} else {
					$error_msg = "&nbsp;&nbsp;&nbsp;&nbsp;パスワードが一致しません";
					$this->set("error_msg", "<font color='red'><b>${error_msg}</b></font>");
				}
			} else {
				$error_msg = "&nbsp;&nbsp;&nbsp;&nbsp;パスワードに文字を入力してください";
				$this->set("error_msg", "<font color='red'><b>${error_msg}</b></font>");
			}
		}
	}

	function add() {
		// 管理者以外のアクセスは認めない
		$user_data = $this->Auth->user();
		$authority = $user_data["User"]["authority"];
 		if ($authority !== "administrator") $this->redirect("./");
		
		// ユーザの追加
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__("The user has been saved", true));
				$this->redirect(array("action" => "index"));
			} else {
				$this->Session->setFlash(__("The user could not be saved. Please, try again.", true));
			}
		}
	}
	
	function remove() {
		// 管理者以外のアクセスは認めない
		$user_data = $this->Auth->user();
		$authority = $user_data["User"]["authority"];
		if ($authority !== "administrator") $this->redirect("./");
		
		// 削除処理
		App::import("sanitize");
		if ($this->RequestHandler->isPost()) {
			$id = $this->params["form"]["id"];
			$sql = "DELETE FROM users WHERE id = ${id};";
			$this->User->query($sql);
		}
		
		// ユーザ一覧の表示
		$sql = "SELECT * FROM users;";
		$users = $this->User->query($sql);
		$this->set("users", $users);
	}
}