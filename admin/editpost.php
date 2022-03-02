<?php
require('../inc/pdo.php');
require('../inc/fonction.php');
require('../inc/request.php');

if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $article = getActeurById($id);
    if(empty($acteur)) { die('404'); }
} else {
    die('404');
}
