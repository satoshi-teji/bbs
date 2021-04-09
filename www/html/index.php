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
                    $dsn = $_ENV['DSN'];
                    $user = $_ENV['POSTGRES_USER'];
                    $pass = $_ENV['POSTGRES_PASSWORD'];

                    try {
                        $dbh = new PDO($dsn, $user, $pass);
                    
                        $query_result = $dbh->query('SELECT * FROM bbs ORDER BY created_at DESC');

                        $dbh = null;
                        
                        foreach ($query_result as $row) { ?>
                            <div class='display'>
                                <div class='profile'>
                                    <img src='profile_icon.png' alt='アイコン' class='icon'>
                                    <div class='name_title'>
                                        <li class='name'><label>名前:<?php print htmlspecialchars($row['name'])?></label></li>
                                        <li><label>タイトル:<?php print htmlspecialchars($row['title'])?></label></li>
                                    </div>
                                </div>
                                <li>
                                    <div class='cont'>
                                        <label>投稿内容</label>
                                    </div>
                                    <div class='created_at'>
                                        <label>投稿日時:<?php print htmlspecialchars(substr($row['created_at'], 0, 19))?></label>
                                    </div>
                                    <p class='post_data'><?php print htmlspecialchars($row['comment'])?></p>
                                </li>
                                <li>
                                    <div class='edit_button'>
                                        <a href='edit_form.php?id=<?php print $row['id']; ?>'><label>編集する</label></a>
                                    </div>
                                    <?php
                                        if ($row['created_at'] !== $row['updated_at']) { ?>
                                    <div class='updated_at'>
                                        <label>最終更新日時:<?php print htmlspecialchars(substr($row['updated_at'], 0, 19))?></label>
                                    </div>
                                </li>
                                <?php 
                                    } 
                                ?>
                            </div>
                        <?php
                        }
                    } catch (PDOException $e) {
                        print "<p>接続に失敗しました。</p>";
                    }
                ?>
            </div>
        </div>
        <footer>
            <a href='post_form.php'>投稿する</a>
        </footer>
    </body>
</html>