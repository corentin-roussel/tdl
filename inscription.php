<?php
    require_once ('_db/connect.php');
    session_start();

    if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confpassword'])) {
        $login = htmlspecialchars(trim($_POST['login']));
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));
        $confpassword = htmlspecialchars(trim($_POST['confpassword']));

        $valid = TRUE;

        if($password == $confpassword)
        {
            if(strlen($login) < 5 || strlen($login) > 25)
            {
                $valid = FALSE;
                $err_message = "Le login doit contenir plus de 5 ou moins 25 caractéres";
            }

            if()

        }
        else
        {
            $err_message = "La confirmation du mot de passe est erronée ";
        }


//        $req = $connect->prepare("INSERT INTO utilisateurs (`login`, `password`, `email`) VALUES (:login, :password, :email)");
//        $req->execute([
//            ":login"=>$login,
//            ":password"=>$password,
//            ":email"=>$email
//        ]);
    }

?>

<form class="form" id="register-form" method="POST">
    <?php if(isset($err_login)) {echo '<div>' . "$err_login" . '</div>' ;} //affichage du message d'erreur si il y'en a une?>
    <label class="space" for="login">Login</label>
    <input class="space input" type="text" name ="login" value="<?php if(isset($login)) {echo "$login";} // si on écrit quelquechose dans le champ et que l'on se trompe le login reste afficher ?>" placeholder="Login" required>

    <label for="email">E-mail</label>
    <input type="email" name="email" placeholder="Mail">

    <?php if(isset($err_password)) {echo '<div>' . "$err_password" . '</div>' ;} //affichage du message d'erreur si il y'en a une?>
    <label class="space" for="password">Mot de passe</label>
    <input class="space input" type="password" name ="password" placeholder="Mot de passe" required>

    <label class="space" for="confpassword">Confirmation mot de passe</label>
    <input class="space input" type="password" name ="confpassword"  value="" placeholder="Confirmez votre mot de passe" required>

    <input class="button" type="submit" name="submit" id="submitReg"  value="Inscription">
</form>