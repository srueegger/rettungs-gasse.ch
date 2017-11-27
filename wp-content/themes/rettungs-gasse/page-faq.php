<?php
/*
Template Name: FAQ - Seite
*/
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
					the_content();
					$args = array(
						'posts_per_page' => -1,
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'post_type' => 'faq',
						'post_status' => 'publish',
						'suppress_filters' => false,
						'tax_query' => array(
							array(
								'taxonomy' => 'faq_categories',
								'field' => 'term_id',
								'terms' => get_field('page_faq_tax')
							)
						)
					);
					$posts = get_posts($args);
					global $post;
					$counter = 1;
					?>
					<div id="accordion" class="mt-3" role="tablist">
						<?php
						foreach($posts as $post):
							setup_postdata($post);
							$show = '';
							if($counter == 1):
								$show = ' show';
							endif;
							$post_classes = array(
								'card',
								'mb-2'
							);
							?>
							 <div <?php post_class($post_classes); ?>>
							 	<div class="card-header" role="tab" id="heading<?php echo $counter; ?>">
							 		<p class="mb-0">
							 			<a class="faq-link" data-toggle="collapse" href="#collapse<?php echo $counter; ?>" aria-expanded="true" aria-controls="collapse<?php echo $counter; ?>">
								 			<i class="fa <?php the_field('icon'); ?>" aria-hidden="true"></i>
							 				<?php the_title(); ?>
										</a>
									</p>
								</div>
								<div id="collapse<?php echo $counter; ?>" class="collapse<?php echo $show; ?>" role="tabpanel" aria-labelledby="heading<?php echo $counter; ?>" data-parent="#accordion">
									<div class="card-body">
										<?php the_content(); ?>
									</div>
								</div>
							</div>
							<?php
							$counter++;
						endforeach;
						wp_reset_postdata();
						?>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div>
	</main>
	<?php
endwhile; endif;
get_footer();

