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
					$times = get_field('eventtimes');
					?>
					<p class="event-time-meta"><?php echo $times['starttime'] ?> &mdash; <?php echo $times['endtime'] ?></p>
					<?php
					if(has_post_thumbnail()):
						echo '<img src="'.get_the_post_thumbnail_url(null, 'container-image').'" alt="'.get_the_title().'" class="img-fluid mb-3">';
					endif;
					the_content();
					?>
					<div class="event-single-meta">
						<h3>Eventdetails</h3>
						<div class="row">
							<div class="col-12 col-lg-6">
								<p><strong>Startdatum:</strong><br><?php echo $times['starttime'] ?></p>
								<p><strong>Enddatum:</strong><br><?php echo $times['endtime'] ?></p>
							</div>
							<div class="col-12 col-lg-6">
								<p class="mb-0">
									<strong>Organisatoren:</strong>
									<ul class="list-inline">
										<?php
										$team_objects = get_field('event_org');
										if($team_objects):
											global $post;
											foreach($team_objects as $post):
												setup_postdata($post);
												echo '<li class="list-inline-item"><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
											endforeach;
											wp_reset_postdata();
										endif;
										?>
									</ul>
								</p>
								<?php
								$location_datas = get_field('location_datas');
								$location = $location_datas['maps_datas'];
								?>
								<p>
									<strong>Ort:</strong><br>
									<?php echo str_replace(',', '<br>', $location['address']); ?>
								</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="single-event-map">
							<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"><?php echo $location_datas['map_content']; ?></div>
						</div>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</main>
	<?php
endwhile; endif;
get_footer();