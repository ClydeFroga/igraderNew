<?php
$terms = array(
	'taxonomy' => 'magazins',
	'number' => '2',
	'orderby' => 'term_id',
	'order' => 'DESC',
//        'hide_empty' => false
);
$lastMagazine = get_terms($terms);
$lastMagazine = array_values($lastMagazine);

$term = $lastMagazine[1];
$term1 = $lastMagazine[0];
$term2 = $lastMagazine[1];
$reliz_jrnl1 = get_field('reliz_jrnl', $term1);
$my_date = date('Ymd');
if($reliz_jrnl1 <= $my_date){
	$term = $term1;
}else{
	$term = $term2;
};

$magazine_link = get_term_link($term -> term_id, 'magazins');
$linkFl = get_field('floowie_link', $term);
$linkPdf = get_field('pdf_magazine', $term);
$image_id = get_term_meta( $term->term_id, '_thumbnail_id', 1 );
$image_url = wp_get_attachment_image_url( $image_id, 'full' );
if(!$image_url){
	$image_url = 'https://igrader.ru/wp-content/uploads/2020/06/№-3-39-maj-iyun-2020-g.jpg';
};
?>

<div class="newMag">
    <span class="largeTitle">
        Новый номер журнала
    </span>
	<img loading="lazy" src="<?php echo $image_url; ?>">
	<div>
		<a href="<?php echo $magazine_link; ?>" class="orangeButton readOnline">Читать on-line</a>
		<span id="openModal"  class="subscribe">Подписаться</span>
		<a href="<?php echo get_page_link(86); ?>" >Архив журнала</a>
	</div>
</div>