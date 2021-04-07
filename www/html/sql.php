<?php
$dsn = 'pgsql:dbname=TEST;host=neoinstagram_db_1;port=5432';
$user = 'admin';
$pass = 'admin';

try {
    $dbh = new PDO($dsn, $user, $pass);

    $sth = $dbh->prepare('INSERT INTO test_comments (name, text) VALUES (?, ?)');
    $query_result = $dbh->query('SELECT * FROM test_comments');
    $sth_select = $dbh->prepare('SELECT * FROM test_comments WHERE name = ?');
    
    $dbh = null;
} catch (PDOException $e) {
    print "DB ERROR: " . $e->getMessage() . "<br/>";
    die();
}
?>

<?php
    //foreach($query_result as $row){
    //    print $row["name"] . ": " . $row["text"] . "<br/>";
    //}
?>

<?php
    $name = "John";
    $text = "Power is Power";
    $sth->execute(array($name, $text));
?>

<?php
    $name = "John";
    $sth_select->execute(array($name));
    $prepare_result = $sth_select->fetchAll();
    foreach($prepare_result as $row) {
        print($row['name'] . ": " . $row['text'] . " created at " . $row['created_at'] . "<br/>");
    }
    $sth_select->execute(array($name));
?>