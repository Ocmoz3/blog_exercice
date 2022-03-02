<?php
require('../inc/pdo.php');
require('../inc/fonction.php');
require('../inc/request.php');



$errors = array();
$success = false;
$lesStatus = array('publish', 'draft');

if(!empty($_POST['submitted'])) {
    
    $title = trim(strip_tags($_POST['title']));
    $content = trim(strip_tags($_POST['content']));
    $user_id = trim(strip_tags($_POST['user_id']));
    $user_id = trim(strip_tags($_POST['status']));


    $errors = Validpseudo($errors,$title,'title', 1, 255);
    $errors = Validpseudo($errors,$content,'content', 1, 65535);
    $errors = validationId_user($errors,$user_id,'user_id');
    $errors = validationStatus($errors,$status,'status',$lesStatus);

    
    if(count($errors) === 0) {
        $sql = "UPDATE article SET title = :title, content = :content, status = :status, modified_at = NOW() WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':title',$title, PDO::PARAM_STR);
        $query->bindValue(':content',$content, PDO::PARAM_STR);
        $query->bindValue(':id',$id, PDO::PARAM_INT);
        $query->execute();
        header('Location: index.php');
    }
}

include('inc/header.php'); ?>

<div class="wrap">
    <section id="articles">
            <?php if($success) {
        echo '<p>Bravo</p>';
    } else { ?>

    <form class="wrapform" action="" method="post" novalidate>
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" value="<?php 
        if(!empty($_POST['title'])) {
            echo $_POST['title'];
        } elseif (!empty($article['title'])) { 
            echo $article['title'] ; 
        } ?>">
        <span class="error"><?php spanErrors($errors,'title'); ?></span>

        <label for="content">Contenu</label>
        <input type="text" name="content" id="content" value="<?php 
        if(!empty($_POST['content'])) {
            echo $_POST['content'];
        } elseif (!empty($article['content'])) { 
            echo $article['content'] ; 
        } ?>">
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