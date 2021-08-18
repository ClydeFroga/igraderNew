<?php

if ($tickets['classes']) {
	$classesT = implode(' ', $tickets['classes']);
}
?>

<section class="tickets <?php echo $classesT;?>">
	<span class="largeTitle">Обьявления</span>

	<div>
		<?php
		while($query->have_posts()) {
			$query->the_post();
			require locate_template( 'includes/tickets__block.php' );
		} ?>

		<?php
		if($tickets['loadMore']) {
			require locate_template( 'includes/loadMore.php' );
		}
		?>
	</div>

</section>