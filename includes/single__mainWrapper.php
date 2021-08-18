<div class="single__mainWrapper">

	<div class="single__main">
		<?php
		if ( $offset == NULL) {
			get_template_part( 'includes/breadcrumbs' );
		}?>

		<div class="single__mainContent">
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

			<div class="imgBlock imgBlockFull">
				<?php the_post_thumbnail('full'); ?>
			</div>
            <span class="sign">
                                                <?php
                                                echo the_post_thumbnail_caption();
                                                ?>
                                            </span>
			<?php
			if ($brand !== NULL && $brand !== false) {?>
                <div class="single__mainContentHidden">
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
                </div>
			<?php }
			?>
			<div  class="single__mainContentText">
				<div class="single__contentLeftText">

					<?php the_content(); ?>

				</div>
			</div>

			<?php
			if ( $offset == NULL) {
				$banners = [
					'c1' => true
				];
			}
			elseif ($offset == 0) {
				$banners = [
					'c2' => true
				];
            }
            elseif ($offset == 1) {
				$banners = [
					'c3' => true
				];
			}
            elseif ($offset == 2) {
				$banners = [
					'c4' => true
				];
			}
            elseif ($offset == 3) {
				$banners = [
					'c5' => true
				];
			}
            elseif ($offset == 4) {
				$banners = [
					'c' => true
				];
			}
			require locate_template( 'includes/foxyes'. $ghost . '.php' );
			?>

			<?php
			require locate_template('includes/single__mainStickyRideSharing.php');
			?>

		</div>

        <?php
        if ($is_PC) { ?>
            <div class="single__mainSticky">
                <div class="single__mainStickyRide">
                    <div class="verticalBlock__bot special">
                        <?php
                        $query = new WP_Query( [
                            'posts_per_page'      => 1,
                            'offset'              => $offset !== NULL ? $offset + 1 : 0,
                            'ignore_sticky_posts' => true,
                            'post_status' => 'publish',
                            'tax_query'           => [
                                [
                                    "operator" => 'IN',
                                    'taxonomy' => 'mainthemes',
                                    'field'    => 'id',
                                    'terms'    => [ '1601' ]
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
                </div>
            </div>
        <?php } ?>
	</div>

	<div class="single__secondary">
		<div>
			<?php
			if ( $offset == NULL) {
				$banners = [
					'a' => true
				];
				require locate_template( 'includes/foxyes'. $ghost . '.php' );

				if ( $is_mobile) {
				?>

                <div class="verticalBlock__bot special">
					<?php
					$query = new WP_Query( [
						'posts_per_page'      => 1,
						'offset'              => $offset !== NULL ? $offset + 1 : 0,
						'ignore_sticky_posts' => true,
						'tax_query'           => [
							[
								"operator" => 'IN',
								'taxonomy' => 'mainthemes',
								'field'    => 'id',
								'terms'    => [ '1601' ]
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

			<?php }
			}
			?>

			<?php
			if ( $offset == NULL) {
				$banners = [
					'b1' => true
				];
			}
			elseif ( $offset == 0) {
				$banners = [
					'b2' => true
				];
            }
            elseif ( $offset == 1) {
				$banners = [
					'b3' => true
				];
			}
            elseif ( $offset == 2) {
				$banners = [
					'b4' => true
				];
			}
            elseif ( $offset == 3) {
				$banners = [
					'b5' => true
				];
			}
            elseif ( $offset == 4) {
				$banners = [
					'b6' => true
				];
			}
			require locate_template( 'includes/foxyes'. $ghost . '.php' );
			?>
		</div>

	</div>

	<?php
    if ( $offset == NULL) {
	    get_template_part('includes/sendpulseForNews');
    }
    ?>

	<?php
	if ( $offset == NULL) {
		$banners = [
			'd1' => true
		];
		require locate_template( 'includes/foxyes'. $ghost . '.php' );
	}
	elseif ( $offset == 1) {
		$banners = [
			'd2' => true
		];
		require locate_template( 'includes/foxyes'. $ghost . '.php' );
    }
	?>
</div>

<?php if ( $offset !== NULL) { ?>
    <script>
      urls.push('<?php echo get_the_permalink() ?>')
      checkedFoxyes.loadNews()
    </script>
<?php } ?>