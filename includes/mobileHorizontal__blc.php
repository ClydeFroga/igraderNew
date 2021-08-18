<a href="<?php the_permalink(); ?>" class="mobileHorizontal__blc">
	<div class="mobileHorizontal__blcInner">
		<div class="imgBlock">
			<?php the_post_thumbnail('thumbnail'); ?>
		</div>

		<?php
		$dateAndViews = [
			'read' => true,
			'views' => [
				'classes' => ['dark']
			]
		];
		require locate_template('includes/dateAndViews.php');
		?>

	</div>
	<div class="mobileHorizontal__blcTitle">
		<?php the_title(); ?>
	</div>
</a>