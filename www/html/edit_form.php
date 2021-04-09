<?php
    $dsn = $_ENV['DSN'];
    $user = $_ENV['POSTGRES_USER'];
    $pass = $_ENV['POSTGRES_PASSWORD'];

    try {
        $dbh = new PDO($dsn, $user, $pass);
     
        $sth_select = $dbh->prepare('SELECT * FROM bbs WHERE id=?');
        $sth_select-> execute(array($_GET['id']));
        $query_result = $sth_select->fetchAll();
        $row = $query_result[0];
        $dbh = null;
    } catch (PDOException $e) {
        print "<p>接続に失敗しました。</p>";
        die();
    }
?>

<!DOCTYPE html>
<html>  
    <head>
        <meta charset="UTF-8" />
        <title>投稿を編集する</title>
        <link rel="stylesheet" href="default.css">
        <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    </head>
    <body class='wf-roundedmplus1c'>
        <header>
            <h1>投稿の編集</h1>
        </header>
        <div class='outer'>
            <div class='contents'>
                <form method="POST" action="edit_result.php?id=<?php print $_GET['id']; ?>" class='post'>
                        <ul>
                            <li>
                                <label for='name'>名前:</label>
                                <input type='text' id='name' name="name" minlength="1" maxlength="20" value=<?php print $row['name']; ?> />
                            </li>
                            <li>
                                <label for='title'>タイトル:</label>
                                <input type='text' id='title' minlength="1" maxlength="30" name="title" value=<?php print $row['title']; ?> />                                   
                            </li>
                            <li>
                                <label for='password'>パスワード:</label>
                                <input type="password" id='password' minlength="1" name="password" />
                            </li>
                            <li>
                                <label for='comment'>投稿内容:</label>
                                <textarea id='comment' name="comment" minlength="1" maxlength='140' width=100%><?php print $row['comment']; ?></textarea>
                            </li>
                            <li class='button'>
                                <button type='submit'>編集する</button>
                                <button type='submit' formaction='delete.php?id=<?php print $_GET['id']; ?>'>削除する</button>
                            </li>
                        </ul>
                    </form>
            </div>
        </div>
        <footer>
            <a href="javascript:history.back()">戻る</a>
        </footer>
    </body>
</html>