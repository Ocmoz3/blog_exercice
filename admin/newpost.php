<?php
// session_start();
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
    $status = trim(strip_tags($_POST['status']));


    $errors = Validpseudo($errors,$title,'title', 1, 255);
    $errors = Validpseudo($errors,$content,'content', 1, 65535);
    $errors = validationId_user($errors,$user_id,'user_id');
    $errors = validationStatus($errors,$status,'status',$lesStatus);

    if(count($errors) === 0) {
        $sql = "INSERT INTO blog_articles (title,content, user_id, created_at, status)
                VALUES (:title, :content, :user_id, NOW(), :status)";
        $query = $pdo->prepare($sql);
        $query->bindValue(':title',$title, PDO::PARAM_STR);
        $query->bindValue(':content',$content, PDO::PARAM_STR);
        $query->bindValue(':user_id',$user_id, PDO::PARAM_INT);
        $query->bindValue(':status',$status, PDO::PARAM_STR);
        $query->execute();
        header('Location: index.php');
    }

}



include('inc/header.php');
?>
<div class="wrapform">
    <section id="articles">
            <?php if($success) {
        echo '<p>Bravo</p>';
    } else { ?>
    <form class="form" action="" method="POST" novalidate>
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" value="<?php if(!empty($_POST['title']) ) { echo $_POST['title']; } ?>">
        <span class="error"><?php if(!empty($errors['title'])) {echo $errors['title']; } ?></span>

        <label for="content">Contenu</label>
        <input type="text" name="content" id="content" value="<?php if(!empty($_POST['content']) ) { echo $_POST['content']; } ?>">
        <span class="error"><?php if(!empty($errors['content'])) {echo $errors['content']; } ?></span>

        <label for="user_id">Auteur</label>
        <input type="number" name="user_id" id="user_id" value="<?php if(!empty($_POST['user_id']) ) { echo $_POST['user_id']; } ?>">
        <span class="error"><?php if(!empty($errors['user_id'])) {echo $errors['user_id']; } ?></span>

        <label for="status">Status</label>
            <select name="status" id="status">
                <?php foreach ($lesStatus as $value) { ?>
                    <option value="<?php echo $value; ?>"<?php
                    if(!empty($_POST['status']) && $_POST['status'] === $value) {
                        echo ' selected';
                    } elseif (!empty($status['status'])) { if($status['status'] === $value) { echo ' selected';} }
                    ?>><?php echo ucfirst($value); ?></option>
                <?php } ?>
            </select>
        <span class="error"><?php if(!empty($errors['status'])) { echo $errors['status']; } ?></span>

        <input type="submit" name="submitted" value="Envoyer">
    </form>
    <?php } ?>

    </section>
</div>








<?php
include('inc/footer.php');