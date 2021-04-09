<?php
    date_default_timezone_set('UTC');
    $date = new DateTime('now');
    $date = $date->format('Y-m-d H:i:s');
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>編集結果</title>
        <link rel="stylesheet" href="default.css">
        <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    </head>
    <body class='wf-roundedmplus1c'>
        <header>
            <h1>編集結果</h1>
        </header>
        <div class='outer'>
            <div class='contents'>
                <?php
                    $flag = TRUE;
                    if (!isset($_POST['name'])) {
                        print "<p>名前が送信されていません。</p>";
                        $flag = FALSE;
                    } elseif ($_POST['name'] === '') {
                        print "<p>名前が入力されていません。</p>";
                        $flag = FALSE;
                    }

                    if (!isset($_POST['title'])) {
                        print "<p>タイトルが送信されていません。</p>";
                        $flag = FALSE;
                    } elseif ($_POST['title'] === '') {
                        print "<p>タイトルが入力されていません。</p>";
                        $flag = FALSE;
                    }

                    if (!isset($_POST['password'])) {
                        print "<p>パスワードが送信されていません。</p>";
                        $flag = FALSE;
                    } elseif ($_POST['password'] === '') {
                        print "<p>パスワードが入力されていません。</p>";
                        $flag = FALSE;
                    }

                    if (!isset($_POST['comment'])) {
                        print "<p>投稿内容が送信されていません。</p>";
                        $flag = FALSE;
                    } elseif ($_POST['comment'] === '') {
                        print "<p>投稿内容が入力されていません。</p>";
                        $flag = FALSE;
                    }

                    if ($flag) {
                        $dsn = $_ENV['DSN'];
                        $user = $_ENV['POSTGRES_USER'];
                        $pass = $_ENV['POSTGRES_PASSWORD'];
                        $id = $_GET['id'];

                        try {
                            $dbh = new PDO($dsn, $user, $pass);
                        
                            $select = $dbh->prepare('SELECT * FROM bbs WHERE id=?');
                            $select->execute(Array($id));
                            $select_result = $select->fetchAll();

                            if (password_verify($_POST['password'], $select_result[0]['password'])) {
                                $update = $dbh->prepare('UPDATE bbs SET name=?, title=?, comment=?, updated_at=? WHERE id=?');
                                $update_result = $update->execute(Array($_POST['name'], $_POST['title'], $_POST['comment'], $date, $id));

                                if ($update_result) {
                                    print "<p>編集しました。</p>";
                                } else {
                                    print "<p>編集に失敗しました。</p>";
                                }

                            } else {
                                print "<p>パスワードが一致しません。</p>";
                            }

                            $dbh = null;        
                        } catch (PDOException $e) {
                            print "<p>編集に失敗しました。</p>";
                        }
                    } else {
                        print "<p>編集に失敗しました。</p>";
                    }
                ?>
            </div>
        </div>
        <footer>
            <a href='index.php'>掲示板に戻る</a>
        </footer>
    </body>
</html>