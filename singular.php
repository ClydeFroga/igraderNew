<?php get_header();
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

if ($is_news) { ?>
    <script id="loadmore_single">
      let urls = ['<?php echo get_the_permalink() ?>'];
      let title = '<?php echo html_entity_decode(get_the_title()) ?>';
      let ajaxurl_single = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
      let offset = 0;
      let exclude = '<?php echo $ID; ?>';
      let pc = '<?php echo $is_PC; ?>';
      let ghost = '';
      // let checkedFoxyes2 = checkedFoxyes
    </script>
<?php }

$comTrans2021 = has_term( 2466, 'specials' );
?>

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

                                <?php
                                if($comTrans2021) {
                                    get_template_part('includes/specialsBanners/comTrans/cmtr2021');
                                }
                                ?>

                                <div class="single__mainWrapper">
                                    <div class="single__mainContent">

                                        <?php if(has_post_thumbnail()) { ?>
                                            <a title="" data-rl_caption="" data-rl_title="" data-rel="lightbox-gallery-0" href="<?php the_post_thumbnail_url(); ?>" class="imgBlock imgBlockFull">
                                                <?php the_post_thumbnail('full'); ?>
                                            </a>
                                            <span class="sign">
                                                <?php
                                                    echo the_post_thumbnail_caption();
                                                ?>
                                            </span>
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
	                                    require locate_template( 'includes/foxyes.php' );
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
                                    require locate_template('includes/foxyes.php');
                                }
                                ?>

                                <?php
                                $banners = [
                                    'a' => true
                                ];
                                require locate_template('includes/foxyes.php');
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
                                    require locate_template( 'includes/foxyes.php' );
                                ?>

                                <div class="verticalBlock__bot special">
                                    <?php
                                    $query = new WP_Query( [
                                        'posts_per_page'      => 1,
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
                                require locate_template('includes/foxyes.php');
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
                            require locate_template('includes/foxyes.php');
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
                                require locate_template( 'includes/foxyes.php' );
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

                                    require locate_template( 'includes/foxyes.php' );
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
                                        'taxonomy' => 'post_tag',
                                        'field'    => 'id',
                                        'terms'    => [ '223' ]
                                    ],
                                ]
                            ] );

                            $slider =
                                [
                                    'id' => 'sliderSec2',
                                    'cats' => false,
                                    'title' => [
                                        'name' => 'Дорожники',
                                        'catId' => 223,
                                        'tax' => 'post_tag',
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
                        require locate_template('includes/foxyes.php');
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
                                require locate_template('includes/foxyes.php');
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
                                require locate_template('includes/foxyes.php');
                                ?>
                            </div>
                        </section>
                    </div>
                </div>

            </div>

		<?php }
		else { ?>

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

        <?php } ?>

	</div>

<?php get_footer(); ?>

<?php if (!$is_news) { ?>

    <script src="<?php bloginfo('template_url')?>/js/sticky.min.js?version=3"></script>

    <script>
      window.addEventListener('load', () => {
        stickyScrollWatch()
      })
    </script>

<?php }
else { ?>
    <script type="text/javascript" src="<?php bloginfo('template_url')?>/js/loadMore.min.js?version=2"></script>
    <script>
      document.addEventListener('DOMContentLoaded', loadMoreOnNews )
    </script>
<?php } ?>