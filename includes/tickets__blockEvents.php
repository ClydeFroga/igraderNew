<a href="<?php the_permalink(); ?>" class="tickets__block">
	<div class="imgBlock">
		<?php the_post_thumbnail('medium'); ?>
	</div>
	<?php
	$dateAndViews = [
		'theme' => ['classes' => ['dark']]
	];

	require locate_template( 'includes/dateAndViews.php' );
	?>

	<div class="tickets__blockBot">
        <span class="tickets__blockBotTitle">
            <?php the_title(); ?>
        </span>
        <?php
        $dateAndViews = [
          'category' => ['classes' => ['transparent']]
        ];

        require locate_template( 'includes/dateAndViews.php' );
        ?>

	</div>
</a>