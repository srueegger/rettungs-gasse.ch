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
			if ( have_posts() ) : while ( have_posts() ):
				the_post();
				$image = get_field('image');
				?>
				<div <?php post_class($post_classes); ?>>
					<a href="<?php the_permalink(); ?>"><img class="img-fluid team-image" src="<?php echo $image['url']; ?>" alt="<?php the_title(); ?>"></a>
					<?php
					echo '<div class="carousel-caption team-caption">';
					the_title('<h3 class="team-title"><a href="'.get_the_permalink().'">', '</a></h3>');
					$terms = get_the_terms($post, 'team_functions');
					$terms_print = '';
					foreach($terms as $term):
						$terms_print .= $term->name.' ';
					endforeach;
					echo '<p class="team-function">'.$terms_print.'</p></div>';
					?>
				</div>
				<?php
				endwhile; endif;
			?>
		</div>
</main>
<?php
get_footer();