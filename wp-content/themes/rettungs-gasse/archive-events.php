<?php
get_header();
?>
<main>
	<div class="container">
		<div class="row">
			<?php
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
				get_template_part( 'templates/loop', 'events' );
				$counter++;
			endforeach;
			wp_reset_postdata();
			?>
		</div>
		<?php if($counter > 0 && get_field('event_show_map', 'option')): ?>
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