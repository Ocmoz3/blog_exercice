<?php
session_start();
require('../inc/pdo.php');
require('../inc/fonction.php');
require('../inc/request.php');
debug($_SESSION);
$sql = "SELECT b_a.id, b_a.title, b_a.created_at, b_a.status, b_u.pseudo AS author
        FROM blog_articles AS b_a
        LEFT JOIN blog_users AS b_u
        ON b_a.user_id = b_u.id";
        //ORDER BY created_at DESC
$query = $pdo->prepare($sql);
$query->execute();
$articles = $query->fetchAll();

// Pagination
// nbre de reves par page
$numPerPage = 3;
// page current par default
$page = 1;
if(!empty($_GET['page'])) {
    $page = $_GET['page'];
}
$offset = $page * $numPerPage - $numPerPage;

$sql = "SELECT * FROM blog_articles ORDER BY created_at DESC LIMIT $numPerPage OFFSET $offset";
$query = $pdo->prepare($sql);
$query->execute();
$articles = $query->fetchAll();

$sql = "SELECT COUNT(id) FROM blog_articles";
$query = $pdo->prepare($sql);
$query->execute();
$count = $query->fetchColumn();



include('inc/header.php');
?>

<div class="wrap">
    <nav id="menu">
        <ul>
            <li><a href="./newpost.php">Ecrire un article</a></li>
        </ul>
    </nav>
</div>

<h1 class="titrePage">Articles</h1>

<div class="wrap">
    <p>Nombre total d'articles : <?= $count; ?></p>
    <?php pagination($page,$numPerPage,$count); ?>
    <section id="articles">
        <?php foreach ($articles as $article) { ?>
            <div class="pagin" id="ancre-<?= $article['id']; ?>">
                <div class="wrap_article">
                <h3 class="article_title"><a href="single.php?id=<?= $article['id']; ?>"><?= $article['title']; ?></a></h3>
                <p class="author">Auteur : <?= $article['user_id']; ?></p>
                <p class="created"><?php echo formatDate($article['created_at']); ?></p>
                </div>
            </div>
        <?php } ?>
    </section>
    <?php pagination($page,$numPerPage,$count); ?>
</div>









<?php
include('inc/footer.php');