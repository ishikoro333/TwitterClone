<?php
//設定関連を読み込む
include_once('../config.php');
//便利な関数を読み込む
include_once('../util.php');

?>


<!DOCTYPE html><!-- ! でテンプレ出せる-->
<html lang="ja"><!--日本語サイト-->
<head >
    <?php include_once('../Views/common/head.php'); ?>
    <title>つぶやく画面 / Twitterクローン</title>
    <meta name="description" content="つぶやく画面です">
</head>

<body class="home">
    <div class="container">
        <?php include_once('../Views/common/side.php'); ?>
        <div class="main">
            <div class="main-header">
                <h1>つぶやく</h1>
            </div>
            <!--つぶやく投稿エリア-->
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


        </div>
    </div>
    <?php include_once('../Views/common/foot.php'); ?>
</body>
</html>