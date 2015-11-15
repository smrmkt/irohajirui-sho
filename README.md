irohajirui-sho
==============

### About
- CakePHP application for database of words in Irohajirui-sho.

### Requirements
##### software
- nginx
- mysql(5.5.33 or higher)
  - utf8mb4 support required
- php(5.3 or higher)
- php-mysql
- php-fpm
- php-mbstring

##### data
- mojikyo SVGs
  - http://www.mojikyo.org/PWU8N/index.php?SVG_download
  - set files below:
    - irohajirui-sho/app/webroot/img/MojikyoSVG/MojikyoM_SVG_XXXXXX.svg

### setup
- set timezone in php.ini
  - /etc/php.ini
- setup mysql
  - user and password
  - create db
  - create required tables
    - iroha_datas
    - users
    - controls
- irohajirui-sho
  - move this directory to nginx webroot
  - edit db info
    - irohajirui-sho/app/config/database.php
- edit nginx conf for CakePHP
  - /etc/nginx/conf.d/default.conf
  - http://memo.dogmap.jp/2013/02/19/nginx-cakephp/
- service start and chkconfig on
  - mysqld
  - php-fpm
  - nginx

