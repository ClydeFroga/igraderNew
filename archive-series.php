<?php get_header();
?>

	<div class="wrapper">
		<?php get_sidebar('left'); ?>

		<div class="wrapper__block marginAll">

			<div class="wrapper__content">
				<div class="container top magArchive">
					<?php get_template_part('includes/headerMenu'); ?>

					<section class="withFoxy">
						<div>
							<?php require locate_template('includes/breadcrumbs.php'); ?>

							<div class="magArchive__part1">

								<?php
								$magazines = get_terms(array(
									'taxonomy' => 'magazins',
									'number' => $is_PC ? '9' : '4',
									'orderby' => 'slug',
									'order' => 'DESC',
								));
								foreach( $magazines as $mag ) {
									require locate_template('includes/magazine__item.php');
								} ?>

							</div>

						</div>

						<div>
							<?php
							$banners = [
								'a' => true
							];
							require locate_template('includes/foxyes.php');
							?>
						</div>

					</section>

					<?php
					$banners = [
						'd1' => true
					];
					require locate_template('includes/foxyes.php');
					?>

					<section class="withFoxy">
						<div>
							<div class="magArchive__part2">

								<?php
								$magazines = get_terms(array(
									'taxonomy' => 'magazins',
									'offset' => $is_PC ? '9' : '4',
									'number' => $is_PC ? '9' : '4',
									'orderby' => 'slug',
									'order' => 'DESC',
								));
								foreach( $magazines as $mag ) {
									require locate_template('includes/magazine__item.php');
								} ?>

							</div>

							<script>
                              var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                              var offset = <?php echo $is_PC ? 18 : 8 ?>;
							</script>

					        <span id="archiveLoad" class="buttonBlack fullWidthButton full">
					          Загрузить еще
					        </span>

						</div>

						<div>
							<?php
							$banners = [
								'b1' => true,
								'b2' => true,
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

					<section class="secondarySlider">
						<?php
						if ( !$is_mobile) { ?>
							<div class="secondarySlider__foxy">
								<?php
								$banners = [
									'b3' => true,
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
								'id' => 'sliderSec1',
								'control' => true,
								'title' => [
									'name' => 'Обзор техники',
									'catId' => 1599,
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
									'b3' => true,
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


					if ( $query1->have_posts() ) {
						$secondaryText =
							[
//								'foxy' => !$is_mobile ? ['b4'] : ['b4'],
								'foxy' => ['b4'],
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
									'b5' => true
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

					$sliderLarge =
						[
							'classes' => $is_mobile ? ['reverse'] : false,
							'banner' => $is_PC || $is_mobile ? 'b6' : 'b5',
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
								<?php if ( !$is_mobile ) { ?>
									<div class="doubleFoxyB__foxyBlock noMargin">
										<?php
										$banners = [
											'b6' => true
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