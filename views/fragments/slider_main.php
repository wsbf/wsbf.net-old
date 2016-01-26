<?php $query = new WP_Query( 'tag=featured' );?>
<ul class="rslides">
    <?php while($query->have_posts()) : $query->the_post();  ?>
    <li>
        <div class="caption"><a href=<?php echo '"showpost.php?p='.  get_the_ID().'"'; ?>><h4><?php the_title(); ?></h4>
                <p><?php add_filter( 'excerpt_length', 'custom_excerpt_length', 20 ); the_excerpt() ?></p></a>
        </div>
        <img src=<?php echo '"'.catch_that_image(get_post()).'"';?> alt="">
    </li>
    <?php endwhile;?>
</ul>