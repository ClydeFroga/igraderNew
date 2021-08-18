<a href="<?php the_permalink(); ?>" class="catalog__block">
	<div class="imgBlock">
		<img src="<?php echo get_field( 'izobrazhenie_zapisi')['url']; ?>">
	</div>

	<div class="catalog__blockBot">
		<?php
		$brand = get_the_terms( get_the_ID(), 'brand' );
		if($brand !== false) {
			$term_id = $brand[0]->term_id;
			$image_id  = get_term_meta( $term_id, '_thumbnail_id', 1 );
			$img_url = wp_get_attachment_image_url( $image_id, 'medium' );

			?>

			<div class="catalog__blockBotBrandLine">
                <span>
                    Каталог спецтехники
                </span>

				<img src="<?php echo $img_url; ?>">
			</div>
		<?php }
		?>

		<span class="catalog__blockBotTitle">
            <?php the_title(); ?>
        </span>
		<span class="catalog__blockBotLearnMore">
            Узнать больше →
        </span>
	</div>
</a>