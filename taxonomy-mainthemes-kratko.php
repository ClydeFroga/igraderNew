<?php get_header();

$per_page = 16;
if($is_tablet) {
	$per_page = 14;
}
query_posts($query_string . "&posts_per_page=". $per_page . '&post_status=publish');
?>

	<div class="wrapper">
		<?php
		get_sidebar('left');
		?>

		<div class="wrapper__block">

			<div class="wrapper__content">
				<div class="container top newsPage">
					<?php get_template_part('includes/headerMenu'); ?>

					<section class="withFoxy">
						<div class="">
							<div class="newsPage__top">
								<?php get_template_part('includes/breadcrumbs'); ?>

								<h1 class="rubricTitle">
									<?php echo single_term_title('', 0); ?>
	                            </h1>
								<?php if (!$is_mobile) { ?>
									<span class="rubricDesc">
	                                     <?php echo term_description(); ?>
	                                </span>
								<?php } ?>
							</div>


							<?php if (!$is_mobile) { ?>
								<section class="tickets news">
									<div>
										<?php
										$tickets = [
											'loadMore' => false,
											'text' => [
												'max' => $is_PC ? 150 : 100
											],
										];
										$dateAndViews = [
											'category' => [
												'classes' => ['transparent']
											]
										];

										if ( have_posts() ) {
											$num = 0;
											while( have_posts()) {
												the_post();
												require locate_template( 'includes/tickets__blockNews.php' );
												$num++;
												if ($num === 2) break;
											}
										}
										?>

									</div>
								</section>
							<?php }
							else { ?>
								<section class="mobileHorizontal">
									<?php
									if ( have_posts() ) {
										$num = 0;
										while( have_posts()) {
											the_post();
											require locate_template('includes/mobileHorizontal__blc.php'); 											$num++;
											if ($num === 2) break;
										}
									}
									?>
								</section>
							<?php } ?>
						</div>

						<div>
							<?php
							$banners = [
								'a' => true,
								'b1' => !$is_mobile,
							];
							require locate_template('includes/foxyes.php');
							?>
						</div>
					</section>

					<section class="forked">
						<?php if ($is_PC) { ?>
							<div class="forked__left">
								<div class="rightAside__darkBlock">
									<span class="smallTitle">Материал дня</span>

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

									$wrongBlock = [
										'classes' => ['dedicated']
									];
									if ( $query->have_posts() ) {
										require locate_template('includes/wrongBlock.php');
									}
									wp_reset_postdata();
									?>

								</div>
							</div>
						<?php } ?>

						<div class="forked__right">

							<div class="horizontalBar around withBorder">
								<?php
								if (have_posts()) {
									$num           = 0;
									$horizontalBar =
										[
											'loadMore'     => false,
											'dateAndViewsBot' => [
												'classes' => !$is_mobile ? [ 'start' ] : [''],
												'date'  => true,
												'views' => [ 'classes' => [ 'dark' ] ],
											],
											'text'         => $is_mobile ? false : [
												'max' => $is_PC ? 200 : 150,
											],
											'special' => true,
											'mobile' => $is_mobile,
										];
									while ( have_posts() ) {
										the_post();
										require locate_template( 'includes/horizontalBarDiv.php' );
										$num ++;
										if ( $num === 3 )break;
									}
								}
								?>
							</div>
						</div>
					</section>

					<?php
					$banners = [
						'd1' => true,
						'b1' => $is_mobile,
					];
					require locate_template('includes/foxyes.php');
					?>

					<?php if ($is_mobile) { ?>
						<div class="horizontalBar around withBorder">
							<?php
							if (have_posts()) {
								$num           = 0;

								while ( have_posts() ) {
									the_post();
									require locate_template( 'includes/horizontalBarDiv.php' );
									$num ++;
									if ( $num === 1 )break;
								}
							}
							?>
						</div>
					<?php
						$banners = [
							'b2' => true,
						];
						require locate_template('includes/foxyes.php');
					} ?>

					<section class="withFoxy <?php if ($is_tablet) echo 'transform'; ?>">
						<?php if ($is_tablet) { ?>
							<div class="horizontalBar around withBorder">
								<?php
								if (have_posts()) {
									$num           = 0;
									$horizontalBar =
										[
											'loadMore'     => false,
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
									while ( have_posts() ) {
										the_post();
										require locate_template( 'includes/horizontalBarDiv.php' );
										$num ++;
										if ( $num === 1 )break;
									}
								}
								?>
							</div>
						<?php } ?>

						<div class="horizontalBar around withBorder">
							<?php
							if (have_posts()) {
								$num           = 0;
								$horizontalBar =
									[
										'loadMore'     => false,
										'dateAndViewsBot' => [
											'classes' => !$is_mobile ? [ 'start' ] : [''],
											'date'  => true,
											'views' => [ 'classes' => [ 'dark' ] ],
										],
										'text'         => $is_mobile ? false : [
											'max' => $is_PC ? 200 : 150,
										],
										'special' => true,
										'mobile' => $is_mobile,
									];
								$max = 5;
								if($is_tablet) {
									$max = 3;
								}
								if ( $is_mobile) {
									$max = 6;
								}
								while ( have_posts() ) {
									the_post();
									require locate_template( 'includes/horizontalBarDiv.php' );
									$num ++;
									if ( $num === $max ) break;
								}
							}
							?>
						</div>

						<div>
							<?php
							$banners = [
								'b2' => !$is_mobile,
								'b3' => $is_mobile,
							];
							require locate_template('includes/foxyes.php');
							?>
						</div>
					</section>

					<section class="withFoxy">
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
								'cats' => $is_mobile ? false : true,
								'control' => $is_mobile ? false : true,
								'scrollbar' => $is_mobile ? true : false,
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
								]
							];
						if ( $query->have_posts() ) {
							shuffle($query -> posts);
							require locate_template( 'includes/slider.php' );
						}
						wp_reset_postdata(); ?>

						<?php if (!$is_mobile) { ?>
						<div>
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
						'd2' => true,
					];
					require locate_template('includes/foxyes.php');
					?>

					<section class="withFoxy">
						<div>
							<div class="horizontalBar around withBorder">
								<?php
								if (have_posts()) {
									$num           = 0;
									$max = $is_mobile ? 4 : 6;
									$loadMore = [
										'classes' => ['buttonBlack'],
										'offset'  => $per_page,
										'perView' => 10,
										'block'   => 'horizontalBarDiv',
										'horizontalBar' => $horizontalBar,
										'verticalBar' => null,
										'forRubric' => true,
									];
									while ( have_posts() ) {
										the_post();
										require locate_template( 'includes/horizontalBarDiv.php' );
										$num ++;
										if ( $num === $max ) break;
									}
									require locate_template( 'includes/loadMore.php' );
								}
								?>
							</div>
						</div>

						<div class="<?php if (!$is_PC) echo 'between'; ?>">
							<?php
							$banners = [
								'b4' => true,
								'b5' => !$is_mobile,
							];
							require locate_template('includes/foxyes.php');
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
									'taxonomy' => 'mainthemes',
									'field'    => 'id',
									'terms'    => [ '1980' ]
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
											'catId' => 1980,
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

							$banners = [
								'b5' => true,
							];
							require locate_template('includes/foxyes.php');

							get_template_part( 'includes/sendpulse' );
						}
						?>

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