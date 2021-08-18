<?php
/*
    $wrongBlock =
	[
        'classes' => array,
        'price' => boolean',
    ];
 */
if ($wrongBlock['classes']) {
	$classesWB = implode(' ', $wrongBlock['classes']);
}
?>


<div class="wrongBlock <?php echo $classesWB; ?>">

	<?php
	while ($query -> have_posts()) {
		$query -> the_post(); ?>

		<a href="<?php the_permalink(); ?>" class="wrongBlock__blc">
			<?php
			if (!$wrongBlock['simple']) {
			?>
			<div class="imgBlock">
				<?php
                if (!$wrongBlock['price']) {
	                the_post_thumbnail('thumbnail');
                }
                else { ?>
	                <img src="<?php echo get_field( 'izobrazhenie_zapisi')['url']; ?>">
                <?php } ?>
			</div>
			<?php
            } ?>
			<span class="wrongBlock__blcTitle">
				<?php the_title() ?>
            </span>
			<?php
				if($wrongBlock['price'] ) { ?>
					<span class="wrongBlock__blcPrice">
						<?php echo number_format(get_field( 'czena'), 0, '.', ' '); ?> ₽
	                </span>
				<?php }
			?>
			<?php
			if ($wrongBlock['simple']) {
				$dateAndViews = [
                    'classes' => [''],
					'date' => [
						'classes' => ['dark']
					],
					'views' => ['classes' => ['dark']],
                ];
				require locate_template('includes/dateAndViews.php');
			} ?>
		</a>
	<?php } ?>
</div>