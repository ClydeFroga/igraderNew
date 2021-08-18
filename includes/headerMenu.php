<header class="header">
	<div class="header__menu">
		<svg id="openMenu" class="header__menuButton">
			<use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#menu"></use>
		</svg>
		<a href="<?php echo home_url(); ?>" class="header__menuLogo">
			<svg>
				<use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#logoLarge"></use>
			</svg>
		</a>

		<?php wp_nav_menu( [
			'container' => '',
			'items_wrap' => '<ul class="header__menuLinks">%3$s</ul>',
			'theme_location'  => 'topMenu'
		] ); ?>

        <form role="search" action="<?php echo home_url( '/' ); ?>" class="search">
            <label>
                <input value="<?php echo get_search_query() ?>" name="s" id="s" class="form-control" type="text" placeholder="Поиск по сайту...">
            </label>
        </form>

		<div class="delimiter"></div>

		<?php get_template_part('includes/socialMedia'); ?>
	</div>

</header>

<script src="<?php bloginfo('template_url')?>/js/menuToggle.min.js?version=1.5"></script>