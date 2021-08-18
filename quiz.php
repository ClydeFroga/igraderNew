<?php
/*
Template name: Quiz
*/
?>

<!DOCTYPE html>
<html lang="<?php bloginfo('language');?>">
<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="<?php bloginfo('template_url')?>/style.css?version=1.10">
	<link rel="stylesheet" href="<?php bloginfo('template_url')?>/styles/quiz.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url')?>/styles/fonts.css?version=2">
	<?php if(is_singular() && has_category(1480)) echo "<meta name='robots' content='noindex,nofollow'>";?>
	<script src="https://yastatic.net/pcode/adfox/loader.js" crossorigin="anonymous"></script>
	<?php wp_head();?>
</head>
<body class="quiz">

<form id="quiz" name="quiz">
	<div class="quiz__number">
            <span>
                1
            </span>
		<span>/</span>
		<span>3</span>
	</div>

	<div class="quiz__wrapper">
		<div class="quiz__bottom active">
			<h1 class="quiz__bottomTitle">
				Why did you decide to do the work you’re doing now?
			</h1>
			<div class="quiz__bottomVariants">
				<div>
					<input id="1" type="radio" value="1" name="first">
					<label for="1">Первый</label>
				</div>
				<div>
					<input id="2"  type="radio" value="2" name="first">
					<label for="2">Второй</label>
				</div>
				<div>
					<input id="3"  type="radio" value="3" name="first">
					<label for="3">Третий</label>
				</div>
				<div>
					<input id="4"  type="radio" value="4" name="first">
					<label for="4">Четвертый</label>
				</div>
			</div>
		</div>
		<div class="quiz__bottom">
			<h1 class="quiz__bottomTitle">
				Why did?
			</h1>
			<div class="quiz__bottomVariants">
				<div>
					<input id="5" type="radio" value="1" name="two">
					<label for="5">Пятый</label>
				</div>
				<div>
					<input id="6"  type="radio" value="2" name="two">
					<label for="6">Шестой</label>
				</div>
				<div>
					<input id="7"  type="radio" value="3" name="two">
					<label for="7">Седьмой</label>
				</div>
				<div>
					<input id="8"  type="radio" value="4" name="two">
					<label for="8">Восьмой</label>
				</div>
			</div>

		</div>
		<div class="quiz__bottom">
			<h1 class="quiz__bottomTitle">
				Why did?
			</h1>
			<div class="quiz__bottomVariants">
				<div>
					<input id="9" type="radio" value="1" name="three">
					<label for="9">Пятый</label>
				</div>
				<div>
					<input id="10"  type="radio" value="2" name="three">
					<label for="10">Шестой</label>
				</div>
				<div>
					<input id="11"  type="radio" value="3" name="three">
					<label for="11">Седьмой</label>
				</div>
				<div>
					<input id="12"  type="radio" value="4" name="three">
					<label for="12">Восьмой</label>
				</div>
			</div>

		</div>
	</div>

</form>


<?php //get_template_part('includes/counters');?>
<script src="<?php bloginfo('template_url')?>/js/gsap.min.js"></script>
<?php
wp_enqueue_script( 'quiz' );
?>
<!--<script src="--><?php //bloginfo('template_url')?><!--/js/quiz.js"></script>-->
<?php wp_footer(); ?>
</body>
</html>