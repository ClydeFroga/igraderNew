<a href="<?php the_permalink(); ?>" class="tickets__block">
	<div class="imgBlock">
		<?php the_post_thumbnail('medium'); ?>
	</div>
	<div class="tickets__blockBot">
		<span class="tickets__blockBotTitle">
			<?php the_title(); ?>
        </span>

        <?php
            require locate_template( 'includes/dateAndViews.php' );
        ?>

        <?php if ( $tickets['text']) { ?>
            <span class="tickets__blockBotText">
                <?php echo kama_excerpt( array('maxchar'=> $tickets['text']['max'] ? $tickets['text']['max'] : 150 , 'text'=> get_the_excerpt()) ); ?>
            </span>
        <?php } ?>
	</div>
</a>