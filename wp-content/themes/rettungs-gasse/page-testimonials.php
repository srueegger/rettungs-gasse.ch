<?php
// Template Name: Testimonial Seite
get_header();
if ( have_posts() ) : while ( have_posts() ):
	the_post();
	?>
	<main <?php post_class(); ?>>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<?php
					the_title('<h2 class="mb-4">', '</h2>');
					the_content();
					?>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12 text-center mb-4">
					<button type="button" data-mixitup-control class="btn btn-primary mr-1" data-filter="all">Alle</button>
					<?php
					$terms_id = get_field('show_categories');
					foreach($terms_id as $term_id):
						$term = get_term($term_id);
						echo '<button type="button" data-mixitup-control class="btn btn-primary mr-1" data-filter=".'.$term->slug.'">'.$term->name.'</button>';
					endforeach;
					?>
				</div>
			</div>
			<div class="row filter-content-testimonials">
				<?php
				$args = array(
					'posts_per_page' => -1,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'post_type' => 'testimonials',
					'post_status' => 'publish',
					'suppress_filters' => false,
					'tax_query' => array(
						array(
							'taxonomy' => 'testimonials_categories',
							'field' => 'term_id',
							'terms' => get_field('show_categories')
						)
					)
				);
				$posts = get_posts($args);
				global $post;
				foreach($posts as $post):
					setup_postdata( $post );
					$image = get_field('image');
					$content = get_the_content();
					$content = htmlentities($content);
					$post_classes = array(
						'col-6',
						'col-md-4',
						'col-lg-3',
						'mb-4',
						'mix'
					);
					$terms = wp_get_post_terms( get_the_ID(), 'testimonials_categories');
					foreach($terms as $term):
						array_push($post_classes, $term->slug);
					endforeach;
					?>
					<div <?php post_class($post_classes); ?>>
						<a data-toggle="modal" data-job="<?php the_field('job'); ?>" data-img="<?php echo $image['sizes']['testimonial-image']; ?>" data-txtcontent="<?php echo $content; ?>" data-testname="<?php the_title(); ?>" data-target="#testimonialModal" href=""><img class="img-fluid w-100 new-test-image" src="<?php echo $image['sizes']['testimonial-image-big']; ?>" alt="<?php the_title(); ?>"></a>
					</div>
					<?php
				endforeach;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</main>
	<div class="modal fade" id="testimonialModal" tabindex="-1" role="dialog" aria-labelledby="testimonialModalTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="testimonialModalTitle"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-6">
						<p class="text-center"><img src="" alt="" class="img-fluid" id="testimonial-image-modal"></p>
						<p id="testimonial-job" class="text-center"></p>
						</div>
						<div id="modal-txt-content" class="col-6"></div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Schliessen</button>
			</div>
			</div>
		</div>
	</div>
	<?php
endwhile; endif;
get_footer();

