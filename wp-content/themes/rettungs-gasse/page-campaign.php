<?php
// Template Name: Kampagnenseite
get_header();
if ( have_posts() ) : while ( have_posts() ):
	the_post();
	?>
	<main <?php post_class(); ?>>
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-8">
					<?php
					the_title('<h2 class="mb-4">', '</h2>');
					the_content();
					if(get_field('has_presse')):
						if(!empty(get_field('presse_title'))):
							echo '<h3>'.get_field('presse_title').'</h3>';
						endif;
						the_field('presse_txt');
						echo '<div class="row">';
						$presse_posts = get_field('presse_posts');
						global $post;
						foreach($presse_posts as $post):
							setup_postdata( $post );
							get_template_part('templates/loop', 'presse');
						endforeach;
						wp_reset_postdata();
						echo '</div>';
						if(get_field('presse_has_link')):
							echo '<p class="text-center"><a href="'.get_post_type_archive_link('presse').'" class="btn btn-primary">'.get_field('presse_linktext').'</a></p>';
						endif;
					endif;
					if(get_field('has_events')):
						if(!empty(get_field('events_title'))):
							echo '<h3>'.get_field('events_title').'</h3>';
						endif;
						the_field('events_txt');
						$date_now = date('Y-m-d H:i:s');
						$args = array(
							'posts_per_page' => get_field('events_count'),
							'post_type' => 'events',
							'meta_query' => array(
								array(
									'key' => 'starttime',
									'compare' => '>=',
									'value' => $date_now,
									'type' => 'DATETIME'
								)
							),
							'order' => 'ASC',
							'orderby' => 'meta_value',
							'meta_key' => 'starttime',
							'meta_type' => 'DATE',
							'post_status' => 'publish',
							'suppress_filters' => false
						);
						$events = get_posts($args);
						global $post;
						echo '<div class="row">';
						foreach($events as $post):
							setup_postdata( $post );
							get_template_part( 'templates/loop', 'events' );
						endforeach;
						echo '</div>';
						wp_reset_postdata();
						if(get_field('events_has_link')):
							echo '<p class="text-center"><a href="'.get_post_type_archive_link('events').'" class="btn btn-primary">'.get_field('events_linktext').'</a></p>';
						endif;
					endif;
					if(get_field('has_team')):
						if(!empty(get_field('team_title'))):
							echo '<h3>'.get_field('team_title').'</h3>';
						endif;
						the_field('team_txt');
						$team_posts = get_field('team_posts');
						global $post;
						$counter = 1;
						$post_classes = array(
							'col-12',
							'col-md-6',
							'mb-4'
						);
						echo '<div class="row">';
						foreach($team_posts as $post):
							setup_postdata( $post );
							$image = get_field('image');
							?>
							<div <?php post_class($post_classes); ?>>
								<div id="team-img-<?php echo $counter; ?>">
									<a id="team-link-<?php echo $counter; ?>" href="<?php the_permalink(); ?>"><img class="img-fluid team-image" src="<?php echo $image['sizes']['team-list-image']; ?>" alt="<?php the_title(); ?>"></a>
									<?php
									echo '<div id="team-caption-'.$counter.'" class="carousel-caption team-caption d-block d-lg-none">';
									the_title('<h3 class="team-title"><a href="'.get_the_permalink().'">', '</a></h3>');
									$terms = get_the_terms($post, 'team_functions');
									$terms_print = '';
									foreach($terms as $term):
										$terms_print .= $term->name.' ';
									endforeach;
									echo '<p class="team-function">'.$terms_print.'</p></div>';
									?>
								</div>
							</div>
							<script type="text/javascript">
								(function($) {
									$('#team-img-<?php echo $counter; ?>').hover(function () {
										$('#team-caption-<?php echo $counter; ?>').toggleClass('d-lg-none');
									}, 
									function () {
										$('#team-caption-<?php echo $counter; ?>').toggleClass('d-lg-none');
									});
								})(jQuery);
							</script>
							<?php
							$counter++;
						endforeach;
						echo '</div>';
						wp_reset_postdata();
						if(get_field('team_has_link')):
							echo '<p class="text-center"><a href="'.get_post_type_archive_link('team').'" class="btn btn-primary">'.get_field('team_linktext').'</a></p>';
						endif;
					endif;
					?>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</main>
	<?php
endwhile; endif;
get_footer();

