<section class="catalog">
	<span class="largeTitle">Новое в каталоге</span>

	<div>
		<?php
		while($query->have_posts()) {
			$query->the_post();

			require locate_template( 'includes/catalog__block.php' );

		} ?>

		<?php
		if($catalog['loadMore']) {
			require locate_template( 'includes/loadMore.php' );
		}
		?>

	</div>

</section>