<?php
get_header();
?>
<main>
	<div class="container">
		<div class="row">
			<?php
			$post_classes = array(
				'col-12',
				'col-md-6',
				'col-lg-4'
			);
			$counter = 1;
			if ( have_posts() ) : while ( have_posts() ):
				the_post();
				$image = get_field('image');
				?>
				<div <?php post_class($post_classes); ?>>
					<div id="team-img-<?php echo $counter; ?>">
						<a id="team-link-<?php echo $counter; ?>" href="!#"><img class="img-fluid team-image" src="<?php echo $image['sizes']['team-list-image']; ?>" alt="<?php the_title(); ?>"></a>
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
				<div id="team-desc-<?php echo $counter; ?>" class="col-12 team-archive-desc">
					<div class="row">
						<div class="col-12 col-md-6 d-none d-md-block">
							<img src="<?php echo $image['sizes']['team-list-image']; ?>" class="img-fluid team-image">
						</div>
						<div class="col-12 col-md-6">
							<?php
							the_title('<h3>', '</h3>');
							echo '<p><strong>'.$terms_print.'</strong></p>';
							the_field('more_txt');
							if(have_rows('links')):
								echo '<ul class="list-inline">';
								while(have_rows('links')):
									the_row();
									$link = get_sub_field('link');
									$target = '_self';
									if(!empty($link['target'])):
										$target = '_blank';
									endif;
									echo '<li class="list-inline-item mr-4"><a href="'.$link['url'].'" target="'.$target.'"><i class="fa '.get_sub_field('icon').' fa-5x" aria-hidden="true"></i></a></li>';
								endwhile;
								echo '</ul>';
							endif;
							?>
							<p class="text-right"><a id="close-teamdesc-<?php echo $counter; ?>" href="!#"><i class="fa fa-times" aria-hidden="true"></i> Schliessen</a></p>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					(function($) {
						$('#team-link-<?php echo $counter; ?>').on("click", function(e) {
							$('#team-desc-<?php echo $counter; ?>').slideToggle(500, 'linear');
							return false;
						});

						$('#team-caption-<?php echo $counter; ?>').on("click", function(e) {
							$('#team-desc-<?php echo $counter; ?>').slideToggle(500, 'linear');
							return false;
						});

						$('#close-teamdesc-<?php echo $counter; ?>').on("click", function(e) {
							$('#team-desc-<?php echo $counter; ?>').slideToggle(500, 'linear');
							return false;
						});
						
						$('#team-img-<?php echo $counter; ?>').hover(function () {
							$('#team-caption-<?php echo $counter; ?>').toggleClass('d-lg-none');
						}, 
						function () {
							$('#team-caption-<?php echo $counter; ?>').toggleClass('d-lg-none');
						});

						/*$('#team-caption-<?php echo $counter; ?>').hover(function () {
							$('#team-img-<?php echo $counter; ?>').css('filter','blur(5px)');
						}, 
						function () {
							$('#team-img-<?php echo $counter; ?>').css('filter','');
						});*/
					})(jQuery);
				</script>
				<?php
				$counter++;
				endwhile; endif;
			?>
		</div>
	</div>
</main>
<?php
get_footer();