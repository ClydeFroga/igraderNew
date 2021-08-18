<?php
/*
Template name: Шаблон-новость
*/
$ghost = 'Ghost';
$ID = get_the_ID();

$theme = get_the_terms($ID, 'mainthemes')[0];

if ($theme == null) {
	$theme = '1599';
} else {
	$theme = (string) $theme -> term_id;
}

$is_news = true;

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
<script id="loadmore_single">
  let urls = ['<?php echo get_the_permalink() ?>'];
  let title = '<?php echo html_entity_decode(get_the_title()) ?>';
  let ajaxurl_single = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
  let offset = 0;
  let exclude = '<?php echo $ID; ?>';
  let pc = '<?php echo $is_PC; ?>';
  let ghost = 'Ghost';
</script>
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


        <div class="wrapper__block singleBody news">

            <div class="wrapper__content">
                <div class="container top ">
					<?php get_template_part('includes/headerMenu'); ?>

                    <section class="single">
						<?php require locate_template('includes/single__mainWrapper.php'); ?>
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

<script type="text/javascript" src="<?php bloginfo('template_url')?>/js/loadMore.min.js?version=2"></script>
<script>
  document.addEventListener('DOMContentLoaded', loadMoreOnNews )
</script>


