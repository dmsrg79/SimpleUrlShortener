<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=dima', 'root','password');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
$h = "QqWwEeRrTtYyUuIiOoPpAaSsDdFfGgHhJjKkLlZzXxCcVvBbNnMm1234567890";
$rand = substr(str_shuffle($h), 0, 5);
$url = $_POST['url'];
//if ($_POST['submit']) {

/*
    $stmt = $pdo->prepare('Select * from urls where full_url=:full_url');
    $stmt->bindParam(":short_code",$rand);
    $stmt->execute();
*/

    $stmt = $pdo->prepare("SELECT short_code FROM urls WHERE full_url = :full_url LIMIT 1");
    $stmt->bindParam(":full_url",$url);
    $stmt->execute();
    $result = $stmt->fetch();

    if (empty($result)) {
        $stmt = $pdo->prepare("Insert into urls (full_url, short_code) VALUES(:full_url,:short_code)");
        $stmt->bindParam(":full_url",$url);
        $stmt->bindParam(":short_code",$rand);
        $stmt->execute();
    } else {
        $rand = $result[0];
 //   }


    

echo "<strong><a href='s.php?h=$rand'>Short link</a></strong>";

}

    ?>
