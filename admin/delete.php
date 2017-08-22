<?php

session_start();

require_once ('../includes/connection.php');
require_once ('../includes/article_fetch.php');

$article = new Article;

if(isset($_SESSION['logged_in'])) {
    if (isset($_GET['id'])){
        $id = $_GET['id'];

        $query = $pdo->prepare('DELETE FROM articles WHERE article_id = ?');
        $query->bindValue(1, $id);
        $query->execute();

        header('Location: index.php');

    }
}
