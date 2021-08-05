<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHP Motor | CSE 340</title>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>
    </head>
    <body>
        <div id="site_container">
            <header>
                <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
                <nav id="page_nav">
                    <?php echo $navList; ?>
                </nav>
            </header>
            <main>
                <h1>Welcome to PHP Motors!</h1>
                <div id="biggerholygrail">
                    <section id="delorean">
                        <h4>DMC Delorean</h4>
                        <p>3 cup holders<br>Superman doors<br>Fuzzy dice!</p>
                        <img src="/phpmotors/images/vehicles/delorean.jpg" alt="Delorean Image">
                        <button>Own Today</button>
                    </section>
                    <div id="holygrail">
                        <section id="reviews">
                            <h2>DMC Delorean Reviews</h2>
                            <ul>
                                <li>"So fast it's almost like traveling in time." (4/5)</li>
                                <li>"Coolest ride on the road." (4/5)</li>
                                <li>"I'm feeling Marty McFly!" (5/5)</li>
                                <li>"The most futuristic ride of our day." (5/5)</li>
                                <li>"80's livin and I love it!" (5/5)</li>
                            </ul>
                        </section>
                        <section id="upgrades">
                            <h2>Delorean Upgrades</h2>
                            <div>
                                <a href="/" title="Flux Capacitor"><img src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux Capacitor">Flux Capacitor</a>
                                <a href="/" title="Flame Decals"><img src="/phpmotors/images/upgrades/flame.jpg" alt="Flame Decals">Flame Decals</a>
                                <a href="/" title="Bumper Stickers"><img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers">Bumper Stickers</a>
                                <a href="/" title="Hub Caps"><img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub Caps">Hub Caps</a>
                            </div>
                        </section>
                    </div>
                </div>
            </main>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
            </footer>
        </div>
    </body>
</html>