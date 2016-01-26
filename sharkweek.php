<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            /* Needed to load most recent blog posts */
            define('WP_USE_THEMES', false);
            require('./blog/wp-blog-header.php');
            
            require('./api/config/functions.php');
        ?>
        <title>WSBF-FM Clemson | SHARK WEEK</title>
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
                                                    <h2 class="page-head">SHARK WEEK</h2>
                                                <hr>
                                                <div id="in-page-content">
                                                    <img src = 'images/sharkweekminischeds.jpg' alt = ' '>
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
