<?php
get_header();
if ( have_posts() ) : while ( have_posts() ):
	the_post();
	?>
	<main <?php post_class(); ?>>
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-8">
					<?php the_title('<h2>', '</h2>'); ?>
					<div class="row lp-news-meta mt-3 mb-2">
						<div class="col-6 post-date-container">
							<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php the_time(get_option( 'date_format' )); ?>
						</div>
						<div class="col-6 text-right">
							<i class="fa fa-user" aria-hidden="true"></i> <?php the_author_posts_link(); ?>
						</div>
					</div>
					<?php if ( has_post_thumbnail() ): ?>
					<img src="<?php the_post_thumbnail_url('container-image'); ?>" class="img-fluid w-100 mb-4">
					<?php endif; ?>
					<?php the_content(); ?>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</main>
	<?php
endwhile; endif;
get_footer();