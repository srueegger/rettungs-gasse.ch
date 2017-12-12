<?php
get_header();
if ( have_posts() ) : while ( have_posts() ):
	the_post();
	$event_only_view = get_field('event_onlyview', 'option');
	?>
	<main <?php post_class(); ?>>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<?php
					$date_now = date('Y-m-d H:i:s');
					if($date_now > get_field('starttime', false, false)):
						?>
						<div class="alert alert-primary" role="alert">
							<?php echo $event_only_view['text_eventend']; ?>
						</div>
						<?php
					endif;
					the_title('<h2>', '</h2>');
					?>
					<p class="event-time-meta"><?php the_field('starttime'); ?> &mdash; <?php the_field('endtime'); ?></p>
					<?php
					if(has_post_thumbnail()):
						echo '<img src="'.get_the_post_thumbnail_url(null, 'fullwidth-image').'" alt="'.get_the_title().'" class="img-fluid mb-3">';
					endif;
					the_content();
					?>
					<div class="event-single-meta">
						<h3><?php echo $event_only_view['text_eventdetails']; ?></h3>
						<div class="row">
							<div class="col-12 col-lg-6">
								<p><strong></strong<?php echo $event_only_view['text_startdatum']; ?>><br><?php the_field('starttime'); ?></p>
								<p><strong><?php echo $event_only_view['text_enddatum']; ?></strong><br><?php the_field('endtime'); ?></p>
							</div>
							<div class="col-12 col-lg-6">
								<p class="mb-0">
									<strong><?php echo $event_only_view['text_organisatoren']; ?></strong>
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
						<div class="col-12">
							<div id="single-event-map">
								<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"><?php echo $location_datas['map_content']; ?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?php
endwhile; endif;
get_footer();