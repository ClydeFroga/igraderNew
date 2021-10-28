<?php get_header();

global $query_string;

$term = get_queried_object();
$term_id = $term -> term_id;
$image_id = get_term_meta( $term_id, '_thumbnail_id', 1 );
$image_url = wp_get_attachment_image_url( $image_id, 'medium' );
if (!is_search()) {
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
	}}
$per_page = 7;
if($is_tablet) {
	$per_page = 12;
}
query_posts($query_string . "&posts_per_page=". $per_page);
?>

	<div class="wrapper">
		<?php get_sidebar('left'); ?>

		<div class="wrapper__block marginAll">

			<div class="wrapper__content">
				<div class="container top <?php if ($is_mobile) echo 'rubric'; ?>">
					<?php get_template_part('includes/headerMenu'); ?>

					<section class="withFoxy string">
						<div class="<?php if (!$is_mobile) echo 'rubric'; ?>">
							<div class="<?php if (!is_search()) echo 'rubric__top'; ?>">

								<?php get_template_part('includes/breadcrumbs'); ?>

								<?php if (!is_search()) { ?>
                                    <div class="rubric__topImg">
										<?php
										echo '<img src="'. $image_url .'" alt="" />';
										?>
                                    </div>
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
								<?php } ?>
							</div>

                            <?php if($is_PC) { ?>
                                <div class="horizontalBar withBorder around firstBack effectInclude">
                                    <?php
                                    if (have_posts()) {
                                        $num = 0;
                                        $horizontalBar =
                                            [
                                                'classes' => ['firstBack', 'around'],
                                                'loadMore' => true,
                                                'dateAndViews' => [
                                                    'category' => [
                                                            'classes' => ['transparent']
                                                    ]
                                                ],
                                                'text' => [
                                                        'max' => 250
                                                ],
                                            ];

                                        while (have_posts()) {
                                            the_post();
                                            require locate_template('includes/horizontalBarDiv.php');
                                            $num++;
                                            if ($num === 1) {
                                                $horizontalBar['dateAndViews'] = false;
                                                $horizontalBar['dateAndViewsBot'] = [
                                                    'classes' => ['start'],
                                                    'date' => [
                                                        'classes' => ['dark']
                                                    ],
                                                    'views' => [
                                                        'classes' => ['dark']
                                                    ],
                                                ];
                                            }
                                        }
                                        $loadMore = [
                                            'classes' => ['buttonBlack', 'full'],
                                            'offset'  => $per_page,
                                            'perView' => $per_page,
                                            'block'   => 'horizontalBarDiv',
                                            'horizontalBar' => $horizontalBar,
                                            'verticalBar' => null,
                                            'forRubric' => true,
                                        ];
                                        require locate_template( 'includes/loadMore.php' );
                                    }
                                    else { ?>
                                        <p>Записей не найдено</p>
                                    <?php }
                                    ?>
                                </div>

                                <section class="slider verticalBlock">
                                    <?php
                                    global $post;
                                    $a = get_option( 'sticky_posts' );

                                    $query = new WP_Query( [
	                                    'posts_per_page' => 8,
	                                    'ignore_sticky_posts'=>true,
	                                    'post__in' => $a,
                                    ] );

                                    $slider =
                                        [
                                            'id' => 'sliderTop',
                                            'cats' => false,
                                            'control' => true,
                                            'scrollbar' => true,
                                        ];

                                    $verticalBlock__botBlock =
                                        [
                                            'classes' => ['swiper-slide'],
                                            'topDate' => [
                                                'classes' => ['dark'],
                                            ],
                                            'botDate' => [
                                                'date'  => [
                                                    'classes' => [ 'dark' ]
                                                ],
                                            ]
                                        ];
                                    if ( $query->have_posts() ) {
	                                    shuffle($query -> posts);
                                        require locate_template( 'includes/slider.php' );
                                    }
                                    wp_reset_postdata(); ?>

                                </section>
                            <?php } ?>
						</div>

						<div class="<?php if ($is_mobile) echo 'marginAll'; ?>">
							<?php if($is_mobile) { ?>

                                <div class="horizontalBar around firstBack text">
									<?php
									if (have_posts()) {
										$num = 0;
										$horizontalBar =
											[
												'dateAndViews' => [
													'category' => true,
												],
												'text' => [
													'max' => 150
												],
											];

										while (have_posts()) {
											the_post();

											require locate_template('includes/horizontalBarDiv.php');
											$num++;
											if ($num === 1) {
				                                break;
											}
										}
									}
									else { ?>
                                        <p>Записей не найдено</p>
									<?php }
									?>
                                </div>

							<?php } ?>

							<?php
							$banners = [
								'a' => true
							];
							require locate_template('includes/foxyes.php');
							?>

							<?php if($is_mobile) { ?>

                                <div class="horizontalBar withBorder around">
									<?php
									if (have_posts()) {
										$num = 0;
										$horizontalBar =
											[
												'dateAndViewsBot' => [
													'views' => [
														'classes' => ['dark']
													],
													'date' => true
												],
												'text' => false,
												'mobile' => $is_mobile,
											];

										while (have_posts()) {
											the_post();

											require locate_template('includes/horizontalBarDiv.php');
											$num++;
										}
									}
									$loadMore = [
										'classes' => ['buttonBlack'],
										'offset'  => $per_page,
										'perView' => $per_page,
										'block'   => 'horizontalBarDiv',
										'horizontalBar' => $horizontalBar,
										'verticalBar' => null,
										'forRubric' => true,
									];
									require locate_template( 'includes/loadMore.php' );

									?>
                                </div>

                                <section class="slider verticalBlock">
									<?php
									$query = new WP_Query( [
										'posts_per_page'      => 8,
										'offset'              => 0,
										'ignore_sticky_posts' => true,
										'tax_query'           => [
											[
												"operator" => 'IN',
												'taxonomy' => 'mainthemes',
												'field'    => 'id',
												'terms'    => [ '1599' ]
											],
										]
									] );

									$slider =
										[
											'id' => 'sliderTop',
											'cats' => false,
											'control' => false,
											'scrollbar' => true,
										];

									$verticalBlock__botBlock =
										[
											'classes' => ['swiper-slide'],
											'botDate' => [
												'classes' => [''],
												'date'  => [
													'classes' => [ 'dark' ]
												],
												'views'  => [
													'classes' => [ 'dark' ]
												],
											]
										];
									if ( $query->have_posts() ) {
										require locate_template( 'includes/slider.php' );
									}
									wp_reset_postdata(); ?>

                                </section>

								<?php
								$banners = [
									'b1' => true
								];
								require locate_template('includes/foxyes.php');
								?>

							<?php } ?>

                            <?php if($is_PC) { ?>
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

                                <?php
                                $banners = [
                                    'b1' => true
                                ];
                                require locate_template('includes/foxyes.php');
                                ?>

                                <div class="rightAside__border">
                                    <a href="<?php echo get_term_link(1607, 'mainthemes') ?>" class="smallTitle">Популярное на сайте</a>

                                    <div class="textBlock">
	                                    <?php
	                                    if ( function_exists('wpp_get_mostpopular') ) {

		                                    wpp_get_mostpopular(array(
			                                    'limit' => 3,
			                                    'range' => 'last7days',
			                                    'stats_date' => 1,
			                                    'stats_category' => 1,
			                                    'stats_date_format' => 'j.m.Y',
			                                    'wpp_start' => '',
			                                    'wpp_end' => '',
			                                    'thumbnail_width' => 800,
			                                    'thumbnail_height' => 600,
			                                    'post_html' => '
                                                    <a href="{url}" class="textBlock__block">
                                                        {text_title}
                                                        <div class="dateAndViews">
                                                            <span class="date dark">
                                                                    {date}                                                    
                                                            </span>
                                                            <span class="time">
                                                                    {time}                                                    
                                                            </span>
                                                            
                                                        </div>
                                                    
                                                    </a>
                                                '
		                                    ));
	                                    }
	                                    ?>
                                    </div>


                                </div>

                                <?php
                                $banners = [
                                    'b2' => true
                                ];
                                require locate_template('includes/foxyes.php');
                                ?>
                            <?php } ?>
						</div>
					</section>

					<?php if($is_tablet) { ?>
                        <section class="rubricPage__middle">
                            <div class="rubric">

                                <div class="horizontalBar around firstBack text withBorder">
	                                <?php
                                        if (have_posts()) {
                                            $num = 0;
                                            $horizontalBar =
                                                [
                                                    'classes' => ['firstBack', 'around'],
                                                    'loadMore' => true,
                                                    'dateAndViews' => [
                                                        'category' => [
                                                            'classes' => ['transparent']
                                                        ]
                                                    ],
                                                    'text' => [
                                                        'max' => 250
                                                    ],
                                                ];

                                            while (have_posts()) {
                                                the_post();
                                                require locate_template('includes/horizontalBarDiv.php');
                                                $num++;
                                                if ($num === 1) {
                                                    break;
                                                }
                                            }
                                        }
                                        else { ?>
                                            <p>Записей не найдено</p>
                                        <?php }
	                                ?>
                                </div>

                            </div>
                        </section>

                        <section class="withFoxy">
                            <div class="rubric">
                                <div class="horizontalBar around withBorder">
	                                <?php
	                                if (have_posts()) {
		                                $num = 0;
		                                $horizontalBar =
			                                [
				                                'dateAndViews' => [
					                                'classes' => ['start'],
					                                'views' => [
						                                'classes' => ['dark']
					                                ],
                                                    'date' => true
				                                ],
				                                'text' => false
			                                ];

		                                while (have_posts()) {
			                                the_post();

			                                require locate_template('includes/horizontalBarDiv.php');
			                                $num++;
			                                if ($num === 5) {
				                                break;
			                                }
		                                }
	                                }
	                                ?>

                                </div>
                            </div>

                            <div>
	                            <?php
	                            $banners = [
		                            'b1' => true
	                            ];
	                            require locate_template('includes/foxyes.php');
	                            ?>

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
                            </div>
                        </section>

                        <hr class="hrSmall">

                        <div class="rubric">
                            <div class="horizontalBar around text withBorder">
	                            <?php
	                            if (have_posts()) {
		                            $num = 0;
		                            $horizontalBar =
			                            [
				                            'dateAndViewsBot' => [
					                            'classes' => ['start'],
					                            'views' => [
						                            'classes' => ['dark']
					                            ],
					                            'date' => true
				                            ],
				                            'text' => [
					                            'max' => 150
				                            ],
			                            ];

		                            while (have_posts()) {
			                            the_post();

			                            require locate_template('includes/horizontalBarDiv.php');
			                            $num++;
		                            }
	                            }
	                            $loadMore = [
		                            'classes' => ['buttonBlack'],
		                            'offset'  => $per_page,
		                            'perView' => $per_page,
		                            'block'   => 'horizontalBarDiv',
		                            'horizontalBar' => $horizontalBar,
		                            'verticalBar' => null,
		                            'forRubric' => true,
	                            ];
	                            require locate_template( 'includes/loadMore.php' );
	                            ?>
                            </div>
                            <section class="slider verticalBlock">
		                        <?php
		                        $query = new WP_Query( [
			                        'posts_per_page'      => 8,
			                        'offset'              => 0,
			                        'ignore_sticky_posts' => true,
			                        'tax_query'           => [
				                        [
					                        "operator" => 'IN',
					                        'taxonomy' => 'mainthemes',
					                        'field'    => 'id',
					                        'terms'    => [ '1599' ]
				                        ],
			                        ]
		                        ] );

		                        $slider =
			                        [
				                        'id' => 'sliderDouble',
				                        'cats' => true,
				                        'control' => true,
				                        'scrollbar' => true,
			                        ];

		                        $verticalBlock__botBlock =
			                        [
				                        'classes' => ['swiper-slide'],
				                        'botDate' => [
				                               'classes' => [''],
					                        'date'  => [
						                        'classes' => [ 'dark' ]
					                        ],
					                        'views'  => [
						                        'classes' => [ 'dark' ]
					                        ],
				                        ]
			                        ];
		                        if ( $query->have_posts() ) {
			                        require locate_template( 'includes/slider.php' );
		                        }
		                        wp_reset_postdata(); ?>

                            </section>
                        </div>
					<?php } ?>

					<?php
					$banners = [
						'd1' => true
					];
					require locate_template('includes/foxyes.php');
					?>

                    <section class="secondarySlider">
                        <?php
                            if ( !$is_mobile) { ?>
                                <div class="secondarySlider__foxy">
                                    <?php
                                        $banners = [
                                            'b3' => $is_PC,
                                            'b2' => $is_tablet || $is_mobile,
                                        ];
                                        require locate_template('includes/foxyes.php');
                                    ?>
                                </div>
                        <?php } ?>

						<?php
						$posts_per_page = $is_PC ? 8 : 4;

						$query = new WP_Query( [
							'posts_per_page'      =>  $posts_per_page,
							'offset'              => 0,
							'ignore_sticky_posts' => true,
							'tax_query'           => [
								[
									"operator" => 'IN',
									'taxonomy' => 'mainthemes',
									'field'    => 'id',
									'terms'    => [ '1603' ]
								],
							]
						] );

						$verticalBlock__botBlock =
							[
								'classes' => ['swiper-slide'],
								'topDate' => false,
								'botDate' => false
							];
						$slider =
							[
								'id' => 'sliderSec1',
								'control' => true,
								'title' => [
									'name' => 'Обзор техники',
									'catId' => 1603,
									'tax' => 'mainthemes',
								],
							];

						if ($is_PC) {
							if ( $query->have_posts() ) {
								require locate_template( 'includes/slider.php' );
							}
						}

						if ($is_tablet) { ?>
                            <div>
                                <a href="<?php echo get_term_link($slider['title']['catId'], $slider['title']['tax']) ?>" class="largeTitle"><?php echo $slider['title']['name'];?></a>

                                <div class="verticalBlock inTwo">

									<?php while ($query->have_posts()) {
										$query->the_post();

										require locate_template( 'includes/verticalBlock__botBlock.php' );
									} ?>

                                </div>
                            </div>
						<?php }

						if ($is_mobile) {
							$tripleBlock__second =
								[
									'classes' => ['flat'],
									'title' => [
										'name' => 'Обзор техники',
										'catId' => 1599,
										'tax' => 'mainthemes',
									],
								];
							$horizontalBar =
								[
									'classes' => ['around'],
									'loadMore' => true
								];
							$loadMore = [
                                'classes' => [''],
								'offset' => $posts_per_page,
								'perView' => $posts_per_page,
								'block' => 'horizontalBarDiv',
								'horizontalBar' => null,
								'verticalBar' => null,
							];

							require locate_template( 'includes/tripleBlock__second.php' );


							?>

                            <div class="secondarySlider__foxy">
								<?php
								$banners = [
									'b2' => true,
								];
								require locate_template('includes/foxyes.php');
								?>
                            </div>
						<?php }

						wp_reset_postdata(); ?>
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
					$foxy = ['b4'];
					if($is_tablet) $foxy = ['b3'];
					if($is_mobile) $foxy = ['d2','b3'];

					if ( $query1->have_posts() ) {
						$secondaryText =
							[
								'foxy' => $foxy,
								'classes' => ['reverse'],
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
                    if ( !$is_mobile) {
	                    $banners = [
		                    'd2' => true
	                    ];
	                    require locate_template('includes/foxyes.php');
                    }
					?>

                    <section class="doubleFoxyB withSlider">
                        <section class="slider verticalBlock simple">
                            <?php
                            $query = new WP_Query( [
                                'posts_per_page'      => $is_mobile ? 1 : 8,
                                'offset'              => 0,
                                'ignore_sticky_posts' => true,
                                'tax_query'           => [
                                    [
                                        "operator" => 'IN',
                                        'taxonomy' => 'post_tag',
                                        'field'    => 'id',
                                        'terms'    => [ '223' ]
                                    ],
                                ]
                            ] );

                            $slider =
                                [
                                    'id' => 'sliderSec3',
                                    'cats' => false,
                                    'control' => $is_mobile ? false : true,
                                    'scrollbar' => false,
                                    'title' => [
	                                    'name' => 'Дорожники',
	                                    'catId' => 223,
	                                    'tax' => 'post_tag',
                                    ],
                                ];

                            $verticalBlock__botBlock =
                                [
                                    'classes' => ['swiper-slide'],
                                    'topDate' => false,
                                    'text' => [
                                            'max' => 130
                                    ],
                                    'midDate' => [
	                                    'category'  => [
		                                    'classes' => [ 'transparent' ]
	                                    ],
                                    ],
                                    'botDate' => [
                                        'date'  => [
                                            'classes' => [ 'dark' ]
                                        ],
                                        'views' => true
                                    ]
                                ];
                            if ( $query->have_posts() ) {
                                require locate_template( 'includes/slider.php' );
                            }
                            wp_reset_postdata(); ?>
                        </section>

                        <?php if(!$is_tablet) { ?>
                            <div class="doubleFoxyB__foxyBlock">
                                <?php
                                $banners = [
                                    'b5' => !$is_mobile,
                                    'b4' => $is_mobile
                                ];
                                require locate_template('includes/foxyes.php');
                                ?>
                            </div>
                        <?php } ?>
                    </section>

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
					$foxy = 'b6';
					if($is_tablet) $foxy = 'b4';
					if($is_mobile) $foxy = 'b5';
					$sliderLarge =
						[
                            'classes' => $is_mobile ? ['reverse'] : false,
							'banner' => $foxy,
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
			                        'terms'    => [ '1980' ]
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
                                            'name' => 'Горячие предложения',
                                            'catId' => 223,
                                            'tax' => 'post_tag',
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
                        else { ?>
                            <section class="doubleFoxyB withSlider marginAll">
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
                                        ],
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
                            <?php if ( !$is_mobile ) { ?>
                                <div class="doubleFoxyB__foxyBlock noMargin">
	                                <?php
	                                $banners = [
		                                'b5' => true
	                                ];
	                                require locate_template('includes/foxyes.php');
	                                ?>
                                </div>
                            <?php } ?>
                            </section>
	                    <?php } ?>

                        <div class="doubleFoxyF__foxyBlock foxyFBlock">
	                        <?php
	                        if ( $is_mobile ) {
		                        get_template_part( 'includes/sendpulse' );
	                        }
	                        $banners = [
		                        'f1' => true,
		                        'f2' => true,
		                        'f3' => true
	                        ];
	                        require locate_template('includes/foxyes.php');
	                        ?>
                        </div>
                    </section>

					<?php if(!$is_mobile) {
						get_template_part('includes/sendpulse');
					} ?>
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