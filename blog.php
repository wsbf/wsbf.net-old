<!DOCTYPE html>

<html lang="en">
    <head>
        <?php 
            /* Short and sweet */
            define('WP_USE_THEMES', false);
            require('./blog/wp-blog-header.php');
            
            require('./api/config/functions.php');
            ?>
        <title>WSBF-FM Clemson | Blog</title>
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
                    <div class="header" style="display:none;">
                        <!-- header start -->
                        <div class="clearfix">
                            <div class="container slider-container">
                                <div class="row">
                                    <div>
                                        <div class="slider col-md-8">
                                            <?php include('views/fragments/slider_main.php'); ?>
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
                        <!-- header end -->
                    </div>
                </section>
                <section class="content" id="lazyjaxdavisroot">
                    
                    <div class="container" id="blog">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 class="page-head">WSBF BLOG</h2>
                            </div>
                            <div class="col-md-5 pull-right">
                                <div class="row">
                                    <div class="pull-left">
                                        <div class="search-control">
                                            filter by: <a href="#" class="news"> <i class="fa fa-tag"></i> News</a> <a href="#" class="music"> <i class="fa fa-tag"></i> Music</a> 
                                        </div>
                                    </div>
                                    <div class="pull-right">
                                        <div class="search-control pull-right">
                                            <input type="text" placeholder="search" name="q" class="col-md-3 form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- content -->
                        <div class="row grid blog-boxes">
                            <?php
                                $posts = get_posts('numberposts=20&order=DESC&orderby=date');
                                foreach ($posts as $post) : setup_postdata( $post ); ?>
                                
                                <div class="blog-item my-col n-2-5">  
                                    <div class="blog-box">
                                        <figure class="rollover">
                                            <?php
                                                if ( get_the_post_thumbnail() != '' ) {

                                                    echo '<a href="showpost.php?p='. get_the_ID() .'" class="thumbnail-wrapper">';
                                                     the_post_thumbnail();
                                                    echo '</a>';

                                                  } else if(catch_that_image($post)!='') {

                                                   echo '<a href="showpost.php?p='. get_the_ID() .'" class="thumbnail-wrapper">';
                                                   echo '<img src="';
                                                   echo catch_that_image($post);
                                                   echo '" alt="" />';
                                                   echo '</a>';

                                                  }
                                            ?>
                                        </figure>
                                        <div class="info">
                                            <h3 class="blog-title">
                                                <?php
                                                    echo '<a href="showpost.php?p='. get_the_ID() .'">';
                                                     the_title();
                                                    echo '</a>';
                                                ?>
                                            </h3>
                                            <div class="category">
                                                
                                                <strong><?php echo get_the_category_list(); ?></strong>
                                            </div>
                                            <div class="mini-row date"><?php the_date("j F");?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                endforeach;
                                ?>
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