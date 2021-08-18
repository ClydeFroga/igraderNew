

<?php
/*
Template name: Шаблон-лонгрид
*/
$ghost = 'Ghost';
$ID = get_the_ID();

$theme = get_the_terms($ID, 'mainthemes')[0];

if ($theme == null) {
	$theme = '1599';
} else {
	$theme = (string) $theme -> term_id;
}

$is_news = has_term(1599, 'mainthemes');

$brand = get_the_terms( $ID, 'brand' );
$journal = get_the_terms( $ID, 'magazins' );
if ($brand !== false) {
	$term_id = $brand[0] -> term_id;
	$image_id = get_term_meta( $term_id, '_thumbnail_id', 1 );
	$brandImgUrl = wp_get_attachment_image_url( $image_id, 'medium' );
//	$brandImgUrl = get_field('izobrazhenie', 'brand_' . $brand[0]->term_id);
	$brandUrl = get_field('url', 'brand_' . $brand[0]->term_id);
	$brandUrlPretty = get_field('krasivaya_ssylka', 'brand_' . $brand[0]->term_id);
}
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
    footer, .header, .newMag, #sliderLarge, .sendpulse, img  {
        filter: grayscale(100%);
    }
    a:not(.ghost) {
        filter: grayscale(100%);
    }

</style>

	<div class="wrapper">
		<?php get_sidebar('left'); ?>

		<?php if (!$is_news) { ?>

			<div class="wrapper__block marginAll">

				<div class="wrapper__content">
					<div class="container top">
						<?php get_template_part('includes/headerMenu'); ?>

						<section class="single">
							<div class="single__main">
								<?php get_template_part('includes/breadcrumbs'); ?>

								<div class="single__mainWrapper">
									<div class="single__mainContent">

										<?php if(has_post_thumbnail()) { ?>
											<div class="imgBlock imgBlockFull">
												<?php the_post_thumbnail('full'); ?>
											</div>
										<?php } ?>

										<h1>
											<?php the_title(); ?>
										</h1>

										<?php
										$dateAndViews =
											[
												'views'=> [
													'classes' => ['dark']
												],
												'date'=> true,
												'tags' => true,
											];

										require locate_template('includes/dateAndViews.php');
										?>

										<div class="single__mainContentHidden">
											<?php
											if ($brand !== false) { ?>
												<a target="_blank" href="<?php echo $brandUrl ?>" class="single__mainStickyRideSponsor">
													<div>
                                                        <span>
                                                            <?php echo $brand[0] -> name; ?>
                                                        </span>
														<img src="<?php echo $brandImgUrl; ?>">
													</div>

													<div>
                                                        <span class="buttonBlack">
                                                            <?php echo $brandUrlPretty; ?>
                                                        </span>
													</div>
												</a>
											<?php } ?>
										</div>

										<div  class="single__mainContentText">
											<?php the_content(); ?>
										</div>

										<?php if ($journal !== false) { ?>
											<div class="single__mainContentJournal">
												<a href="<?php echo get_term_link( $journal[0]->term_id, $journal[0]->taxonomy ) ?>">
													Статья опубликована в журнале <?php echo $journal[0] -> name; ?>
												</a>
											</div>
										<?php } ?>

										<div class="dateAndViews single__mainContentTags">
											<?php
											$dateAndViews =
												[
													'tags' => true,
												];

											require locate_template('includes/dateAndViews.php');
											?>
										</div>

                                        <?php
                                        $banners = [
                                            'c' => true
                                        ];
                                        require locate_template( 'includes/foxyes'. $ghost . '.php' );
                                        ?>
									</div>

									<div class="single__mainSticky">
										<div class="single__mainStickyRide">
											<?php
											if ($brand !== false) { ?>
												<a target="_blank" href="<?php echo $brandUrl ?>" class="single__mainStickyRideSponsor">
													<div>
                                                        <span>
                                                            <?php echo $brand[0] -> name; ?>
                                                        </span>
														<img src="<?php echo $brandImgUrl; ?>">
													</div>

													<div>
                                                        <span class="buttonBlack">
                                                            <?php echo $brandUrlPretty; ?>
                                                        </span>
													</div>
												</a>
											<?php }
											?>

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
											<?php
											require locate_template('includes/single__mainStickyRideSharing.php');
											?>
										</div>
									</div>
								</div>

							</div>

							<div class="single__secondary">
								<?php
								if($is_mobile) {
									$banners = [
										'd1' => true
									];
									require locate_template('includes/foxyesGhost.php');
								}
								?>

								<?php
								$banners = [
									'a' => true
								];
								require locate_template('includes/foxyesGhost.php');
								?>

								<div class="single__secondaryNews">
									<span class="largeTitle">партнёрский контент</span>

									<?php
									$query = new WP_Query( [
										'posts_per_page'      => 5,
										'offset'              => 0,
										'ignore_sticky_posts' => true,
										'tax_query'           => [
											[
												"operator" => 'IN',
												'taxonomy' => 'mainthemes',
												'field'    => 'id',
												'terms'    => [ $theme ]
											],
										]
									] );

									$horizontalBar =
										[
											'classes' => ['smallText'],
											'dateAndViews' => [
												'date' => true
											],
										];
									require locate_template( 'includes/horizontalBar.php' );
									?>

								</div>

								<?php
								if(!$is_mobile) {
									$banners = [
										'b1' => true
									];
									require locate_template( 'includes/foxyesGhost.php' );
									?>

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
										'b2' => true
									];
									require locate_template('includes/foxyesGhost.php');
									?>

									<div class="single__secondaryEnd"></div>
								<?php } ?>
							</div>
						</section>

						<?php
						if(!$is_mobile) {
							$banners = [
								'd1' => true
							];
							require locate_template('includes/foxyesGhost.php');
						}
						?>

						<?php get_template_part('includes/sendpulse'); ?>

						<section class="tripleBlock <?php if(!$is_mobile) echo 'withFoxyB' ?>">
							<div class="tripleBlock__first">

                                <span class="largeTitle" >
                                    Читайте также по теме
                                </span>

								<?php
								$query = new WP_Query( [
									'posts_per_page'      =>  6,
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
										'topDate' => [
											'classes' => ['dark'],
										],
									];
								$slider =
									[
										'id' => 'sliderSingleTop',
										'scrollbar' => true,
									];


								if ( $query->have_posts() ) {
									require locate_template( 'includes/slider.php' );
								}

								?>

							</div>

							<div class="tripleBlock__separator"></div>

							<?php
							if ($is_mobile) {
								$banners = [
									'b1' => true,
								];
								require locate_template( 'includes/foxyesGhost.php' );
							}
							?>

							<?php
							$perPage = 3;

							$query = new WP_Query( [
								'posts_per_page' => $perPage,
								'offset' => 0,
								'ignore_sticky_posts'=> true,
								'tax_query' => [
									[
										"operator" => 'IN',
										'taxonomy' => 'mainthemes',
										'field' => 'id',
										'terms' => [ '1603' ]
									],
								]
							] );
							$loadMore = [
								'offset'  => 3,
								'perView' => 3,
								'block'   => 'horizontalBarDiv',
								'horizontalBar' => $horizontalBar,
								'verticalBar' => null,
							];

							$horizontalBar =
								[
									'classes' => ['withBottom'],
									'bottom' => [
										'date' => true,
										'max' => 150
									],
									'loadMore' => true,
								];

							if ($is_mobile) {
								$horizontalBar =
									[
										'classes' => [''],
										'bottom' => false,
										'loadMore' => true,
										'dateAndViewsBot' => [
											'date' => true
										]
									];
							}

							$tripleBlock__second =
								[
									'title' => [
										'name' => 'Крупным планом',
										'catId' => 1603,
										'tax' => 'mainthemes',
									],
								];

							require locate_template( 'includes/tripleBlock__second.php' );
							?>

							<?php if (!$is_mobile) { ?>
								<div class="tripleBlock__third">
									<?php
									$banners = [
										'b3' => true,
										'b4' => true,
									];

									require locate_template( 'includes/foxyesGhost.php' );
									?>
								</div>
							<?php } ?>
						</section>
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
										'taxonomy' => 'mainthemes',
										'field'    => 'id',
										'terms'    => [ '1599' ]
									],
								]
							] );

							$slider =
								[
									'id' => 'sliderSec2',
									'cats' => false,
									'title' => [
										'name' => 'Дорожники',
										'catId' => 1599,
										'tax' => 'mainthemes',
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
						<?php
						$banners = [
							'd2' => true
						];
						require locate_template('includes/foxyesGhost.php');
						?>

						<section class="doubleFoxyB">
							<?php
							//                            $tickets = [
							//                                'classes' => $is_PC ? ['events'] : [''],
							//                                'loadMore' => true,
							//                                'text' => $is_PC ? true : false,
							//                            ];

							$per_page = $is_PC ? 3 : 4;

							$query = new WP_Query( [
								'posts_per_page' => $per_page,
								'offset' => 0,
								'ignore_sticky_posts'=> true,
								'tax_query'           => [
									[
										"operator" => 'IN',
										'taxonomy' => 'mainthemes',
										'field'    => 'id',
										'terms'    => [ '1599' ]
									],
								]
							] );

							//                            $loadMore = [
							//                                'classes' => ['fullWidthButton', 'black'],
							//                                'offset'  => $per_page,
							//                                'perView' => $per_page,
							//                                'block'   => 'tickets__block',
							//                                'horizontalBar' => null,
							//                                'verticalBar' => null,
							//                            ];
							$verticalBlock__botBlock =
								[
									'classes' => [''],
									'topDate' => false,
									'text' => [
										'max' => 130
									],
									'midDate' => false,
									'botDate' => [
										'date'  => [
											'classes' => [ 'dark' ]
										],
										'views' => true
									]
								];

							if ( $query->have_posts() ) { ?>
								<div class="verticalBlock inThree gap">
									<div class="verticalBlock__bot">
										<?php
										while ( $query->have_posts()) {
											$query-> the_post();
											require locate_template( 'includes/verticalBlock__botBlock.php' );
										}
										?>
									</div>
								</div>


							<?php }
							wp_reset_postdata();
							?>

							<div class="doubleFoxyB__foxyBlock">
								<?php
								$banners = [
									'b5' => !$is_mobile,
									'b2' => $is_mobile,
								];
								require locate_template('includes/foxyesGhost.php');
								?>
							</div>
						</section>

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
								require locate_template('includes/foxyesGhost.php');
								?>
							</div>
						</section>
					</div>
				</div>

			</div>

		<?php }
		?>

	</div>

<?php get_footer(); ?>

<script src="<?php bloginfo('template_url')?>/js/sticky.min.js"></script>

<script>
  window.addEventListener('load', () => {
    stickyScrollWatch()
  })
</script>


