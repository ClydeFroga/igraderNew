<?php
/*
    $verticalBlock__botBlock =
	[
        'classes' => array,
        'topDate' => [
            'classes' => array,
        ],
        'botDate' => boolean,
        'read' => boolean,
    ];
 */
	if ($verticalBlock__botBlock['classes']) {
		$classesVB = implode(' ', $verticalBlock__botBlock['classes']);
	}
    if ($verticalBlock__botBlock['classesAdd']) {
        $classesVBAdd = implode(' ', $verticalBlock__botBlock['classesAdd']);
    }
?>

<a href="<?php the_permalink(); ?>" class="verticalBlock__botBlock  <?php echo $classesVB;?>">
	<div class="imgBlock imgBlockFull">
		<?php the_post_thumbnail('medium'); ?>

		<?php
        if ($verticalBlock__botBlock['topDate']) {
	        $dateAndViews = [
		        'category' => [
			        'classes' => $verticalBlock__botBlock['topDate']['classes']
		        ]
	        ];
	        require locate_template('includes/dateAndViews.php');
        }
		?>

	</div>
	<div class="<?php echo $classesVBAdd;?>">
		<?php
		if ($verticalBlock__botBlock['midDate']) {
		    $dateAndViews = $verticalBlock__botBlock['midDate'];
			require locate_template( 'includes/dateAndViews.php' ); } ?>
			<span class="verticalBlock__botBlockTitle">
		        <?php the_title(); ?>
		    </span>
		<?php
		if ($verticalBlock__botBlock['text']) { ?>
            <span class="verticalBlock__botBlockText">
				<?php echo kama_excerpt( array('maxchar'=> $verticalBlock__botBlock['text']['max'], 'text'=> get_the_excerpt()) ); ?>
            </span>
		<?php }

		if ($verticalBlock__botBlock['botDate']) {
			$dateAndViews = $verticalBlock__botBlock['botDate'];
			require locate_template( 'includes/dateAndViews.php' );
		}

		if ($verticalBlock__botBlock['read']) { ?>
		    <span>
                Узнать больше →
            </span>
		<?php }
		?>
	</div>


</a>
