<?php
 require "src/modules/config.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><? echo $config['title']?></title>
    <link rel="stylesheet" href="./src/index.css" >
</head>
<body>
<? include "./src/modules/header.php"?>
<main class="wrapper">
    <div class="grid-big">
        <section class="grid-big-card">
            <div class="card-head">
                <h3> Новинки </h3>
                <a href="/articles.php"><span>Все записи</span></a>
            </div>
            <?
            $articles = mysqli_query($connection,"SELECT * FROM `articles` ORDER BY id DESC LIMIT 6")
            ?>
            <div class="card-content">
                <?
                while ($article = mysqli_fetch_assoc($articles))
                {?>
                    <article class="article">
                        <div class="article-head">
                            <a href="article.php?id=<?echo $article['id']?>"><h3><? echo $article['title']?></h3></a>
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
                            <span>Категория:
                                <a href="/articles.php?id=<? echo $art_cat['id']?>">
                                    <? echo $art_cat['name']?>
                                </a>
                            </span>
                        </div>
                        <div class="article-content">
                            <? echo  mb_substr($article['text'],0,100,"utf-8")?>...
                        </div>
                    </article>
                    <?
                }
                ?>
            </div>
        </section>
        <section class="grid-big-card">
            <div class="card-head">
                <h3> Gaming </h3>
                <a href="/articles.php?id?=1"><span>Все записи</span></a>
            </div>
            <?
            $articles = mysqli_query($connection,"SELECT * FROM `articles` WHERE categorie_id = 1 ORDER BY id DESC LIMIT 6")
            ?>
            <div class="card-content">
                <?
                while ($article = mysqli_fetch_assoc($articles))
                {?>
                <article class="article">
                    <div class="article-head">
                        <a href="article.php?id=<?echo $article['id']?>"><h3><? echo $article['title']?></h3></a>
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
                        <span>Категория:
                                <a href="/articles.php?id=<? echo $art_cat['id']?>">
                                    <? echo $art_cat['name']?>
                                </a>
                            </span>
                    </div>
                    <div class="article-content">
                        <? echo  mb_substr($article['text'],0,100,"utf-8")?>...
                    </div>
                </article>
                <?
                }
                ?>
            </div>
        </section>
        <section class="grid-big-card">
            <div class="card-head">
                <h3> Music </h3>
                <a href="/articles.php?id=3"><span>Все записи</span></a>
            </div>
            <?
            $articles = mysqli_query($connection,"SELECT * FROM `articles` WHERE categorie_id = 3 ORDER BY id DESC LIMIT 6")
            ?>
            <div class="card-content">
                <?
                while ($article = mysqli_fetch_assoc($articles))
                {?>
                    <article class="article">
                        <div class="article-head">
                            <a href="article.php?id=<?echo $article['id']?>"><h3><? echo $article['title']?></h3></a>
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
                            <span>Категория:
                                <a href="/articles.php?id=<? echo $art_cat['id']?>">
                                    <? echo $art_cat['name']?>
                                </a>
                            </span>
                        </div>
                        <div class="article-content">
                            <? echo  mb_substr($article['text'],0,100,"utf-8")?>...
                        </div>
                    </article>
                    <?
                }
                ?>
            </div>
        </section>
    </div>
    <? include "./src/modules/sidebar.php"?>
</main>
<? include "./src/modules/footer.php"?>
</body>
</html>