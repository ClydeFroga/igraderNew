<a href="<?php the_permalink(); ?>" class="horizontalBar__blc <?php if ($horizontalBar['special'] && has_tag('2417')) echo 'special'; ?>">
	<div class="horizontalBar__blcLeft imgBlock">
		<?php the_post_thumbnail('medium'); ?>
	</div>
	<div class="horizontalBar__blcRight">
        <span class="horizontalBar__blcRightTitle">
            <?php the_title(); ?>
        </span>
        <?php
            if ($horizontalBar['dateAndViews']) {
	            $dateAndViews = $horizontalBar['dateAndViews'];
	            require locate_template( 'includes/dateAndViews.php' );
            }
        ?>
		<?php
		if ($horizontalBar['text']) { ?>
            <span class="horizontalBar__blcRightText">
                <?php echo kama_excerpt( array('maxchar'=> $horizontalBar['text']['max'], 'text'=> get_the_excerpt()) ); ?>
            </span>
		<?php }
		?>
        <?php
        if ($horizontalBar['dateAndViewsBot'] && !$horizontalBar['mobile']) {
	        $dateAndViews = $horizontalBar['dateAndViewsBot'];
	        require locate_template( 'includes/dateAndViews.php');
        }
        ?>

	</div>

	<?php
	if ($horizontalBar['dateAndViewsBot'] && $horizontalBar['mobile']) {
		$dateAndViews = $horizontalBar['dateAndViewsBot'];
		require locate_template( 'includes/dateAndViews.php');
	}
	?>

    <?php if ($horizontalBar['bottom']) { ?>
        <div class="horizontalBar__blcBottom">
            <span class="horizontalBar__blcBottomText">
                <?php echo kama_excerpt( array('maxchar'=> $horizontalBar['bottom']['max'], 'text'=> get_the_excerpt()) ); ?>
            </span>
	        <?php if ($horizontalBar['bottom']['date']) { ?>
            <div class="dateAndViews">
                <span class="date">
                    <?php echo get_the_date("d F Y"); ?>
                </span>
            </div>
	        <?php } ?>
        </div>
	<?php } ?>
</a>