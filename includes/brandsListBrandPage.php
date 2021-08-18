<?php
$term_id = $term -> term_id;
$image_id = get_term_meta( $term_id, '_thumbnail_id', 1 );
$image_url = wp_get_attachment_image_url( $image_id, 'medium' );
$query = new WP_Query( [
	'posts_per_page' => $is_PC ? 2 : 1,
	'offset' => 0,
	'ignore_sticky_posts'=> true,
	'post_type' => 'post',
	'tax_query' => [
		[
			"operator" => 'IN',
			'taxonomy' => 'brand',
			'field' => 'id',
			'terms' => [ $term_id ]
		],
	]
] );
?>

<div  class="brandsList__block">

	<?php
	$num = 0;
	while($query->have_posts()) {
		$query->the_post();
		if ($is_PC) {
			if($num == 0) { ?>

                <a href="<?php the_permalink(); ?>" class="imgBlock">
                    <img src="<?php echo $image_url ?>">

                    <div class="brandsList__blockHidden">
                        <div class="dateAndViews">
                            <span class="date"><?php echo get_the_date("d F Y"); ?></span>
                        </div>
                        <span>
						<?php the_title(); ?>
					</span>
                    </div>
                </a>

			<?php }
			else { ?>

                <a href="<?php the_permalink(); ?>" class="brandsList__blockLinks">
                    <div class="dateAndViews">
                        <span class="date"><?php echo get_the_date("d F Y"); ?></span>
                    </div>
                    <p>
						<?php the_title(); ?>
                    </p>
                </a>

			<?php }
			$num++;
        } else { ?>
            <a href="<?php the_permalink(); ?>" class="imgBlock">
                <img src="<?php echo $image_url ?>">
            </a>
            <a href="<?php the_permalink(); ?>" class="brandsList__blockLinks">
                <div class="dateAndViews">
                    <span class="date"><?php echo get_the_date("d F Y"); ?></span>
                </div>
                <p>
					<?php the_title(); ?>
                </p>
            </a>
		<?php }
	} ?>




	<a href="<?php echo get_term_link($term_id, 'brand') ?>" class="hiddenButton notHidden">Смотреть все</a>
</div>