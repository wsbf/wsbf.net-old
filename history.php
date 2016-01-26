<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            /* Needed to load most recent blog posts */
            define('WP_USE_THEMES', false);
            require('./blog/wp-blog-header.php');
            
            require('./api/config/functions.php');
        ?>
        <title>WSBF-FM Clemson | History</title>
        <script src="js/libs/pace/pace.min.js"></script>
        <?php include('views/fragments/styles.html'); ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="wrapper">
            <!-- LazyJaxDavis start -->
            <div class="page-wrapper">
                <section class="banner">
                    <?php include('views/fragments/nav_main.php'); ?>
                    <div class="header">
                        <div class="clearfix">
                            <div class="container slider-container">
                                <div class="row">
                                    <div>
                                        <div class="in-page col-md-8">
                                            <div class="col-md ">
                                                    <h2 class="page-head">History</h2>
                                                <hr>
                                                <div id="in-page-content">
                                                    <p>WSBF-FM began as a closed-circuit broadcasting facility on May 1, 1958 and made its first broadcast on April Fool’s Day of 1960. It quickly became known as “Wizz-Bif”. In the early days, WSBF broadcasted shows such as an agricultural show by Bob Mattison a.k.a. the “Voice of Clemson”, which was also broadcast on AM stations in Anderson, Spartanburg, and Columbia. Other shows included one broadcasted from Harcombe in the mornings, a “Late, Late” show featuring old standards, and a “Concert Hall” show featuring the classics. By 1965, WSBF had changed format to Include “The Frank Howard Show”, “Pigskin Preview”, “Night Beat”, and “East of Midnight”. The purpose was to provide students with educational entertain ment, news, and music.</p>

                                                    <p>The next major format change occurred under Woody Culp, changing to that of “progressive.” The strategy at that time was heavy airplay for the most contemporary new groups. Off-beat news stories and non-Top 40 music were emphasized.</p>

                                                    <p>The format evolved from “progressive” to “alternative,” a shift taking place in the mid- 1980s. The alternative format included many genres such as: progressive, classical, rap, jazz, punk, indus trial, and indie. The “alternative” name implies alternative in any genre, not just alternative rock (the worst- named genre of mainstream music ever; how can it be both alternative and mainstream?). It has devel oped into: “We educate the listener by exposing him or her to new genres and the leading edge of more familiar genres, such as rock. We play what other stations cannot and do not.”</p>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 ">
                                            <div class="grid2">
                                                <?php include('views/fragments/playlist.home.php'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content" id="lazyjaxdavisroot">
                    <div class="container">
                        <div class="row media">
                            <div class="col-md-4">
                                <div class="grid1">
                                    <?php include('views/fragments/schedule.home.php'); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="grid2">
                                    <?php include('views/fragments/chart.home.php'); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="grid3">
                                    <?php include('views/fragments/socialstream.home.php'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row blog">
                            <?php include('views/fragments/blogpreview.home.php'); ?>
                        </div>
                    </div>
                    
                </section>
                <section id="footer">
                    <div class="overlay clearfix">
                        <?php include('views/fragments/footer.home.php'); ?>
                    </div>
                </section>
            </div>
            <!-- LazyJaxDavis end -->
        </div>

        <?php include('views/fragments/mediawidget.php'); ?>

        <?php include('views/fragments/libraries.html'); ?>

        <?php include('views/fragments/page.dialog.html'); ?>
        <!-- Button trigger modal -->

    </body>
</html>