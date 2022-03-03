<?php
require('../inc/pdo.php');
require('../inc/fonction.php');
require('../inc/request.php');


$errors = array();
$success = false;
$lesStatus = array('publish', 'draft');

if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $article = getArticleById($id);
    if(empty($article)) { die('404'); }
} else {
    die('404');
}

if(!empty($_POST['submitted'])) {
    
    $title = trim(strip_tags($_POST['title']));
    $content = trim(strip_tags($_POST['content']));
    $status = trim(strip_tags($_POST['status']));


    $errors = Validpseudo($errors,$title,'title', 1, 255);
    $errors = Validpseudo($errors,$content,'content', 1, 65535);
    $errors = validationStatus($errors,$status,'status',$lesStatus);


    if(count($errors) === 0) {
        $sql = "UPDATE blog_articles SET title = :title, content = :content, status = :status, modified_at = NOW() WHERE id = $id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':title',$title, PDO::PARAM_STR);
        $query->bindValue(':content',$content, PDO::PARAM_STR);
        $query->bindValue(':status',$status, PDO::PARAM_STR);
        $query->execute();
        header('Location: index.php');
    }
}


include('inc/header.php'); ?>

<div class="wrapform">
    <section id="articles">
            <?php if($success) {
        echo '<p>Bravo</p>';
    } else { ?>

    <form class="form" action="" method="post">
        <label for="title">Titre</label>
        <input class= "input" type="text" name="title" id="title" value="<?php 
        if(!empty($_POST['title'])) {
            echo $_POST['title'];
        } elseif (!empty($article['title'])) { 
            echo $article['title'] ; 
        } ?>">
        <span class="error"><?php spanErrors($errors,'title'); ?></span>

        <label for="content">Contenu</label>
        <textarea name="content" id="content" value="<?php 
        if(!empty($_POST['content'])) {
            echo $_POST['content'];
        } elseif (!empty($article['content'])) { 
            echo $article['content'] ; 
        } ?>" cols="62" rows="10"></textarea>
        
        <span class="error"><?php spanErrors($errors,'content'); ?></span>

        <label for="status">Status</label>
            <select name="status" id="status">
                <?php foreach ($lesStatus as  $value) { ?>
                    <option value="<?php echo $value; ?>"<?php
                    if(!empty($_POST['status']) && $_POST['status'] === $value) {
                        echo ' selected';
                    }elseif (!empty($article['status'])) { if($article['status'] === $value) { echo ' selected';} }
                    ?>><?php echo ucfirst($value); ?></option>
                <?php } ?>
            </select>
        <span class="error"><?php if(!empty($errors['status'])) { echo $errors['status']; } ?></span>



        <input type="submit" name="submitted" value="Modifiez un article">

    </form>

    <?php } ?>

    </section>
</div>





<?php
include('inc/footer.php');