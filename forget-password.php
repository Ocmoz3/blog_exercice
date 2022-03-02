<?php 
require('inc/pdo.php');
require('inc/fonction.php');


$errors = array();

if(!empty($_POST['submitted'])) {

    $email = trim(strip_tags($_POST['email']));

    if(!empty($_POST['email'])) {
        // die('RRRRR');
        $sql = "SELECT * FROM blog_users WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();
        debug($user);
        if(!empty($user)) {
            // die('comprends pas');

            $urlBase = urlRemovelast( "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
            $href = $urlBase . '/modif-password.php?email=' . urlencode($email) . '&token=' . urlencode($user['token']);
            // echo '<a href="'.$href.'">Click ici tout en sachant qu\'il faut envoyer un mail pour que cela soit sécurisé</a>';
            // die();

            header('Location:'. $urlBase . '/modif-password.php?email=' . urlencode($email) . '&token=' . urlencode($user['token']));

            // header('Location: modif-password.php?email=' . $_POST['email'] . '&token=' . $user['token']);
        }
        else {
            echo 'Error !';
        }
    }
    
}
include('inc/header.php');

?>
<h2 class="titrePage">Mot de passe oublié</h3>
<div class="wrapform">
    <form class="form" action="" method="POST" novalidate>

        <label for="">Veuillez entrer votre email :</label>
        <input type="email" name="email" value="<?php getValueInput('email'); ?>">

        <input type="submit" name="submitted">

    </form>
</div>






<?php
debug($_GET);
include('inc/footer.php');