<?php

function getArticleById($id)
{
    global $pdo;
    $sql = "SELECT * FROM article WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}