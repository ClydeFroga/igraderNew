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
		                   'relation' => 'AND',
		                   [
			                   "operator" => 'IN',
			                   'taxonomy' => 'category',
			                   'field' => 'id',
			                   'terms' => [ '1613' ]
		                   ],
		                   [
			                   "operator" => 'IN',
			                   'taxonomy' => 'mainthemes',
			                   'field' => 'id',
			                   'terms' => [ '1601' ]
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
			require locate_template('includes/foxyes'. $ghost . '.php');

			require locate_template('includes/sendpulseSmall.php');
			?>
		</div>
	</div>

</section>