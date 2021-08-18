<?php
/*
  $dateAndViews =
	[
		'viewsDateWrapper' => boolean,
		'views'=> [
            'classes' => array
         ],
		'date'=> [
            'classes' => array
         ],
		'theme'=> boolean,
		'category'=> [
            'classes' => array
         ],
		'categoryMany'=> boolean,
		'read' => boolean,
        'classes' => array,
        'tags' => boolean,
	];
 */

if ($dateAndViews['classes']) {
	$classesDAV = implode(' ', $dateAndViews['classes']);
}
?>

<div class="dateAndViews <?php echo $classesDAV;?>">

	<?php if($dateAndViews['tags']) {

		$arrTags = get_the_tags();
		foreach( $arrTags as $tag ) {
			?>
            <a href="<?php echo get_category_link($tag -> term_id); ?>" class="category">
				<?php echo $tag -> name; ?>
            </a>
		<?php }
	} ?>

	<?php if($dateAndViews['category']) {
		$cat = get_the_category();
		if ($dateAndViews['category']['classes']) {
			$classesCat = implode(' ', $dateAndViews['category']['classes']);
		}
		?>

		<?php if($dateAndViews['categoryMany']) { ?>
            <div class="category <?php echo $classesCat;?>">

				<?php foreach ($cat as $category) { ?>
                    <span>
			            <?php echo $category->name; ?>
			          </span>
				<?php } ?>

            </div>
		<?php }
		else if(!empty($cat)) { ?>
            <span class="category <?php echo $classesCat;?>">
			     <?php echo $cat[0]->name; ?>
		    </span>
		<?php } ?>
	<?php } ?>

	<?php if($dateAndViews['date']) {
		if ($dateAndViews['date']['classes']) {
			$classesDate = implode(' ', $dateAndViews['date']['classes']);
		}
		?>

        <span class="date <?php echo $classesDate;?>">
            <?php echo get_the_date("d F Y"); ?>
        </span>

	<?php } ?>

	<?php if($dateAndViews['theme']) {

		if ($dateAndViews['theme']['classes']) {
			$classesTh = implode(' ', $dateAndViews['theme']['classes']);
		}
	    ?>

		<span class="category <?php echo $classesTh;?>">
		  <?php
		  $specialTag = get_the_terms(get_the_ID(), 'mainthemes')[0];
		  echo $specialTag -> name ?>
    </span>

	<?php } ?>

	<?php if($dateAndViews['read']) { ?>

		<span class="read">Читать</span>

	<?php } ?>

	<?php if(false) {
		if ($dateAndViews['views']['classes']) {
			$classesViews = implode(' ', $dateAndViews['views']['classes']);
		}
		?>

        <span class="views <?php echo $classesViews;?>">
	          <?php echo do_shortcode('[post-views]') ?>
	      </span>

	<?php } ?>

	<?php if($dateAndViews['time']) { ?>

        <span class="time">
            <?php echo get_post_time("H:i"); ?>
        </span>

	<?php } ?>


</div>









