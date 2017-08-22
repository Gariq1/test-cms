<?php

session_start();

require_once ('../includes/connection.php');

if (isset($_SESSION['logged_in'])) {
    if (isset($_POST['title'], $_POST['content'])){
        $title = $_POST['title'];
        $content = nl2br($_POST['content']);

        if (empty($title) or empty ($content)) {
            $error = 'All fields are required!';
        } else {
            $query = $pdo->prepare('INSERT INTO articles (article_title, article_content, article_timestamp) VALUES (?, ?, ?)');

            $query->bindValue(1, $title);
            $query->bindValue(2, $content);
            $query->bindValue(3, time());

            $query->execute();

            header('Location: index.php');
        }
    }
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

                <br />

                <h4>Add new article</h4>

                <?php if (isset($error)) { ?>
                    <small style="color:#aa0000;"><?php echo $error; ?></small>
                    <br /><br />
                <?php } ?>

                <form action="add.php" method="post" autocomplete="off">
                    <input type="text" name="title" placeholder="Title" /> <br /><br />
                    <textarea rows="15" cols="50" placeholder="Content" name="content"></textarea><br /><br />
                    <input type="submit" value="Add" />
                </form>
                <a href="index.php">&larr; Back</a>
            </div>
        </body>
    </html>

    <?php

} else {
    header('Location: index.php');
}
