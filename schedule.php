<!DOCTYPE html>

<html lang="en">
    <head>
        <title>WSBF-FM Clemson | Schedule</title>
        <?php include('views/fragments/styles.html'); ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="wrapper">
            
            <div class="page-wrapper">
                <section class="banner">
                    <?php include('views/fragments/nav_main.php'); ?>
                </section>
                <section class="content" id="lazyjaxdavisroot">
                    <!-- DO NOT DELETE THE FOLLOWING COMMENT!!! Website needs it to ajaxify pages -->
                    <!-- LazyJaxDavis start -->
                    <div class="container" id="schedule">
                        <div class="row">
                            <div class="col-md">
                                <h2 class="page-head">Schedule</h2>

                                <div class="row">
                                    <div class="col-md">
                                        <ul class="this-week">
                                            <li><h4>This Week</h4></li>
                                            <li><a id="1" class="apply-nolazy" href="#">MON</a></li>
                                            <li><a id="2" class="apply-nolazy" href="#">TUE</a></li>
                                            <li><a id="3" class="apply-nolazy" href="#">WED</a></li>
                                            <li><a id="4" class="apply-nolazy" href="#">THU</a></li>
                                            <li><a id="5" class="apply-nolazy" href="#">FRI</a></li>
                                            <li><a id="6" class="apply-nolazy" href="#">SAT</a></li>
                                            <li><a id="0" class="apply-nolazy" href="#">SUN</a></li>
                                        </ul>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md programs">
                                        <h4 class="date_header"></h4>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- LazyJaxDavis end -->
                    <!-- DO NOT DELETE THE FOLLOWING COMMENT!!! Website needs it to ajaxify pages -->
                </section>
                <section id="footer">
                    <div class="overlay clearfix">
                        <?php include('views/fragments/footer.home.php'); ?>
                    </div>
                </section>
            </div>
        </div>

        <?php include('views/fragments/mediawidget.php'); ?>
        <?php include('views/fragments/page.dialog.html'); ?>
        <?php include('views/fragments/libraries.html'); ?>

    </body>
</html>