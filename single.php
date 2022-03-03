<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
debug($_SESSION);

$errors = array();

if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id=$_GET['id'];

    $sql = "SELECT b_a.id, b_a.title, b_a.content, b_a.created_at, b_a.modified_at, b_u.pseudo AS author
        FROM blog_articles AS b_a
        LEFT JOIN blog_users AS b_u
        ON b_a.user_id = b_u.id
        WHERE b_a.id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $article = $query->fetch();
    debug($article);

    if(empty($article)) {
        die('empty article');
    }

    if(!empty($_POST['submitted'])) {
        // if(isLogged()) {
        // die('entre dans cette condition');
            //formulaire visible
            //peut laisser un commentaire -> INSERT INTO
        //sinon
            //demande de connexion -> button = "Connectez-vous pour envoyer votre commentaire"
    

        $id_article = trim(strip_tags($article['id']));
        $content = trim(strip_tags($_POST['content']));
        $user_id = trim(strip_tags($_SESSION['user']['id']));
        $status = 'new';
        // debug($_POST);

        $errors = Validpseudo($errors,$content,'content',2,500);
        // die('errors ok');
        

        if(count($errors) === 0) {
            $sql = "INSERT INTO blog_comments (id_article, content, user_id, created_at, status) VALUES (:id_article, :content, :user_id, NOW(), '$status')";
            $query = $pdo->prepare($sql);
            // $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':id_article', $id_article, PDO::PARAM_INT);
            $query->bindValue(':content', $content, PDO::PARAM_STR);
            $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $query->execute();
            $last_id=$pdo->lastInsertId();
            // die('insertion ok');
        } else {
                // debug($errors);
            //     die('errors !');
                
        }
    }

        
} else {
    die('empty id');
}
debug($errors);
include('inc/header.php');
?>
<?php debug($errors); ?>
<div class="wrap_article">
    <div class="article_single">
        <h3><?= $article['title']; ?></h3>
        <p><?= $article['content']; ?></p>
        <p>Auteur : <?= $article['author']; ?></p>
        <div class="created_modified">
            <p><?= $article['created_at']; ?></p>
            <p><?php if(!empty($article['modified_at'])) { ?>
            Mis à jour le : <?= $article['modified_at']; ?>
        <?php } ?></p>
        </div>
    </div>
</div>


<?php if(isLogged()) { ?>
<form class="wrap_article" method="POST" novalidate>

    <label class="" for="content"><strong>Donnez votre avis :</strong></label>
    <textarea class="content" name="content" id="" cols="100" rows="5" value=""></textarea>
                <!-- Écrivez votre commentaire ici... -->

    <input class="comment_btn" type="submit" name="submitted">
    <span class="error">
        <?php //debug($errors) ?>
        <?php spanErrors($errors,'content') ?>
    </span>
    
    <!-- <span class="errors"><?php //validComment($errors,$_POST['content'],'content') ?></span> -->

    <!-- <span class="error"><?php //if(empty($content)) {
        //echo 'Veuillez entrer un commentaire';
    //} ?></span> -->

</form>
<?php } ?>



<?php
// debug($errors);


include('inc/footer.php');