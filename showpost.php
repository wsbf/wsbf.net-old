<!DOCTYPE html>

<html lang="en">
    <head>
        <?php 
            /* Short and sweet */
            define('WP_USE_THEMES', false);
            require('./blog/wp-blog-header.php');
            
            $post_id = NULL;
            if(isset($_GET['p'])){
                $post_id = $_GET['p'];
            }
            setup_postdata(get_post());
            ?>
        <title>WSBF-FM Clemson | <?php the_title();?></title>
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
                </section>
                <section class="content" id="lazyjaxdavisroot">
                   
                    <div class="container" id="blog">
                        <div class="row">
                            <div class="col-md header-post">
                                <h1><?php the_title();?></h1>
                                <div class="social-share">
                                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                        <div class="addthis_sharing_toolbox"></div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="row">
                            <hr>
                            <div class="col-md">
                                <ul class="postinfo">
                                    <li><?php the_date('j F')?></li>
                                    <li>By <strong><?php the_author(); ?></strong></li>
                                    <li class="categories">In <strong><?php echo get_the_category_list(", "); ?></strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row blog-main">
                            <div class="col-md">
                                <?php the_content(); ?>
                            </div>
                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <div class="pull-left" style="margin-right:20px;">Share this article: </div> <div class="addthis_sharing_toolbox"></div>
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

    </body>
</html>