<?php
/*
     $loadMore = [
        'classes' => array,
        'offset' => int,
        'perView' => int,
        'block' => string,
        'forRubric' => boolean,
      ];
*/
if ($loadMore['classes']) {
	$classesLM = implode(' ', $loadMore['classes']);
}
$classesLMTrue = 'hiddenButton';
if($classesLM) {
	$classesLMTrue =  $classesLM;
}
?>

<span id="loadMore" data-load="<?php echo $loadMoreNum++; ?>" class="<?php echo $classesLMTrue; ?>">Показать ещё ↓</span>

<script>
      loadmore_params.block.push("<?php echo $loadMore['block']; ?>")
      <?php
        if($loadMore['forRubric']) {
            ?>
        loadmore_params.posts.push('<?php echo json_encode( $wp->query_vars ); ?>')
      <?php }
        else { ?>
        loadmore_params.posts.push('<?php echo json_encode( $query->query_vars ); ?>')
      <?php }
        ?>
      loadmore_params.offset.push(<?php echo $loadMore['offset']; ?>)
      loadmore_params.perView.push(<?php echo $loadMore['perView']; ?>)
      loadmore_params.horizontalBar.push('<?php echo json_encode($loadMore['horizontalBar']); ?>')
      loadmore_params.verticalBar.push('<?php echo json_encode($loadMore['verticalBar']); ?>')
</script>