<!DOCTYPE html>
<html>  
    <head>
        <meta charset="UTF-8" />
        <title>削除結果</title>
        <link rel="stylesheet" href="default.css">
        <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    </head>
    <body class='wf-roundedmplus1c'>
        <header>
            <h1>削除結果</h1>
        </header>
        <div class='outer'>
            <div class='contents'>
                <?php
                    $dsn = $_ENV['DSN'];
                    $user = $_ENV['POSTGRES_USER'];
                    $pass = $_ENV['POSTGRES_PASSWORD'];
                    $id = $_GET['id'];

                    try {
                        $dbh = new PDO($dsn, $user, $pass);
                    
                        $select = $dbh->prepare('SELECT * FROM bbs WHERE id=?');
                        $select->execute(Array($id));
                        $select_result = $select->fetchAll();
                        print $select_result[0];

                        if (password_verify($_POST['password'], $select_result[0]['password'])) {
                            $delete = $dbh->prepare('DELETE FROM bbs WHERE id=?');
                            $delete_result = $delete->execute(Array($id));

                            if ($delete_result) {
                                print "<p>削除しました。</p>";
                            } else {
                                print "<p>削除に失敗しました。</p>";
                            }

                        } else {
                            print "<p>パスワードが一致しません。</p>";
                        }

                        $dbh = null;
                    } catch (PDOException $e) {
                        print "<p>削除に失敗しました。</p>";
                    }
                ?>
            </div>
        </div>
        <footer>
            <a href='index.php'>掲示板に戻る</a>
        </footer>
    </body>
</html>