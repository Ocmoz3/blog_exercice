<?php

require('inc/pdo.php');
require('inc/fonction.php');

$errors = array();

if(!empty($_POST['submitted'])) {
    
    $pseudo = trim(strip_tags($_POST['pseudo']));
    $email = trim(strip_tags($_POST['email']));
    $password = trim(strip_tags($_POST['password']));
    $password_confirm = trim(strip_tags($_POST['password_confirm']));

    $errors = Validpseudo($errors, $pseudo, 'pseudo', 3, 140);
    if(empty($errors['pseudo'])) {
        $sql = "SELECT id FROM blog_users
            WHERE pseudo = :pseudo";
            $query = $pdo->prepare($sql);
            $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $query->execute();
            $pseudoExist = $query->fetch();
            if(!empty($pseudoExist)) {
                $errors['pseudo'] = 'Pseudo déjà pris';
            }
    }

    $errors = validEmail($errors, $email, 'email');
    if(empty($errors['email'])) {
        $sql = "SELECT id FROM blog_users
            WHERE email = :email";
            $query = $pdo->prepare($sql);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->execute();
            $emailExist = $query->fetch();
            if(!empty($emailExist)) {
                $errors['email'] = 'Email déjà existant';
            }
    }

    $errors = ValidPassword($errors, $password, 'password', 6, $password_confirm, 'password_confirm');

    if(count($errors) === 0) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        // die($passwordHash);

        $token = generateRandomString(70);
        // die($token);

        $role = 'Abonné';
        $sql = "INSERT INTO blog_users (pseudo, email, password, created_at, role, token) VALUES (:pseudo, :email, :password, NOW(), '$role', '$token')";
        $query = $pdo->prepare($sql);
        $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':password', $passwordHash, PDO::PARAM_STR);
        $query->execute();
        header('Location: login.php');
        //die('ok');
    }
}

debug($_POST);
debug($errors);





include('inc/header.php');
?>

<h2 class="titrePage">Inscription</h3>
<div class="wrapform">
    <form class="form" action="" method="POST" novalidate>
        <h3>Inscrivez-vous</h3>

        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" value="<?php getValueInput('pseudo'); ?>">
        <span class="error"><?php spanErrors($errors,'pseudo') ?></span>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?php getValueInput('email'); ?>">
        <span class="error"><?php spanErrors($errors,'email') ?></span>

        <label for="password">Mot de passe</label>
        <input type="password" name="password">
        <span class="error"><?php spanErrors($errors,'password') ?></span>

        <label for="password_confirm">Confirmez votre mot de passe</label>
        <input type="password" name="password_confirm">
        <span class="error">
            <?php spanErrors($errors,'password_confirm'); ?></span>

        <input type="submit" name="submitted" value="Inscription">

    </form>
</div>






<?php
include('inc/footer.php');