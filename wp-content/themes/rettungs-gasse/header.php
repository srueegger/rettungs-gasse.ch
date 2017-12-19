<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<?php
		$metadatas = get_field('meta_infos', 'option');
		$logo = get_field('site_logo', 'option');
		?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="<?php echo $metadatas['meta_beschreibung']; ?>">
		<meta name="keywords" content="<?php echo $metadatas['meta_stichworte']; ?>">
		<meta name="author" content="Samuel Rüegger - rueegger.me">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo THEME_IMAGES; ?>/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo THEME_IMAGES; ?>/favicon-16x16.png">
		<link rel="manifest" href="<?php echo THEME_IMAGES; ?>/manifest.json">
		<link rel="mask-icon" href="<?php echo THEME_IMAGES; ?>/safari-pinned-tab.svg" color="#0e538e">
		<meta name="msapplication-TileColor" content="#0e538e">
		<meta name="msapplication-TileImage" content="<?php echo THEME_IMAGES; ?>/mstile-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<nav class="navbar navbar-expand-xl navbar-primary fixed-top">
		<a class="navbar-brand" href="<?php echo HOME_URI; ?>">
			<img src="<?php echo $logo['sizes']['site-logo']; ?>" class="img-fluid site-logo no-border" alt="Logo">
			<h1 class="sr-only"><?php echo get_option('blogname'); ?></h1>
		</a>
		<button id="mainmenu-trigger-menu" data-target="#rettungsgasse-mainmenu" data-toggle="collapse" class="hamburger hamburger--elastic d-lg-none mx-auto" type="button" aria-label="Menu" aria-controls="rettungsgasse-mainmenu">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</button>
		<?php
		wp_nav_menu(array(
			'theme_location'	=> 'main-menu',
			'container'			=> 'div',
			'container_id'		=> 'rettungsgasse-mainmenu',
			'container_class'	=> 'collapse navbar-collapse text-center',
			'menu_id'			=> false,
			'menu_class'		=> 'navbar-nav mx-auto',
			'fallback_cb'		=> 'wp_bootstrap_navwalker::fallback',
			'walker'			=> new wp_bootstrap_navwalker()
		));
		$header_link = get_field('header_link', 'option');
		if($header_link['header_link_has']):
			$link = $header_link['header_link_link'];
			$target = '_selft';
			if(!empty($link['target'])):
				$target = '_blank';
			endif;
			?>
			<div class="ribbon-wrapper">
				<div class="ribbon">
					<a href="<?php echo $link['url']; ?>" target="<?php echo $target; ?>"><?php echo $link['title']; ?></a>
				</div>
			</div>
			<?php
		endif;
		?>
	</nav>
	<?php
	if(!is_front_page()):
		$default_image = get_field('header_bg_pages', 'option');
		$page_bg_image = get_field('page_header_bg', get_queried_object_id());
		$page_bg_text = get_field('page_header_text', get_queried_object_id());
		if(empty($page_bg_image)):
			$bg_img_url = $default_image['sizes']['fullwidth-image'];
		else:
			$bg_img_url = $page_bg_image['sizes']['fullwidth-image'];
		endif;
		if(empty($page_bg_text)):
			$bg_img_txt = get_the_title(get_queried_object_id());
		else:
			$bg_img_txt = $page_bg_text;
		endif;
		if(is_post_type_archive('team')):
			$team_settings = get_field('header_einstellungen', 'option');
			$bg_img_url = $team_settings['team_bg_image']['sizes']['fullwidth-image'];
			$bg_img_txt = $team_settings['team_title'];
		endif;
		if(is_post_type_archive('presse')):
			$bg_img_url = get_field('bg_presse_header_image', 'option')['sizes']['fullwidth-image'];
			$bg_img_txt = get_field('bg_presse_title', 'option');
		endif;
		if(is_post_type_archive('partner')):
			$bg_img_url = get_field('bg_partner_header_image', 'option')['sizes']['fullwidth-image'];
			$bg_img_txt = get_field('bg_partner_title', 'option');
		endif;
		if(is_post_type_archive('events')):
			$bg_img_url = get_field('bg_events_header_image', 'option')['sizes']['fullwidth-image'];
			$bg_img_txt = get_field('bg_events_title', 'option');
		endif;
		if(is_post_type_archive('mitstreiter')):
			$mitstreiter_settings = get_field('header_einstellungen', 'option');
			$bg_img_url = $mitstreiter_settings['mitstreiter_bg_image']['sizes']['fullwidth-image'];
			$bg_img_txt = $mitstreiter_settings['mitstreiter_title'];
		endif;
		?>
		<div class="page-header-image mb-5" style="background-image: url('<?php echo $bg_img_url; ?>');">
			<div class="header-title-container"><h2><?php echo $bg_img_txt; ?></h2></div>
		</div>
	<?php endif;
