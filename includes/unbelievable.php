<?php
/*
    $unbelievable =
	[
		'banner' => 'b3',
	];
*/



?>

<section class="unbelievable">
	<a href="<?php the_permalink(); ?>" class="unbelievable__block">
		<span class="largeTitle">Обзор рынка</span>
		<div class="imgBlock">
			<?php the_post_thumbnail('medium'); ?>
		</div>
		<div class="unbelievable__blockText">
            <span class="unbelievable__blockTextTitle">
                <?php the_title(); ?>
            </span>
			<span class="unbelievable__blockTextExcerpt">
				<?php echo kama_excerpt(array('maxchar'=> 200, 'text'=> get_the_excerpt()))?>
            </span>
		</div>
	</a>

	<?php
	$banners = [
		$unbelievable['banner'] => true
	];
	require locate_template( 'includes/foxyes'. $ghost . '.php' );
	?>
</section>