<div class="side-bar">
    <div class="grid-small">
        <section class="grid-small-card">
            <div class="socials">
                <ul>
                    <li><a target="_blank" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">Facebook</a></li>
                    <li><a target="_blank"href="https://github.com/P1aer">GitHub</a></li>
                    <li><a target="_blank" href="https://www.youtube.com/watch?v=Wl959QnD3lM">Twitter</a></li>
                </ul>
            </div>
        </section>
        <section class="grid-small-card">
            <h3 class="aside-head"> Топ недели</h3>
            <?
            $articles = mysqli_query($connection,"SELECT * FROM `articles` ORDER BY views DESC LIMIT 6")
            ?>
            <div class="aside-grid">
                <?
                while ($article = mysqli_fetch_assoc($articles))
                {?>
                    <article class="article">
                        <div class="article-head">
                            <a href="src/article.php?id=<?echo $article['id']?>"><h3><? echo $article['title']?></h3></a>
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
        <section class="grid-small-card">
            <h3 class="aside-head">Комментарии</h3>
            <?
            $comments = mysqli_query($connection,"SELECT * FROM `comments` ORDER BY pub_date DESC LIMIT 6")
            ?>
            <div class="aside-grid">
                <?
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
                            <span class="from"><? echo $art_cat['name'] ?></span>
                            <span class="time"><? echo $com['pub_date']?></span>
                        </div>
                        <div class="article-body">
                            <?echo mb_substr($com['text'],0,60,"utf-8")?>
                        </div>
                    </article>
                    <?
                }
                ?>
            </div>
        </section>
    </div>
</div>