<!DOCTYPE html>
<html>  
    <head>
        <meta charset="UTF-8" />
        <title>投稿フォーム</title>
        <link rel="stylesheet" href="default.css">
        <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    </head>
    <body class='wf-roundedmplus1c'>
        <header>
            <h1>投稿フォーム</h1>
        </header>
        <div class='outer'>
            <div class='contents'>
                <form method="POST" action="post_result.php" class='post'>
                        <ul>
                            <li>
                                <label for='name'>名前:</label>
                                <input type='text' id='name' name="name" minlength="1" maxlength="20" value='名無しさん' />
                            </li>
                            <li>
                                <label for='title'>タイトル:</label>
                                <input type='text' id='title' minlength="1" maxlength="30" name="title" />                                   
                            </li>
                            <li>
                                <label for='password'>パスワード:</label>
                                <input type="password" id='password' minlength="1" name="password" />
                            </li>
                            <li>
                                <label for='comment'>投稿内容:</label>
                                <textarea id='comment' name="comment" minlength="1" maxlength='140' width=100%></textarea>
                            </li>
                            <li class='button'>
                                <button type='submit'>投稿する</button>
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