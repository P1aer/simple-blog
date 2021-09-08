<header>
    <div class="header-container">
        <div class="upper-part wrapper">
            <div class="logo">
                <h1><? echo $config['title']?></h1>
            </div>
            <div class="about">
                <ul>
                    <li class="about-elem"><a href="/">Главная</a></li>
                    <li class="about-elem"><a target="_blank" href=<? echo $config['meme_url']?>>???</a></li>
                </ul>
            </div>
        </div>
        <?
        $categories = mysqli_query($connection,"SELECT CONCAT( UPPER( LEFT( `article_name` , 1 ) ) , LOWER ( SUBSTRING( `article_name` , 2) ) ) AS `name`,id FROM `article_categories`")
        ?>
        <nav class="header-nav">
            <ul class="nav-list">
                <?
                    while ($cat = mysqli_fetch_assoc($categories))
                    {
                        ?>
                <li class="nav-element"><a href="/articles.php?id=<? echo $cat['id']?>"><? echo $cat['name'] ?></a></li>
                <?
                    }
                ?>
            </ul>
        </nav>
    </div>
</header>
