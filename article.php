<?php
require "./src/modules/config.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><? echo $config['title']?></title>
    <link rel="stylesheet" href="src/index.css" >
</head>
<body>
<? include "./src/modules/header.php" ?>
<main class="wrapper">
    <div class="grid-big">
    <?
        $article = mysqli_query($connection, "SELECT * FROM `articles` WHERE `id` =". (int)$_GET['id']);
        if (mysqli_num_rows($article) <= 0)
        {
            ?>
    <section class="grid-big-card">
        <div class="card-head">
            <h3> Статья не найдена</h3>
        </div>
        <div class="text-card-content">
            <article class="text-article">
                <div class="text-article-content">
                    К сожалению, данной статьи не существует
                </div>
            </article>
        </div>
    </section>
    <?
        }
        else
        {
            $article = mysqli_fetch_assoc($article);
            mysqli_query($connection,'UPDATE `articles` SET `views` = `views` + 1 WHERE `id`='.(int)$_GET['id'])
            ?>
        <section class="grid-big-card">
            <div class="card-head">
                <h3> <? echo $article['title']?></h3>
                <h4><span><? echo $article['views']?> просмотров</span></h4>
            </div>
            <div class="text-card-content">
                <article class="text-article">
                    <div class="text-article-content">
                        <? echo $article['text']?>
                    </div>
                </article>
            </div>
        </section>
        <?
        }
    ?>
        <?
        if( isset($_POST['do_post']))
        {
            header("Location: /article.php?id=".(int) $_GET['id']);
            mysqli_query($connection,"INSERT INTO `comments` (`author`,`text`,`article_id`) VALUES ('".$_POST['name']."','".$_POST['text']."','".$article['id']."')");
        }
        ?>
        <section class="grid-big-card">
            <div class="card-head">
                <h3> Комментарии к статье</h3>
                <a href="#comments"><span>Написать отзыв</span></a>
            </div>
            <div class="comments-card-content">
                <?
                $comments = mysqli_query($connection,"SELECT * FROM `comments` WHERE `article_id`=".(int)$_GET['id']." ORDER BY pub_date DESC LIMIT 6");
                if (mysqli_num_rows($comments) <= 0)
                {
                    echo "Нет комментариев";
                }
                else {
                     while ($com = mysqli_fetch_assoc($comments))
                    {?>
                        <article class="aside-comment">
                            <div class="comment-head">
                                <h4 class="name"><? echo $com['author']?></h4>
                                <?
                                $art_cat = false;
                                foreach ($categories as $cat)
                                {
                                    if($cat['id'] == $article['categorie_id'])
                                    {
                                        $art_cat = $cat;
                                        break;
                                    }
                                }
                                ?>
                                <span class="from"><? echo $art_cat['name'] ?></span><br>
                                <span class="time"><? echo $com['pub_date']?></span>
                            </div>
                            <div class="article-body">
                                <?echo $com['text']?>
                            </div>
                        </article>
                        <?
                    }
                }   ?>

            </div>
        </section>
        <form id="comments" class="comment-form" method="post"#comments>
            <div class="card-head">
                <h3> Добавить комментарий </h3>
            </div>
            <div class="form-content">
                <input type="text" class="form-name" name="name" required placeholder="Имя" minlength="5">
                <textarea placeholder="Текст комментария" required name="text" class="form-text" minlength="6"></textarea>
            </div>
            <div class="form-footer">
                <button class="form-submit" name="do_post">Добавить комментарий</button>
            </div>
        </form>
    </div>
    <? include "./src/modules/sidebar.php" ?>
</main>
<? include "./src/modules/footer.php" ?>

</body>
</html>