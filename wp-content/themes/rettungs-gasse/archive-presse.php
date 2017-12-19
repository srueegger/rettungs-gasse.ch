<?php
get_header();
?>
<main>
	<div class="container">
		<div class="row">
			<?php
			if ( have_posts() ) : while ( have_posts() ):
				the_post();
				get_template_part('templates/loop', 'presse');
			endwhile; endif;
			?>
		</div>
	</div>
</main>
<?php
get_footer();