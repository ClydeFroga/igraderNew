<?php get_header();

global $query_string;
$term = get_queried_object();
$term_id = $term -> term_id;
$image_id = get_term_meta( $term_id, '_thumbnail_id', 1 );
$image_url = wp_get_attachment_image_url( $image_id, 'medium' );
$linkFl = get_field('floowie_link', $term);
$linkPdf = get_field('pdf_magazine', $term);
query_posts($query_string . "&posts_per_page=12");
?>

	<div class="wrapper">
		<?php get_sidebar('left'); ?>

		<div class="wrapper__block marginAll">

			<div class="wrapper__content">
				<div class="container top ">
					<?php get_template_part('includes/headerMenu'); ?>

					<section class="withFoxy">
						<div class="<?php echo $is_mobile ? 'marginAll' : false; ?>">
							<?php get_template_part('includes/breadcrumbs'); ?>

							<div class="journal">
								<div class="journal__img">
									<img src="<?php echo $image_url; ?>">
								</div>
								<div class="journal__right">
									<h1 class="journalTitle">
										<?php echo single_term_title('', 0); ?>
									</h1>

                                    <?php echo term_description(); ?>

									<div class="journal__rightButtons">
										<a target="_blank" href="<?php echo $linkFl; ?>" class="buttonBlack readOnline">Листать онлайн</a>
										<a class="download" href="<?php echo $linkPdf; ?>">
											<svg>
												<use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#download"></use>
											</svg>
											Скачать pdf
										</a>
										<span id="openModal" class="subscribe dark">Оформить подписку</span>
									</div>
								</div>
								<div class="journal__rightButtons hidden">
									<a href="#" class="buttonBlack readOnline">Листать онлайн</a>
									<a  class="download" href="<?php echo $linkFl; ?>">
										<svg>
											<use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#download"></use>
										</svg>
										Скачать pdf
									</a>
									<span id="openModal" class="subscribe dark">Оформить подписку</span>
								</div>
							</div>

							<?php
							if ($is_mobile) {
								$banners = [
									'a' => true
								];
								require locate_template('includes/foxyes.php');
							}
							?>

							<div class="horizontalBar withBorder around ">
								<?php
								if (have_posts()) {
									$num = 0;
									$max = 3;
									if ($is_tablet) {
										$max = 6;
                                    }
									if ($is_mobile) {
										$max = 4;
									}
									$horizontalBar =
										[
											'loadMore' => false,
											'dateAndViewsBot' => [
												'classes' => ['start'],
                                                'category' => [
                                                        'classes' => ['transparent']
                                                ],
												'date' => [
													'classes' => ['dark']
												],
												'views' => $is_PC ? [
													'classes' => ['dark']
												] : false,
											],
											'text' => $is_PC ? [
												'max' => 150
											] : false,
										];

									while (have_posts()) {
										the_post();
										require locate_template('includes/horizontalBarDiv.php');
										$num++;
										if ($num === $max) break;
									}
								}
								?>
							</div>
						</div>

						<div>
							<?php
	                            $banners = [
		                            'a' => !$is_mobile,
		                            'b1' => $is_mobile
	                            ];
	                            require locate_template('includes/foxyes.php');

							?>
                            <?php
                            if (!$is_mobile) { ?>
                            <div class="verticalBlock__bot special">
								<?php
								$query = new WP_Query( [
									'posts_per_page'      => 1,
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

								$verticalBlock__botBlock =
									[
										'classes' => [''],
										'topDate' => [
											'classes' => ['dark']
										],
										'read' => true
									];
								if ( $query -> have_posts()) {
									$query -> the_post();
									require locate_template( 'includes/verticalBlock__botBlock.php' );
								}

								?>
                            </div>

							<?php
                                $banners = [
                                    'b1' => true
                                ];
                                require locate_template('includes/foxyes.php');
                                if (!$is_PC) {
                                ?>

                                <div>
                                    <h2 class="smallTitle">Материал дня</h2>

                                    <?php
                                    $query = new WP_Query( [
                                        'posts_per_page' => 3,
                                        'offset' => 0,
                                        'ignore_sticky_posts'=> true,
                                        'tax_query' => [
                                            [
                                                "operator" => 'NOT IN',
                                                'taxonomy' => 'mainthemes',
                                                'field' => 'id',
                                                'terms' => [ '1599' ]
                                            ],
                                        ]
                                    ] );

                                    $wrongBlock = [
                                        'classes' => ['dedicated'],
                                        'simple' => true
                                    ];
                                    if ( $query->have_posts() ) {
                                        require locate_template('includes/wrongBlock.php');
                                    }
                                    wp_reset_postdata();
	                                ?>
                                </div>
                            <?php }
                            } else { ?>
                                <div class="horizontalBar withBorder around ">
		                            <?php
		                            if (have_posts()) {
			                            $num = 0;
			                            $max = 2;

			                            while (have_posts()) {
				                            the_post();
				                            require locate_template('includes/horizontalBarDiv.php');
				                            $num++;
				                            if ($num === $max) break;
			                            }
		                            }
		                            ?>
                                </div>
                            <?php } ?>
						</div>
					</section>

                    <?php if ($is_PC) { ?>
                        <section class="forked borderless">
                            <div class="forked__left">
                                <div class="rightAside__darkBlock">
                                    <span class="smallTitle">Материал дня</span>

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
                                        'classes' =>['dedicated'],
                                    ];
                                    if ( $query->have_posts() ) {
                                        require locate_template('includes/wrongBlock.php');
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                            <div class="forked__right">
                                <div class="horizontalBar withBorder around ">
                                    <?php
                                    if (have_posts()) {
                                        $num = 0;
                                        $max = 3;
                                        $horizontalBar =
                                            [
                                                'loadMore' => false,
                                                'dateAndViewsBot' => [
                                                    'classes' => ['start'],
                                                    'category' => [
                                                        'classes' => ['transparent']
                                                    ],
                                                    'date' => [
                                                        'classes' => ['dark']
                                                    ],
                                                    'views' => $is_PC ? [
                                                        'classes' => ['dark']
                                                    ] : false,
                                                ],
                                                'text' => $is_PC ? [
                                                    'max' => 150
                                                ] : false,
                                            ];

                                        while (have_posts()) {
                                            the_post();
                                            require locate_template('includes/horizontalBarDiv.php');
                                            $num++;
                                            if ($num === $max) break;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </section>
                    <?php } ?>

					<?php
                    $banners = [
                        'd1' => true
                    ];
                    require locate_template('includes/foxyes.php');
					?>

                    <section class="withFoxy">
                        <div class="">
                            <div class="horizontalBar withBorder around ">
		                        <?php
		                        if (have_posts()) {
			                        $num = 0;
			                        $max = 6;
			                        if ($is_mobile) {
				                        $max = 3;
			                        }
			                        $horizontalBar =
				                        [
					                        'loadMore' => !$is_mobile,
					                        'dateAndViewsBot' => [
						                        'classes' => ['start'],
						                        'category' => [
							                        'classes' => ['transparent']
						                        ],
						                        'date' => [
							                        'classes' => ['dark']
						                        ],
						                        'views' => $is_PC ? [
							                        'classes' => ['dark']
						                        ] : false,
					                        ],
					                        'text' => $is_PC ? [
						                        'max' => 150
					                        ] : false,
				                        ];

			                        while (have_posts()) {
				                        the_post();
				                        require locate_template('includes/horizontalBarDiv.php');
				                        $num++;
				                        if ($num === $max) break;
			                        }
			                        if (!$is_mobile) {
				                        $loadMore = [
					                        'classes'       => [ 'buttonBlack', 'full' ],
					                        'offset'        => 12,
					                        'perView'       => 12,
					                        'block'         => 'horizontalBarDiv',
					                        'horizontalBar' => $horizontalBar,
					                        'verticalBar'   => null,
					                        'forRubric'     => true,
				                        ];
				                        require locate_template( 'includes/loadMore.php' );
			                        }
		                        }
		                        ?>
                            </div>
                        </div>

                        <div class="<?php echo !$is_PC ? 'between' : false; ?>">
	                        <?php
	                        $banners = [
		                        'b2' => true,
	                        ];
	                        require locate_template('includes/foxyes.php');
	                            if ($is_mobile) {
	                        ?>


                            <div class="horizontalBar withBorder around ">
		                        <?php
		                        if (have_posts()) {
			                        $num = 0;
			                        $max = 3;
			                        $horizontalBar =
				                        [
					                        'loadMore' => !$is_mobile,
					                        'dateAndViewsBot' => [
						                        'classes' => ['start'],
						                        'category' => [
							                        'classes' => ['transparent']
						                        ],
						                        'date' => [
							                        'classes' => ['dark']
						                        ],
						                        'views' => $is_PC ? [
							                        'classes' => ['dark']
						                        ] : false,
					                        ],
					                        'text' => $is_PC ? [
						                        'max' => 150
					                        ] : false,
				                        ];

			                        while (have_posts()) {
				                        the_post();
				                        require locate_template('includes/horizontalBarDiv.php');
				                        $num++;
				                        if ($num === $max) break;
			                        }
			                        $loadMore = [
				                        'classes' => ['buttonBlack', 'full'],
				                        'offset'  => 12,
				                        'perView' => 12,
				                        'block'   => 'horizontalBarDiv',
				                        'horizontalBar' => $horizontalBar,
				                        'verticalBar' => null,
				                        'forRubric' => true,
			                        ];
			                        require locate_template( 'includes/loadMore.php' );

		                        }
		                        ?>
                            </div>


	                        <?php
                                }
	                        $banners = [
		                        'b3' => true,
	                        ];
	                        require locate_template('includes/foxyes.php');
	                        ?>
                        </div>
                    </section>

                    <section class="withFoxy">
                        <div>
                            <span class="largeTitle" >
                                Популярное на сайте
                            </span>
                            <?php
                            if ($is_mobile) { ?>

                                <div class="tripleBlock__second flat">

                                    <div class="horizontalBar around">
                                        <?php
                                        if ( function_exists('wpp_get_mostpopular') ) {

                                            wpp_get_mostpopular(array(
                                                'limit' => 4,
                                                'range' => 'last7days',
                                                'stats_date' => 1,
                                                'stats_category' => 1,
                                                'stats_date_format' => 'j.m.Y',
                                                'wpp_start' => '',
                                                'wpp_end' => '',
                                                'thumbnail_width' => 800,
                                                'thumbnail_height' => 600,
                                                'post_html' => '
                                                <a href="{url}" class="horizontalBar__blc">
                                                    <div class="horizontalBar__blcLeft imgBlock">
                                                        <img src="{thumb_url}">
                                                    </div>
                                                    <div class="horizontalBar__blcRight">
                                                    <span class="horizontalBar__blcRightTitle">
                                                        {text_title}
                                                    </span>
                                                    </div>
                                                </a>
                                                '
                                            ));
                                        }
                                        ?>
                                        <script>
                                          let popularOffset = 4;
                                        </script>
                                        <span id="loadMorePopular" class="hiddenButton">Показать ещё ↓</span>
                                    </div>
                                </div>



                            <?php }
                            else { ?>
                                <div class="verticalBlock inThree gap">
                                    <div class="verticalBlock__bot">
                                        <?php
                                        if ( function_exists('wpp_get_mostpopular') ) {

                                            wpp_get_mostpopular(array(
                                                'limit' => $is_PC ? 6 : 4,
                                                'range' => 'last7days',
                                                'stats_date' => 1,
                                                'stats_category' => 1,
                                                'stats_date_format' => 'j.m.Y',
                                                'wpp_start' => '',
                                                'wpp_end' => '',
                                                'thumbnail_width' => 800,
                                                'thumbnail_height' => 600,
                                                'post_html' => '
                                            <a href="{url}" class="verticalBlock__botBlock">
                                                <div class="imgBlock imgBlockFull">
                                                    <img src="{thumb_url}">
                                                </div>
                                                <span class="verticalBlock__botBlockTitle">
                                                    {text_title}
                                                </span>
                                                <div class="dateAndViews">
                                                    <span class="category transparent">
                                                        {catsNames}
                                                    </span>
                                                </div>
                                            </a>
                                            '
                                            ));
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <?php if (!$is_mobile) { ?>
                            <div class="between" style="<?php echo $is_PC ? 'margin-top: 63px;' : false; ?>">
                                <?php
                                $query = new WP_Query( [
                                    'posts_per_page' => 1,
                                    'offset' => 0,
                                    'ignore_sticky_posts'=> true,
                                    'post_type' => 'advertisement'
                                ] );
                                if($query->have_posts()) {
                                    $tickets = [
                                            'button' => true
                                    ];
                                    ?>
                                    <section class="tickets">
                                        <?php
                                        while($query->have_posts()) {
                                            $query->the_post();
                                            require locate_template( 'includes/tickets__block.php' );
                                        } ?>
                                    </section>
                                <?php } ?>

                                <?php
                                $banners = [
                                    'b4' => true
                                ];
                                require locate_template('includes/foxyes.php');
                                ?>
                            </div>
                        <?php } ?>
                    </section>

					<?php
					$banners = [
						'd2' => true
					];
					require locate_template('includes/foxyes.php');
					?>

                    <section class="<?php echo $is_tablet ? 'withFoxy' : 'doubleFoxyB'; ?>">
	                    <?php
                        if(false) {
	                        $tickets = [
		                        'loadMore' => true,
		                        'text' => true,
		                        'price' => true,
		                        'button' => $is_PC,
	                        ];

	                        $per_page = 4;

	                        $query = new WP_Query( [
		                        'posts_per_page' => $per_page,
		                        'offset' => 0,
		                        'ignore_sticky_posts'=> true,
		                        'post_type' => 'advertisement'
	                        ] );

	                        $loadMore = [
		                        'classes' => ['fullWidthButton', 'black'],
		                        'offset'  => $per_page,
		                        'perView' => $per_page,
		                        'block'   => 'tickets__block',
		                        'horizontalBar' => null,
		                        'verticalBar' => null,
	                        ];

	                        if ( $query->have_posts() ) {
		                        require locate_template( 'includes/tickets.php' );
	                        }
	                        wp_reset_postdata();
                        }
                        if($is_tablet) { ?>
                            <div class="verticalBlock inThree gap">
                                <a href="<?php echo get_term_link(223, 'post_tag') ?>" class="largeTitle" >
                                    Горячие предложения
                                </a>
                                <div class="verticalBlock__bot">
                                    <?php
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
                                    $query = new WP_Query( [
	                                    'posts_per_page'      => 4,
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

                                    while ( $query->have_posts()) {
                                        $query-> the_post();
	                                    require locate_template('includes/verticalBlock__botBlock.php');
                                        }
                                        ?>

                                </div>
                            </div>

	                    <?php } ?>

                        <?php
                            if ($is_tablet) { ?>
                                <div>
	                                <?php
	                                $banners = [
		                                'b5' => true
	                                ];
	                                require locate_template('includes/foxyes.php');
	                                ?>
                                </div>
                           <?php }
                        ?>
                    </section>

                    <section class="doubleFoxyB <?php echo !$is_mobile ? 'reverse' : false; ?> ">

                        <?php
                        if ($is_PC) { ?>
                            <div class="doubleFoxyB__foxyBlock">
		                        <?php
		                        $banners = [
			                        'b5' => true
		                        ];
		                        require locate_template('includes/foxyes.php');
		                        ?>
                            </div>
                        <?php }
                        ?>

                        <section class="verticalBlock simple inThree">
                            <a class="largeTitle" href="<?php echo get_term_link(223, 'post_tag') ?>">
                                Дорожники
                            </a>

                            <div class="verticalBlock__bot">
                                <?php
                                $per_page = 3;
                                if($is_tablet) $per_page = 2;
                                if($is_mobile) $per_page = 1;

                                $query = new WP_Query( [
	                                'posts_per_page'      => $per_page,
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
                                $verticalBlock__botBlock =
	                                [
		                                'classes' => [''],
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
                                            'classes' => [''],
			                                'date'  => [
				                                'classes' => [ 'dark' ]
			                                ],
			                                'views' => [
				                                'classes' => [ 'dark' ]
			                                ],
		                                ]
	                                ];
                                if ( $query->have_posts() ) {
                                    while ( $query->have_posts()) {
                                        $query->the_post();
	                                    require locate_template( 'includes/verticalBlock__botBlock.php' );
                                    }
                                }

                                ?>
                            </div>
                        </section>

	                    <?php
	                    if ($is_mobile) { ?>
                            <div class="doubleFoxyB__foxyBlock">
			                    <?php
			                    $banners = [
				                    'b4' => true
			                    ];
			                    require locate_template('includes/foxyes.php');
			                    ?>
                            </div>
	                    <?php }
	                    ?>

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

				</div>

				<?php
				if ($is_PC) {
					get_sidebar('right');
				}
				?>
			</div>

            <div class="wrapper__content">
                <div class="container">
                    <section class="doubleFoxyF">
                        <a href="<?php echo get_term_link(2110, 'mainthemes') ?>" class="orangeTitle">
                            <span>
                               Пит-стоп
                            </span>
                        </a>

						<?php
						$query = new WP_Query( [
							'posts_per_page' => !$is_mobile ? 6 : 3,
							'offset' => 0,
							'ignore_sticky_posts'=> true,
							'tax_query' => [
								[
									"operator" => 'IN',
									'taxonomy' => 'mainthemes',
									'field' => 'id',
									'terms' => [ '2110' ]
								],
							]
						] );

						if ( $query->have_posts() ) {
							$backgroundBlock =
								[
									'classes' => ['backgroundBlockMiddle','pit-stop'],
									'banner' => false,
									'dateAndViews' => false,
									'text' => false,
									'loadMore' => true,
								];
							$loadMore = [
								'classes' => [''],
								'offset'  => 3,
								'perView' => 3,
								'block'   => 'backgroundBlock__spec',
								'horizontalBar' => null,
								'verticalBar' => null,
							];
							require locate_template('includes/backgroundBlock.php');

						}
						wp_reset_postdata();
						?>

                        <div class="doubleFoxyF__foxyBlock foxyFBlock">
							<?php
							$banners = [
								'f1' => true,
								'f2' => true,
								'f3' => true,
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