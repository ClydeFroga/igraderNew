<aside class="rightAside">
	<?php get_template_part('includes/socialMedia'); ?>

    <?php if(is_home()) { ?>
        <div class="rightAside__darkBlock">
            <a href="<?php echo get_term_link(1607, 'mainthemes') ?>" class="smallTitle">Открытое голосование</a>

            <?php
            $query = new WP_Query( [
                'posts_per_page' => 3,
                'offset' => 0,
                'ignore_sticky_posts'=> true,
                'tax_query' => [
                    [
                        "operator" => 'IN',
                        'taxonomy' => 'mainthemes',
                        'field' => 'id',
                        'terms' => [ '1607' ]
                    ],
                ]
            ] );
            $textBlock = [
                'comments' => true
            ];
            if ( $query->have_posts() ) {
                    require locate_template('includes/textBlock.php');
            }
            wp_reset_postdata();
            ?>
        </div>

        <div class="rightAside__whiteBlock">
            <a href="<?php echo get_term_link(1599, 'mainthemes') ?>" class="smallTitle">Новости</a>

            <?php
            $query = new WP_Query( [
                'posts_per_page' => 3,
                'offset' => 0,
                'ignore_sticky_posts'=> true,
                'tax_query' => [
                    [
                        "operator" => 'IN',
                        'taxonomy' => 'mainthemes',
                        'field' => 'id',
                        'terms' => [ '1599' ]
                    ],
                ]
            ] );
            $textBlock = [
                'comments' => false,
                'date' => true,
            ];
            if ( $query->have_posts() ) {
                require locate_template('includes/textBlock.php');
            }
            wp_reset_postdata();
            ?>
        </div>
	<?php }
	else { ?>
        <div class="rightAside__darkBlock">
            <span class="smallTitle">Важное</span>

	        <?php
	        $query = new WP_Query( [
		        'posts_per_page' => 4,
		        'offset' => 0,
		        'ignore_sticky_posts'=> true,
		        'tax_query'           => [
			        [
				        "operator" => 'NOT IN',
				        'taxonomy' => 'mainthemes',
				        'field'    => 'id',
				        'terms'    => [ '1599' ]
			        ],
		        ]
	        ] );

	        $wrongBlock = [
		        'price' => false
	        ];
	        if ( $query->have_posts() ) {
		        require locate_template('includes/wrongBlock.php');
	        }
	        wp_reset_postdata();
	        ?>
        </div>
    <?php }
    ?>
</aside>