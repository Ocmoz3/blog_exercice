<?php 
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
// if(isLogged()) {
//     header('Location: index.php');
// }
debug($_SESSION);
$errors = array();
if(!empty($_POST['submitted'])) {
    
    $identifiant = trim(strip_tags($_POST['identifiant']));
    $mdp = trim(strip_tags($_POST['mdp']));
    
    $sql = "SELECT * FROM blog_users WHERE pseudo = :identifiant OR email = :identifiant";
    $query = $pdo->prepare($sql);
    $query->bindValue(':identifiant', $identifiant, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

debug($user);
    if(!empty($user)) {
        if(password_verify($mdp, $user['password'])) {
            $_SESSION['user'] = array(
                'id' => $user['id'],
                'pseudo' => $user['pseudo'],
                'email' => $user['email'],
                'role' => $user['role'],
                'ip' => $_SERVER['REMOTE_ADDR'],
            );
            header('Location: index.php');
        } 
    else {
            $errors['mdp'] = 'Error';
        }
    } else {
        $errors['login'] = 'Error';
    } 
}

debug($errors);
include('inc/header.php');
?>

<div class="wrapform">
    <form action="" class="form" method="POST" novalidate>

        <label for="identifiant">Entrez votre identifiant</label>
        <input type="text" name="identifiant" id="identifiant" placeholder="Email ou pseudo" value="<?php getValueInput('identifiant'); ?>">

        <label for="mdp">Mot de passe</label>
        <input type="password" name="mdp" id="mdp">

        <input type="submit" name="submitted" value="Valider">

        <span><a href="forget-password.php">Mot de passe oublié ?</a></span>
    </form>
</div>






<?php
include('inc/footer.php');