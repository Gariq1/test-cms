<?php

session_start();

require_once ('../includes/connection.php');
require_once ('../includes/article_fetch.php');

$article = new Article;
$articles = $article->fetch_all();

if (isset($_SESSION['logged_in'])) {
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

                <h4><a href="add.php"> + Add new article</a></h4>

                <ul>
                    <?php foreach ($articles as $article) { ?>
                        <li>
                            <a href="edit.php?id=<?php echo $article['article_id'];?>">
                                <?php echo $article['article_title']; ?> [edit]
                            </a>

                            - <small>
                                posted <?php echo date('d m Y', $article['article_timestamp']); ?>
                            </small>

                            <a href="delete.php?id=<?php echo $article['article_id'];?>">
                                <span id="delete">Delete</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>

                <a href="logout.php">Logout</a>

            </div>
        </body>
    </html>

    <?php
} else {
    if (isset($_POST['username'], $_POST['password'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        if (empty($username) or empty($password)){
            $error = 'All fields are required!';
        } else {
            $query = $pdo->prepare('SELECT * FROM users WHERE user_name = ? AND  user_password = ?');
            $query->bindValue(1, $username);
            $query->bindValue(2, $password);

            $query->execute();

            $num = $query->rowCount();

            if ($num == 1) {
                $_SESSION['logged_in'] = true;
                header('Location: index.php');
                exit();

            } else {
                $error = 'Incorrect details.';
            }

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

                <br /><br />

                <?php if (isset($error)) { ?>
                    <small style="color:#aa0000;"><?php echo $error; ?></small>
                    <br /><br />
                <?php } ?>

                <form action="index.php" method="post">
                    <input type="text" name="username" placeholder="Username" />
                    <input type="password" name="password" placeholder="Password" />
                    <input type="submit" value="Login" />
                </form>
            </div>
        </body>
    </html>

    <?php
}
