<?php get_template_part('includes/modalSubscriptionContactForm'); ?>
<?php get_template_part('includes/modalSubscriptionSendPulse'); ?>
<?php get_template_part('includes/menuOpener'); ?>

<footer class="footer">
	<div class="container">
		<div class="footer__one">
			<a href="<?php echo home_url(); ?>" class="footer__oneLogoLarge">
				<svg>
					<use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#logoLarge"></use>
				</svg>
			</a>
			<a href="<?php echo home_url(); ?>" class="footer__oneLogoSmall">
				<svg>
					<use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#logoSmall"></use>
				</svg>
			</a>
		</div>
		<div class="footer__two">
			<?php wp_nav_menu( [
				'container' => '',
				'items_wrap' => '<ul>%3$s</ul>',
				'theme_location'  => 'footerMenu'
			] ); ?>

            <div>
				<span class="">
					Подпишитесь
					на ежемесячную рассылку
					для специалистов отрасли
				</span>
				<span id="openModalSendpulse" class="buttonBlack">Подписаться</span>
	            <?php get_template_part('includes/socialMedia'); ?>
			</div>
		</div>
		<div class="footer__three">
			<span>
				Сетевое издание igrader.ru зарегистрировано в Федеральной службе по надзору в сфере связи,
				информационных технологий и массовых коммуникаций (Роскомнадзор). Свидетельство ЭЛ № ФС 77 - 76723 от 02.09.2019
			</span>
			<span>
				© ООО "ПромоГрупп Медиа", 2016-<?php echo date('Y');?>
				Копирование материалов запрещено.
			</span>
		</div>
		<div class="footer__four">
			<?php wp_nav_menu( [
				'container' => '',
				'items_wrap' => '<ul>%3$s</ul>',
				'theme_location'  => 'footerMenuBot'
			] ); ?>
			<span>16+</span>
		</div>
	</div>
</footer>

<?php get_template_part('includes/scriptsAndCo');?>

<?php wp_footer(); ?>
</body>
</html>