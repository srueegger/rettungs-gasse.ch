<?php
get_header();
?>
<main>
	<div class="container">
			<?php
			$post_classes = array(
				'col-12',
				'col-md-4',
				'col-lg-3',
				'mb-4'
			);
			$post_classes = array(
				'card'
			);
			$counter = 1;
			$rowcounter = 1;
			if ( have_posts() ) : while ( have_posts() ):
				the_post();
				$image = get_field('image');
				if($rowcounter == 1):
					?>
					<div class="card-deck">
				<?php endif; ?>
				<div id="team-desc-<?php the_ID(); ?>" class="team-archive-desc">
					<div class="row">
						<div class="col-12 col-md-4 d-none d-md-block">
							<img src="https://via.placeholder.com/475x271<?php #echo $image['sizes']['team-small-image']; ?>" class="img-fluid team-image">
						</div>
						<div class="col-12 col-md-8">
							<div class="row">
								<div class="col-10">
									<?php
									the_title('<h3>', '</h3>');
								echo '</div>';
								echo '<div class="col-2"><p class="float-right"><i id="close-team-desc-'.get_the_ID().'" class="fa fa-times fa-3x text-primary close-team-desc" aria-hidden="true"></i></p></div>';
							echo '</div>';
							echo '<p><strong>'.$terms_print.'</strong></p>';
							the_field('more_txt');
							if(!empty(get_field('zitat_der_person'))):
								echo '<blockquote class="team-quote"><i class="fa fa-quote-right fa-2x text-primary mr-3" aria-hidden="true"></i><span style="font-size: 2rem;">'.get_field('zitat_der_person').'</span></blockquote>';
							endif;
							if(have_rows('links')):
								echo '<ul class="list-inline">';
								while(have_rows('links')):
									the_row();
									$link = get_sub_field('link');
									$target = '_self';
									if(!empty($link['target'])):
										$target = '_blank';
									endif;
									echo '<li class="list-inline-item mr-4"><a href="'.$link['url'].'" target="'.$target.'"><i class="fa '.get_sub_field('icon').' fa-2x" aria-hidden="true"></i></a></li>';
								endwhile;
								echo '</ul>';
							endif;
							?>
						</div>
					</div>
				</div>
				<div <?php post_class($post_classes); ?>>
					<div id="team-img-<?php the_ID(); ?>">
						<div id="layer-<?php the_ID(); ?>" class="team-layer"><img id="photo-<?php the_ID(); ?>" class="img-fluid team-image" src="https://via.placeholder.com/475x271<?php #echo $image['sizes']['team-list-image']; ?>" alt="<?php the_title(); ?>">
						<?php
						echo '<div id="team-caption-'.get_the_ID().'" class="carousel-caption team-caption">';
						the_title('<h3 class="team-title">', '</h3>');
						$terms = get_the_terms($post, 'team_functions');
						$terms_print = '';
						foreach($terms as $term):
							$terms_print .= $term->name.' ';
						endforeach;
						echo '<p class="team-function">'.$terms_print.'</p></div>';
						?>
						</div>
					</div>
				</div>
				<?php
				$counter++;
				$rowcounter++;
				if($rowcounter == 4):
					echo '</div>';
					$rowcounter = 1;
				endif;
				endwhile; endif;
			?>
	</div>
</main>
<?php
get_footer();