<?php
/*
  $sliderLarge =
	[
		'classes' => array,
		'banner' => string,
		'title' => [
			'name' => string,
			'catId' => int,
			'tax' => string,
		],
	];
*/
if ($sliderLarge['classes']) {
	$classesSL = implode(' ', $sliderLarge['classes']);
}
?>

<section class="sliderLarge <?php echo $classesSL; ?>">

	<div>

		<a class="largeTitle" href="<?php echo get_term_link($sliderLarge['title']['catId'], $sliderLarge['title']['tax']) ?>">
			<?php echo $sliderLarge['title']['name'] ?>
		</a>

		<div id="sliderLarge" class="swiper">
			<div class="swiper-wrapper">
				<?php
				while($query -> have_posts()) {
					$query -> the_post(); ?>

					<div class="swiper-slide sliderLarge__block">

						<a href="<?php the_permalink(); ?>" class="sliderLarge__blockText">
							<span class="sliderLarge__blockTextTitle"><?php the_title(); ?></span>
							<?php
							$dateAndViews = [
								'category'  => [
									'classes' => ['']
								],
								'views' => [
									'classes' => ['']
								]
							];
							require locate_template( 'includes/dateAndViews.php' );

							?>
							<span class="sliderLarge__blockTextExcerpt">
								<?php echo kama_excerpt( array('maxchar'=> $sliderLarge['banner'] ? 100 : 250, 'text'=> get_the_excerpt()) ); ?>
                            </span>
						</a>
						<div class="sliderLarge__blockImage">
							<div class="imgBlock imgBlockFull">
								<?php the_post_thumbnail('large') ?>
							</div>
						</div>
					</div>

				<?php } ?>



			</div>
			<span class="sliderLarge__left">
                <svg>
                    <use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#smallArrowLeft"></use>
                </svg>
            </span>
			<span class="sliderLarge__right">
                <svg>
                    <use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#smallArrowLeft"></use>
                </svg>
            </span>
		</div>
	</div>

	<?php
	$banners = [
		$sliderLarge['banner'] => true
	];
	require locate_template( 'includes/foxyes'. $ghost . '.php' );
	?>

</section>