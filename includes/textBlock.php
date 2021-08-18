<section class="textBlock">
    <?php
    while ($query->have_posts()) {
        $query->the_post();
        ?>

        <a href="<?php the_permalink(); ?>" class="textBlock__block">
		    <?php the_title(); ?>

            <?php
            if ( $textBlock['comments']) { ?>
                <span class="commentsCount">
                    Читать
                    <?php //echo get_comments_number_text( ); ?>
                </span>
            <?php }
            if ( $textBlock['date']) { ?>
                <span class="commentsCount">

                    <?php echo get_the_date("d F Y"); ?>

                </span>
            <?php }
            if ( $textBlock['dateAndViews']) {
                $dateAndViews = $textBlock['dateAndViews'];
	            require locate_template( 'includes/dateAndViews.php' );
            } ?>

        </a>
    <?php } ?>



</section>