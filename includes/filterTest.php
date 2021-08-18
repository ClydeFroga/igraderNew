    <?php if (is_tax('mainthemes')) {
	    $terms = get_terms( array(
		    'taxonomy'      => array( 'category' ),
		    'orderby'       => 'id',
		    'order'         => 'ASC',
		    'exclude'       => array(1480),
	    ) );
	    $tags = get_terms( array(
		    'taxonomy'      => array( 'post_tag' ),
		    'orderby'       => 'id',
		    'order'         => 'ASC',
	    ) );
        ?>
            <div class="filter">
                <form class="form" name="filterForm">
                    <div>
                        <span class="filterTitle">
                            Категории
                        </span>
                        <div class="filterItems">
                            <ul class="">
					            <?php
					            foreach( $terms as $term ) { ?>
                                    <li>
                                        <input name="category" id="<?php print_r($term -> slug); ?>" type="checkbox" value="<?php print_r($term -> term_id); ?>">
                                        <label for="<?php print_r($term -> slug); ?>"><?php print_r($term -> name); ?>  (<?php print_r($term -> count); ?>)</label>
                                    </li>
					            <?php } ?>
                            </ul>
                            <span class="filterMore">Показать больше</span>
                        </div>
                    </div>
                    <div>
                        <span class="filterTitle">
                            Теги
                        </span>
                        <div class="filterItems">
                            <ul class="">
				                <?php
				                foreach( $tags as $term ) { ?>
                                    <li>
                                        <input name="tag" id="<?php print_r($term -> slug); ?>" type="checkbox" value="<?php print_r($term -> term_id); ?>">
                                        <label for="<?php print_r($term -> slug); ?>"><?php print_r($term -> name); ?>  (<?php print_r($term -> count); ?>)</label>
                                    </li>
				                <?php } ?>
                            </ul>
                            <span class="filterMore">Показать больше</span>
                        </div>
                    </div>
                    <button type="submit">Применить</button>
                </form>
            </div>

        <script type="text/javascript" src="<?php bloginfo('template_url')?>/js/filter.js"></script>
    <?php } ?>