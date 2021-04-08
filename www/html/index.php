<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>掲示板</title>
        <link rel="stylesheet" href="default.css">
        <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    </head>
    <body class='wf-roundedmplus1c'>
        <header>
            <h1>掲示板</h1>
        </header>
        <div class='outer'>
            <div class='contents'>
                <?php
                    //commentがpostされている場合
                    if(isset($_POST["comment"])){
                        //エスケープしてから表示
                        $comment = htmlspecialchars($_POST["color"]);
                        print("あなたのコメントは「${comment}」です。");
                    }
                ?>
            </div>
        </div>
        <footer>
            <a href='post_comment.php'>投稿する</a>
        </footer>
    </body>
</html>