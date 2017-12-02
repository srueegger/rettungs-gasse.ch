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
						<a href="<?php the_permalink(); ?>"><img class="img-fluid team-image" src="<?php echo $image['sizes']['team-list-image']; ?>" alt="<?php the_title(); ?>"></a>
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
				<script type="text/javascript">
					(function($) {
						$('#team-img-<?php echo $counter; ?>').on()
						
						$('#team-img-<?php echo $counter; ?>').hover(function () {
							$('#team-caption-<?php echo $counter; ?>').toggleClass('d-lg-none');
						}, 
						function () {
							$('#team-caption-<?php echo $counter; ?>').toggleClass('d-lg-none');
						});
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