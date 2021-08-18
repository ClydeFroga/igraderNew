<div class="textModule__containerBlock">
    <span class="textModule__containerBlockCat"><?php echo get_the_category()[0] -> name; ?></span>
    <a class="textModule__containerBlockTitle" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    <?php
        $dateAndViews =
        [
            'date'=> true,
        ];
    require locate_template( 'includes/dateAndViews.php' );
    ?>
</div>


