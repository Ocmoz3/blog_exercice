<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(!empty($title)) {echo $title;} else {echo 'Blog';} ?></title>
    <link rel="stylesheet" href="./asset/css/style.css">
</head>
<body>
    
    <header id="header">

        <h3>Blog_exercice</h3  >

        <nav id="menu">
            <ul>
                <li class="accueil"><a href="index.php">Accueil</a></li>
                <?php if(isLogged()) { ?>
                    <li class="accueil"><a href="logout.php">Déconnexion</a></li>
                    <?php //if(isLoggedAdmin()) { ?>
                    <li class="accueil"><a href="admin/index.php"></a>Admin</li>
                    <?php //} ?>
                <?php } else { ?>
                <li class="accueil"><a href="register.php">Inscription</a></li>
                <li class="accueil"><a href="login.php">Connexion</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>