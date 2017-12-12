<?php
get_header();
?>
<main>
	<div class="container">
		<div class="row">
			<?php
			$post_classes = array(
				'col-12',
				'col-md-4'
			);
			$date_now = date('Y-m-d H:i:s');
			$args = array(
				'posts_per_page' => -1,
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
			$counter = 0;
			foreach($events as $post):
				setup_postdata( $post );
				?>
				<div <?php post_class($post_classes); ?>>
					<div class="row lp-news-meta">
						<div class="col-12 post-date-container">
							<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php the_field('starttime') ?>
						</div>
					</div>
					<?php if ( has_post_thumbnail() ): ?>
						<div class="row mt-2 lp-news-image">
							<div class="col-12">
								<a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url('news-image'); ?>" alt="<?php the_title(); ?>" class="img-fluid w-100"></a>
							</div>
						</div>
					<?php endif; ?>
					<div class="row mt-4 lp-news-text">
						<div class="col-12">
							<?php
							the_title('<h3>', '</h3>');
							the_excerpt();
							?>
						</div>
					</div>
					<div class="row lp-news-readmore">
						<div class="col-12">
							<p class="text-center">
								<a href="<?php the_permalink(); ?>" class="btn btn-outline-primary"><?php the_field('events_txt_link', 'option'); ?></a>
							</p>
						</div>
					</div>
				</div>
				<?php
				$counter++;
			endforeach;
			wp_reset_postdata();
			?>
		</div>
		<?php if($counter > 0): ?>
			<div class="row">
				<div id="all-event-map">
					<?php
					foreach($events as $post):
						setup_postdata( $post );
						$location_datas = get_field('location_datas');
						$location = $location_datas['maps_datas'];
						echo '<div class="marker" data-lat="'.$location['lat'].'" data-lng="'.$location['lng'].'">';
						the_title('<h4>','</h4>');
						echo '<p class="float-left">'.get_field('starttime').'</p>';
						echo '<p class="float-right"><a href="'.get_the_permalink().'">'.get_field('events_txt_link', 'option').'</a></p>';
						if ( has_post_thumbnail() ):
							echo '<img src="'.get_the_post_thumbnail_url(get_the_ID(), 'news-image').'" alt="'.get_the_title().'" class="img-fluid w-100 mb-2 no-border">';
						endif;
						the_excerpt();
						echo '<p><a href="'.get_the_permalink().'">'.get_field('events_txt_link', 'option').'</a></p>';
						echo '</div>';
					endforeach;
					wp_reset_postdata();
					?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();