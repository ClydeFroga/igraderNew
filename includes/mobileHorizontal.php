<?php
/*
    $mobileHorizontal =
	[
        'foxyPlace' => false, //after which block does "foxy" go, starting from 0
    ];
 */
?>


<section class="mobileHorizontal">
	<?php
		$num = 0;
	while ($query->have_posts()) {
		$query->the_post();

		require locate_template( 'includes/mobileHorizontal__blc.php' );

		if($num === $mobileHorizontal['foxyPlace']) {
			$banners = [
				'a' => true
			];
			require locate_template( 'includes/foxyes'. $ghost . '.php' );
		} ?>

		<?php
		$num++;
	} ?>

</section>