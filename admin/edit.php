<?php

session_start();

require_once ('../includes/connection.php');
require_once ('../includes/article_fetch.php');

$article = new Article;
$articles = $article->fetch_all();

if(isset($_SESSION['logged_in'])) {

    if (isset($_POST['id'])) {
        $query = $pdo->prepare("UPDATE articles SET article_title = ?, article_content = ? WHERE article_id = ?");
        $query->bindValue(1, $_POST['title']);
        $query->bindValue(2, $_POST['content']);
        $query->bindValue(3, $_POST['id']);
        $query->execute();

        header('Location: index.php');

    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = $article->fetch_data($id);

        ?>

        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>CMS</title>
                <link rel="stylesheet" href="../assets/style.css"
            </head>
            <body>
            <div class="container">
                <a href="../index.php" id="home">Home</a>

                <br /><br />

                <form method="post" action="edit.php">
                    <input name="id" type="hidden" value="<?=$data['article_id']?>"/>
                    <input name="title" type="text" value="<?=$data['article_title']?>"  size="40"/>
                    <textarea name="content" style="width:100%;height:300px;"><?=$data['article_content']?></textarea>
                    <input type="submit" name="edit" value="Edit">
                    <input type="reset" name="reset" value="Reset">
                </form>

                <a href="index.php">&larr; Back</a>
            </div>
            </body>
        </html>
        <?php
    }
} else {
    header('Location: index.php');
}
