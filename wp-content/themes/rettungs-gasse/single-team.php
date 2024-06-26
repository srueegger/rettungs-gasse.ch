<?php
get_header();
if ( have_posts() ) : while ( have_posts() ):
	the_post();
	?>
	<main <?php post_class(); ?>>
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-8">
					<?php
					the_title('<h2>', '</h2>');
					echo '<p class="text-center"><img src="'.get_field('image')['sizes']['team-list-image'].'" class="img-fluid team-image"></p>';
					the_field('more_txt');
					if(have_rows('links')):
						echo '<ul class="list-inline">';
						while(have_rows('links')):
							the_row();
							$link = get_sub_field('link');
							$target = '_self';
							if(!empty($link['target'])):
								$target = '_blank';
							endif;
							echo '<li class="list-inline-item mr-4"><a href="'.$link['url'].'" target="'.$target.'"><i class="fa '.get_sub_field('icon').' fa-5x" aria-hidden="true"></i></a></li>';
						endwhile;
						echo '</ul>';
					endif;
					?>
					<p class="mt-3"><a href="<?php echo get_post_type_archive_link('team'); ?>"><i class="fa fa-arrow-left mr-2" aria-hidden="true"></i><?php the_field('team_backlink_txt', 'option'); ?></a></p>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</main>
	<?php
endwhile; endif;
get_footer();