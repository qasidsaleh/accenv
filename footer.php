		<footer>
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<h1>Services</h1>
						<div class="row">
							<?php
				                echo str_replace( '<li class="', '<li class="',
				                    wp_nav_menu( array(
				                    'container'       => false,
				                    'theme_location' => 'footer1',
				                    'items_wrap'      => '<ul>%3$s</ul>',
				                    'menu_class' => ''
				                )));
				            ?>			
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<h1>Training Courses</h1>
						<?php
			                echo str_replace( '<li class="', '<li class="',
			                    wp_nav_menu( array(
			                    'container'       => false,
			                    'theme_location' => 'footer2',
			                    'items_wrap'      => '<ul>%3$s</ul>',
			                    'menu_class' => ''
			                )));
			            ?>	
					</div>
					<div class="col-xs-12 col-sm-4">
						<h1>Customers</h1>
						<?php
			                echo str_replace( '<li class="', '<li class="',
			                    wp_nav_menu( array(
			                    'container'       => false,
			                    'theme_location' => 'footer3',
			                    'items_wrap'      => '<ul>%3$s</ul>',
			                    'menu_class' => ''
			                )));
			            ?>	
						<h1>Newsletter</h1>
						<div class="newsletter">
							<?php //echo do_shortcode('[contact-form-7 id="131" title="Newsletter"]'); ?>
							<form method="post" action="https://oi.vresp.com?fid=2bff4ab5d4" target="vr_optin_popup" onsubmit="window.open( 'https://www.verticalresponse.com', 'vr_optin_popup', 'scrollbars=yes,width=600,height=450' ); return true;">
								<fieldset>
									<div>
										<input name="email_address" type="text" id="submail" placeholder="Enter Your Email">
										<button type="submit" class="pull-right">Submit</button>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
					<div class="col-sm-12">
						<hr class="clearfix" role="presentation" data-uw-rm-sr="">
						<div class="row">
							<div class="col-sm-6">
								<p data-uw-styling-context="true">
									<a href="<?php echo get_home_url(); ?>">Home</a> | <a href="<?php echo get_page_link(88); ?>" >Events/Presentations</a> | <a href="<?php echo get_page_link(19); ?>">Contact</a> | <a href="<?php echo get_page_link(86); ?>">Legal Notice</a> | <a href="<?php echo get_page_link(84); ?>">Privacy Policy</a> | <a href="<?php echo get_page_link(82); ?>">Site Map</a>
								</p>
								<p>© <?php echo date('Y') ?> <?php echo bloginfo('name'); ?>. All rights reserved.  |  Powered by: <a href="https://espinspire.com/" target="_blank">Bay Area Web Design Company</a></p>
							</div>
							<div class="col-sm-3 translate"> 
								<strong class="d-block mb-1">Translate</strong>
								<?php echo do_shortcode('[gtranslate]'); ?>
							</div>
							<div class="col-sm-3 social-icons">
								<p>
									<a href="<?php the_field('facebook_link','options'); ?>" target="_blank">
										<img src="<?php bloginfo('template_url'); ?>/images/footer_icon_f.jpg" alt="facebook">
									</a>
									<a href="<?php the_field('linkedin_link','options'); ?>" target="_blank">
										<img src="<?php bloginfo('template_url'); ?>/images/footer_icon_ln.jpg" alt="linkedin">
									</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<?php get_template_part( 'inc/foot' ); ?>