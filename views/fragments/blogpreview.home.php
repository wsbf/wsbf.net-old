<div class="col-lg"><h2>WSBF BLOG</h2></div>
<div class="col-lg blog-content">
    <div id="ca-container" class="ca-container">
        <div class="ca-wrapper">
            <?php $posts = get_posts('numberposts=9&order=DESC&orderby=date');
                foreach ($posts as $post) : setup_postdata( $post ); ?>
                <div class="ca-item ca-item-1">
                    <div class="ca-item-main">
                        
                        <?php 
                        $image_catch = catch_that_image($post);
                        if(get_the_post_thumbnail() != '' || $image_catch != '' ): ?>
                        <div class="ca-icon">
                            <?php
                                if ( get_the_post_thumbnail() != '' ) {

                                    echo '<a href="showpost.php?p='. get_the_ID() .'" class="thumbnail-wrapper">';
                                     the_post_thumbnail();
                                    echo '</a>';

                                  } else if($image_catch!='') {

                                   echo '<a href="showpost.php?p='. get_the_ID() .'" class="thumbnail-wrapper">';
                                   echo '<img src="';
                                   echo $image_catch;
                                   echo '" alt="" />';
                                   echo '</a>';

                                  }
                            ?>
                        </div>
                        <?php endif; ?>
                        <h3><?php
                                echo '<a href="showpost.php?p='. get_the_ID() .'">';
                                the_title();
                                echo '</a>';
                            ?></h3>
                        
                        <?php add_filter('the_excerpt', 'removeps');
                            if(trim(get_the_excerpt()) != ''): ?>
                        <h4>
                            <span><?php
                            add_filter( 'excerpt_length', 'custom_excerpt_length', 15 );
                            the_excerpt(); ?></span>
                        </h4>
                        <?php endif; ?>
                        <a href="#" class="ca-more">more...</a>
                    </div>
                    <div class="ca-content-wrapper">
                        <div class="ca-content">
                            <h6><?php
                                echo '<a href="showpost.php?p='. get_the_ID() .'">';
                                the_title();
                                echo '</a>';
                            ?></h6>
                            <a href="#" class="ca-close">close</a>
                            <div class="ca-content-text">
                                <?php 
                                //add_filter( 'excerpt_length', 'custom_excerpt_longer', 50 );
                                the_excerpt(); ?>
                            </div>
                            <ul>
                                <li><a href=<?php echo '"showpost.php?p='.  get_the_ID().'"' ?>>Read more</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>