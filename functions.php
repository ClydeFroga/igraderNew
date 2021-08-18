<?php
require_once 'Mobile_Detect.php';

$detect = new Mobile_Detect;

$is_PC = !$detect->isMobile();
$is_tablet = $detect->isTablet();
$is_mobile = $detect->isMobile() && !$detect->isTablet();


/*________ADD ThemeSupports_______*/
add_theme_support('widgets');
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('menus');
add_theme_support( 'html5' );
add_theme_support( 'custom-logo' );
/*________END ThemeSupports_______*/

/*________Start POST TYPES ADDING_______*/
function advertisement() {
	$labels = array(
		'name' => 'Объявления',
		'singular_name' => 'Объявления', // админ панель Добавить->Функцию
		'add_new' => 'Добавить объявление',
		'add_new_item' => 'Добавить новое объявление', // заголовок тега <title>
		'edit_item' => 'Редактировать объявление',
		'new_item' => 'Новое объявление',
		'all_items' => 'Все объявления',
		'view_item' => 'Просмотр объявления на сайте',
		'search_items' => 'Искать объявление',
		'not_found' =>  'Объявлений не найдено',
		'not_found_in_trash' => 'В корзине нет объявлений',
		'menu_name' => 'Объявления' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true,
		'rewrite'=>true,
		'menu_icon'=> 'dashicons-megaphone',
		'capability_type' => 'post',
		'show_in_rest' => true,
		'menu_position' => 21, // порядок в меню
		'supports' => array( 'title', 'editor', 'excerpt','comments', 'author', 'thumbnail', 'custom-fields'),
		'taxonomies' => array('advtypes'),
	);
	register_post_type('advertisement', $args);
}
add_action( 'init', 'advertisement', 1 );
/*________End POST TYPES ADDING_______*/

/*________Start KAmaExcerpt_______*/
function kama_excerpt( $args = '' ){
	global $post;

	if( is_string($args) )
		parse_str( $args, $args );

	$rg = (object) array_merge( array(
		'maxchar'     => 350,   // Макс. количество символов.
		'text'        => '',    // Какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
		// Если в тексте есть `<!--more-->`, то `maxchar` игнорируется и берется
		// все до <!--more--> вместе с HTML.
		'autop'       => true,  // Заменить переносы строк на <p> и <br> или нет?
		'save_tags'   => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'.
		'more_text'   => 'Читать дальше...', // Текст ссылки `Читать дальше`.
		'ignore_more' => false, // нужно ли игнорировать <!--more--> в контенте
	), $args );

	$rg = apply_filters( 'kama_excerpt_args', $rg );

	if( ! $rg->text )
		$rg->text = $post->post_excerpt ?: $post->post_content;

	$text = $rg->text;
	// убираем блочные шорткоды: [foo]some data[/foo]. Учитывает markdown
	$text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text );
	// убираем шоткоды: [singlepic id=3]. Учитывает markdown
	$text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text );
	$text = trim( $text );

	// <!--more-->
	if( ! $rg->ignore_more  &&  strpos( $text, '<!--more-->') ){
		preg_match('/(.*)<!--more-->/s', $text, $mm );

		$text = trim( $mm[1] );

		$text_append = ' <a href="'. get_permalink( $post ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
	}
	// text, excerpt, content
	else {
		$text = trim( strip_tags($text, $rg->save_tags) );

		// Обрезаем
		if( mb_strlen($text) > $rg->maxchar ){
			$text = mb_substr( $text, 0, $rg->maxchar );
			$text = preg_replace( '~(.*)\s[^\s]*$~s', '\\1...', $text ); // кил последнее слово, оно 99% неполное
		}
	}

	// сохраняем переносы строк. Упрощенный аналог wpautop()
	if( $rg->autop ){
		$text = preg_replace(
			array("/\r/", "/\n{2,}/", "/\n/",   '~</p><br ?/?>~'),
			array('',     '</p><p>',  '<br />', '</p>'),
			$text
		);
	}

	$text = apply_filters( 'kama_excerpt', $text, $rg );

	if( isset($text_append) )
		$text .= $text_append;

	return ( $rg->autop && $text ) ? "$text" : $text;
}
/*________End KAmaExcerpt_______*/

