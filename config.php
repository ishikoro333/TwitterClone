<?php
// エラー表示あり
ini_set('display_errors',1);//ini_set:phpを設定する関数
// 日本時間に変更
date_default_timezone_set('Asia/Tokyo');
// URL/ディレクトリ設定
define('HOME_URL' , 'http://localhost/TwitterClone/');
//データベースの接続情報
define('DB_HOST' , 'localhost');
define('DB_USER' , 'root');
define('DB_PASSWORD' , 'root');
define('DB_NAME' , 'twitter_clone');
?>