<?php
/*
  $tripleBlock__second =
	[
		'classes' => array,
        'title' => [
            'name' => string,
            'catId' => int,
            'tax' => string,
        ],
	];
 */
if ($tripleBlock__second['classes']) {
	$classesTB = implode(' ', $tripleBlock__second['classes']);
}
?>



<div class="tripleBlock__second <?php echo $classesTB;?>">
	<a class="largeTitle" href="<?php echo get_term_link($tripleBlock__second['title']['catId'], $tripleBlock__second['title']['tax']) ?>">
		<?php echo $tripleBlock__second['title']['name'] ?>
	</a>

    <?php require locate_template( 'includes/horizontalBar.php' ); ?>
</div>