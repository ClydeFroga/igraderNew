<?php
$cat_name = single_term_title('', 0);
$cat_id = get_cat_ID($cat_name);
$cat_link = get_category_link($cat_id);
?>

<div class="breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
	<div>
		<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
			<a href="<?php echo home_url(); ?>" itemprop="item">
				<span itemprop="name">Главная</span>
				<meta itemprop="position" content="0">
			</a>
		</span>

		<svg>
			<use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#menuArrowUp"></use>
		</svg>

		<?php if (is_search()) { ?>
			<span >
                <span >
					<span>
						Результат поиска по запросу "<?php echo get_search_query();?>"
					</span>
				</span>
			</span>

		<?php	} ?>

		<?php if(is_singular()) {
			$categoryPost = get_the_terms($post->ID, 'category');
			if($categoryPost[0]) { ?>
				<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a href="<?php echo get_category_link($categoryPost[0] -> term_id); ?>"  itemprop="item">
						<span itemprop="name">
							<?php echo $categoryPost[0] -> name; ?>
						</span>
						<meta itemprop="position" content="1">
					</a>
				</span>
                <svg>
                    <use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#menuArrowUp"></use>
                </svg>
			<?php } else if(is_singular('event')) { ?>
				<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a href="<?php echo home_url() . '/blizhajshie-meropriyatiya' ?>"  itemprop="item">
						<span itemprop="name">
							Мероприятия
						</span>
						<meta itemprop="position" content="1">
					</a>
				</span>
				<svg>
					<use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#menuArrowUp"></use>
				</svg>
			<?php  }
			?>

			<span>
			<a href="<?php the_permalink(); ?>" >
				<span>
					<?php the_title(); ?>
				</span>
			</a>
		</span>
		<?php } ?>

        <?php if(is_archive()) { ?>
            <span>
                <span >
                    <span>
                        <?php echo $cat_name; ?>
                    </span>
                </span>
            </span>
        <?php } ?>

		<?php if(is_404()) { ?>
			<span >
				<span >
					<span >
						404
					</span>
				</span>
			</span>
		<?php } ?>
	</div>
</div>