<?php
// session_start();
require('../inc/pdo.php');
require('../inc/fonction.php');
require('../inc/request.php');



include('inc/header.php');
?>

<div class="wrap">
    <nav id="menu">
        <ul>
            <li><a href="./newpost.php">Ecrire un article</a></li>
            <li><a href="./editpost.php">Modifier un article</a></li>
        </ul>
    </nav>
</div>









<?php
include('inc/footer.php');