<?php
get_header();
?>
<main <?php post_class(); ?>>
	<div class="container-fluid downloads-categories">
		<div class="row">
			<?php
			$args = array(
				'taxonomy' => 'downloads_categories',
				'hide_empty' => true,
				'orderby' => 'menu_order',
				'order' => 'ASC'
			);
			$terms = get_terms($args);
			foreach($terms as $term):
				$image = get_field('term_img', $term);
				?>
				<div class="col-12 col-md-6 col-lg-4 tax-container">
					<a href="<?php echo get_term_link($term); ?>"><div style="background-image: url('<?php echo $image['sizes']['presse-image']; ?>');" class="download-image"></div></a>
					<div class="carousel-caption">
						<h3><a hreF="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a></h3>
					</div>
				</div>
				<?php
			endforeach;
			?>
		</div>
	</div>
</main>
<?php
get_footer();