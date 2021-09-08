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
                <h3> Все статьи </h3>
            </div>
            <?
            $per_page = 6;
            $page = 1;
            $new_id = '';
            if (isset($_GET['page']))
            {
                $page = (int)$_GET['page'];
            }
            $total_count = mysqli_query($connection,"SELECT COUNT(id) AS 'total' FROM `articles`");
            $total_count = mysqli_fetch_assoc($total_count);
            $total_count = $total_count['total'];

            if ( $page <= 1 || $page > ceil($total_count/$per_page) )
            {
                $page = 1;
            }
            $offset = $per_page * ($page-1);
            if (isset($_GET['id']))
            {
                $new_id = $_GET['id'];
                $articles = mysqli_query($connection,"SELECT * FROM `articles` WHERE `categorie_id` =".(int)$_GET['id']."  ORDER BY id DESC LIMIT $offset,$per_page");
            }
            else {
                $articles = mysqli_query($connection,"SELECT * FROM `articles` ORDER BY id DESC LIMIT $offset,$per_page");
            }
            $articles_exist = mysqli_num_rows($articles) > 0;
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
            <?
            if ($articles_exist || $page> 1 )
            {
                echo "<div class='paginator' style='margin-top: 10px; font-weight: bold' >";
                    echo '<a href="articles.php?page='.($page - 1).'&id='.$new_id.'" style="margin-right: 20px">Прошлая страница</a>';
                if ($page <  ceil($total_count/$per_page))
                {
                    echo '<a href="articles.php?page='.($page + 1).'&id='.$new_id.'">Следущая страница</a>';
                }
                echo "</div>";
            }
            ?>
        </section>
    </div>
    <? include "./src/modules/sidebar.php"?>
</main>
<? include "./src/modules/footer.php"?>
</body>
</html>
