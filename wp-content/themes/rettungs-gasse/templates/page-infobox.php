</p><div class="row info-container mx-auto">
	<?php
	while(have_rows('infokreise')):
		the_row();
		?>
		<div class="col-6 col-lg-3">
			<p style="background-color: <?php the_sub_field('bgcolor'); ?>" class="round-icon"><i class="fa <?php the_sub_field('icon'); ?>" aria-hidden="true"></i></p>
			<p class="counter-box" data-count="<?php the_sub_field('count_number'); ?>">0</p>
		</div>
	<?php endwhile; ?>
</div><p>