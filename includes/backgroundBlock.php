<?php
/*
    $backgroundBlock =
	[
        'banner' => boolean,
        'dateAndViews' => boolean,
        'loadMore' => boolean,
        'text' => boolean,
        'classes' => array,
        'topDate' => [
            'classes' => array,
        ],
        'botDate' => boolean,
    ];
 */
if ($backgroundBlock['classes']) {
	$classesBB = implode(' ', $backgroundBlock['classes']);
}
?>

<section class="backgroundBlock <?php echo $classesBB;?>">
		<?php
		$num = 0;
		while ($query->have_posts()) {
			$query->the_post();

			require locate_template('includes/backgroundBlock__spec.php');

			$num++;
		}
		if ($backgroundBlock['banner']) {
			$banners = [
				'a' => true
			];
			require locate_template('includes/foxyes'. $ghost . '.php');
        }
		if ($backgroundBlock['loadMore']) {

			require locate_template('includes/loadMore.php');
		}

		?>
</section>