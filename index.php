<?php

require_once('includes/connection.php');
require_once('includes/article_fetch.php');

$article = new Article;
$articles = $article->fetch_all();

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

            <ul>
                <?php foreach ($articles as $article) { ?>
                    <li>
                        <a href="article_view.php?id=<?php echo $article['article_id'];?>">
                            <?php echo $article['article_title']; ?>
                        </a>
                        - <small>
                            posted <?php echo date('d m Y', $article['article_timestamp']); ?>
                        </small></li>
                <?php } ?>
            </ul>

            <br/>
            <small><a href="admin">admin</a></small>

        </div>
    </body>
</html>