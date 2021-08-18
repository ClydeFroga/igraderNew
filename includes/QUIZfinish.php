<?php if($id == 1) { ?>

<section class="finish">
	<img src="https://picsum.photos/800/600?random=1">
	<div>
		<h2>
			Диван-трансформер
		</h2>
		<p>
			Ты просто чудо эволюции, мечта бедного студента (богатого и не студента, впрочем, тоже) и вообще крутая штука. Потому что умеешь выкрутиться так, что прям диву даешься. При этом пространства много не занимаешь, глаз радуешь и… всегда держишь в тонусе тех, кто с тобой имеет дело 😁
		</p>
		<span>
            Поделитесь результатом
        </span>
		<div class="socialMedia">
			<a target="_blank" onclick="window.open('https://telegram.me/share/url?url=<?php the_permalink();?>&text=<?php the_title();?>', '', 'width=500,height=600')">
				<svg>
					<use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#telegram"></use>
				</svg>
			</a>
			<a target="_blank" onclick='window.open("http://vk.com/share.php?url=<?php the_permalink(); ?>&title=<?php the_title();?>&image=<?php $thumb_id = get_post_thumbnail_id(); $thumb_cover_url = wp_get_attachment_image_src($thumb_id, 'og-image', true); echo $thumb_cover_url[0];?>&noparse=true", "", "width=500,height=600")' >
				<svg>
					<use href="<?php echo get_template_directory_uri();?>/svg/out/symbol/svg/sprite.symbol.svg#vk"></use>
				</svg>
			</a>
			<a target="_blank" href="https://wa.me/?text=<?php the_title(); the_permalink();?>">
				<svg>
					<use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#whatsapp"></use>
				</svg>
			</a>
			<a target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&display=popup', '', 'width=500,height=600')">
				<svg>
					<use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#facebook"></use>
				</svg>
			</a>
		</div>

		<a href="<?php echo home_url(); ?>">Вернуться</a>
	</div>

</section>

<?php } ?>