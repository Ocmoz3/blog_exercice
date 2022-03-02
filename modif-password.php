<?php

require('inc/fonction.php');
require('inc/pdo.php');
$errors= array();

if(!empty($_GET['email']) && !empty($_GET['token'])) {
    $email = urldecode($_GET['email']);
    $token = urldecode($_GET['token']);

    $sql = "SELECT * FROM blog_users WHERE email = :email AND token = :token";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':token', $token, PDO::PARAM_STR);
    $query-> execute();
    $user = $query->fetch();
    debug($user);
    if(empty($user)) {
        header('Location: index.php');
    }
} 
else {
    header('Location: index.php');
}


if(!empty($_POST['submitted'])) {
    
    $password = trim(strip_tags($_POST['password']));
    $password_confirm = trim(strip_tags($_POST['password_confirm']));


    $errors = ValidPassword($errors,$password,'password', 6, $password_confirm,'password_confirm');

    if(count($errors) === 0) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        // die($passwordHash);
        $token = generateRandomString(70);
        // die($token);
        $sql = "UPDATE blog_users SET password = :passwordHash, token = :token WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':passwordHash', $passwordHash, PDO::PARAM_STR);
        $query->bindValue(':token', $token, PDO::PARAM_STR);
        $query->bindValue(':id', $user['id'], PDO::PARAM_INT);
        $query->execute();
        
        header('Location: login.php');
    }
}

include('inc/header.php');
?>

<h2 class="titrePage">Modifiez votre mot de passe</h3>
<div class="wrapform">
    <form class="form" action="" method="POST" novalidate>

        <label for="password">Veuillez entrer votre nouveau mot de passe :</label>
        <input type="password" name="password">
        <span class="error"><?php spanErrors($errors,'password'); ?></span>

        <label for="password_confirm">Veuillez confirmer votre nouveau mot de passe :</label>
        <input type="password" name="password_confirm">
        <span class="error"><?php spanErrors($errors,'password_confirm'); ?></span>


        <input type="submit" name="submitted">

    </form>
</div>


<?php debug($errors); ?>


<?php

include('inc/footer.php');