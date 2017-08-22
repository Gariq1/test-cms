<?php

require_once('includes/connection.php');
require_once('includes/article_fetch.php');

$article = new Article;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $article->fetch_data($id);

    ?>

    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>CMS</title>
            <link rel="stylesheet" href="assets/style.css"
        </head>
        <body>
            <div class="container">
                <a href="index.php" id="home">Home</a>

                <h4>
                    <?php echo $data['article_title'];?> -

                    <small>
                        posted <?php echo date ('d m Y', $data['article_timestamp']); ?>
                    </small>
                </h4>

                <p><?php echo $data['article_content'];?></p>

                <a href="index.php">&larr; Back</a>
            </div>
        </body>
    </html>

    <?php
} else {
    header('Location: index.php');
    extit();
}
