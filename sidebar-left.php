<aside class="asideMenu">
	<div>
		<div class="asideMenu__close">
			<svg>
				<use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#close"></use>
			</svg>
		</div>

		<?php get_template_part('includes/userFields'); ?>

		<?php wp_nav_menu( [
			'container' => '',
			'items_wrap' => '<ul >%3$s</ul>',
			'theme_location'  => 'leftAside'
		] ); ?>
        <svg id="openMenu" class="">
            <use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#turnUp"></use>
        </svg>
	</div>
</aside>