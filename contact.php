<!DOCTYPE html>

<html lang="en">
    <head>
        <title>WSBF-FM Clemson | Philosophy</title>
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
                    <!-- LazyJaxDavis start -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="page-head">Contact Us!</h2>
                                <div id="in-page-content">
                                	<h3>Location</h3>
                                        <p>Our station is on the third floor of the Hendrix Center in the Student Media Suite.</p>
                                        <a href='https://www.google.com/maps/place/WSBF-FM+Clemson/@34.683814,-82.8164373,14z/data=!4m2!3m1!1s0x88585ddf54135d45:0x19458414f4a88df4'>
                                        <p>WSBF-FM Clemson<p>
                                        <p>315 Hendrix Center<p>
                                        <p>Clemson, SC 29634<p></a>

                                        <h3>Phone Line</h3>
                                        <p>On-Air DJ: (864) 656-9723<p>
                                        <p>General Manager: (864) 656-4009</p>
                                        <p>Music Director: (864) 656-4011</p>
                           	</div>
				<div>
                                    <form role="form">
                                        <div class="form-group">
                                            <label for="name">Name</label> <input type="text"
                                                                                  name="fromName" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Email</label> <input type="email"
                                                                                   name="fromEmail" class="form-control" id="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="subject">Subject</label> <input type="text"
                                                                                        name="subject" class="form-control" id="subject">
                                        </div>
                                        <div class="form-group">
                                            <label for="feedbacktype">Message category</label> <select
                                                name="feedbackType" class="form-control" id="feedbacktype">
                                                <option>Enhancement request</option>
                                                <option>Bug report</option>
                                                <option>Design/ease of use</option>
                                                <option>Efficiency/workflow</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="comment">Comment</label>
                                            <textarea name="comment" class="form-control" id="comment"
                                                      rows="4"></textarea>
                                        </div>
                                        <input type="submit" class="btn btn-primary"
                                               value="Submit feedback">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- LazyJaxDavis end -->
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
