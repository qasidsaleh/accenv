<?php get_template_part( 'inc/head' ); ?>
<body <?php if(is_front_page()){echo 'class="home"'; }else {echo 'class="'.body_class().'"';}?> >
    <div class="loader d-block">
        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
    </div>
	<header id="header" class="header">
		<div class="container">
			<nav class="navbar navbar-expand-md navbar-light">
				<a class="navbar-brand" href="<?php echo get_home_url(); ?>">
					<img src="<?php the_field('logo','options'); ?>" class="img-fluid" alt="">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					<span class="navbar-toggler-icon"></span>
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
					<?php
		                echo str_replace( '<li class="nav-item', '<li class="',
		                    wp_nav_menu( array(
		                    'container'       => false,
		                    'theme_location' => 'header',
		                    'items_wrap'      => '<ul class="navbar-nav mr-auto" id="nav">%3$s</ul>',
		                    'menu_class' => 'nav-link'
		                )));
		            ?>
				</div>
				<form action="<?php echo esc_url(home_url('/')); ?>" class="search-form d-none d-md-block" method="get">
                    <a href="javascript:void(0)" class="search-opner"><i class="fa fa-search"></i></a>
                    <div class="field">
                        <input placeholder="Search" name="s" id="search" class="input" type="search">
                        <button type="submit" onclick="removeChar()"><i class="fa fa-search"></i></button>
                    </div>
                </form>
                <a href="<?php echo get_page_link(684); ?>" class="user-login1"><i class="fa fa-user"></i></a>
			</nav>
		</div>
		<form action="<?php echo esc_url(home_url('/')); ?>" class="search-form d-block d-md-none" method="get">
            <a href="javascript:void(0)" class="search-opner"><i class="fa fa-search"></i></a>
            <div class="field">
                <input placeholder="Search" name="s" id="searchmobile" class="input" type="search">
                <button type="submit" onclick="removeChar2()"><i class="fa fa-search"></i></button>
            </div>
        </form>
	</header>
	<script type="text/javascript">
    	function removeChar(){
		    var a = document.getElementById("search").value.trim();
		    a = a.split('');
		    a.forEach(function (character, index) {
		        if (character === '-') {
		            a.splice(index, 1);
		        }
		    });
		    a = a.join('');
		    document.getElementById("search").value = a;
    	}
    	function removeChar2(){
		    var a = document.getElementById("searchmobile").value.trim();
		    a = a.split('');
		    a.forEach(function (character, index) {
		        if (character === '-') {
		            a.splice(index, 1);
		        }
		    });
		    a = a.join('');
		    document.getElementById("searchmobile").value = a;
    	}
    </script>