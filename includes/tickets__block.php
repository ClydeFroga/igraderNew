<a href="<?php the_permalink(); ?>" class="tickets__block">
	<div class="imgBlock">
		<img src="<?php echo get_field( 'izobrazhenie_zapisi')['url']; ?>">
	</div>
	<div class="tickets__blockBot">
		<div class="tickets__blockBotBrandLine">
            <span>
                Обьявления
            </span>
		</div>
		<span class="tickets__blockBotTitle">
			<?php the_title(); ?>
        </span>
        <?php
        if ( $tickets['text']) { ?>
            <span class="tickets__blockBotText">
                <?php echo kama_excerpt( array('maxchar'=> 150, 'text'=> get_the_excerpt()) ); ?>
            </span>
        <?php } ?>

        <?php if ( $tickets['price']) { ?>
            <span class="tickets__blockBotPrice">
                <?php echo number_format(get_field( 'czena'), 0, '.', ' '); ?> ₽
            </span>
        <?php } ?>

		<?php if ( $tickets['button']) { ?>
            <span class="buttonBlack">
                Узнать больше
            </span>
		<?php } ?>


	</div>
</a>