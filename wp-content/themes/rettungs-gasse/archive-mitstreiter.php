<?php
get_header();
?>
<main>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="controls text-center">
					<button type="button" class="btn btn-primary mr-1" data-filter="all"><?php the_field('mitstreiter_txt_all', 'option'); ?></button>
					<?php
					$args = array(
						'taxonomy' => 'mitstreiter_categories',
						'hide_empty' => true,
						'orderby' => 'menu_order',
						'order' => 'ASC'
					);
					$terms = get_terms($args);
					$count_terms = count($terms);
					$counter = 1;
					foreach($terms as $term):
						$class = ' mr-1';
						if($counter == $count_terms):
							$class = '';
						endif;
						echo '<button type="button" class="btn btn-primary'.$class.'" data-filter=".'.$term->slug.'">'.$term->name.'</button>';
						$counter++;
					endforeach;
					?>
				</div>
			</div>
		</div>
		<div class="filter-content row my-5">
			<?php
			$args = array(
				'posts_per_page' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'post_type' => 'mitstreiter',
				'post_status' => 'publish',
				'suppress_filters' => true,
			);
			$mitstreiter = get_posts($args);
			global $post;
			foreach($mitstreiter as $post):
				setup_postdata( $post );
				$image = get_field('image');
				$terms = wp_get_post_terms( get_the_ID(), 'mitstreiter_categories');
				$post_term = array();
				foreach($terms as $term):
					array_push($post_term, $term->slug);
				endforeach;
				$post_term = implode(' ', $post_term);
				?>
				<div class="mix <?php echo $post_term; ?> col-12 col-6 col-lg-4 p-2">
					<?php if(!empty(get_field('url'))): ?>
						<a href="<?php the_field('url'); ?>" target="_blank">
					<?php endif; ?>
					<div style="background-image: url('<?php echo $image['sizes']['news-image']; ?>');" class="mitstreiter-image">
						<?php the_title('<h6 class="mitstreiter-caption">', '</h6>'); ?>
					</div>
					<?php if(!empty(get_field('url'))): ?>
						</a>
					<?php endif; ?>
				</div>
				<?php
			endforeach;
			wp_reset_postdata();
			?>
		</div>
	</div>
</main>
<?php
get_footer();