function add_new_taxonomies() {
	register_taxonomy('magazins',
		array('post'),
		array(
			'hierarchical' => true,
			'labels' => array(
				/* ярлыки, нужные при создании UI, можете
				не писать ничего, тогда будут использованы
				ярлыки по умолчанию */
				'name' => 'Выпуски журналов',
				'singular_name' => 'Журнал',
				'search_items' =>  'Найти журнал',
				'all_items' => 'Все журналы',
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => 'Редактировать номер журнала',
				'update_item' => 'Обновить номер журнала',
				'add_new_item' => 'Добавить новый номер журнала',
				'new_item_name' => 'Название нового номера журнала',
				'menu_name' => 'Номера журналов'
			),
			'public' => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'show_ui' => true,
			'show_tagcloud' =>false,
			'show_in_rest' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array(
				/* настройки URL пермалинков */
				'slug' => 'magazins', // ярлык
				'hierarchical' => false // разрешить вложенность
			),
		)
	);
	register_taxonomy('mainthemes',
		array('post'),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => 'Форматы',
				'singular_name' => 'Формат',
				'search_items' =>  'Найти формат',
				'popular_items' => 'Популярные форматы',
				'all_items' => 'Все форматы',
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => 'Редактировать формат',
				'update_item' => 'Обновить формат',
				'add_new_item' => 'Добавить новый формат',
				'new_item_name' => 'Название нового формата',
				'separate_items_with_commas' => 'Разделяйте форматы запятыми',
				'add_or_remove_items' => 'Добавить или удалить формат',
				'choose_from_most_used' => 'Выбрать из наиболее часто используемых форматов',
				'menu_name' => 'Форматы'
			),
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => false,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' =>true,
			'has_archive'=>'themes',
			'show_in_rest' => true,
			'rest_base' => 'mainthemes',
		)
	);
	register_taxonomy('specials',
		array('post','functions'),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => 'Спецпроекты',
				'singular_name' => 'Спецпроект',
				'search_items' =>  'Найти спецпроект',
				'popular_items' => 'Популярные спецпроекты',
				'all_items' => 'Все спецпроекты',
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => 'Редактировать спецпроект',
				'update_item' => 'Обновить спецпроект',
				'add_new_item' => 'Добавить новый спецпроект',
				'new_item_name' => 'Название нового спецпроект',
				'separate_items_with_commas' => 'Разделяйте спецпроекты запятыми',
				'add_or_remove_items' => 'Добавить или удалить спецпроект',
				'choose_from_most_used' => 'Выбрать из наиболее часто используемых спецпроектов',
				'menu_name' => 'Спецпроекты'
			),
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'query_var' => true,
			'rewrite' =>true,
			'has_archive'=>'themes',
			'show_in_rest' => true,
			'rest_base' => 'specials',
		)
	);
	register_taxonomy('AdStatus',
		array('post'),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => 'Рекламный статус',
				'singular_name' => 'Рекламный статус',
				'search_items' =>  'Найти рекламный статус',
				'popular_items' => 'Популярные рекламные статусы',
				'all_items' => 'Все рекламные статусы',
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => 'Редактировать рекламный статус',
				'update_item' => 'Обновить рекламный статус',
				'add_new_item' => 'Добавить новый рекламный статус',
				'new_item_name' => 'Название нового рекламного статуса',
				'separate_items_with_commas' => 'Разделяйте рекламные статусы запятыми',
				'add_or_remove_items' => 'Добавить или удалить рекламный статус',
				'choose_from_most_used' => 'Выбрать из наиболее часто используемых рекламных статусов',
				'menu_name' => 'Рекламные статусы'
			),
			'public' => false,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => false,
			'query_var' => false,
			'rewrite' =>true,
			'show_in_rest' => true,
			'rest_base' => 'AdStatus',
			'show_admin_column'     => true,
			'publicly_queryable' => false,
		)
	);
	register_taxonomy('brand',
		array('post', 'advertisement'),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => 'Бренд',
				'singular_name' => 'Бренд',
				'search_items' =>  'Найти Бренд',
				'popular_items' => 'Популярные бренды',
				'all_items' => 'Все бренды',
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => 'Редактировать бренд',
				'update_item' => 'Обновить бренд',
				'add_new_item' => 'Добавить новый бренд',
				'new_item_name' => 'Название нового бренда',
				'separate_items_with_commas' => 'Разделяйте бренды запятыми',
				'add_or_remove_items' => 'Добавить или удалить бренд',
				'choose_from_most_used' => 'Выбрать из наиболее часто используемых брендов',
				'menu_name' => 'Бренды'
			),
			'public' => true,
			'show_tagcloud' => false,
			'query_var' => false,
			'rewrite' =>true,
			'show_in_nav_menus' => false,
			'show_admin_column' => true,
			'show_in_rest' => true,
			'rest_base' => 'brand',
//			'publicly_queryable' => false,
		)
	);
}
add_action( 'init', 'add_new_taxonomies');

/*____________START EXCLUDE CATEGORY___________*/
function exclude_category( $query ) {
	$query->set( 'cat', '-1480' );

}
if(!is_admin()){
	add_action( 'pre_get_posts', 'exclude_category' );
}
/*____________END EXCLUDE CATEGORY___________*/

/*________Start MENUS_____________*/
function themeMenuRegister(){
	register_nav_menu('topMenu', 'Верхнее меню');
	register_nav_menu('leftAside', 'Боковое меню');
	register_nav_menu('footerMenu', 'Футер');
	register_nav_menu('footerMenuBot', 'Футер нижняя строка');
}
add_action('after_setup_theme', 'themeMenuRegister');
/*________END MENUS_____________*/

class trueTopPostsWidget extends WP_Widget {

	/*
	 * создание виджета
	 */
	function __construct() {
		parent::__construct(
			'topBanner',
			'Баннер верхний', // заголовок виджета
			array( 'description' => '' ) // описание
		);
	}

