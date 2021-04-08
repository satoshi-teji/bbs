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
                                        <label>投稿日時:<?php print htmlspecialchars($row['created_at'])?></label>
                                    </div>
                                    
                                    <p class='post_data'><?php print htmlspecialchars($row['comment'])?></p>
                                </li>
                                <?php
                                    if (!$row['created_at'] === $row['updated_at']) { ?>
                                <li><label>最終更新日時:<?php print htmlspecialchars($row['updated_at'])?></label></li>
                                <?php 
                                    } 
                                ?>
                                <li><a href='edit.php'>編集する</a></li>
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
            <a href='post_comment.php'>投稿する</a>
        </footer>
    </body>
</html>