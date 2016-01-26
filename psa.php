<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            /* Needed to load most recent blog posts */
            define('WP_USE_THEMES', false);
            require('./blog/wp-blog-header.php');
            
            require('./api/config/functions.php');
        ?>
        <title>WSBF-FM Clemson | Public Service Announcements</title>
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
                                                    <h2 class="page-head">Public Service Announcements</h2>
                                                <hr>
                                                <div id="in-page-content">
<p>Public service announcements are aired twice per hour as part of WSBF's service to Clemson University and the surrounding area. These announcements range from information about events and clubs at Clemson University to national health awareness, environmental conservation and other relevant issues to the Clemson University student body.</p>
<h3>Where should I submit my PSA?</h3>
<p>PSAs should be emailed to the music director at <a href="mailto:music@wsbf.net">music@wsbf.net</a>.</p>
<h3>When can I hear my PSA?</h3>
<p>Unfortunately, we cannot specify a time that you will be able to hear your PSA. It is up to the discretion of the DJs as to when to play PSAs and which PSAs to play. If you're interested in having your message broadcast on a regular schedule, please consider underwriting.</p>
<h3>Where should I submit my PSA?</h3>
<p>If you are submitting a PSA for a specific event, you should submit your PSA 3-4 weeks prior to the event. This gives us time to enter the PSA into our system as well as ample for it to get airplay. If you are emailing us the day or the week before the event, that may not be enough time to coordinate deploying the PSA and ensure that it gets played by DJs.</p>
<h3>How much does it cost to submit a PSA?</h3>
<p>Submitting a PSA costs nothing; however, if your PSA is promotional in nature, you may wish to consider purchasing underwriting here.</p>

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
