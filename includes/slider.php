<?php
/*
    $slider =
	[
        'id' => int,
        'control' => string,
        'cats' => boolean,
        'scrollbar' => boolean
        'title' => [
            'name' => string,
            'catId' => int,
            'tax' => string,
         ],
    ];
 */
?>

<div class="slider verticalBlock">

	<div class="verticalBlock__bot">
        <div class="slider__top">
			<?php if($slider['cats'] && !$is_mobile) {
				$idArr = [];
				foreach($query -> posts as $post) {
					$idArr[] = $post -> ID;
				}
				$catArr = [];
				$nameArr = [];
				foreach ($idArr as $arg) {
					$catArr[] = get_the_category($arg)[0] -> slug;
					$nameArr[] = get_the_category($arg)[0] -> name;
				}
				$idArr = array_values(array_unique($catArr));
				$nameArr = array_values(array_unique($nameArr));
				?>
                <div class="dateAndViews">
                    <?php
                    for ($i = 0, $count = count($idArr); $i < $count; $i++) {?>
                        <span id="<?php echo $idArr[$i]; ?>" class="category"><?php echo $nameArr[$i]; ?></span>
                    <?php } ?>
                </div>
			<?php } ?>
	        <?php if($slider['title'] ) { ?>
                <a class="largeTitle" href="<?php echo get_term_link($slider['title']['catId'], $slider['title']['tax']) ?>">
			        <?php echo $slider['title']['name'] ?>
                </a>
	        <?php } ?>
	        <?php if($slider['control']) { ?>
                <div class="slider__topControl">
                    <div id="<?php echo $slider['id']; ?>__toLeft" class="slider__toLeft">
                        <svg>
                            <use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#turnUp"></use>
                        </svg>
                    </div>
                    <div id="<?php echo $slider['id']; ?>__pagination" class="slider__pagination"></div>
                    <div id="<?php echo $slider['id']; ?>__toRight" class="slider__toRight">
                        <svg>
                            <use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#turnUp"></use>
                        </svg>
                    </div>
                </div>
	        <?php } ?>

        </div>

		<div id="<?php echo $slider['id']; ?>" class="swiper">
			<div class="swiper-wrapper">
				<?php

				while ($query->have_posts()) {
					$query->the_post();
					if($slider['cats']) {
						$cat = get_the_category()[0] -> slug;
						$verticalBlock__botBlock['classes'] = ['swiper-slide', $cat];
                    }

					require locate_template( 'includes/verticalBlock__botBlock.php' );
				} ?>
			</div>
		</div>

	</div>
		<?php
		if ($slider['scrollbar']) { ?>
            <div id="<?php echo $slider['id']; ?>__scrollBar" class="slider__scrollbar"></div>
		<?php } ?>
</div>