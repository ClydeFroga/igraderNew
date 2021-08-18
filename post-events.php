<?php get_header(); ?>

	<div class="wrapper">
		<?php
		get_sidebar('left');
		?>

		<div class="wrapper__block marginAll">

			<div class="wrapper__content">
				<div class="container top">
					<?php get_template_part('includes/headerMenu'); ?>

					<section class="withFoxy">
						<div class="">
							<div class="">
								<?php get_template_part('includes/breadcrumbs'); ?>

								<span class="rubricTitle margin">
	                                Мероприятия
	                            </span>

							</div>

							<div class="horizontalBar around events">
								<?php
                                if (!$is_mobile) {
	                                echo do_shortcode('[events_list scope="future" limit=6 offset=0 orderby="event_start_date" order="ASC"]
								<a href="#_EVENTURL" class="horizontalBar__blc">
									<div class="horizontalBar__blcLeft imgBlock">
										<img src="#_EVENTIMAGEURL">
									</div>
									<div class="horizontalBar__blcRight">
                                    <span class="horizontalBar__blcRightTitle">
                                        #_EVENTNAME
                                    </span>
										<div class="dateAndViews start">
                                        <span class="eventsDate">
                                            #_EVENTDATES
                                        </span>
											<span class="city">
                                            #_LOCATIONTOWN
                                        </span>
										</div>
										<span class="horizontalBar__blcRightText">
											#_EVENTEXCERPT{25,...}
										</span>
									</div>
								</a>
								[/events_list]');
                                }
                                else {
	                                echo do_shortcode('[events_list scope="future" limit=2 offset=0 orderby="event_start_date" order="ASC"]
								<a href="#_EVENTURL" class="horizontalBar__blc">
									<div class="horizontalBar__blcLeft imgBlock">
										<img src="#_EVENTIMAGEURL">
									</div>
									<div class="horizontalBar__blcRight">
                                    <span class="horizontalBar__blcRightTitle">
                                        #_EVENTNAME
                                    </span>
										<div class="dateAndViews start">
                                        <span class="eventsDate">
                                            #_EVENTDATES
                                        </span>
											<span class="city">
                                            #_LOCATIONTOWN
                                        </span>
										</div>
										<span class="horizontalBar__blcRightText">
											#_EVENTEXCERPT{25,...}
										</span>
									</div>
								</a>
								[/events_list]');
                                }
								if (!$is_mobile) {
								?>
                                    <span id="eventsLoad" class="buttonBlack full">Показать еще ↓</span>
                                <?php } ?>
							</div>
						</div>

						<div>
							<?php
							$banners = [
								'a' => true
							];
							require locate_template('includes/foxyes.php');
							?>
                            <?php if (!$is_mobile) { ?>
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
                            <?php } else { ?>
                                <div class="horizontalBar around events">
		                            <?php
		                            if ($is_mobile) {
			                            echo do_shortcode('[events_list scope="future" limit=2 offset=2 orderby="event_start_date" order="ASC"]
								<a href="#_EVENTURL" class="horizontalBar__blc">
									<div class="horizontalBar__blcLeft imgBlock">
										<img src="#_EVENTIMAGEURL">
									</div>
									<div class="horizontalBar__blcRight">
                                    <span class="horizontalBar__blcRightTitle">
                                        #_EVENTNAME
                                    </span>
										<div class="dateAndViews start">
                                        <span class="eventsDate">
                                            #_EVENTDATES
                                        </span>
											<span class="city">
                                            #_LOCATIONTOWN
                                        </span>
										</div>
										<span class="horizontalBar__blcRightText">
											#_EVENTEXCERPT{25,...}
										</span>
									</div>
								</a>
								[/events_list]');
		                            } ?>
                                </div>
                            <?php } ?>
							<?php
							$banners = [
								'b1' => true
							];
							require locate_template('includes/foxyes.php');
							?>
                            <div class="horizontalBar around events">
								<?php
								if ($is_mobile) {
									echo do_shortcode('[events_list scope="future" limit=2 offset=4 orderby="event_start_date" order="ASC"]
								<a href="#_EVENTURL" class="horizontalBar__blc">
									<div class="horizontalBar__blcLeft imgBlock">
										<img src="#_EVENTIMAGEURL">
									</div>
									<div class="horizontalBar__blcRight">
                                    <span class="horizontalBar__blcRightTitle">
                                        #_EVENTNAME
                                    </span>
										<div class="dateAndViews start">
                                        <span class="eventsDate">
                                            #_EVENTDATES
                                        </span>
											<span class="city">
                                            #_LOCATIONTOWN
                                        </span>
										</div>
										<span class="horizontalBar__blcRightText">
											#_EVENTEXCERPT{25,...}
										</span>
									</div>
								</a>
								[/events_list]'); ?>

                                <span id="eventsLoad" class="buttonBlack full">Показать еще ↓</span>
								<?php } ?>
                            </div>
						</div>
					</section>

					<?php
					$banners = [
						'd1' => true
					];
					require locate_template('includes/foxyes.php');
					?>

                    <section class="withFoxy">
	                    <?php
	                    $a = get_option( 'sticky_posts' );

	                    $query = new WP_Query( [
		                    'posts_per_page' => 8,
		                    'ignore_sticky_posts'=>true,
		                    'post__in' => $a,
	                    ] );

	                    $slider =
		                    [
			                    'id' => 'sliderTop',
			                    'cats' => !$is_mobile,
			                    'control' => !$is_mobile,
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
				                    'views' => [
					                    'classes' => [ 'dark' ]
				                    ]
			                    ]
		                    ];
	                    if ( $query->have_posts() ) {
		                    require locate_template( 'includes/slider.php' );
	                    }
	                    wp_reset_postdata(); ?>

                        <div>
                            <?php $banners = [
			                'b2' => true
		                ];
		                require locate_template('includes/foxyes.php');
                            ?>
                        </div>
                    </section>

                    <?php if (!$is_mobile) { ?>
                        <hr class="hrSmall">
                    <?php } ?>

                    <section class="withFoxy">

                        <section class="tickets events ">
                            <a href="#" class="largeTitle">Итоги мероприятий</a>
                            <div>
	                            <?php
	                            $tickets = [
		                            'loadMore' => true,
		                            'text' => true,
	                            ];

	                            $per_page = 6;
	                            if ( $is_tablet) {
		                            $per_page = 4;
                                } elseif ( $is_mobile) {
		                            $per_page = 3;
                                }

	                            $query = new WP_Query( [
		                            'posts_per_page' => $per_page,
		                            'offset' => 0,
		                            'ignore_sticky_posts'=> true,
		                            'tax_query' => [
			                            [
				                            "operator" => 'IN',
				                            'taxonomy' => 'mainthemes',
				                            'field' => 'id',
				                            'terms' => [ '1980' ]
			                            ],
		                            ]
	                            ] );

	                            $loadMore = [
		                            'classes' => ['buttonBlack', 'full', 'fullWidthButton'],
		                            'offset'  => $per_page,
		                            'perView' => $per_page,
		                            'block'   => 'tickets__blockEvents',
		                            'horizontalBar' => null,
		                            'verticalBar' => null,
	                            ];

	                            if ( $query->have_posts() ) {
	                                while ( $query->have_posts()) {
		                                $query->the_post();
		                                require locate_template( 'includes/tickets__blockEvents.php' );
                                    }
		                            require locate_template( 'includes/loadMore.php' );
	                            }
	                            wp_reset_postdata();
	                            ?>
                            </div>
                        </section>

                        <div>
	                        <?php
	                        $banners = [
		                        'b3' => true
	                        ];
	                        require locate_template('includes/foxyes.php');
	                        ?>
                        </div>
                    </section>

					<?php
					$banners = [
						'd2' => true
					];
					require locate_template('includes/foxyes.php');
					?>

					<?php
					$query1 = new WP_Query( [
						'posts_per_page' => 4,
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
					$query2 = new WP_Query( [
						'posts_per_page' => 4,
						'offset' => 0,
						'ignore_sticky_posts'=> true,
						'tax_query' => [
							[
								"operator" => 'IN',
								'taxonomy' => 'mainthemes',
								'field' => 'id',
								'terms' => [ '1600' ]
							],
						]
					] );

					if ( $query1->have_posts() ) {
						$secondaryText =
							[
								'foxy' => $is_tablet ? ['b4', 'b5']:['b4'] ,
								'classes' => false,
								'textBlock' => [
									'classes' => false,
									'title' => ['Новости', 'Аналитика'],
									'catId' => [1599, 1600],
									'tax' => ['mainthemes', 'mainthemes']
								],

							];

						require locate_template('includes/secondaryText.php');
					}
					wp_reset_postdata();
					?>

					<?php if ($is_mobile) {
						$banners = [
							'b5' => true
						];
						require locate_template('includes/foxyes.php');
					} ?>

					<?php if ($is_PC) { ?>
                        <section class="withFoxy">
                    <?php } ?>
                        <?php
                        $query = new WP_Query( [
	                        'posts_per_page'      =>  8,
	                        'offset'              => 0,
	                        'ignore_sticky_posts' => true,
	                        'tax_query'           => [
		                        [
			                        "operator" => 'IN',
			                        'taxonomy' => 'mainthemes',
			                        'field'    => 'id',
			                        'terms'    => [ '1605' ]
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
		                        'control' => $is_PC,
		                        'title' => [
			                        'name' => 'Сервисмены',
			                        'catId' => 1605,
			                        'tax' => 'mainthemes',
		                        ],
		                        'scrollbar' => $is_mobile,
	                        ];


                        if ( $query->have_posts() ) {
                            require locate_template( 'includes/slider.php' );
                        }

                        ?>

	                    <?php if ($is_PC) { ?>
                        <div>
                            <?php
                            $banners = [
	                            'b5' => true
                            ];
                            require locate_template('includes/foxyes.php');
                            ?>
                        </div>
                        <?php } ?>

                    <?php if ($is_PC) { ?>
                        </section>
                    <?php } ?>

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
							'classes' => $is_mobile ? ['reverse'] : false,
							'banner' => $is_PC ? 'b6' : false,
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
									'taxonomy' => 'post_tag',
									'field'    => 'id',
									'terms'    => [ '223' ]
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
