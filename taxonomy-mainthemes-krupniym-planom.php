<?php get_header();

global $query_string;
$term = get_queried_object();
$term_id = $term -> term_id;
$image_id = get_term_meta( $term_id, '_thumbnail_id', 1 );
$image_url = wp_get_attachment_image_url( $image_id, 'medium' );

$count = count(get_posts(
	[
		'posts_per_page' => -1,
		'tax_query' => [
			[
				"operator" => 'IN',
				'taxonomy' => $term -> taxonomy,
				'field' => 'id',
				'terms' => [ $term_id ]
			],
		]
	]
));

$str = (string) $count;
$lastChar = (int) substr($str, -1, 1);
if($lastChar >= 2 && $lastChar <= 4) {
	$str = ' статьи';
}
if($count > 5 && $count < 21 || $lastChar == 0 || $lastChar >= 5 && $lastChar <= 9) {
	$str = ' статей';
}
if($count == 1 || $lastChar == 1) {
	$str = ' статья';
}

$per_page = 15;
if($is_tablet) {
	$per_page = 14;
}
if($is_mobile) {
	$per_page = 9;
}
query_posts($query_string . "&posts_per_page=". $per_page);
?>

	<div class="wrapper">
		<?php get_sidebar('left'); ?>

		<div class="wrapper__block marginAll">

			<div class="wrapper__content">
				<div class="container top">
					<?php get_template_part('includes/headerMenu'); ?>

                    <section class="withFoxy">
                        <div class="">
                            <div class="rubric__top closeUp">
	                            <?php get_template_part('includes/breadcrumbs'); ?>

                                <div class="rubric__topLine">
                                    <h1 class="rubricTitle">
			                            <?php echo single_term_title('', 0); ?>
                                    </h1>

                                    <span class="rubric__topLineAmount">
                                            <?php echo $count, $str; ?>
                                        </span>
                                </div>

                                <span class="rubric__topDescription rubricDesc">
									<?php echo term_description(); ?>
	                            </span>
                            </div>
                            <div class="verticalBlock closeUp">
                                <div class="verticalBlock__bot">
		                        <?php
		                        $verticalBlock__botBlock =
			                        [
				                        'classes' => [''],
				                        'classesAdd' => ['verticalBlock__botBlockWrapper'],
				                        'text' => [
					                        'max' => 200,
                                        ],
				                        'midDate' => [
					                        'classes' => [''],
					                        'category'  => [
						                        'classes' => [ 'transparent' ]
					                        ],
				                        ],
				                        'botDate' => [
					                        'classes' => ['start'],
					                        'date'  => [
						                        'classes' => [ 'dark' ]
					                        ],
					                        'views'  => [
						                        'classes' => [ 'dark' ]
					                        ],
				                        ]
			                        ];
		                            $num = 0;
		                        $max = 6;
		                        if($is_mobile) {
			                        $max = 3;
		                        }
                                while (have_posts()) {
                                    the_post();
                                    require locate_template( 'includes/verticalBlock__botBlock.php' );
                                    if ($num == $max - 1) break;
                                    $num++;
                                }
		                        ?>
                                </div>
                            </div>
                        </div>

                        <div>
	                        <?php
	                        $banners = [
		                        'a' => true
	                        ];
	                        require locate_template('includes/foxyes.php');
	                        ?>

                            <?php if(!$is_mobile) { ?>
                                <div class="rightAside__darkBlock">
                                    <a href="<?php echo get_term_link(1607, 'mainthemes') ?>" class="smallTitle">Открытое голосование</a>

		                            <?php
		                            global $post;
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
                            <?php } ?>

	                        <?php
	                        $banners = [
		                        'b1' => true
	                        ];
	                        require locate_template('includes/foxyes.php');
	                        ?>
                        </div>
                    </section>

                    <section class="doubleFoxyB <?php if (!$is_mobile) echo 'reverse'; ?> ">

	                    <?php if(!$is_mobile) { ?>
                            <div class="doubleFoxyB__foxyBlock">
			                    <?php
			                    $banners = [
				                    'b2' => true
			                    ];
			                    require locate_template('includes/foxyes.php');
			                    ?>
                            </div>
	                    <?php } ?>

						<?php
						$sliderClass = 'sliderBigOne';
						global $post;
						$a = get_option( 'sticky_posts' );

						$posts_per_page = !$is_mobile ? 8 : 4;

						$query = new WP_Query( [
							'posts_per_page'      =>  $posts_per_page,
							'offset'              => 0,
							'ignore_sticky_posts' => true,
							'post__in' => $a,
						] );

						$verticalBlock__botBlock =
							[
								'classes' => ['swiper-slide'],
								'topDate' => false,
								'botDate' => false
							];
						$slider =
							[
								'id' => 'sliderTop',
								'control' => !$is_mobile,
								'cats' => !$is_mobile,
								'scrollbar' => $is_mobile,
								'title' => false,
							];


						if ( $query->have_posts() ) {
							shuffle($query -> posts);
							require locate_template( 'includes/slider.php' );
						}
						?>

	                    <?php if($is_mobile) { ?>
                            <div class="doubleFoxyB__foxyBlock">
			                    <?php
			                    $banners = [
				                    'b2' => true
			                    ];
			                    require locate_template('includes/foxyes.php');
			                    ?>
                            </div>
	                    <?php } ?>
                    </section>

					<?php
					$banners = [
						'd1' => true
					];
					require locate_template('includes/foxyes.php');
					?>

                    <section class="withFoxy">

                        <div class="verticalBlock closeUp">
                            <div class="verticalBlock__bot">
	                            <?php
	                            $num = 0;
	                            $max = 3;
	                            $verticalBlock__botBlock =
		                            [
			                            'classes' => [''],
			                            'classesAdd' => ['verticalBlock__botBlockWrapper'],
			                            'text' => [
				                            'max' => 200,
			                            ],
			                            'midDate' => [
				                            'classes' => [''],
				                            'category'  => [
					                            'classes' => [ 'transparent' ]
				                            ],
			                            ],
			                            'botDate' => [
				                            'classes' => ['start'],
				                            'date'  => [
					                            'classes' => [ 'dark' ]
				                            ],
				                            'views'  => [
					                            'classes' => [ 'dark' ]
				                            ],
			                            ]
		                            ];
	                            if($is_tablet) {
		                            $max = 4;
	                            }
	                            while (have_posts()) {
		                            the_post();
		                            require locate_template( 'includes/verticalBlock__botBlock.php' );
		                            if ($num == $max - 1) break;
		                            $num++;
	                            }
	                            ?>
                            </div>
                        </div>

                        <div>
	                        <?php
	                        $banners = [
		                        'b3' => true
	                        ];
	                        require locate_template('includes/foxyes.php');
	                        ?>
                        </div>
                    </section>

                    <section class="withFoxy">

                        <div class="verticalBlock closeUp">
                            <div class="verticalBlock__bot">
								<?php
								$loadMore = [
									'classes' => ['full', 'buttonBlack'],
									'offset' => $per_page,
									'perView' => $is_PC ? 9 : 6,
									'block' => 'verticalBlock__botBlock',
									'horizontalBar' => null,
									'verticalBar' => $verticalBlock__botBlock,
									'forRubric' => true,
								];
								while (have_posts()) {
									the_post();
									require locate_template( 'includes/verticalBlock__botBlock.php' );
								}
								require locate_template( 'includes/loadMore.php' );
								?>
                            </div>
                        </div>

                        <div>
							<?php
							$banners = [
								'b4' => true
							];
							require locate_template('includes/foxyes.php');
							?>
                        </div>
                    </section>

					<?php
					$query1 = new WP_Query( [
						'posts_per_page' => $is_PC ? 8 : 4,
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

					if ( $query1->have_posts() ) {
						$secondaryText =
							[
								'foxy' => ['b5'],
								'classes' => $is_PC ? ['reverse'] : ['foxySecond', 'reverse'],
								'textBlock' => [
									'classes' => ['four'],
									'title' => ['Новости'],
									'catId' => [1599],
									'tax' => ['mainthemes']
								],
							];

						require locate_template('includes/secondaryText.php');
					}
					wp_reset_postdata();
					?>

					<?php
					$banners = [
						'd2' => true
					];
					require locate_template('includes/foxyes.php');
					?>

					<?php
					$terms = get_terms( [
						'taxonomy' => 'brand',
						'hide_empty' => false,
						'number' => 4,
					] );
//					if(!$is_mobile) {
					if(false) {
						if (!is_wp_error($terms)) { ?>
                            <section class="brandsList <?php if ($is_tablet) echo 'double'; ?>">
                                <span class="largeTitle">Бренды</span>
                                <div>
									<?php
									foreach( $terms as $term ) {

										require locate_template( 'includes/brandsList__block.php' );

									} ?>
                                </div>

                            </section>

						<?php }
					}
//					else {
                    if(false) {
						if (!is_wp_error($terms)) {
						    $brandsList__block = [
						      'classes' => ['swiper-slide']
                            ];
						    ?>
                        <div class="slider verticalBlock">
                            <div class="slider__top">
                                <a href="#" class="largeTitle">Бренды</a>
                            </div>
                            <div class="verticalBlock__bot">
                                <div id="sliderSec1" class="swiper-container">
                                    <div class="swiper-wrapper">
	                                    <?php
	                                    foreach( $terms as $term ) {

		                                    require locate_template( 'includes/brandsList__block.php' );

	                                    } ?>
                                    </div>
                                </div>
                            </div>
                            <div id="sliderSec1__scrollBar" class="slider__scrollbar"></div>
                        </div>
                    <?php }
					}
					?>

					<?php
					$query = new WP_Query( [
						'posts_per_page' => 4,
						'offset' => 0,
						'ignore_sticky_posts'=> true,
						'tax_query' => [
							[
								"operator" => 'IN',
								'taxonomy' => 'mainthemes',
								'field' => 'id',
								'terms' => [ '1606' ]
							],
						]
					] );

					$sliderLarge =
						[
							'banner' => false,
							'title' => [
								'name' => 'Страницы истории',
								'catId' => 1606,
								'tax' => 'mainthemes',
							],
						];

					if ( $query->have_posts() ) {
						require locate_template( 'includes/sliderLarge.php' );
					}
					wp_reset_postdata();
					?>

					<?php
					if ($is_mobile) {
						$banners = [
							'b6' => true
						];
						require locate_template('includes/foxyes.php');
					}
					?>

                    <section class="doubleFoxyF withFMargin">

						<?php
						$posts_per_page = 10;
						if ( $is_tablet) {
							$posts_per_page = 4;
						}
						if ( $is_mobile) {
							$posts_per_page = 3;
						}
						$query = new WP_Query( [
							'posts_per_page'      => $posts_per_page,
							'offset'              => 0,
							'ignore_sticky_posts' => true,
							'tax_query'           => [
								[
									"operator" => 'IN',
									'taxonomy' => 'mainthemes',
									'field'    => 'id',
									'terms'    => [ '1601' ]
								],
							]
						] );

						if ($is_PC) { ?>
                            <div class="slider verticalBlock">
								<?php

								$slider =
									[
										'id' => 'sliderDouble',
										'cats' => false,
										'control' => true,
										'scrollbar' => false,
										'title' => [
											'name' => 'Рынок',
											'catId' => 1601,
											'tax' => 'mainthemes',
										],
									];

								$verticalBlock__botBlock =
									[
										'classes' => ['swiper-slide'],
										'topDate' => false,
										'text' => false,
										'midDate' => false,
										'botDate' => [
											'views'  => [
												'classes' => [ 'dark' ]
											],
											'date' => true
										]
									];
								if ( $query->have_posts() ) {
									require locate_template( 'includes/slider.php' );
								}
								wp_reset_postdata(); ?>
                            </div>
						<?php }
						if ( $is_tablet ) {
							$horizontalBar =
								[
									'classes'         => [ 'around' ],
									'loadMore'        => false,
									'dateAndViewsBot' => [
										'date' => true,
									]
								];

							$tripleBlock__second =
								[
									'title' => [
										'name'  => 'Горчячие предложения',
										'catId' => 1980,
										'tax'   => 'mainthemes',
									],
								];

							require locate_template( 'includes/tripleBlock__second.php' );

						}
						if ($is_mobile) { ?>
							<?php
							$tripleBlock__second =
								[
									'classes' => ['inColumnTablet'],
									'title' => [
										'name' => 'горячие предложения',
										'catId' => 1599,
										'tax' => 'mainthemes',
									],
								];
							$horizontalBar =
								[
									'classes' => [''],
									'loadMore' => true,
									'dateAndViewsBot' => [
										'date' => true
									]
								];
							$loadMore = [
								'classes' => ['hiddenButton'],
								'offset' => $posts_per_page,
								'perView' => $posts_per_page,
								'block' => 'horizontalBarDiv',
								'horizontalBar' => $horizontalBar,
								'verticalBar' => null,
							];

							require locate_template( 'includes/tripleBlock__second.php' );
							?>
						<?php } ?>

                        <div class="doubleFoxyF__foxyBlock foxyFBlock">
							<?php
							$banners = [
								'f1' => true,
								'f2' => true,
								'f3' => true
							];
							require locate_template('includes/foxyes.php');
							?>
                        </div>
                    </section>
				</div>

				<?php
				if ($is_PC) {
					get_sidebar('right');
				}
				?>
			</div>

		</div>

	</div>

<?php get_footer(); ?>