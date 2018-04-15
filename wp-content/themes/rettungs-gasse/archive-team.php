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
			if ( have_posts() ) : while ( have_posts() ):
				the_post();
				$image = get_field('image');
				$terms = get_the_terms($post, 'team_functions');
				$terms_print = '';
				if(!empty($terms)):
					foreach($terms as $term):
						$terms_print .= $term->name.' ';
					endforeach;
				endif;
				$quote = get_field('zitat_der_person');
				$quote = htmlentities($quote);
				$txt = get_field('more_txt');
				$txt = htmlentities($txt);
				$socialmedia = get_field('team_social_media_links');
				?>
				<a data-toggle="modal" data-target="#teamModal" data-mail="<?php echo $socialmedia['mail']; ?>" data-linkedin="<?php echo $socialmedia['linkedin']; ?>" data-facebook="<?php echo $socialmedia['facebook']; ?>" data-twitter="<?php echo $socialmedia['twitter']; ?>" data-instagram="<?php echo $socialmedia['instagram']; ?>" data-xing="<?php echo $socialmedia['xing']; ?>" data-quote="<?php echo $quote; ?>" data-img="<?php echo $image['sizes']['team-rechteck-container']; ?>" data-txt="<?php echo $txt; ?>" data-terms="<?php echo $terms_print; ?>" data-teamname="<?php the_title(); ?>" <?php post_class($post_classes); ?>>
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
				endwhile; endif;
			?>
		</div>
	</div>
	<?php if(!empty(get_field('team_organigram_titel', 'option'))): ?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h3><?php the_field('team_organigram_titel', 'option'); ?></h3>
				</div>
			</div>
		</div>
		<?php
	endif;
	if(!empty(get_field('team_image_organigram', 'option'))): ?>
		<div class="container-fluid mb-4">
			<div class="row">
				<div class="col-12">
					<img src="<?php echo get_field('team_image_organigram', 'option')['url']; ?>" class="no-border img-fluid" alt="Organigram">
				</div>
			</div>
		</div>
	<?php endif; ?>
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
							<ul class="list-inline">
								<li class="list-inline-item mr-4 mail-li"><a class="mail-link" href=""><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i></a></li>
								<li class="list-inline-item mr-4 linkedin-li"><a class="linkedin-link" href="" target="_blank"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></a></li>
								<li class="list-inline-item mr-4 facebook-li"><a class="facebook-link" href="" target="_blank"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a></li>
								<li class="list-inline-item mr-4 twitter-li"><a class="twitter-link" href="" target="_blank"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a></li>
								<li class="list-inline-item mr-4 instagram-li"><a class="instagram-link" href="" target="_blank"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a></li>
								<li class="list-inline-item mr-4 xing-li"><a class="xing-link" href="" target="_blank"><i class="fa fa-xing fa-2x" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><?php __rg_trans('Close'); ?></button>
			</div>
			</div>
		</div>
	</div>
<?php
get_footer();