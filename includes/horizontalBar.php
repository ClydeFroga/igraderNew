<?php
/*
  $horizontalBar =
	[
		'classes' => array,
		'loadMore' => boolean,
        'dateAndViews' => array,
        'dateAndViewsBot' => array,
        'text' => true
	];
 */
if ($horizontalBar['classes']) {
	$classesHB = implode(' ', $horizontalBar['classes']);
}
?>


<div class="horizontalBar <?php echo $classesHB;?>">
	<?php while ($query->have_posts()) {
		$query->the_post();

        require locate_template( 'includes/horizontalBarDiv.php' );

	 } ?>


	<?php
	if ($horizontalBar['loadMore']) {
		require locate_template( 'includes/loadMore.php' );
	 } ?>
</div>