	/*
	 * фронтэнд виджета
	 */
	public function widget( $args, $instance ) {
		$title2 = $instance['title2'];
		$text = $instance['text'];
		$link = $instance['link'];
		$image = $instance['image'];
		$image2 = $instance['image2'];

		require locate_template('includes/ridgepole.php');
	}

	/*
	 * бэкэнд виджета
	 */
	public function form( $instance ) {

		if ( isset( $instance[ 'title2' ] ) ) {
			$title2 = $instance[ 'title2' ];
		}
		if ( isset( $instance[ 'text' ] ) ) {
			$text = $instance[ 'text' ];
		}
		if ( isset( $instance[ 'link' ] ) ) {
			$link = $instance[ 'link' ];
		}
		if ( isset( $instance[ 'image' ] ) ) {
			$image = $instance[ 'image' ];
		}
		if ( isset( $instance[ 'image2' ] ) ) {
			$image2 = $instance[ 'image2' ];
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title2' ); ?>">Заголовок</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title2' ); ?>" name="<?php echo $this->get_field_name( 'title2' ); ?>" type="text" value="<?php echo esc_attr( $title2 ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>">Скрытый текст:</label>
			<?php wp_editor( $text, $this->get_field_id( 'text' ), array(
				'wpautop'       => 1,
				'media_buttons' => 1,
				'textarea_name' => $this->get_field_name( 'text' ),
				'textarea_rows' => 20,
				'tabindex'      => null,
				'editor_css'    => '',
				'editor_class'  => '',
				'teeny'         => 0,
				'dfw'           => 0,
				'tinymce'       => 0,
				'quicktags'     => 1,
				'drag_drop_upload' => false
			) ); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>">Ссылка:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo $link; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>">Ссылка на фоновое изображение(на разрешение > 576):</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo $image; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'image2' ); ?>">Ссылка на фоновое изображение(на разрешение <= 576):</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'image2' ); ?>" name="<?php echo $this->get_field_name( 'image2' ); ?>" type="text" value="<?php echo $image2; ?>"/>
		</p>

		<?php
	}

