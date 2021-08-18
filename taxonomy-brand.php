<?php get_header();

global $query_string;
$term = get_queried_object();
$term_id = $term -> term_id;
$image_id = get_term_meta( $term_id, '_thumbnail_id', 1 );
$image_url = wp_get_attachment_image_url( $image_id, 'medium' );

$per_page = 6;
if($is_mobile) {
	$per_page = 9;
}
query_posts($query_string . "&posts_per_page=". $per_page . '&post_type=post');
?>

	<div class="wrapper">
		<?php get_sidebar('left'); ?>

		<div class="wrapper__block marginAll">

			<div class="wrapper__content rubricPage">
				<div class="container top">
					<?php get_template_part('includes/headerMenu'); ?>

					<section class="withFoxy string">
						<div class="rubric <?php if ($is_mobile) echo 'brandsPage'; ?>">
							<div class="rubric__top">

								<?php get_template_part('includes/breadcrumbs'); ?>

								<div class="rubric__topImg">
									<?php
									echo '<img src="'. $image_url .'" alt="" />';
									?>
								</div>
								<div class="rubric__topLine">
									<?php if (!is_search()) { ?>
										<h1 class="rubricTitle">
											<?php echo single_term_title('', 0); ?>
										</h1>
									<?php } ?>
								</div>
								<span class="rubric__topDescription rubricDesc">
									<?php echo term_description(); ?>
	                            </span>
							</div>

                            <div class="horizontalBar withBorder around">
                                <?php
                                if (have_posts()) {
                                    $num = 0;
                                    $horizontalBar =
                                        [
                                            'classes' => ['firstBack', 'around'],
                                            'loadMore' => true,
                                            'mobile' => $is_mobile,
                                            'dateAndViewsBot' => [
                                                'classes' => $is_PC ? ['start'] : [''],
                                                'category' => [
                                                    'classes' => ['transparent']
                                                ],
                                                'date' => [
                                                    'classes' => ['dark']
                                                ],
                                            ],
                                            'text' => $is_PC ? [
                                                'max' => 250
                                            ] : false,
                                        ];

                                    while (have_posts()) {
                                        the_post();
                                        require locate_template('includes/horizontalBarDiv.php');
                                        if($is_mobile && $num == 3) break;
                                        $num++;
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
                                    $wp->query_vars['post_type'] = 'post';
                                    if(!$is_mobile) require locate_template( 'includes/loadMore.php' );
                                }
                                ?>
                            </div>

						</div>

						<div class="<?php if ($is_mobile) echo 'marginAll'; ?>">

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
												'classes' => ['withBorder', 'around'],
												'loadMore' => true,
												'mobile' => $is_mobile,
												'dateAndViewsBot' => [
													'classes' => $is_PC ? ['start'] : [''],
													'category' => [
														'classes' => ['transparent']
													],
													'date' => [
														'classes' => ['dark']
													],
												],
												'text' => $is_PC ? [
													'max' => 250
												] : false,
											];

										while (have_posts()) {
											the_post();

											require locate_template('includes/horizontalBarDiv.php');
											$num++;
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

									?>
								</div>

							<?php } ?>

							<?php if(!$is_mobile) { ?>
								<?php
								$query = new WP_Query( [
									'posts_per_page' => 1,
									'offset' => 0,
									'ignore_sticky_posts'=> true,
									'post_type' => 'advertisement'
								] );
								if($query->have_posts()) {
									$tickets = [
										'button' => $is_PC,
										'text' => $is_PC,
										'price' => true,
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
							<?php } ?>
						</div>
					</section>

                    <section class="doubleFoxyB reverse">
                        <div class="doubleFoxyB__foxyBlock">
	                        <?php
	                        $banners = [
		                        'b1' => true
	                        ];
	                        require locate_template('includes/foxyes.php');
	                        ?>
                        </div>

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
									'terms'    => [ '1599' ]
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
								'id' => 'sliderTop',
								'control' => !$is_mobile,
								'cats' => !$is_mobile,
								'scrollbar' => $is_mobile,
								'title' => false,
							];


                        if ( $query->have_posts() ) {
                            require locate_template( 'includes/slider.php' );
                        }
						 ?>
                    </section>

					<?php
					$banners = [
						'd1' => true
					];
					require locate_template('includes/foxyes.php');
					?>

                    <section class="withFoxy">
                        <section class="brandsList brandPage">
                            <div>
                                <?php
                                $number = 6;
                                if($is_tablet) $number = 4;
                                if($is_mobile) $number = 2;

                                $terms = get_terms( [
	                                'taxonomy' => 'brand',
	                                'hide_empty' => true,
	                                'number' => $number,
                                ] );

                                foreach( $terms as $term ) {

	                                require locate_template( 'includes/brandsListBrandPage.php' );

                                }
                                ?>
                            </div>
                        </section>

                        <div class="between">
	                        <?php
	                        $banners = [
		                        'b2' => true,
		                        'b3' => !$is_mobile,
	                        ];
	                        require locate_template('includes/foxyes.php');
	                        ?>
                        </div>

                        <?php if ($is_mobile) { ?>

                            <section class="brandsList brandPage">
                                <div>
                                    <?php
                                    $terms = get_terms( [
                                        'taxonomy' => 'brand',
                                        'hide_empty' => true,
                                        'offset' => $number,
                                        'number' => $number,
                                    ] );

                                    foreach( $terms as $term ) {

                                        require locate_template( 'includes/brandsListBrandPage.php' );

                                    }
                                    ?>
                                </div>
                            </section>

                            <div class="between">
                                <?php
                                $banners = [
                                    'b3' => true,
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

                    <section class="withFoxy ">
                        <div class="">
                            <a class="largeTitle" href="<?php echo get_term_link(1606, 'mainthemes') ?>">
                                Страницы истории
                            </a>

                            <?php
                            $number = 8;
                            if($is_tablet) $number = 6;
                            if($is_mobile) $number = 3;

                            $query = new WP_Query( [
	                            'posts_per_page' => $number,
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
                            if ($query -> have_posts()) {
                                if($is_PC) {
	                                $horizontalBar =
		                                [
			                                'classes' => ['withBorder', 'around'],
			                                'loadMore' => false,
			                                'dateAndViewsBot' => [
				                                'classes' => $is_PC ? ['start'] : [''],
				                                'views' => [
					                                'classes' => ['dark']
				                                ],
				                                'date' => [
					                                'classes' => ['dark']
				                                ],
			                                ],
			                                'text' =>[
				                                'max' => 250
			                                ],
			                                'special' => true,
		                                ];

	                                require locate_template('includes/horizontalBar.php');

                                } else {
	                                $verticalBlock__botBlock =
		                                [
			                                'classes' => [''],
			                                'botDate' => [
				                                'date'  => [
					                                'classes' => [ 'dark' ]
				                                ],
				                                'views' => [
					                                'classes' => [ 'dark' ]
				                                ]
			                                ]
		                                ];
	                                ?>

                                     <div class="verticalBlock ugly">
                                         <div class="verticalBlock__bot">

                                         <?php
                                         $num = 0;
                                         while ($query -> have_posts()) {
                                             if($num != 0 && $is_mobile) break;
                                             $query -> the_post();
	                                         require locate_template('includes/verticalBlock__botBlock.php');
	                                         $num++;
                                         }
                                         ?>

                                         </div>
                                     </div>
                                <?php }

                            }

                            ?>

                        </div>

                        <div class="between">
	                        <?php
	                        $banners = [
		                        'b4' => true,
		                        'b5' => !$is_mobile,
	                        ];
	                        require locate_template('includes/foxyes.php');
	                        ?>
                            <?php if ($is_PC) { ?>
                                <div class="foxyFBlock">
		                            <?php
		                            $banners = [
			                            'f1' => true,
			                            'f2' => true,
			                            'f3' => true,
		                            ];
		                            require locate_template('includes/foxyes.php');
		                            ?>
                                </div>
                            <?php } ?>
                        </div>

                        <?php
                        if($is_mobile) { ?>
                            <div class="verticalBlock ugly">
                                <div class="verticalBlock__bot">
			                        <?php
			                        $num = 0;
			                        while ($query -> have_posts()) {
				                        if($num == 0) {
					                        $num ++;
					                        continue;
				                        }
				                        $query -> the_post();
				                        require locate_template('includes/verticalBlock__botBlock.php');
			                        }
			                        ?>
                                </div>
                            </div>
                        <?php }
                        ?>

                    </section>

					<?php if (!$is_PC) { ?>
                        <div class="foxyFBlock">
							<?php
							$banners = [
								'f1' => true,
								'f2' => true,
								'f3' => true,
							];
							require locate_template('includes/foxyes.php');
							?>
                        </div>
					<?php } ?>

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