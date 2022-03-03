<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(!empty($title)) {echo $title;} else {echo 'Blog';} ?></title>
    <link rel="stylesheet" href="./asset/css/style.css">
</head>
<?php


$errors2 = array();
$success = false;


if(!empty($_POST['submitted'])) {
    
    $search = trim(strip_tags($_POST['search']));

    $errors2 = Validpseudo($errors,$search,'search', 1, 255);

    if(count($errors2) === 0) {
        $sql = "INSERT INTO blog_articles (title,content, user_id, created_at, status)
                VALUES (:title, :content, :user_id, NOW(), :status)";
        $query = $pdo->prepare($sql);
        $query->bindValue(':search',$search, PDO::PARAM_STR);
        
        $query->execute();
        header('Location: index.php');
    }

    if(!empty($search)) {
        $urlBase = urlRemovelast( "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        $href = $urlBase . urlencode($search);
        echo 'Bravo';
        die();

    } else {
        $errors2['mail'] = 'error credentials';
    }

}
?>
<body>
    
    <header id="header">

        <h3>Blog_exercice</h3  >

        <nav id="menu">
            <ul>
                <li class="accueil"><a href="index.php">Accueil</a></li>
                <?php if(isLogged()) { ?>
                    <li class="accueil"><a href="logout.php">Déconnexion</a></li>
                    <?php if(isLoggedAdmin()) { ?>
                    <li class="accueil"><a href="admin/index.php">Admin</a></li>
                    <?php } ?>
                <?php } else { ?>
                <li class="accueil"><a href="register.php">Inscription</a></li>
                <li class="accueil"><a href="login.php">Connexion</a></li>
                <?php } ?>
            </ul>
        </nav>
        <?php
        debug($_SESSION); ?>
        
        <div id="search">
            <?php if($success) {
            echo '<p>Bravo</p>';
            } else { ?>
            <form class="search" action="" method="POST" novalidate>
                <!-- <label for="search">Recherche</label> -->
                <input type="text" name="search" id="search" value="<?php if(!empty($_POST['search']) ) { echo $_POST['search']; } ?>">
                <span class="error"><?php if(!empty($errors2['search'])) {echo $errors2['search']; } ?></span>

                <input type="submit" name="submitted" value="Rechercher">
            </form>
            <?php } ?>

        </div>
    </header>