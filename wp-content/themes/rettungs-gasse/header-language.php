<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<?php
		$metadatas = get_field('meta_infos', 'option');
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

