<?php
get_header();
?>
<main>
	<div class="container-fluid">
		<div class="row">
			<?php
			$args = array(
				'taxonomy' => 'partner_categories',
				'hide_empty' => true,
				'orderby' => 'menu_order',
				'order' => 'ASC'
			);
			$terms = get_terms($args);
			foreach($terms as $term):
				echo '<div class="col-12 col-lg-4 my-5">';
				echo '<h2>'.$term->name.'</h2>';
				$args = array(
					'posts_per_page' => -1,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'post_type' => 'partner',
					'post_status' => 'publish',
					'suppress_filters' => false,
					'tax_query' => array(
						array(
							'taxonomy' => 'partner_categories',
							'field' => 'term_id',
							'terms' => $term->term_id
						)
					)
				);
				$posts = get_posts($args);
				global $post;
				foreach($posts as $post):
					setup_postdata($post);
					?>
					<div <?php post_class('mt-5'); ?>>
					<?php
					$image = get_field('image');
					echo '<a target="_blank" href="'.get_field('url').'"><img class="img-fluid partner-image" src="'.$image['sizes']['presse-image'].'" alt="'.get_the_title().'"></a>';
					echo '</div>';
				endforeach;
				wp_reset_postdata();
				echo '</div>';
			endforeach;
			?>
		</div>
	</div>
</main>
<?php
get_footer();