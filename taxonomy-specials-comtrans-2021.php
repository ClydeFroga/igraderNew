<?php
$pageID = get_the_ID();
$ID     = get_the_terms( $pageID, 'specials' )[0]->term_id;
//$ID     = 2372;


$title = single_term_title('', 0);
//$title = get_the_title();
$desc = term_description();
//$desc = get_the_content();


$per_page = 100;
//if($is_tablet) {
//    $per_page = 4;
//}

get_header();

query_posts($query_string . "&posts_per_page=". $per_page . '&post_status=publish');
?>


<div class="wrapper">
    <?php get_sidebar('left'); ?>

    <div class="wrapper__block marginAll">

        <div class="wrapper__content">
            <div class="container top">
                <?php get_template_part('includes/headerMenu'); ?>

                <section class="withFoxy">
                    <div class="marginAll">
                        <div class="rubric__top closeUp">
                            <?php get_template_part('includes/breadcrumbs'); ?>

                            <div class="rubric__topLine">
                                <h1 class="rubricTitle">
                                    <?php echo $title; ?>
                                </h1>
                            </div>

                            <span class="rubric__topDescription rubricDesc">
									<?php echo $desc; ?>
	                            </span>
                        </div>

                        <?php get_template_part('includes/specialsBanners/comTrans/cmtr2021'); ?>

                        <div class="verticalBlock closeUp">
                            <div class="verticalBlock__bot">
                                <?php
                                $verticalBlock__botBlock =
                                    [
                                        'classes' => [''],
                                        'classesAdd' => ['verticalBlock__botBlockWrapper'],
                                        'text' => [
                                            'max' => 200,
                                        ],
                                        'midDate' => [
                                            'classes' => [''],
                                            'category'  => [
                                                'classes' => [ 'transparent' ]
                                            ],
                                        ],
                                        'botDate' => [
                                            'classes' => ['start'],
                                            'date'  => [
                                                'classes' => [ 'dark' ]
                                            ],
                                            'views'  => [
                                                'classes' => [ 'dark' ]
                                            ],
                                        ]
                                    ];
                                $num = 0;
                                $max = 6;
                                if($is_mobile) {
                                    $max = 3;
                                }
                                $query = new WP_Query( [
                                    'posts_per_page' => $per_page,
                                    'offset' => 0,
                                    'ignore_sticky_posts'=>true,
                                    'tax_query' => [
                                        'relation' => 'AND',
                                        [
                                            "operator" => 'IN',
                                            'taxonomy' => 'specials',
                                            'field' => 'id',
                                            'terms' => [ $ID ]
                                        ],
                                    ]
                                ] );
                                while ($query -> have_posts()) {
                                    $query -> the_post();
                                    require locate_template( 'includes/verticalBlock__botBlock.php' );
//                                    if ($num == $max - 1) break;
//                                    $num++;
                                }

                                ?>
                            </div>
                        </div>

                    </div>

                    <div>
                        <?php
                        $banners = [
                            'a' => true
                        ];
                        require locate_template('includes/foxyes.php');
                        ?>

                        <?php
                        $banners = [
                            'b1' => true
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
        <?php if(false) { ?>
        <div class="wrapper__content dark">
            <div class="container">
                <section class="onDark slider verticalBlock">
                    <?php
                    $query = new WP_Query( [
                        'posts_per_page'      => $is_PC || $is_tablet ? 6 : 1,
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
                                'name' => 'Отраслевые решения',
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
        <?php } ?>
        <div class="wrapper__content">
            <div class="container marginAll">
                <?php
                $banners = [
                    'd1' => true
                ];
                require locate_template('includes/foxyes.php');
                ?>

                <section class="secondarySlider">
                    <?php
                    if ( !$is_mobile) { ?>
                        <div class="secondarySlider__foxy">
                            <?php
                            $banners = [
                                'b2' => true,
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
                                'b2' => true,
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
                $foxy = ['b3'];

                if ( $query1->have_posts() ) {
                    $secondaryText =
                        [
                            'foxy' => $foxy,
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

                    <div class="doubleFoxyB__foxyBlock">
                        <?php
                        $banners = [
                            'b4' => true,
                        ];
                        require locate_template('includes/foxyes.php');
                        ?>
                    </div>

                </section>

                <?php
                $query = new WP_Query( [
                    'posts_per_page' => 1,
                    'offset' => 0,
                    'ignore_sticky_posts'=> true,
                    'orderby' => 'rand',
                    'tax_query' => [
                        'relation' => 'AND',
                        [
                            "operator" => 'IN',
                            'taxonomy' => 'specials',
                            'field' => 'id',
                            'terms' => [ $ID ]
                        ],
                    ]
                ] );
                $foxy = 'b5';

                $sliderLarge =
                    [
                        'classes' => $is_mobile ? ['reverse', 'disabled'] : ['disabled'],
                        'banner' => $foxy,
                        'title' => [
                            'name' => 'Материал дня',
                            'catId' => 1606,
                            'tax' => 'mainthemes',
                        ],
                    ];

                if ( $query->have_posts() ) {
                    require locate_template( 'includes/sliderLarge.php' );
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
                $banners = [
                    'd2' => true
                ];
                require locate_template('includes/foxyes.php');
                ?>

            </div>
        </div>

    </div>

</div>


<?php get_footer(); ?>


