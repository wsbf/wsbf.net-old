<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            /* Needed to load most recent blog posts */
            define('WP_USE_THEMES', false);
            require('./blog/wp-blog-header.php');
            
            require('./api/config/functions.php');
        ?>
        <title>WSBF-FM Clemson | Underwriting</title>
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
                                                    <h2 class="page-head">WSBF Underwriting Rates</h2>
                                                <hr>
                                                <div id="in-page-content">
<p>Underwriting is an FCC-approved form of sponsorship for broadcasting which is undertaken by non-commercial, educational FM radio stations, such as WSBF-FM. This sponsorship allows an underwriter to contribute resources to be utilized by the station for support of broadcast activities. In return, the radio station is able to provide name recognition and acknowledgement of the underwriter’s contributions and sponsorship.</p> 
<p>The following rates apply to an underwriting that is 30 seconds in length, which can include the name of the underwriter, a non-qualitative description of the service or products they provide, their location, their website, their contact information, and a company slogan. In order to include a slogan, it must be one that has consistently been used in identifying the company, it cannot contain qualitative language (such as "Always Low Prices"), and it cannot contain a call to action (such as "Come fly with us"). </p>

<h3>Semester: </h3>
<ul>
    <li><p>(Aug 22 - Dec 7, 2012) or (Jan 9 – April Semester: 26, 2013) </p></li>
    <li><p>$1300 once per show. </p></li>
    <li><p>$2400 twice per show. </p></li>
</ul>
<h3>School Year: </h3>
    <ul>
        <li><p>(Aug 22, 2012 - April 26, 2013)</p></li>
        <li><p>$2300 once per show. </p></li>
        <li><p>$4200 twice per show. </p></li>
    </ul>
<h3>Year: </h3>
    <ul>
        <li><p>(ex. Aug 22, 2012 - Aug 22, 2013) </p></li>
        <li><p>$2600 once per show. </p></li>
        <li><p>$4600 twice per show. </p></li>
    </ul>
<h3>Month: </h3>
    <ul>
        <li><p>(ex. Sep 1 - Sep 30)</p></li>
        <li><p>$350 once per show. </p></li>
        <li><p>$650 twice per show. </p></li>
    </ul>
<h3>Two Weeks: </h3>
    <ul>
        <li><p>(ex. Aug 25 - Sep 7) </p></li>
        <li><p>$200 once per show. </p></li>
        <li><p>$375 twice per show. </p></li>
    </ul>
<h3>Per Show: </h3>
    <ul>
        <li><p><strong>Prime Time</strong> (M-F 5-7pm, 7-9pm, or 9-11pm) </p></li>
        <li><p>$10 once per two hour show. </p></li>
        <li><p>$18 twice per two hour show. </p></li>
    </ul><ul>
        <li><p><strong>Morning Drive </strong>(M-F 7-9am, 9-11am) </p></li>
        <li><p>$8 once per two hour show. </p></li>
        <li><p>$15 twice per two hour show. </p></li>
    </ul><ul>
        <li><p><strong>Other Shows</strong></p></li>
        <li><p>$5 once per show. </p></li>
        <li><p>$10 twice per show. </p></li>
    </ul>
<p>For specialty rates, (ex. One month of just prime time) please inquire with specific duration and play period. </p>
<p>To contact our General Manager, email <a href="mailto:gm@wsbf.net">gm@wsbf.net</a> or call 864-656-4009</p>

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