	/*
	 * сохранение настроек виджета
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title2'] = ( ! empty( $new_instance['title2'] ) ) ? strip_tags( $new_instance['title2'] ) : '';
		$instance['text'] = ( ! empty( $new_instance['text'] ) ) ? $new_instance['text']  : '';
		$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? $new_instance['link']  : '';
		$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
		$instance['image2'] = ( ! empty( $new_instance['image2'] ) ) ? $new_instance['image2'] : '';
		return $instance;
	}
}
class plugsWidget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'plugsWidget',
			'Заглушки', // заголовок виджета
			array( 'description' => 'Появляются если реклама заблокирована' ) // описание
		);
	}

	public function widget( $args, $instance ) {
		$params = json_encode($instance);

		require locate_template('includes/plugs.php');
	}


	public function form( $instance ) {
		isset($instance[ 'linkA' ]) ? $linkA = $instance[ 'linkA' ] : $linkA = '';
		isset($instance[ 'imageA' ]) ? $imageA = $instance[ 'imageA' ] : $imageA = '';
		isset($instance[ 'linksB' ]) ? $linksB = $instance[ 'linksB' ] : $linksB = [];
		isset($instance[ 'imagesB' ]) ? $imagesB = $instance[ 'imagesB' ] : $imagesB = [];
		isset($instance[ 'linksC' ]) ? $linksC = $instance[ 'linksC' ] : $linksC = [];
		isset($instance[ 'imagesC' ]) ? $imagesC = $instance[ 'imagesC' ] : $imagesC = [];
		isset($instance[ 'linksD' ]) ? $linksD = $instance[ 'linksD' ] : $linksD = [];
		isset($instance[ 'imagesD' ]) ? $imagesD = $instance[ 'imagesD' ] : $imagesD = [];
		isset($instance[ 'linksF' ]) ? $linksF = $instance[ 'linksF' ] : $linksF = [];
		isset($instance[ 'imagesF' ]) ? $imagesF = $instance[ 'imagesF' ] : $imagesF = [];
		?>

        <p>
            <label for="<?php echo $this->get_field_id( 'linkA' ); ?>">Ссылка (баннер А): </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'linkA' ); ?>" name="<?php echo $this->get_field_name( 'linkA' ); ?>" type="text" value="<?php echo esc_attr( $linkA ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'imageA' ); ?>">Ссылка на изображение (баннер А):</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'imageA' ); ?>" name="<?php echo $this->get_field_name( 'imageA' ); ?>" type="text" value="<?php echo esc_attr($imageA); ?>"/>
        </p>

        <?php
        for ($i = 1; $i < 7; $i++) {

            ?>
            <p>
                <label for="<?php echo $this->get_field_id( "linkB${i}" ); ?>">Ссылка (баннер B<?php echo $i; ?>): </label>
                <input class="widefat" id="<?php echo $this->get_field_id( "linkB${i}" ); ?>" name="<?php echo $this->get_field_name( "linkB${i}" ); ?>" type="text" value="<?php echo esc_attr( $linksB["B${i}"] ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( "imageB${i}" ); ?>">Ссылка на изображение(баннер B<?php echo $i; ?>):</label>
                <input class="widefat" id="<?php echo $this->get_field_id( "imageB${i}" ); ?>" name="<?php echo $this->get_field_name( "imageB${i}" ); ?>" type="text" value="<?php echo esc_attr($imagesB["B${i}"]); ?>"/>
            </p>
        <?php }

		for ($i = 1; $i < 7; $i++) { ?>
            <p>
                <label for="<?php echo $this->get_field_id( "linkC${i}" ); ?>">Ссылка (баннер C<?php echo $i; ?>): </label>
                <input class="widefat" id="<?php echo $this->get_field_id( "linkC${i}" ); ?>" name="<?php echo $this->get_field_name( "linkC${i}" ); ?>" type="text" value="<?php echo esc_attr( $linksC["C${i}"] ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( "imageC${i}" ); ?>">Ссылка на изображение(баннер C<?php echo $i; ?>):</label>
                <input class="widefat" id="<?php echo $this->get_field_id( "imageC${i}" ); ?>" name="<?php echo $this->get_field_name( "imageC${i}" ); ?>" type="text" value="<?php echo esc_attr($imagesC["C${i}"]); ?>"/>
            </p>
		<?php }

		for ($i = 1; $i < 3; $i++) { ?>
            <p>
                <label for="<?php echo $this->get_field_id( "linkD${i}" ); ?>">Ссылка (баннер D<?php echo $i; ?>): </label>
                <input class="widefat" id="<?php echo $this->get_field_id( "linkD${i}" ); ?>" name="<?php echo $this->get_field_name( "linkD${i}" ); ?>" type="text" value="<?php echo esc_attr( $linksD["D${i}"] ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( "imageD${i}" ); ?>">Ссылка на изображение(баннер D<?php echo $i; ?>):</label>
                <input class="widefat" id="<?php echo $this->get_field_id( "imageD${i}" ); ?>" name="<?php echo $this->get_field_name( "imageD${i}" ); ?>" type="text" value="<?php echo esc_attr($imagesD["D${i}"]); ?>"/>
            </p>
		<?php }
		for ($i = 1; $i < 4; $i++) { ?>
            <p>
                <label for="<?php echo $this->get_field_id( "linkF${i}" ); ?>">Ссылка (баннер F<?php echo $i; ?>): </label>
                <input class="widefat" id="<?php echo $this->get_field_id( "linkF${i}" ); ?>" name="<?php echo $this->get_field_name( "linkF${i}" ); ?>" type="text" value="<?php echo esc_attr( $linksF["F${i}"] ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( "imageF${i}" ); ?>">Ссылка на изображение(баннер F<?php echo $i; ?>):</label>
                <input class="widefat" id="<?php echo $this->get_field_id( "imageF${i}" ); ?>" name="<?php echo $this->get_field_name( "imageF${i}" ); ?>" type="text" value="<?php echo esc_attr($imagesF["F${i}"]); ?>"/>
            </p>
		<?php }
	}

	/*
	 * сохранение настроек виджета
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['linkA'] = ( ! empty( $new_instance['linkA'] ) ) ? $new_instance['linkA']  : '';
		$instance['imageA'] = ( ! empty( $new_instance['imageA'] ) ) ? $new_instance['imageA'] : '';
		$instance['linksB'] = [
		  'B1' =>  ( ! empty( $new_instance['linkB1'] ) ) ? $new_instance['linkB1'] : '',
		  'B2' =>  ( ! empty( $new_instance['linkB2'] ) ) ? $new_instance['linkB2'] : '',
		  'B3' =>  ( ! empty( $new_instance['linkB3'] ) ) ? $new_instance['linkB3'] : '',
		  'B4' =>  ( ! empty( $new_instance['linkB4'] ) ) ? $new_instance['linkB4'] : '',
		  'B5' =>  ( ! empty( $new_instance['linkB5'] ) ) ? $new_instance['linkB5'] : '',
		  'B6' =>  ( ! empty( $new_instance['linkB6'] ) ) ? $new_instance['linkB6'] : '',
        ];
		$instance['imagesB'] = [
			'B1' =>  ( ! empty( $new_instance['imageB1'] ) ) ? $new_instance['imageB1'] : '',
			'B2' =>  ( ! empty( $new_instance['imageB2'] ) ) ? $new_instance['imageB2'] : '',
			'B3' =>  ( ! empty( $new_instance['imageB3'] ) ) ? $new_instance['imageB3'] : '',
			'B4' =>  ( ! empty( $new_instance['imageB4'] ) ) ? $new_instance['imageB4'] : '',
			'B5' =>  ( ! empty( $new_instance['imageB5'] ) ) ? $new_instance['imageB5'] : '',
			'B6' =>  ( ! empty( $new_instance['imageB6'] ) ) ? $new_instance['imageB6'] : '',
		];
		$instance['linksC'] = [
			'C1' =>  ( ! empty( $new_instance['linkC1'] ) ) ? $new_instance['linkC1'] : '',
			'C2' =>  ( ! empty( $new_instance['linkC2'] ) ) ? $new_instance['linkC2'] : '',
			'C3' =>  ( ! empty( $new_instance['linkC3'] ) ) ? $new_instance['linkC3'] : '',
			'C4' =>  ( ! empty( $new_instance['linkC4'] ) ) ? $new_instance['linkC4'] : '',
			'C5' =>  ( ! empty( $new_instance['linkC5'] ) ) ? $new_instance['linkC5'] : '',
			'C6' =>  ( ! empty( $new_instance['linkC6'] ) ) ? $new_instance['linkC6'] : '',
		];
		$instance['imagesC'] = [
			'C1' =>  ( ! empty( $new_instance['imageC1'] ) ) ? $new_instance['imageC1'] : '',
			'C2' =>  ( ! empty( $new_instance['imageC2'] ) ) ? $new_instance['imageC2'] : '',
			'C3' =>  ( ! empty( $new_instance['imageC3'] ) ) ? $new_instance['imageC3'] : '',
			'C4' =>  ( ! empty( $new_instance['imageC4'] ) ) ? $new_instance['imageC4'] : '',
			'C5' =>  ( ! empty( $new_instance['imageC5'] ) ) ? $new_instance['imageC5'] : '',
			'C6' =>  ( ! empty( $new_instance['imageC6'] ) ) ? $new_instance['imageC6'] : '',
		];
		$instance['linksD'] = [
			'D1' =>  ( ! empty( $new_instance['linkD1'] ) ) ? $new_instance['linkD1'] : '',
			'D2' =>  ( ! empty( $new_instance['linkD2'] ) ) ? $new_instance['linkD2'] : '',
		];
		$instance['imagesD'] = [
			'D1' =>  ( ! empty( $new_instance['imageD1'] ) ) ? $new_instance['imageD1'] : '',
			'D2' =>  ( ! empty( $new_instance['imageD2'] ) ) ? $new_instance['imageD2'] : '',
		];
		$instance['linksF'] = [
			'F1' =>  ( ! empty( $new_instance['linkF1'] ) ) ? $new_instance['linkF1'] : '',
			'F2' =>  ( ! empty( $new_instance['linkF2'] ) ) ? $new_instance['linkF2'] : '',
			'F3' =>  ( ! empty( $new_instance['linkF3'] ) ) ? $new_instance['linkF3'] : '',
		];
		$instance['imagesF'] = [
			'F1' =>  ( ! empty( $new_instance['imageF1'] ) ) ? $new_instance['imageF1'] : '',
			'F2' =>  ( ! empty( $new_instance['imageF2'] ) ) ? $new_instance['imageF2'] : '',
			'F3' =>  ( ! empty( $new_instance['imageF3'] ) ) ? $new_instance['imageF3'] : '',
		];

		return $instance;
	}
}

add_action( 'widgets_init', 'register_my_widgets' );
function register_my_widgets(){
	register_widget( 'trueTopPostsWidget' );
	register_widget( 'plugsWidget' );
	register_sidebar( array(
		'name'          => 'Растяжка',
		'id'            => "topbanner",
	) );
	register_sidebar( array(
		'name'          => 'Заглушки',
		'id'            => "plugs",
	) );
	register_sidebar( array(
		'name'          => 'Растяжка на прототипы',
		'id'            => "protobaner",
	) );
}

/**
 * Возможность загружать изображения для терминов (элементов таксономий: категории, метки).
 *
 * Пример получения ID и URL картинки термина:
 *     $image_id = get_term_meta( $term_id, '_thumbnail_id', 1 );
 *     $image_url = wp_get_attachment_image_url( $image_id, 'thumbnail' );
 *
 * @author: Kama http://wp-kama.ru
 *
 * @version 3.0
 */
if( is_admin() && ! class_exists('Term_Meta_Image') ){

	// init
	//add_action('current_screen', 'Term_Meta_Image_init');
	add_action( 'admin_init', 'Term_Meta_Image_init' );
	function Term_Meta_Image_init(){
		$GLOBALS['Term_Meta_Image'] = new Term_Meta_Image();
	}

	class Term_Meta_Image {

		// для каких таксономий включить код. По умолчанию для всех публичных
		static $taxes = []; // пример: array('category', 'post_tag');

		// название мета ключа
		static $meta_key = '_thumbnail_id';
		static $attach_term_meta_key = 'img_term';

		// URL пустой картинки
		static $add_img_url = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAC7u7s37rVJAAAAAXRSTlMAQObYZgAAACJJREFUOMtjGAV0BvL/G0YMr/4/CDwY0rzBFJ704o0CWgMAvyaRh+c6m54AAAAASUVORK5CYII=';

		public function __construct(){
			// once
			if( isset($GLOBALS['Term_Meta_Image']) )
				return $GLOBALS['Term_Meta_Image'];

			$taxes = self::$taxes ? self::$taxes : get_taxonomies( [ 'public' =>true ], 'names' );

			foreach( $taxes as $taxname ){
				add_action( "{$taxname}_add_form_fields",   [ $this, 'add_term_image' ],     10, 2 );
				add_action( "{$taxname}_edit_form_fields",  [ $this, 'update_term_image' ],  10, 2 );
				add_action( "created_{$taxname}",           [ $this, 'save_term_image' ],    10, 2 );
				add_action( "edited_{$taxname}",            [ $this, 'updated_term_image' ], 10, 2 );

				add_filter( "manage_edit-{$taxname}_columns",  [ $this, 'add_image_column' ] );
				add_filter( "manage_{$taxname}_custom_column", [ $this, 'fill_image_column' ], 10, 3 );
			}
		}

		## поля при создании термина
		public function add_term_image( $taxonomy ){
			wp_enqueue_media(); // подключим стили медиа, если их нет

			add_action('admin_print_footer_scripts', [ $this, 'add_script' ], 99 );
			$this->css();
			?>
            <div class="form-field term-group">
                <label><?php _e('Image', 'default'); ?></label>
                <div class="term__image__wrapper">
                    <a class="termeta_img_button" href="#">
                        <img src="<?php echo self::$add_img_url ?>" alt="">
                    </a>
                    <input type="button" class="button button-secondary termeta_img_remove" value="<?php _e( 'Remove', 'default' ); ?>" />
                </div>

                <input type="hidden" id="term_imgid" name="term_imgid" value="">
            </div>
			<?php
		}

		## поля при редактировании термина
		public function update_term_image( $term, $taxonomy ){
			wp_enqueue_media(); // подключим стили медиа, если их нет

			add_action('admin_print_footer_scripts', [ $this, 'add_script' ], 99 );

			$image_id = get_term_meta( $term->term_id, self::$meta_key, true );
			$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'thumbnail' ) : self::$add_img_url;
			$this->css();
			?>
            <tr class="form-field term-group-wrap">
                <th scope="row"><?php _e( 'Image', 'default' ); ?></th>
                <td>
                    <div class="term__image__wrapper">
                        <a class="termeta_img_button" href="#">
							<?php echo '<img src="'. $image_url .'" alt="">'; ?>
                        </a>
                        <input type="button" class="button button-secondary termeta_img_remove" value="<?php _e( 'Remove', 'default' ); ?>" />
                    </div>

                    <input type="hidden" id="term_imgid" name="term_imgid" value="<?php echo $image_id; ?>">
                </td>
            </tr>
			<?php
		}

		public function css(){
			?>
            <style>
                .termeta_img_button{ display:inline-block; margin-right:1em; }
                .termeta_img_button img{ display:block; float:left; margin:0; padding:0; min-width:100px; max-width:150px; height:auto; background:rgba(0,0,0,.07); }
                .termeta_img_button:hover img{ opacity:.8; }
                .termeta_img_button:after{ content:''; display:table; clear:both; }
            </style>
			<?php
		}

		## Add script
		public function add_script(){
			// выходим если не на нужной странице таксономии
			//$cs = get_current_screen();
			//if( ! in_array($cs->base, array('edit-tags','term')) || ! in_array($cs->taxonomy, (array) $this->for_taxes) )
			//  return;

			$title = __('Изображение', 'default');
			$button_txt = __('Установить изображение', 'default');
			?>
            <script>
              jQuery(document).ready(function($){
                var frame,
                  $imgwrap = $('.term__image__wrapper'),
                  $imgid   = $('#term_imgid');

                // добавление
                $('.termeta_img_button').click( function(ev){
                  ev.preventDefault();

                  if( frame ){ frame.open(); return; }

                  // задаем media frame
                  frame = wp.media.frames.questImgAdd = wp.media({
                    states: [
                      new wp.media.controller.Library({
                        title:    '<?php echo $title ?>',
                        library:   wp.media.query({ type: 'image' }),
                        multiple: false,
                        //date:   false
                      })
                    ],
                    button: {
                      text: '<?php echo $button_txt ?>', // Set the text of the button.
                    }
                  });

                  // выбор
                  frame.on('select', function(){
                    var selected = frame.state().get('selection').first().toJSON();
                    if( selected ){
                      $imgid.val( selected.id );
                      $imgwrap.find('img').attr('src', selected.sizes.thumbnail.url );
                    }
                  } );

                  // открываем
                  frame.on('open', function(){
                    if( $imgid.val() ) frame.state().get('selection').add( wp.media.attachment( $imgid.val() ) );
                  });

                  frame.open();
                });

                // удаление
                $('.termeta_img_remove').click(function(){
                  $imgid.val('');
                  $imgwrap.find('img').attr('src','<?php echo self::$add_img_url ?>');
                });
              });
            </script>

			<?php
		}

		## Добавляет колонку картинки в таблицу терминов
		public function add_image_column( $columns ){
			// fix column width
			add_action( 'admin_notices', function(){
				echo '<style>.column-image{ width:50px; text-align:center; }</style>';
			});

			// column without name
			return array_slice( $columns, 0, 1 ) + [ 'image' =>'' ] + $columns;
		}

		public function fill_image_column( $string, $column_name, $term_id ){

			if( 'image' === $column_name && $image_id = get_term_meta( $term_id, self::$meta_key, 1 ) ){
				$string = '<img src="'. wp_get_attachment_image_url( $image_id, 'thumbnail' ) .'" width="50" height="50" alt="" style="border-radius:4px;" />';
			}

			return $string;
		}

		## Save the form field
		public function save_term_image( $term_id, $tt_id ){
			if( isset($_POST['term_imgid']) && $attach_id = (int) $_POST['term_imgid'] ){
				update_term_meta( $term_id,   self::$meta_key,             $attach_id );
				update_post_meta( $attach_id, self::$attach_term_meta_key, $term_id );
			}
		}

		## Update the form field value
		public function updated_term_image( $term_id, $tt_id ){
			if( ! isset($_POST['term_imgid']) )
				return;

			$cur_term_attach_id = (int) get_term_meta( $term_id, self::$meta_key, 1 );

			if( $attach_id = (int) $_POST['term_imgid'] ){
				update_term_meta( $term_id,   self::$meta_key,             $attach_id );
				update_post_meta( $attach_id, self::$attach_term_meta_key, $term_id );

				if( $cur_term_attach_id != $attach_id )
					wp_delete_attachment( $cur_term_attach_id );
			}
			else {
				if( $cur_term_attach_id )
					wp_delete_attachment( $cur_term_attach_id );

				delete_term_meta( $term_id, self::$meta_key );
			}
		}

	}

}

