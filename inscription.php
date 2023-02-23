<?php
    require_once ('_db/connect.php');
    session_start();

    function checkLogin($login)
    {
        if(strlen($login) < 5 || strlen($login) > 25)
        {
            return array("bool" => $valid = FALSE ,"err_login" => "Le login doit contenir plus de 5 ou moins 25 caractéres");
        }
    }

    if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confpassword'])) {
        $login = htmlspecialchars(trim($_POST['login']));
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));
        $confpassword = htmlspecialchars(trim($_POST['confpassword']));

        $regex = "^\S*(?=\S{5,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$^";

        $valid = TRUE;

        if($password == $confpassword)
        {

            $err_login = checkLogin($login);

            if(preg_match($regex, $password))
            {
                $crypt_password = password_hash($password, PASSWORD_DEFAULT);
            }
            else
            {
                $valid = FALSE;
                $err_message = "Le mot de passe doit contenir minimum 5 caractéres dont 1 majuscule, 1 minuscule, 1 caractéres spéciales et 1 chiffre.";
            }



        }
        else
        {
            $err_message = "La confirmation du mot de passe est erronée ";
        }

        if($valid){
            $req = $connect->prepare("INSERT INTO utilisateurs (`login`, `password`, `email`) VALUES (:login, :password, :email)");
            $req->execute([
                ":login"=>$login,
                ":password"=>$crypt_password,
                ":email"=>$email
            ]);
        }
    }
    else
    {
        $err_message = "Tous les champs doivent être remplis";
    }

?>

<form class="form" id="register-form" method="POST">
    <?php if(isset($err_login)) {echo $err_login;} //affichage du message d'erreur si il y'en a une?>
    <label class="space" for="login">Login</label>
    <input class="space input" type="text" name ="login" value="<?php if(isset($login)) {echo "$login";} // si on écrit quelquechose dans le champ et que l'on se trompe le login reste afficher ?>" placeholder="Login" >

    <label for="email">E-mail</label>
    <input type="email" name="email" placeholder="Mail" value="bonjour@gmail.com">

    <?php if(isset($err_password)) {echo $err_password;} //affichage du message d'erreur si il y'en a une?>
    <label class="space" for="password">Mot de passe</label>
    <input class="space input" type="password" name ="password" placeholder="Mot de passe" value="Bonjour.123">

    <label class="space" for="confpassword">Confirmation mot de passe</label>
    <input class="space input" type="password" name ="confpassword" placeholder="Confirmez votre mot de passe" value="Bonjour.123">

    <input class="button" type="submit" name="submit" id="submitReg"  value="Inscription">
</form>