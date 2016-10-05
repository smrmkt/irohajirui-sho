# irohajirui-sho-docker

### 要件
- 対象OSはMacOS 10.10以降でDocker on Macに対応していること

### 事前準備
- ansible, Dockerをインストールする
- docker-machineをセットアップし，defaultという名前のホストマシンを作成しておく
  - 必要に応じて，`hosts` の `[docker_host]` の値を修正する
  - 同様に，`ssh_config` の設定もdocker-machineの設定に応じて修正する
- 以下のコマンドを実行して，ansibleからアプリケーションをコピーできるようにしておく
  - `cd app`
  - `tar cvf irohajirui-sho.tar irohajirui-sho/*`
  - `mv irohajirui-sho.tar ../setup/roles/iroha/files/`

### 実行
- ansibleのplaybookを実行して，Dockerのコンテナ作成，およびアプリケーションのデプロイを行う
  - `ansible-playbook -i hosts site.yml`
- `http://192.168.99.100:8080` にアクセスして，色葉字類抄のページが表示されることを確認する
- アプリを直接編集して，色葉字類抄の管理アカウントを作成する
  - Dockerコンテナ内に入って，アプリの編集
    - `docker exec -it iroha bash`
    - `vi /usr/share/nginx/html/irohajirui-sho/app/controllers/users_controller.php`
  - 以下の行をコメントアウトする
    - https://github.com/smrmkt/irohajirui-sho/blob/master/irohajirui-sho/app/controllers/users_controller.php#L100
  - 以下のURLにアクセスして，新規のアカウントを作成する
    - `http://localhost:8080/users/add`
  - コメントアウトを元に戻す

