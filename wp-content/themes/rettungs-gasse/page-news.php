<?php
// Template Name: Newsübersicht
get_header();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
if ( have_posts() ) : while ( have_posts() ):
	the_post();
	?>
	<main <?php post_class(); ?>>
		<div class="container">
			<div class="row">
				<?php
				$newssettings = get_field('lp_news', get_option('page_on_front'));
				$args = array(
					'posts_per_page' => get_option('posts_per_page'),
					'orderby' => 'date',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => false,
					'paged' => $paged
				);
				$posts = get_posts($args);
				global $post;
				$post_classes = array('col-12', 'col-md-4');
				foreach($posts as $post):
					setup_postdata($post);
					?>
					<div <?php post_class($post_classes); ?>>
						<div class="row lp-news-meta">
							<div class="col-6 post-date-container">
								<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php the_time(get_option( 'date_format' )); ?>
							</div>
							<div class="col-6 text-right">
								<i class="fa fa-user" aria-hidden="true"></i> <?php the_author_posts_link(); ?>
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
									<a href="<?php the_permalink(); ?>" class="btn btn-outline-primary"><?php echo $newssettings['news_btn_txt']; ?></a>
								</p>
							</div>
						</div>
					</div>
					<?php
				endforeach;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</main>
	<?php
endwhile; endif;
get_footer();

