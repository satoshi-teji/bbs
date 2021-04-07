<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>PHP sample</title>
    </head>
    <body>
        <?php
            //commentがpostされている場合
            if(isset($_POST["comment"])){
                //エスケープしてから表示
                $comment = htmlspecialchars($_POST["color"]);
                print("あなたのコメントは「${comment}」です。");
            } else {
        ?>
            <p>コメントしてください</p>
            <form method="POST" action="index.php">
                <div>
                    <label>お名前</label>
                    <input name="name" />
                </div>
                <div>
                    <label>タイトル</label>
                    <input name="title" />
                </div>
                <div>
                    <label>メールアドレス</label>
                    <input type="email" name="mail" />
                </div>
                <div>
                    <label>文字色</label>
                    <input type="color" name="color" />
                </div>
                <div>
                    <label>投稿内容</label>
                    <textarea name="comment" minlength="5"></textarea>
                </div>
                <input type="submit" value="送信" />
            </form>
        <?php
            }
        ?>
    </body>
</html>