/*________Start Loadmore_____________*/
$loadMoreNum = 0;

function load_posts(){
	check_ajax_referer('loading', 'nonce');

	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['offset'] = $_POST['offset'];
	$args['posts_per_page'] = $_POST['perView'];
	$args['post_status'] = 'publish';
	$args['cat'] = '-1480';
	$block = $_POST['block'];

	$horizontalBar =  json_decode(stripslashes($_POST['horizontalBar']), true);
	$verticalBlock__botBlock =  json_decode(stripslashes($_POST['verticalBar']), true);

	query_posts( $args );

	if( have_posts() ) :
		while( have_posts() ): the_post();

			require locate_template('includes/' . $block . '.php');

		endwhile;
	endif;
	wp_die();
}

add_action('wp_ajax_loadmore', 'load_posts');
add_action('wp_ajax_nopriv_loadmore', 'load_posts');

function section_select(){

	$cat = $_POST['cat'];

	$args = [
		'posts_per_page' => 6,
		'offset' => 0,
		'post_status' => 'publish',
		'ignore_sticky_posts'=> true,
		'tax_query' => [
			'relation' => 'AND',
			[
				"operator" => 'IN',
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => [ $cat ]
			],
			[
				"operator" => 'IN',
				'taxonomy' => 'mainthemes',
				'field' => 'id',
				'terms' => [ '1601' ]
			],
		]
	];

	query_posts( $args );

	$verticalBlock__botBlock = false;

	if( have_posts() ) :
		while( have_posts() ): the_post();

			require locate_template('includes/verticalBlock__botBlock.php');

		endwhile;
	endif;
	wp_die();
}

