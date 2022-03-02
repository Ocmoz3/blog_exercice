<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');

$sql = "SELECT b_a.id, b_a.title, b_a.created_at,  FROM blog_articles AS b_a ORDER BY created_at DESC";
$query = $pdo->prepare($sql);
$query->execute();
$articles = $query->fetchAll();
// debug($articles);
// debug($_SESSION);


include('inc/header.php');
?>

<h1 class="titrePage">Articles</h1>

<section>
        <?php 
            foreach ($articles as $article) {
                debug($article); 
                if($article['status'] === 'publish') { ?>
                <div class="wrap_article">
                    <h3 class="article_title"><?= $article['title']; ?></h3>
                    <p class="article_content"><?= $article['content']; ?></p>
                    <p class="created"><?php echo formatDate($article['created_at']); ?></p>
                </div>
        <?php }
        } ?>
    </section>





<?php
include('inc/footer.php');