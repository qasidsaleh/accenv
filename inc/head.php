<!doctype html>
	<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<?php if ( get_field( 'meta_title' ) ): ?>
			<?php $meta_title = get_field( 'meta_title' ); else: $meta_title = ''; ?>
		<?php endif; ?>
		<title><?php echo $meta_title ?></title>
		<?php if ( get_field( 'meta_description' ) ): ?>
			<?php $meta_description = get_field( 'meta_description' ); else: $meta_description = ''; ?>
		<?php endif; ?>
		<meta name="description" content="<?php echo $meta_description ?>">
		<?php if ( get_field( 'meta_keyword' ) ): ?>
			<?php $meta_keyword = get_field( 'meta_keyword' ); else: $meta_keyword = '' ?>
		<?php endif; ?>
		<meta name="keywords" content="<?php echo $meta_keyword; ?>">
		<?php if ( get_field( 'meta_box' ) ): ?>
			<?php the_field( 'meta_box' ); ?>
		<?php endif; ?>
		<?php if ( get_field( 'meta_open_graphs' ) ): ?>
			<?php the_field( 'meta_open_graphs' ); ?>
		<?php endif; ?>
		<?php $basename = basename($_SERVER['SCRIPT_FILENAME']); ?>
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_url'); ?>/images/favicon.ico">
		<?php if(is_front_page()){ ?>
			<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/home.css">
			<link href='<?php bloginfo('template_url'); ?>/fullcalendar/main.css' rel='stylesheet' />
		<?php } else { ?>
			<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/home.css">
			<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/all.css">
			<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/woocommerce.css">
			<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
		<?php } ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/searchform.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/contactform7.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/owl.carousel.css">
		<?php wp_head(); ?>
	</head>
	<body>
		<div id="wrapper">