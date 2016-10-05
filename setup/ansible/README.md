# irohajirui-sho-ansible

### 事前準備
- ansible, Vagrantをインストールする
- centos64のboxをあらかじめvagrantで準備しておく
- リポジトリルートでvagrant upを行ってVMを作成する
- vagrantのssh設定を，ローカルの.ssh/configに追加しておく
  - `vagrant ssh-config >> ~/.ssh/config`

### 実行
- ansibleのplaybookを実行する
  - `ansible-playbook -i hosts site.yml`
- `http://localhost:8080` にアクセスして，色葉字類抄のページが表示されることを確認する
- 色葉字類抄の管理アカウントを作成する
  - `/usr/share/nginx/html/irohajirui-sho/irohajirui-sho/app/controllers/users_controller.php` を編集
  - 以下の行をコメントアウトする
    - https://github.com/smrmkt/irohajirui-sho/blob/master/irohajirui-sho/app/controllers/users_controller.php#L100
  - `http://localhost:8080/users/add` で新規のアカウントを作成する
  - コメントアウトを元に戻す

