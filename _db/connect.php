<?php
    $db = "mysql:host=localhost;dbname=tdl";
    $user = "root";
    $password = "";


try {
    $connect = new PDO($db, $user, $password);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>