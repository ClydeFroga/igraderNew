<a href="<?php the_permalink(); ?>" class="backgroundBlock__spec">
	<div class="backgroundBlock__block" style="background-image: url('<?php the_post_thumbnail_url() ?>')">
		<div class="backgroundBlock__blockText">
			<div class="backgroundBlock__blockTextInner">
                        <span class="backgroundBlock__blockTextInnerTitle">
                            <?php the_title(); ?>
                        </span>

				<?php if ($num === 0 && $backgroundBlock['text']) { ?>

					<span class="backgroundBlock__blockTextInnerMain">
                                <?php echo kama_excerpt( array('maxchar'=>200, 'text'=> get_the_excerpt()) ); ?>
	                        </span>

				<?php }

				$dateAndViews = [
					'read' => true,
					'views' => true
				];
				require locate_template('includes/dateAndViews.php');
				?>

			</div>


			<?php
			if ($backgroundBlock['dateAndViews']) {
				$dateAndViews = [
					'category' => true,
					'views'    => true
				];
				require locate_template( 'includes/dateAndViews.php' );
			}
			?>
		</div>
	</div>
</a>