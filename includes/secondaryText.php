<?php
/*
	$secondaryText =
		[
			'foxy' => 'b2',
			'classes' => false,
            'textBlock' => [
                'classes' => false,
                'title' => [false],
                'catId' => [false],
                'tax' => [false],
            ],
		];

	$textModule = [
		'classes' => false,
		'title' =>	[false],
		'catId' =>	[false],
		'tax' =>	[false],
	];
 */


if ($secondaryText['classes']) {
	$classesSec = implode(' ', $secondaryText['classes']);
}
?>

<section class="secondaryText <?php echo $classesSec;?>">
	<div class="secondaryText__foxy">
		<?php
        foreach( $secondaryText['foxy'] as $foxy) {
	        $banners = [
	                $foxy => true
            ];
	        require locate_template('includes/foxyes'. $ghost . '.php');
        }
		?>
	</div>

	<?php
	if ( $query1->have_posts() ) {
		$textModule = [
			'classes' => $secondaryText['textBlock']['classes'],
			'title' =>	$secondaryText['textBlock']['title'][0],
			'catId' =>	$secondaryText['textBlock']['catId'][0],
			'tax' =>	$secondaryText['textBlock']['tax'][0],
		];
		if ($textModule['classes']) {
			$classesMod = implode(' ', $textModule['classes']);
		}
		?>

		<div class="textModule <?php echo $classesMod;?>">
			<a class="largeTitle" href="<?php echo get_term_link($textModule['catId'], $textModule['tax']) ?>">
				<?php echo $textModule['title'] ?>
			</a>

			<div class="textModule__container">

				<?php
				while ($query1->have_posts()) {
					$query1->the_post();
					require locate_template( 'includes/textModule__containerBlock.php' );
				}
				?>

			</div>

			<a href="<?php echo get_term_link($textModule['catId'], $textModule['tax']) ?>" class="hiddenButton">Показать все →</a>
		</div>


	<?php } ?>

	<?php if ( isset($query2) && $query2->have_posts() ) {
		$textModule = [
			'classes' => false,
			'title' =>	$secondaryText['textBlock']['title'][1],
			'catId' =>	$secondaryText['textBlock']['catId'][1],
			'tax' =>	$secondaryText['textBlock']['tax'][1],
		];
	if ($textModule['classes']) {
		$classesMod = implode(' ', $textModule['classes']);
	}
	?>

	<div class="textModule <?php echo $classesMod;?>">
		<a class="largeTitle" href="<?php echo get_term_link($textModule['catId'], $textModule['tax']) ?>">
			<?php echo $textModule['title'] ?>
		</a>

		<div class="textModule__container">

			<?php
			while ($query2->have_posts()) {
				$query2->the_post();
				require locate_template( 'includes/textModule__containerBlock.php' );
			}
			?>

		</div>

	</div>


	<?php }
	?>


</section>