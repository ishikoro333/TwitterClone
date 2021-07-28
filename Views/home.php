<?php
// エラー表示あり
ini_set('display_errors',1);//ini_set:phpを設定する関数
// 日本時間に変更
date_default_timezone_set('Asia/Tokyo');
// URL/ディレクトリ設定
define('HOME_URL' , 'http://localhost/TwitterClone/');

///////////
//ツイート一覧
///////////
$view_tweets = [
    [
        'user_id' => 1,
        'user_name' => 'taro',
        'user_nickname' => '太郎',
        'user_image_name' => 'sample-person.jpg',
        'tweet_body' => '今プログラミングをしています。',
        'tweet_image_name' => null,
        'tweet_created_at' => '2021-03-15 14:00:00',
        'like_id' => null,
        'like_count' => 0,
    ],
    [
        'user_id' => 2,
        'user_name' => 'jiro',
        'user_nickname' => '次郎',
        'user_image_name' => null,
        'tweet_body' => 'コワーキングスペースをオープンしました。',
        'tweet_image_name' => 'sample-post.jpg',
        'tweet_created_at' => '2021-03-14 14:00:00',
        'like_id' => 1,
        'like_count' => 1,
    ],
];
?>



<!DOCTYPE html><!-- ! でテンプレ出せる-->
<html lang="ja"><!--日本語サイト-->
<head >
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo HOME_URL; ?>Views/img/logo-twitterblue.svg">
    <!-- Bootstrapを参照-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo HOME_URL; ?>Views/css/style.css">
    <!--JS-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" defer></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous" defer></script>
    <!--いいね！JS-->
    <script src="<?php echo HOME_URL; ?>Views/js/like.js" defer></script>
    <title>ホーム画面 / Twitterクローン</title>
    <meta name="description" content="ホーム画面です">
</head>

<body class="home">
    <div class="container">

        <div class="side">
            <div class="side-inner">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/logo-twitterblue.svg" alt="" class="icon"></a></li>
                    <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/icon-home.svg" alt="" ></a></li>
                    <li class="nav-item"><a href="search.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/icon-search.svg" alt="" ></a></li>
                    <li class="nav-item"><a href="notifivation.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/icon-notification.svg" alt="" c></a></li>
                    <li class="nav-item"><a href="profile.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/icon-profile.svg" alt="" ></a></li>
                    <li class="nav-item"><a href="post.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/icon-post-tweet-twitterblue.svg" alt="" class="post-tweet"></a></li>
                    <li class="nav-item my-icon"><img src="<?php echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" class="js-popover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" 
                    data-bs-content="<a href='profile.php'>プロフィール</a><br><a href='sign-out.php'>ログアウト</a>" data-bs-html="true"></li>
                </ul>
            </div>
        </div>

        <div class="main">
            <div class="main-header">
                <h1>ホーム</h1>
            </div>
            <!--つぶやき投稿エリア-->
            <div class="tweet-post">
                <div class="my-icon">
                    <img src="<?php echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" alt="">
                </div>
                <div class="input-area">
                    <form action="post.php" method="post" enctype="multipart/form-data"><!--enctype:ファイルを送信する命令-->
                                                <!--placeholder：背景文字-->
                        <textarea name="body" placeholder="いまどうしてる？"　maxlength="140"></textarea>
                        <div class="bottom-area">
                            <div class="mb-0"><!--mb-0,form-control:bootstrapのタグ-->
                                <input type="file" name="image" class="form-control form-contril-sm">
                            </div>
                            <button class="btn" type="submit">つぶやく</button><!--submit:入力データを送信-->
                        </div>
                    </form>
                </div>
            </div>
            <!--仕切りエリア-->
            <div class="ditch"></div>

            <!--つぶやき一覧エリア-->
    <?php if(empty($view_tweets)) : ?>
            <p class="p-3">ツイートがありません</p><!--p-3はbootstrapのクラス(padding)-->
        <?php else:?>
            <div class="tweet-list">
                <?php foreach($view_tweets as $view_tweet): ?>
                    <div class="tweet">
                        <div class="user">
                            <a href="profile.php?usr_id=<?php echo $view_tweet['user_id']; ?>">
                                <img src="<?php echo HOME_URL; ?>Views/img_uploaded/user/<?php echo $view_tweet['user_image_name']; ?>" alt="">
                            </a>
                        </div>
                        <div class="content">
                            <div class="name">
                                <a href="profile.php?user_id=<?php echo $view_tweet['user_id']; ?>">
                                    <span class="nickname"><?php echo $view_tweet['user_nickname']; ?></span>
                                    <span class="user-name">@<?php echo $view_tweet['user_name']; ?> ・ <?php echo $view_tweet['tweet_created_at']; ?></span>
                                </a>
                            </div>
                            <p><?php echo $view_tweet['tweet_body']; ?></p>
                            
                            <?php if (isset($view_tweet['tweet_image_name'])) : ?>
                                <img src="<?php echo HOME_URL; ?>Views/img_uploaded/tweet/<?php echo $view_tweet['tweet_image_name']; ?>" alt="" class="post-image">
                            <?php endif;?>

                            <div class="icon-list">
                                <div class="like js-like" data-like-id="<?php echo htmlspecialchars($view_tweet['like_id']); ?>">
                                    <?php
                                    if (isset($view_tweet['like_id'])) {
                                        //いいねしている場合は、青のハート
                                        echo '<img src="' . HOME_URL . 'Views/img/icon-heart-twitterblue.svg" alt="">';                                
                                    } else {
                                        //いいねしていない場合は、グレーのハート
                                        echo '<img src="' . HOME_URL . 'Views/img/icon-heart.svg" alt="">';
                                    }
                                    ?>                                    
                                </div>
                                <div class="like-count js-like-count"><?php echo $view_tweet['like_count']; ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
    <?php endif; ?>

        </div>

    </div>
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            $('.js-popover').popover({
                container: 'body'
            })
        }, false);
    </script>
</body>
</html>