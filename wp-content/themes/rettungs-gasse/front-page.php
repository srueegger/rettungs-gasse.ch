<?php
get_header();
if ( have_posts() ) : while ( have_posts() ):
	the_post();
	?>
	<main <?php post_class(); ?>>
		<div class="container-fluid p-0">
			<div id="lp-slider" class="carousel slide" data-ride="carousel" data-interval="<?php the_field('slider_speed'); ?>">
				<ol class="carousel-indicators">
					<?php
					$counter = 0;
					while( have_rows('slider_settings') ):
						the_row();
						$active = '';
						if($counter == 0):
							$active = ' active"';
						endif;
						echo '<li data-target="#lp-slider" data-slide-to="'.$counter.'" class="slider-indicator'.$active.'"></li>';
						$counter++;
					endwhile;
					?>
				</ol>
				<div class="carousel-inner">
					<?php
					$counter = 1;
					while( have_rows('slider_settings') ):
						the_row();
						$active = '';
						if($counter == 1):
							$active = ' active';
						endif;
						$image = get_sub_field('image');
						?>
						<div style="background-image: url('<?php echo $image['sizes']['fullwidth-image']; ?>');" class="lp-bg-slide-item carousel-item<?php echo $active; ?>">
							<!-- <img class="d-block w-100 no-border lp-main-slider" src="<?php echo $image['sizes']['fullwidth-image']; ?>" alt="<?php echo $counter; ?>. Slide"> -->
							<?php if(!empty(get_sub_field('title')) or !empty(get_sub_field('slider_txt'))): ?>
								<div class="carousel-caption d-none d-md-block">
									<?php if(!empty(get_sub_field('title'))): ?>
										<h2><?php the_sub_field('title'); ?></h2>
									<?php endif; ?>
									<?php
									if(!empty(get_sub_field('slider_txt'))):
										the_sub_field('slider_txt');
									endif;
									?>
								</div>
							<?php endif; ?>
						</div>
						<?php
						$counter++;
					endwhile;
					?>
				</div>
				<?php rg_print_slider_controls('lp-slider'); ?>
			</div>
		</div>
		<?php while( have_rows('minislider_settings') ): the_row(); ?>
		<div class="container-fluid mt-5">
			<div id="lp-content-slider" class="carousel slide d-none d-lg-block" data-ride="carousel" data-interval="<?php the_sub_field('geschwindigkeit_des_mini_sliders'); ?>">
				<div class="carousel-inner carousel-inner-lpcontentslider row mx-auto" role="listbox">
					<?php
					$counter = 1;
					while( have_rows('slider') ):
						the_row();
						$active = '';
						if($counter == 1):
							$active = ' active';
						endif;
						$image = get_sub_field('image');
						$link = get_sub_field('link');
						?>
						<div class="carousel-item carousel-lpcontent-item col-4<?php echo $active; ?>">
							<div class="bg-lp-content-img-container" style="background-image: url('<?php echo $image['sizes']['content-slider']; ?>');">
								<h4><?php the_sub_field('text'); ?></h4>
								<?php
								$target = '_self';
								if(!empty($link['target'])):
									$target = '_blank';
								endif;
								?>
								<p><a target="<?php echo $target; ?>" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a></p>
							</div>
						</div>
						<?php
						$counter++;
					endwhile;
					?>
				</div>
				<?php rg_print_slider_controls('lp-content-slider'); ?>
			</div>
			<div id="lp-content-slider-mobile" class="carousel slide d-block d-lg-none" data-ride="carousel" data-interval="<?php the_sub_field('geschwindigkeit_des_mini_sliders'); ?>">
				<div class="carousel-inner carousel-inner-lpcontentslider-mobile row mx-auto" role="listbox">
					<?php
					$counter = 1;
					while( have_rows('slider') ):
						the_row();
						$active = '';
						if($counter == 1):
							$active = ' active';
						endif;
						$image = get_sub_field('image');
						$link = get_sub_field('link');
						?>
						<div class="carousel-item carousel-lpcontent-item-mobile col-12<?php echo $active; ?>">
							<div class="bg-lp-content-img-container" style="background-image: url('<?php echo $image['sizes']['content-slider']; ?>');">
								<h4><?php the_sub_field('text'); ?></h4>
								<?php
								$target = '_self';
								if(!empty($link['target'])):
									$target = '_blank';
								endif;
								?>
								<p><a target="<?php echo $target; ?>" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a></p>
							</div>
						</div>
						<?php
						$counter++;
					endwhile;
					?>
				</div>
				<?php rg_print_slider_controls('lp-content-slider-mobile'); ?>
			</div>
		</div>
		<?php endwhile; ?>
		<?php
		$image_container = get_field('image_container');
		$target = '_self';
		if(!empty($image_container['button_link']['target'])):
			$target = '_blank';
		endif;
		?>
		<div id="lp-heros" class="d-inline-block mt-5" style="background-image: url('<?php echo $image_container['bg_image']['sizes']['fullwidth-image']; ?>');">
			<div class="container">
				<div class="row heros-white">
					<div class="col-12 text-center">
						<h2><?php echo $image_container['title']; ?></h2>
						<h3><?php echo $image_container['subtitle']; ?></h3>
						<p class="mt-5"><a class="btn btn-primary btn-lg" target="<?php echo $target; ?>" href="<?php echo $image_container['button_link']['url']; ?>"><?php echo $image_container['button_text']; ?></a></p>
					</div>
				</div>
				<div class="row">
				</div>
			</div>
		</div>
		<div class="container mt-5">
			<div class="row">
				<div class="col-12">
					<?php
					$newssettings = get_field('lp_news');
					?>
					<h2 class="text-center"><?php echo $newssettings['news_title']; ?></h2>
				</div>
			</div>
			<div class="row mt-3">
				<?php
					$args = array(
						'posts_per_page' => $newssettings['news_count'],
						'orderby' => 'date',
						'order' => 'DESC',
						'post_type' => 'post',
						'post_status' => 'publish',
						'suppress_filters' => false
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
			<div class="row mt-3">
				<div class="col-12">
					<p class="text-center"><a href="<?php echo HOME_URI; ?>/news" class="btn btn-primary">Ältere Neuigkeiten<i class="fa fa-chevron-down ml-2"></i></a></p>
				</div>
			</div>
		</div>
		<div class="jumbotron jumbotron-fluid mt-5 bg-primary">
			<div class="container">
				<?php
				$socialmedia_section = get_field('social_media_sektion');
				$menus = wp_get_nav_menu_items($socialmedia_section['menu_id']);
				?>
				<h2 class="display-3 text-white text-center"><?php echo $socialmedia_section['text']; ?></h2>
				<ul>
					<?php
					foreach($menus as $menu):
						$classes = implode(' ', $menu->classes);
						$target = '_blank';
						if(empty($menu->target)):
							$target = '_self;';
						endif;
						$icon = get_field('icon', $menu);
						?>
						<li><a href="<?php echo $menu->url; ?>" class="<?php echo $classes; ?>" target="<?php echo $target; ?>"><i class="fa <?php echo $icon; ?> fa-5x mr-3" aria-hidden="true"></i></a></li>
						<?php
					endforeach;
					?>
				</ul>
			</div>
		</div>
		<?php
			$testimonial_settings = get_field('testominal_settings');
		?>
		<div class="container mt-5">
			<div class="row">
				<div class="col-12">
					<h2 class="text-center"><?php echo $testimonial_settings['title']; ?></h2>
				</div>
			</div>
		</div>
		<div class="container-fluid my-5">
			<div id="testimonial-slider" class="carousel slide d-none d-lg-block" data-ride="carousel" data-interval="<?php echo $testimonial_settings['slider_speed']; ?>">
				<div class="container">
					<div class="carousel-inner carousel-inner-testimonial row mx-auto" role="listbox">
						<?php
						$args = array(
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'post_type' => 'testimonials',
							'post_status' => 'publish',
							'suppress_filters' => true,
							'tax_query' => array(
								array(
									'taxonomy' => 'testimonials_categories',
									'field' => 'term_id',
									'terms' => $testimonial_settings['slider_tax']
								)
							)
						);
						$posts = get_posts($args);
						global $post;
						$counter = 1;
						foreach($posts as $post):
							setup_postdata($post);
							$active = '';
							if($counter == 1):
								$active = ' active';
							endif;
							$image = get_field('image');
							?>
							<div class="carousel-item carousel-testimonial-item col-4<?php echo $active; ?>">
								<div class="testimonial-text">
									<i class="fa fa-quote-left fa-4x float-left mr-3 text-primary" aria-hidden="true"></i>
									<?php the_content(); ?>
								</div>
								<div class="row testimonial-meta">
									<div class="col-5">
										<img src="<?php echo $image['sizes']['testimonial-image']; ?>" class="testimonial-image float-left" alt="<?php the_title(); ?>">
									</div>
									<div class="col-7">
										<?php the_title('<h6>', '</h6>'); ?>
										<p class="testimonial-autor-txt"><?php the_field('job'); ?></p>
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
				<?php rg_print_slider_controls('testimonial-slider'); ?>
			</div>
			
			
			<div id="testimonial-slider-mobile" class="carousel slide d-block d-lg-none" data-ride="carousel" data-interval="<?php echo $testimonial_settings['slider_speed']; ?>">
				<div class="container">
					<div class="carousel-inner carousel-inner-testimonial-mobile row mx-auto" role="listbox">
						<?php
						global $post;
						$counter = 1;
						foreach($posts as $post):
							setup_postdata($post);
							$active = '';
							if($counter == 1):
								$active = ' active';
							endif;
							$image = get_field('image');
							?>
							<div class="carousel-item carousel-testimonial-item-mobile col-12<?php echo $active; ?>">
								<div class="testimonial-text px-3">
									<i class="fa fa-quote-left fa-4x float-left mr-3 text-primary" aria-hidden="true"></i>
									<?php the_content(); ?>
								</div>
								<div class="row testimonial-meta">
									<div class="col-5">
										<img src="<?php echo $image['sizes']['testimonial-image']; ?>" class="testimonial-image float-left" alt="<?php the_title(); ?>">
									</div>
									<div class="col-7">
										<?php the_title('<h6>', '</h6>'); ?>
										<p class="testimonial-autor-txt"><?php the_field('job'); ?></p>
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
				<?php rg_print_slider_controls('testimonial-slider-mobile'); ?>
			</div>

			
			
		</div>
	</main>
	<?php
endwhile; endif;
get_footer();

