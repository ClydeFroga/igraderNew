<div class="userFields">
    <?php if (false) { ?>
	<a href="#" class="userFields__user">
		<svg>
			<use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#user"></use>
		</svg>
		<span>Войти</span>
	</a>
	<span class="userFields__notification active">
        <svg>
            <use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#bullhorn"></use>
        </svg>
    </span>
    <?php } ?>

	<form role="search" action="<?php echo home_url( '/' ); ?>" class="search">
		<label>
			<input value="<?php echo get_search_query() ?>" name="s" id="s" class="form-control" type="text" placeholder="Поиск по сайту...">
		</label>
	</form>

	<?php get_template_part('includes/socialMedia'); ?>
</div>