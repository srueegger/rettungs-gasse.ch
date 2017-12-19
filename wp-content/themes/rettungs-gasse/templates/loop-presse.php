<?php
$post_classes = array(
	'col-12',
	'col-lg-6',
	'mb-3'
);
?>
<div <?php post_class($post_classes); ?>>
	<div class="presse-container p-3">
		<?php the_title('<h3 class="mt-3">', '</h3>'); ?>
		<div class="row lp-news-meta">
			<div class="col-12 post-date-container mb-3">
				<i class="fa fa-calendar-o mr-2" aria-hidden="true"></i><?php the_time(get_option( 'date_format' )); ?>
			</div>
		</div>
		<?php if(has_post_thumbnail()): ?>
		<div class="row">
			<div class="col-12">
				<img src="<?php the_post_thumbnail_url('presse-image'); ?>" class="img-fluid w-100 no-border">
			</div>
		</div>
		<?php endif; ?>
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