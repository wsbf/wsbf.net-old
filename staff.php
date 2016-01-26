<!DOCTYPE html>

<html lang="en">
    <head>
        <?php
		/*load most recent blog posts */
		define('WP_USE_THEMES', false);
		require('./blog/wp-blog-header.php');
		require('./api/config/functions.php');
	?>	
	<title>WSBF-FM Clemson | Staff</title>
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
                                  <h2 class="page-head">WSBF Staff</h2>
                                    <div id="in-page-content">
                                        <ul>
                                    	<li><h3>Chief Announcer</h3>
                                       	<p>Billy Moir  //  <a href="mailto:announcer@wsbf.net">announcer@wsbf.net</a></p></li>
                                        <li><h3>Chief Engineer</h3>
                                        <p>Matt Rana  //  <a href="mailto:chief@wsbf.net">chief@wsbf.net</a></p></li>
                                     	<li><h3>Computer Engineer</h3>
                                       	<p>Ben Shealy  //  <a href="mailto:computer@wsbf.net">computer@wsbf.net</a></p></li>
                                    	<li><h3>General Manager</h3>
                                       	<p>Morgan Kern  //  <a href="mailto:gm@wsbf.net">gm@wsbf.net</a></p></li>
                                    	<li><h3>Member At Large</h3>
                                       	<p>To Be Determined  //  <a href="mailto:member@wsbf.net">member@wsbf.net</a></p></li>
                                    	<li><h3>Music Director</h3>
                                       	<p>Chandler Pobis  //  <a href="mailto:music@wsbf.net">music@wsbf.net</a></p></li>
                                    	<li><h3>Production Director</h3>
                                        <p>Wesley Heaton  //  <a href="mailto:production@wsbf.net">production.wsbf.net</a></p></li>
                                    	<li><h3>Promotion Director</h3>
                                       	<p>Jessica Martin  //  <a href="mailto:promo@wsbf.net">promo@wsbf.net</a></p></li>
					<li><h3> Events Director </h3>
					<p>Sean Galgano // <a href="mailto:events@wsbf.net">events@wsbf.net</a></p></li>
                                    	<li><h3>Student Media Advisor</h3>
                                       	<p>Jackie Alexander  //  <a href="mailto:jalexa5@g.clemson.edu">jalexa5@g.clemson.edu</a></p></li>
                               		</ul>  
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

    </body>
</html>
