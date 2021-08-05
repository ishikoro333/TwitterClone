<?php
///////////////////////
//ツイートデータを処理
///////////////////////

/**
 * ユーザーを作成
 * 
 * @param array $data
 * @return bool  
 */

 function createTweet(array $data){
     //DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

     //接続エラーがある場合->処理を停止
     if($mysqli->connect_errno){
        echo 'MySQLの接続に失敗しました。:'  . $mysqli->connect_error . "\n";
        exit;
     }

     //新規登録のsqlクエリを作成
     $query = 'INSERT INTO tweets (user_id, body, image_name) VALUES (?, ?, ?)';

     //プリペアドステートメントに、作成したクエリを登録
     $statement = $mysqli->prepare($query);
    
     //クエリのプレースホルダ($queryの?の部分)にカラム値を紐付け iss 左からint型、string型の順
     $statement->bind_param('iss',$data['user_id'],$data['body'],$data['image_name']);

     //クエリを実行
     $response = $statement->execute();

     //実行に失敗した場合->エラー表示
     if($response === false){
         echo 'エラーメッセージ:' . $mysqli->error ."\n";
     }
    
     //DB接続を開放
     $statement->close();
     $mysqli->close();

     return $response;
 }

/**
 * ツイート一覧を取得
 * 
 *@param array $user ログインしているユーザー情報
 *@return array|false
 */

function findTweets(array $user)
{
      //DB接続
      $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      //接続エラーがある場合->処理を停止
      if($mysqli->connect_errno){
         echo 'MySQLの接続に失敗しました。:'  . $mysqli->connect_error . "\n";
         exit;
      }

      //ログインユーザーIDをエスケープ
      $login_user_id = $mysqli->real_escape_string($user['id']);

      //検索のsqlクエリを作成
      $query = <<<SQL
        SELECT
            T.id AS tweet_id,
            T.status AS tweet_status,
            T.body AS tweet_body,
            T.image_name AS tweet_image_name,
            T.created_at AS tweet_created_at,
            U.id AS user_id,
            U.name AS user_name,
            U.nickname AS user_nickname,
            U.image_name AS user_image_name,
            -- ログインユーザーがいいね！したか(いいね！している場合、値が入る)
            L.ID AS like_id,
            -- いいね！数
            (SELECT COUNT(*) FROM likes WHERE status = 'active' AND tweet_id = T.id) AS like_count
        FROM
            tweets AS T
            -- ユーザーテーブルをusers.idとtweets.user_idで紐付ける
            JOIN
            users AS U ON U.id = T.user_id AND U.status = 'active'
            -- いいね！テーブルをlikes.tweet_idとtweets.idで紐づける
            LEFT JOIN
            likes AS L ON L.tweet_id = T.id AND L.status = 'active' AND L.user_id = '$login_user_id'
        WHERE
            T.status = 'active'
        
      SQL;
    
      //クエリ実行
      $result = $mysqli->query($query);
      if ($result){
          //データを配列で受け取る
          $response = $result->fetch_all(MYSQLI_ASSOC);
      }else{
          $response = false;
          echo 'エラーメッセージ:' . $mysqli->error . "\n";
      }

      $mysqli->close();

      return $response;
    }