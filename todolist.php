<?php
    require_once ('_db/connect.php');
    session_start();

    $date = Date("Y-m-d G:i:s");

    if(!empty($_POST['tache']))
    {
        $tache = htmlspecialchars($_POST['tache']);

        $req = $connect->prepare("INSERT INTO taches (`tache`, `id_utilisateur`, `roles`, `date_creation`,`date_modification`) VALUES (:tache, :id_utilisateur, :roles, :date_creation, :date_modification)");
        $req->execute([
            ":tache" => $tache,
            ":id_utilisateur" => $_SESSION['user']['id'],
            ":roles" => 0,
            ":date_creation" => $date,
            ":date_modification" => $date
        ]);
    }

if(isset($_GET['task'])) {
    $req = $connect->prepare("SELECT *, taches.id FROM taches INNER JOIN utilisateurs ON utilisateurs.id = taches.id_utilisateur WHERE id_utilisateur = :id_utilisateur AND roles = :roles");
    $req->execute([
        ":id_utilisateur" => $_SESSION['user']['id'],
        ":roles" => 0
    ]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
    die();
}

if(isset($_GET['update'])){
    $id_task = (int)$_POST['id_task'];
    $req = $connect->prepare("UPDATE taches SET `roles` = :roles, `date_modification` = :date_modification WHERE `id` = :id");
    $req->execute([
            ":roles" => 1,
            ":date_modification" => $date,
            ":id" => $id_task
    ]);

}

if(isset($_GET['done'])) {
    $req = $connect->prepare("SELECT *, taches.id FROM taches INNER JOIN utilisateurs ON utilisateurs.id = taches.id_utilisateur WHERE id_utilisateur = :id_utilisateur AND roles = :roles");
    $req->execute([
        ":id_utilisateur" => $_SESSION['user']['id'],
        ":roles" => 1
    ]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
    die();
}





    if(isset($_SESSION['user'])) {
?>

<!doctype html>
<html lang="fr">
<head>
<?php require_once('_include/head.php') ?>
    <script src="_include/script.js" defer></script>
    <script src="_include/tdl.js" defer></script>
    <title>Document</title>
</head>
<body>
<header>
    <?php require_once ('_include/header.php')?>
</header>
<main>
<article id="place-input">
    <form id="form-tache" action="" method="POST">
        <label for="tache">Tâches</label>
        <input type="text" name="tache" id="tache">
        <input type="submit" name="submit" id="submit-input" value="A faire">
    </form>
</article>
    <h1>Taches a accomplir</h1>
<article id="todo">


</article>
    <h1>Taches accomplis</h1>
<article id="done">

</article >
</main>
<footer>
    <?php require_once('_include/footer.php') ?>
</footer>
</body>
</html>
<?php
    }
    else
    {
        header("location:index.php");
    }


?>