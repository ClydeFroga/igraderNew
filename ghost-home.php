<?php
/*
Template name: Призрак-главная
*/
$ghost = 'Ghost';
?>

<!DOCTYPE html>
<html lang="<?php bloginfo('language');?>">

<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="<?php bloginfo('template_url')?>/style.css?version=1.3">
	<link rel="stylesheet" href="<?php bloginfo('template_url')?>/styles/swiper.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url')?>/styles/fonts.css">
	<?php if(is_singular() && has_category(1480)) echo "<meta name='robots' content='noindex,nofollow'>";?>
	<script src="https://yastatic.net/pcode/adfox/loader.js" crossorigin="anonymous"></script>
	<?php wp_head();?>
</head>

<body>

<?php dynamic_sidebar('protobaner'); ?>

<style>
    footer, .header, .newMag, #sliderLarge, .sendpulse  {
        filter: grayscale(100%);
    }
    a:not(.ghost) {
        filter: grayscale(100%);
    }

</style>

<div class="wrapper">
	<?php
	get_sidebar('left');
	?>

	<div class="wrapper__block marginAll">

		<div class="wrapper__content">
			<div class="container top">
				<?php get_template_part('includes/headerMenu'); ?>

				<?php
				$query = new WP_Query( [
					'posts_per_page' => 4,
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

				if ( $query->have_posts() ) {
					if($is_PC || $is_tablet) {
						$backgroundBlock =
							[
								'banner' => true,
								'dateAndViews' => true,
								'text' => true,
							];
						require locate_template('includes/backgroundBlock.php');
					}
					else if($is_mobile) {
						$mobileHorizontal = [
							'foxyPlace' => 2,
						];
						require locate_template('includes/mobileHorizontal.php');
					}
				}
				wp_reset_postdata();
				?>

				<section class="sliderTop">
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
							'cats' => true,
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
								'views' => [
									'classes' => [ 'dark' ]
								]
							]
						];
					if ( $query->have_posts() ) {
						shuffle($query -> posts);
						require locate_template( 'includes/slider.php' );
					}
					wp_reset_postdata(); ?>

					<div>
						<?php $banners = [
							'b1' => true
						];
						require locate_template('includes/foxyesGhost.php');

						if($is_tablet) { ?>
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

								if ( $query->have_posts() ) {
									require locate_template('includes/textBlock.php');
								}
								wp_reset_postdata();
								?>
							</div>
						<?php } ?>
					</div>
				</section>

				<?php
				$banners = [
					'd1' => true
				];
				require locate_template('includes/foxyesGhost.php');
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
							'foxy' => ['b2'],
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

				<section class="secondarySlider">
					<div class="secondarySlider__foxy">
						<?php
						if ($is_PC || $is_tablet) {
							$banners = [
								'b3' => true,
							];
						} else {
							$banners = [
								'b3' => true,
								'd2' => true
							];
						}

						require locate_template('includes/foxyesGhost.php');
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
							'offset' => $posts_per_page,
							'perView' => $posts_per_page,
							'block' => 'horizontalBarDiv',
							'horizontalBar' => null,
							'verticalBar' => null,
						];

						require locate_template( 'includes/tripleBlock__second.php' );

						?>

					<?php }


					wp_reset_postdata(); ?>

				</section>

				<?php
				if ($is_PC) {
					$banners = [
						'd2' => true
					];
					require locate_template( 'includes/foxyesGhost.php' );
				}
				?>
			</div>

			<?php
			if ($is_PC) {
				get_sidebar('right');
			}
			?>
		</div>

		<div class="wrapper__content dark">
			<div class="container">
				<section class="onDark slider verticalBlock">
					<?php
					$query = new WP_Query( [
						'posts_per_page'      => $is_PC || $is_tablet ? 4 : 1,
						'offset'              => 0,
						'ignore_sticky_posts' => true,
						'tax_query'           => [
							[
								"operator" => 'IN',
								'taxonomy' => 'category',
								'field'    => 'id',
								'terms'    => [ '1609' ]
							],
						]
					] );

					$slider =
						[
							'id' => 'sliderSec2',
							'cats' => false,
							'title' => [
								'name' => 'Дорожники',
								'catId' => 1609,
								'tax' => 'category',
							],
							'control' => true,
							'scrollbar' => false,
						];

					$verticalBlock__botBlock =
						[
							'classes' => ['swiper-slide'],
							'topDate' => [
								'classes' => ['orange'],
							],
							'botDate' => [
								'date'  => [
									'classes' => [ 'dark' ]
								],
								'views' => [
									'classes' => [ 'dark' ]
								]
							],
							'text' => [
								'max' => 200,
							]
						];
					if ( $query->have_posts() ) {
						require locate_template( 'includes/slider.php' );
					}
					wp_reset_postdata();
					?>
				</section>

			</div>
		</div>

		<div class="wrapper__content">
			<div class="container">
				<section class="sectionSelect">
					<span class="largeTitle">Обзор рынка</span>

					<div>
						<div>
							<div class="sectionSelect__sections">
                <span data-select="1613" class="sectionSelect__sectionsLine active">
                    Грузовая техника
                </span>
								<span data-select="1610" class="sectionSelect__sectionsLine">
                    Подъёмная техника
                </span>
								<span data-select="1609" class="sectionSelect__sectionsLine">
                    Дорожно-строительная техника
                </span>
								<span data-select="1616" class="sectionSelect__sectionsLine">
                    Пассажирский транспорт
                </span>
								<span data-select="1614" class="sectionSelect__sectionsLine">
                    Прицепная техника
                </span>
							</div>

							<div class="sectionSelect__blocks">
								<div  class="sectionSelect__blocksHidden verticalBlock active">
									<?php
									$query = new WP_Query( [
										'posts_per_page' => $is_PC ? 6 : 4,
										'offset' => 0,
										'ignore_sticky_posts'=> true,
										'tax_query' => [
											[
												"operator" => 'IN',
												'taxonomy' => 'category',
												'field' => 'id',
												'terms' => [ '1613' ]
											],
										]
									] );

									while ($query->have_posts()) {
										$query->the_post();

										$verticalBlock__botBlock = false;

										require locate_template( 'includes/verticalBlock__botBlock.php' );
									}

									if ($is_mobile) {
										$loadMore = [
											'offset'  => 4,
											'perView' => 4,
											'block'   => 'verticalBlock__botBlock',
											'load'    => 1,
										];
										require locate_template( 'includes/loadMore.php' );
									}
									?>

								</div>

								<div  class="sectionSelect__blocksHidden verticalBlock">

								</div>
								<div  class="sectionSelect__blocksHidden verticalBlock">

								</div>
								<div  class="sectionSelect__blocksHidden verticalBlock">

								</div>
								<div class="sectionSelect__blocksHidden verticalBlock">

								</div>


							</div>
						</div>

						<div>
							<?php
							$banners = [
								'b4' => true
							];
							require locate_template('includes/foxyesGhost.php');

							require locate_template('includes/sendpulseSmall.php');
							?>
						</div>
					</div>

				</section>
			</div>
		</div>

		<div class="wrapper__content middle-block">
			<div class="container ">
				<a href="<?php echo get_term_link(2110, 'mainthemes') ?>" class="orangeTitle">
                    <span>
                       Пит-стоп
                    </span>
				</a>

				<?php
				$query = new WP_Query( [
					'posts_per_page' => $is_mobile ? 3 : 6,
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

				$backgroundBlock =
					[
						'loadMore' => true,
						'classes' => ['backgroundBlockMiddle'],
					];


				$loadMore = [
					'offset'  => 3,
					'perView' => 3,
					'block'   => 'backgroundBlock__spec',
					'horizontalBar' => null,
					'verticalBar' => null,
				];
				if ( $query->have_posts() ) {
					require locate_template('includes/backgroundBlock.php');
				}



				wp_reset_postdata();
				?>

			</div>

			<?php
			require locate_template('includes/newMag.php');
			?>
		</div>

		<div class="wrapper__content">
			<div class="container">
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

				$unbelievable =
					[
						'banner' => 'b5',
					];


				if ( $query->have_posts() ) {
					$query -> the_post();
					require locate_template( 'includes/unbelievable.php' );
				}
				wp_reset_postdata();
				?>

				<section class="sliderBot">
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
								'terms' => [ '1605' ]
							],
						]
					] );

					$slider =
						[
							'id' => 'sliderBot',
							'control' => false,
							'scrollbar' => true,
							'title' => [
								'name' => 'Сервисмены',
								'catId' => 1605,
								'tax' => 'mainthemes',
							],
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
							],
						];
					if ( $query->have_posts() ) {
						require locate_template( 'includes/slider.php' );
					}
					wp_reset_postdata();
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
						'banner' => 'b6',
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

				<section class="tripleBlock">
					<div class="tripleBlock__first">

						<a class="largeTitle" href="<?php echo get_page_link(8499); ?>">
							Выставки
						</a>

						<?php echo do_shortcode('[events_list scope="future" limit=2]
                            <a href="#_EVENTURL" class="exhibition">
                                <div class="imgBlock imgBlockFull">
                                    <img src="#_EVENTIMAGEURL">
                                </div>
                                <div class="exhibition__date">
                                    <span class="notHidden">
                                        #_EVENTDATES
                                    </span>
                                    <span class="hidden">
                                        #_EVENTNAME
                                    </span>
                    
                                </div>
                                <div class="exhibition__dark">
                                    <span class="notHidden">#_EVENTNAME</span>
                                    <span class="hidden">
                                        #_EVENTDATES
                                    </span>
                                    <div class="dateAndViews"><span class="city light">#_LOCATIONTOWN</span></div>
                                </div>
                            </a>
                                [/events_list]')
						?>

					</div>

					<div class="tripleBlock__separator"></div>

					<?php
					$perPage = 3;
					if ($is_PC) {
						$perPage = 5;
					}
					if ($is_tablet) {
						$perPage = 4;
					}

					$query = new WP_Query( [
						'posts_per_page' => $perPage,
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
					$horizontalBar =
						[
							'classes' => ['around'],
							'loadMore' => true,
							'dateAndViewsBot' => [
								'date' => true,
							]
						];
					$loadMore = [
						'offset'  => 3,
						'perView' => 3,
						'block'   => 'horizontalBarDiv',
						'horizontalBar' => $horizontalBar,
						'verticalBar' => null,
					];
					$tripleBlock__second =
						[
							'classes' => $is_mobile ? ['inColumnTablet'] : false,
							'title' => [
								'name' => 'Спецпредложения',
								'catId' => 1980,
								'tax' => 'mainthemes',
							],
						];

					require locate_template( 'includes/tripleBlock__second.php' );
					?>

					<div class="tripleBlock__third foxyFBlock">
						<?php
						$banners = [
							'f1' => true,
							'f2' => true,
							'f3' => true
						];
						require locate_template( 'includes/foxyesGhost.php' );
						?>
					</div>

				</section>


				<?php
				//                if(!$is_mobile) {
				if(false) {
					$terms = get_terms( [
						'taxonomy' => 'brand',
						'hide_empty' => false,
						'number' => $is_PC ? 4 : 2,
					] );

					if (!is_wp_error($terms)) { ?>
						<section class="brandsList">
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
				?>
			</div>


		</div>

		<?php //if(!$is_mobile) {
		if(false) {
			?>


			<div class="wrapper__content dark">
				<div class="container">
					<?php
					$catalog = [
						'loadMore' => true,
					];

					$per_page = $is_PC ? 4 : 2;

					$query = new WP_Query( [
						'posts_per_page' => $per_page,
						'offset' => 0,
						'ignore_sticky_posts'=> true,
						'post_type' => 'advertisement'
					] );

					$loadMore = [
						'classes' => ['fullWidthButton', 'white'],
						'offset'  => $per_page,
						'perView' => $per_page,
						'block'   => 'catalog__block',
						'horizontalBar' => null,
						'verticalBar' => null,
					];

					if ( $query->have_posts() ) {
						require locate_template( 'includes/catalog.php' );
					}
					wp_reset_postdata();
					?>

				</div>
			</div>

		<?php } ?>

		<div class="wrapper__content">
			<div class="container">
				<?php
				if (false) {
					$tickets = [
						'loadMore' => true,
						'text' => true,
						'price' => true,
						'button' => true,
					];

					$per_page = $is_tablet ? 2 : 4;

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

				?>

				<?php if(!$is_mobile) {
					get_template_part('includes/sendpulse');
				} ?>
			</div>

		</div>
	</div>

</div>

<?php get_footer(); ?>

