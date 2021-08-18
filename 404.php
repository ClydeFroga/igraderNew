<?php get_header();


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
}
$per_page = 9;

$query = new WP_Query( [
	'posts_per_page'      => $per_page,
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

?>

	<div class="wrapper">
		<?php get_sidebar('left'); ?>

		<div class="wrapper__block marginAll">

			<div class="wrapper__content">
				<div class="container top <?php if ($is_mobile) echo 'rubric'; ?>">
					<?php get_template_part('includes/headerMenu'); ?>

					<section class="page404">
						<img src="<?php bloginfo('template_url')?>/img/404.png">
						<form role="search" action="<?php echo home_url( '/' ); ?>" class="search ugly">
							<label>
								<input value="<?php echo get_search_query() ?>" name="s" id="s" class="form-control" type="text" placeholder="Поиск по сайту...">
								<button class="formAdd__button" id="searchsubmit">поиск</button>
							</label>
						</form>

					</section>

					<section class="withFoxy">
						<div class="horizontalBar around withBorder">
							<?php
							if ($query -> have_posts()) {
								$num           = 0;
								$horizontalBar =
									[
										'dateAndViewsBot' => [
											'classes' => [ 'start' ],
											'date'  => true,
											'views' => [ 'classes' => [ 'dark' ] ],
										],
										'text'         => $is_mobile ? false : [
											'max' => $is_PC ? 200 : 150,
										],
										'special' => true,
									];
								$max = !$is_mobile ? 3 : 2;

								while ($query -> have_posts() ) {
									$query -> the_post();
									require locate_template( 'includes/horizontalBarDiv.php' );
									$num ++;
									if ( $num == $max ) break;
								}
							}
							?>
						</div>

						<div>
							<?php
							$banners = [
								'a' => true,
								'b1' => !$is_mobile,
							];
							require locate_template('includes/foxyes.php');
							?>

							<?php
							if($is_mobile) { ?>
								<div class="horizontalBar around withBorder">
									<?php
									if ($query -> have_posts()) {
										$num           = 0;
										$horizontalBar =
											[
												'dateAndViewsBot' => [
													'classes' => [ 'start' ],
													'date'  => true,
													'views' => [ 'classes' => [ 'dark' ] ],
												],
												'text'         => $is_mobile ? false : [
													'max' => $is_PC ? 200 : 150,
												],
												'special' => true,
											];
										$max = 1;

										while ($query -> have_posts() ) {
											$query -> the_post();
											require locate_template( 'includes/horizontalBarDiv.php' );
											$num ++;
											if ( $num == $max ) break;
										}
									}
									?>
								</div>

								<?php
								$banners = [
									'b1' => true,
								];
								require locate_template('includes/foxyes.php');
								?>
							<?php }
							?>
						</div>
					</section>

					<section class="sliderBot">
						<?php
						$query = new WP_Query( [
							'posts_per_page' => 6,
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
								'control' => !$is_mobile,
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
									'classes' => [''],
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
					$banners = [
						'd1' => true
					];
					require locate_template('includes/foxyes.php');
					?>

					<section class="withFoxy">
						<div class="horizontalBar around withBorder">
							<?php
							if ($query -> have_posts()) {
								$num = 0;
								$max = !$is_mobile ? 3 : 2;

								while ($query -> have_posts() ) {
									$query -> the_post();
									require locate_template( 'includes/horizontalBarDiv.php' );
									$num ++;
									if ( $num == $max ) break;
								}
							}
							?>
						</div>

						<div>
							<?php
							$banners = [
								'b2' => true,
								'b3' => !$is_mobile,
							];
							require locate_template('includes/foxyes.php');
							?>

							<?php
							if($is_mobile) { ?>
								<div class="horizontalBar around withBorder">
									<?php
									if ($query -> have_posts()) {
										$num = 0;
										$max = 1;

										while ($query -> have_posts() ) {
											$query -> the_post();
											require locate_template( 'includes/horizontalBarDiv.php' );
											$num ++;
											if ( $num == $max ) break;
										}
									}
									?>
								</div>

								<?php
								$banners = [
									'b3' => true,
								];
								require locate_template('includes/foxyes.php');
								?>
							<?php }
							?>
						</div>
					</section>

					<section class="withFoxy">
						<div class="horizontalBar around withBorder">
							<?php
							if ($query -> have_posts()) {
								$num = 0;
								$max = !$is_mobile ? 3 : 2;

								while ($query -> have_posts() ) {
									$query -> the_post();
									require locate_template( 'includes/horizontalBarDiv.php' );
									$num ++;
									if ( $num == $max ) break;
								}
							}
							?>
						</div>

						<div>
							<?php
							$banners = [
								'b4' => true,
								'b5' => !$is_mobile,
							];
							require locate_template('includes/foxyes.php');
							?>

							<?php
							if($is_mobile) { ?>
								<div class="horizontalBar around withBorder">
									<?php
									if ($query -> have_posts()) {
										$num = 0;
										$max = 1;

										while ($query -> have_posts() ) {
											$query -> the_post();
											require locate_template( 'includes/horizontalBarDiv.php' );
											$num ++;
											if ( $num == $max ) break;
										}
									}
									?>
								</div>

								<?php
								$banners = [
									'b5' => true,
								];
								require locate_template('includes/foxyes.php');
								?>
							<?php }
							?>
						</div>
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

					<section class="doubleFoxyF withFMargin">

						<?php
						$posts_per_page = 10;
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

						if (!$is_mobile) { ?>
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
								'horizontalBar' => null,
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