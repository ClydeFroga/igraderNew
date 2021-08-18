<?php
if ($brandsList__block['classes']) {
	$classesBL = implode(' ', $brandsList__block['classes']);
}

?>


<div class="brandsList__block <?php echo $classesBL; ?>">

    <a href="<?php echo get_term_link($term); ?>" class="imgBlock">
        <?php
        $term_id = $term -> term_id;
        $image_id = get_term_meta( $term_id, '_thumbnail_id', 1 );
        $image_url = wp_get_attachment_image_url( $image_id, 'medium' );
        ?>
        <img src="<?php echo $image_url ?>">
    </a>

    <div class="brandsList__blockLinks">
        <?php

            $query = new WP_Query( [
	            'posts_per_page' => 3,
	            'offset' => 0,
	            'ignore_sticky_posts'=> false,
	            'tax_query' => [
		            [
			            "operator" => 'IN',
			            'taxonomy' => 'brand',
			            'field' => 'id',
			            'terms' => [ $term -> term_id ]
		            ],
	            ]
            ] );
        if ( $query->have_posts() ) {
            while ( $query->have_posts()) {
	            $query -> the_post();
            ?>

            <a href="<?php the_permalink(); ?>">
	            <?php echo kama_excerpt( array('maxchar'=> 75, 'text'=> get_the_title()) ); ?>
            </a>

        <?php }
        } ?>

    </div>
</div>