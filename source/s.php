<?php


try {
    $pdo = new PDO('mysql:host=localhost;dbname=dima', 'root','password');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$hash = $_GET['h'];
if(!empty($hash)){
    $stmt = $pdo->prepare('Select * from urls where short_code=:short_code');
    $stmt->bindParam(":short_code",$hash);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_OBJ);
    header("Location: $res->full_url");
}

?>