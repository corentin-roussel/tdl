<?php
    require_once ('_db/connect.php');
    session_start();

    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = htmlspecialchars(trim($_POST['login']));
        $password = htmlspecialchars(trim($_POST['password']));

        $req = $connect->prepare("SELECT * FROM utilisateurs WHERE login = :login");
        $req->execute([
            ":login" => $login
        ]);

        $verif = $req->rowCount();

        if ($verif == 1) {
            $user = $req->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = array('id' => $user['id'], 'login' => $user['login'], 'password' => $user['password'], 'email' => $user['email']);
            }


        } else {
            $err_message = "le nom d'utilisateur ou le mot de passe est incorrect";
        }


    }
var_dump($_SESSION['user']);
?>

<form class="form" id="connexion-form" method="POST">
    <?php if(isset($err_login)) {echo $err_login;} ?>
    <label class="space" for="login">Login</label>
    <input class="space input" type="text" name ="login"  value="<?php if(isset($login)) {echo $login;} ?>" placeholder="Entrez votre login" >

    <?php if(isset($err_password)) {echo $err_password;} ?>
    <label class="space" for="password">Mot de passe</label>
    <input class="space input" type="password" name ="password"  placeholder="Entrez votre mot de passe" >


    <input class="button" type="submit" id="submitCon"  name="submit" value="Connexion">
</form>