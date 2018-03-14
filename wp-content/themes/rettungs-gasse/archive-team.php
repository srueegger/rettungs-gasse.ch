<?php
get_header();
?>
<main>
	<div class="container">
		<div class="row">
			<?php
			$post_classes = array(
				'col-12',
				'col-md-3',
				'col-lg-4',
				'mb-4'
			);
			$counter = 1;
			if ( have_posts() ) : while ( have_posts() ):
				the_post();
				$image = get_field('image');
				?>
				<div id="team-desc-<?php the_ID(); ?>" class="col-12 team-archive-desc">
					<div class="row">
						<div class="col-12 col-md-4 d-none d-md-block">
							<img src="<?php echo $image['sizes']['team-rechteck-container']; ?>" class="img-fluid team-image">
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
				<?php
				$terms = get_the_terms($post, 'team_functions');
				$terms_print = '';
				foreach($terms as $term):
					$terms_print .= $term->name.' ';
				endforeach;
				$quote = get_field('zitat_der_person');
				$quote = htmlentities($quote);
				$txt = get_field('more_txt');
				$txt = htmlentities($txt);
				?>
				<a data-toggle="modal" data-target="#teamModal" data-quote="<?php echo $quote; ?>" data-img="<?php echo $image['sizes']['team-rechteck-container']; ?>" data-txt="<?php echo $txt; ?>" data-terms="<?php echo $terms_print; ?>" data-teamname="<?php the_title(); ?>" <?php post_class($post_classes); ?>>
					<div id="team-img-<?php the_ID(); ?>">
						<div id="layer-<?php the_ID(); ?>" class="team-layer"><img id="photo-<?php the_ID(); ?>" class="img-fluid team-image" src="<?php echo $image['sizes']['team-rechteck-container']; ?>" alt="<?php the_title(); ?>">
						<?php
						echo '<div id="team-caption-'.get_the_ID().'" class="carousel-caption team-caption">';
						the_title('<h3 class="team-title">', '</h3>');
						echo '<p class="team-function">'.$terms_print.'</p></div>';
						?>
						</div>
					</div>
				</a>
				<?php
				$counter++;
				endwhile; endif;
			?>
		</div>
	</div>
</main>
<div class="modal fade" id="teamModal" tabindex="-1" role="dialog" aria-labelledby="teamModalTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="teamModalTitle"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12 col-md-4">
							<p class="text-center">
								<img src="" alt="" class="img-fluid" id="team-image-modal">
							</p>
						</div>
						<div id="modal-txt-content" class="col-12 col-md-8">
							<strong class="term-titles"></strong>
							<p class="team-txt"></p>
							<blockquote class="team-quote"><i class="fa fa-quote-right fa-2x text-primary mr-3" aria-hidden="true"></i><span class="team-quote-insert" style="font-size: 2rem;"></span></blockquote>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Schliessen</button>
			</div>
			</div>
		</div>
	</div>
<?php
get_footer();