add_action('wp_ajax_sectionSelect', 'section_select');
add_action('wp_ajax_nopriv_sectionSelect', 'section_select');

function my_load_more_scripts() {

	wp_enqueue_script('jquery');

	wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/js/loadMores.min.js', array( 'jquery' ), false, false );
	wp_register_script( 'sectionSelect', get_stylesheet_directory_uri() . '/js/sections.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'foxyCheck', get_stylesheet_directory_uri() . '/js/foxyCheck.min.js', array( 'jquery' ), false, true );
//	wp_register_script( 'quiz', get_stylesheet_directory_uri() . '/js/quiz.js', array( 'jquery' ), false, true );

	wp_localize_script( 'my_loadmore', 'loadmore_params', array(
		'ajaxurl'      => site_url() . '/wp-admin/admin-ajax.php',
		'block' => [],
		'posts' => [],
		'offset' => [],
		'perView' => [],
		'horizontalBar' => [],
		'verticalBar' => [],
        'nonce' => wp_create_nonce('loading'),
	) );
	wp_localize_script( 'sectionSelect', 'sectionSelect_params', array(
		'ajaxurl'      => site_url() . '/wp-admin/admin-ajax.php',
	) );
//	wp_localize_script( 'quiz', 'params', array(
//		'ajaxurl'      => site_url() . '/wp-admin/admin-ajax.php',
//		'nonce' => wp_create_nonce('quizFinish'),
//	) );
	wp_localize_script( 'foxyCheck', 'params', array(
		'ajaxurl'      => site_url() . '/wp-admin/admin-ajax.php',
	) );

	wp_enqueue_script( 'my_loadmore' );
	wp_enqueue_script( 'sectionSelect' );
	wp_enqueue_script( 'foxyCheck' );
}
add_action( 'wp_enqueue_scripts', 'my_load_more_scripts' );

function singleLoad(){
	$offset = $_POST['offset'];
	$is_PC = $_POST['pc'];
    $ghost = $_POST['ghost'];

	if($offset > 4) {
		die();
	} else {
		$args = array(
			'post__not_in' => [$_POST['currID']],
			'field' => 'slug',
			'mainthemes'    => 'kratko',
			'offset' => $offset,
			'post_status' => 'publish',
			'posts_per_page' => 1,
			'category__not_in' => [1480]
		);
	}

	query_posts( $args );

	if( have_posts() ) :
		while( have_posts() ): the_post();

			 require locate_template( 'includes/single__mainWrapper.php');

        endwhile;
	endif;
	die();
}

add_action('wp_ajax_singleLoad', 'singleLoad', 999, 2);
add_action('wp_ajax_nopriv_singleLoad', 'singleLoad', 999, 2);

function true_load_events(){
	echo do_shortcode('[events_list scope="future" limit=30 offset=6 orderby="event_start_date" order="ASC"]
        <a href="#_EVENTURL" class="horizontalBar__blc">
    <div class="horizontalBar__blcLeft imgBlock">
        <img src="#_EVENTIMAGEURL">
    </div>
    <div class="horizontalBar__blcRight">
    <span class="horizontalBar__blcRightTitle">
        #_EVENTNAME
    </span>
        <div class="dateAndViews start">
        <span class="eventsDate">
            #_EVENTDATES
        </span>
            <span class="city">
            #_LOCATIONTOWN
        </span>
        </div>
        <span class="horizontalBar__blcRightText">
            #_EVENTEXCERPT{25,...}                                    
        </span>
    </div>
</a>
    [/events_list]');
	die();
}

add_action('wp_ajax_events', 'true_load_events');
add_action('wp_ajax_nopriv_events', 'true_load_events');

function plugsLoad(){
	dynamic_sidebar('plugs');
	die();
}

add_action('wp_ajax_plugsLoad', 'plugsLoad');
add_action('wp_ajax_nopriv_plugsLoad', 'plugsLoad');

function archiveloadmore(){
	$offsetLoad = $_POST['offset'];

	$magazines3 = get_terms(array(
		'taxonomy' => 'magazins',
		'offset' => $offsetLoad,
		'number' => '9',
		'orderby' => 'slug',
		'order' => 'DESC',
	));

	if( $magazines3 ) :

		foreach( $magazines3 as $mag ) {

			require locate_template('includes/magazine__item.php');

		}

	endif;
	die();
}

add_action('wp_ajax_archiveloadmore', 'archiveloadmore');
add_action('wp_ajax_nopriv_archiveloadmore', 'archiveloadmore');

function loadMorePopular(){
	$offsetLoad = $_POST['offset'];

	if ( function_exists('wpp_get_mostpopular') ) {

		wpp_get_mostpopular(array(
			'limit' => 10,
			'offset' => $offsetLoad,
			'range' => 'last7days',
			'stats_date' => 1,
			'stats_category' => 1,
			'stats_date_format' => 'j.m.Y',
			'wpp_start' => '',
			'wpp_end' => '',
			'thumbnail_width' => 800,
			'thumbnail_height' => 600,
			'post_html' => '
            <a href="{url}" class="horizontalBar__blc">
                <div class="horizontalBar__blcLeft imgBlock">
                    <img src="{thumb_url}">
                </div>
                <div class="horizontalBar__blcRight">
                <span class="horizontalBar__blcRightTitle">
                    {text_title}
                </span>
                </div>
            </a>
            '
		));
	}

	die();
}

add_action('wp_ajax_loadMorePopular', 'loadMorePopular');
add_action('wp_ajax_nopriv_loadMorePopular', 'loadMorePopular');

//function quizLoad(){
//	check_ajax_referer('quizFinish', 'nonce');
//
//	$id = $_POST['id'];
//
//    require locate_template('includes/QUIZfinish.php');
//
//	wp_die();
//}
//
//add_action('wp_ajax_quizLoad', 'quizLoad');
//add_action('wp_ajax_nopriv_quizLoad', 'quizLoad');


/*________End Loadmore_____________*/


function wpp_parse_tags_in_popular_posts($html, $post_id){

	// Replace custom content tag {tags} with actual tags
	if ( false !== strpos($html, '{catsNames}') ) {
		$cat = get_the_category($post_id);

		if ( $cat ) {
			$name = $cat[0]->name;

			// Remove last comma from tags list
			$cats = rtrim($name, ', ');
			// Replace {tags} with the actual tags
			$html = str_replace('{catsNames}', $cats, $html);
		}
	}
	if ( false !== strpos($html, '{time}') ) {
		$cat = get_post_time("H:i", false, $post_id);;

		if ( $cat ) {

			// Replace {tags} with the actual tags
			$html = str_replace('{time}', $cat, $html);
		}
	}

	return $html;

}
add_filter("wpp_parse_custom_content_tags", "wpp_parse_tags_in_popular_posts", 10, 2);

