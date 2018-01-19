<?php
// Template Name: Social Media Seite
get_header();
if ( have_posts() ) : while ( have_posts() ):
	the_post();
	?>
	<main <?php post_class(); ?>>
		<div class="container">
			<div class="row">
				<div style="width: 100%;" class="col-12">
					<?php
					the_title('<h2 class="mb-4">', '</h2>');
					the_content();
					?>
				</div>
			</div>
		</div>
	</main>
	<?php
endwhile; endif;
get_footer();

