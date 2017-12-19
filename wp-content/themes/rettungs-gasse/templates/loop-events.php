<?php
$post_classes = array(
	'col-12',
	'col-md-6',
	'col-lg-4'
);
?>
<div <?php post_class($post_classes); ?>>
	<div class="row lp-news-meta">
		<div class="col-12 post-date-container">
			<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php the_field('starttime') ?> Uhr
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
				<a href="<?php the_permalink(); ?>" class="btn btn-outline-primary"><?php the_field('events_txt_link', 'option'); ?></a>
			</p>
		</div>
	</div>
</div>