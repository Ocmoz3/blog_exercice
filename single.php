<?php
require('inc/pdo.php');
require('inc/fonction.php');

if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id=$_GET['id'];

    $sql = "SELECT b_a.id, b_a.title, b_a.content, b_a.created_at, b_a.modified_at, b_u.pseudo AS author
        FROM blog_articles AS b_a
        LEFT JOIN blog_users AS b_u
        ON b_a.user_id = b_u.id
        WHERE b_a.id = :id";
        //ORDER BY created_at DESC
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $article = $query->fetch();
    debug($article);
    if(empty($article)) {
        die('404');
    }
} else {
    die('404');
}


include('inc/header.php');
?>
<div class="wrap_article">
    <div class="acteur-border">
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

<form class="wrap_article">

    <label for="comment"><strong>Donnez votre avis :</strong></label>
    <textarea class="comment_txt" name="comment" id="" cols="100" rows="5" value="">Écrivez votre commentaire ici...</textarea>
    <input class="comment_btn" type="submit" name="submitted">

</form>



<?php
include('inc/footer.php');