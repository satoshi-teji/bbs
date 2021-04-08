<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>投稿結果</title>
        <link rel="stylesheet" href="default.css">
        <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    </head>
    <body class='wf-roundedmplus1c'>
        <header>
            <h1>投稿結果</h1>
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

                        try {
                            $dbh = new PDO($dsn, $user, $pass);
                        
                            $sth = $dbh->prepare('INSERT INTO bbs (name, title, password, comment) VALUES (?, ?, ?, ?)');

                            $result=$sth->execute(array($_POST['name'], $_POST['title'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['comment']));

                            $dbh = null;
                            
                            if ($result) {
                                print "<p>投稿に成功しました。</p>";
                            } else {
                                print "<p>投稿に失敗しました。</p>";
                            }
                            
                        } catch (PDOException $e) {
                            print "<p>投稿に失敗しました。</p>";
                        }
                    } else {
                        print "<p>投稿に失敗しました。</p>";
                    }
                ?>
            </div>
        </div>
        <footer>
            <a href='index.php'>掲示板に戻る</a>
        </footer>
    </body>
</html>