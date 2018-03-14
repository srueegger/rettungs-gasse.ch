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
							<?php if(!empty(get_sub_field('title')) or !empty(get_sub_field('slider_txt'))): ?>
								<div class="carousel-caption lp-slider-caption d-none d-md-block">
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
			</div>
			<div class="front-scoll-button-container">
				<i id="fp-scroll-button" class="fa fa-chevron-down faa-bounce animated" aria-hidden="true"></i>
			</div>
		</div>
		<?php while( have_rows('minislider_settings') ): the_row(); ?>
		<div class="container-fluid mt-5 px-0">
			<div id="lp-content-slider" class="carousel slide d-none d-lg-block p-0 mx-0" data-ride="carousel" data-interval="<?php the_sub_field('geschwindigkeit_des_mini_sliders'); ?>">
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
		<div id="scrolltarget" class="container mt-5">
			<div class="row">
				<div class="col-12">
					<?php
					$newssettings = get_field('lp_news');
					?>
					<h2 class="text-center"><?php the_field('title_second_section'); ?></h2>
				</div>
			</div>
			<div class="row mt-3">
				<?php
					//Aktuellester Presse Artikel
					$args = array(
						'posts_per_page' => 1,
						'post_type' => 'presse',
						'order' => 'DESC',
						'orderby' => 'date',
						'post_status' => 'publish'
					);
					$posts = get_posts($args);
					global $post;
					foreach($posts as $post):
						setup_postdata( $post );
						$post_classes = array(
							'col-12',
							'col-md-6',
							'col-lg-4'
						);
						?>
						<div <?php post_class($post_classes); ?>>
							<div class="row lp-news-meta">
								<div class="col-12 post-date-container">
									<i class="fa fa-calendar-o mr-2" aria-hidden="true"></i><?php the_time(get_option( 'date_format' )); ?>
								</div>
								<?php if(has_post_thumbnail()): ?>
									<div class="row lp-news-image">
										<div class="col-12">
											<img src="<?php the_post_thumbnail_url('presse-image'); ?>" class="img-fluid w-100 no-border">
										</div>
									</div>
								<?php endif; ?>
								<?php the_title('<h3 class="mt-3">', '</h3>'); ?>
								<div class="row lp-news-meta">
									<div class="col-12 post-date-container mb-3">
										<i class="fa fa-calendar-o mr-2" aria-hidden="true"></i><?php the_time(get_option( 'date_format' )); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<?php
										the_content();
										if(get_field('has_link')):
											if(get_field('link_typ')):
												$link = get_field('link_file');
												if($link['mime_type'] == 'application/pdf'):
													$icon = 'fa-file-pdf-o';
												else:
													$icon = 'fa-download';
												endif;
											else:
												$link = array();
												$link['url'] = get_field('link_target');
												$icon = 'fa-globe';
											endif;
											?>
											<p class="text-right"><a href="<?php echo $link['url']; ?>" target="_blank"><i class="fa <?php echo $icon; ?> mr-2" aria-hidden="true"></i><?php the_field('presse_btn_readmore', 'option'); ?></a></p>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
						<?php
					endforeach;
					wp_reset_postdata();
					//Social Media Feed
					$sm_image = get_field('sm_image');
					?>
					<div class="col-12 col-md-6 col-lg-4">
						<div class="front-social-container">
							<a href="<?php the_field('sm_link'); ?>"><img style="border: none; margin-top: 32px;" class=" img-fluid" src="<?php echo $image['sizes']['news-image']; ?>" alt="Rettungs Gasse auf Social Media"></a>
							<h3 class="mt-4"><?php the_field('sm_txt'); ?></h3>
						</div>
					</div>
					<?php
					//Aktuellster Event
					$date_now = date('Y-m-d H:i:s');
					$args = array(
						'posts_per_page' => 1,
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
					$posts = get_posts($args);
					global $post;
					$post_classes = array('col-12', 'col-md-4');
					foreach($posts as $post):
						setup_postdata($post);
						get_template_part('templates/loop', 'events');
					endforeach;
					wp_reset_postdata();
				?>
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
							$bg = '';
							if ($counter % 2 == 0):
								$bg = ' bg-grau';
							endif;
							?>
							<div class="carousel-item carousel-testimonial-item col-4 py-2<?php echo $active.$bg; ?>">
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

