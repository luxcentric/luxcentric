			<footer class="footer" role="contentinfo">

				<div id="footer-wrapper">

					<div id="sidebar3" class="wrap">
						<?php if (is_active_sidebar('sidebar3')) :
							dynamic_sidebar('sidebar3');
						endif; ?>
					</div>

					<div id="inner-footer" class="wrap cf">

						<nav role="navigation">
							<?php bones_footer_links(); ?>
						</nav>
					</div>

				</div>
				
				<div class="source-org copyright"><span>&copy; <?php echo date('Y'); ?></span> <?php bloginfo( 'name' ); ?> | Website Design &amp; Development by <a href="http://caffecomm.com" target="_blank">Caffeinated Communications Studio</a></div>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

		<?php if (is_singular( 'post' ) || is_category() || is_tag() || is_search()) {   //  displaying a single blog post or a blog archive ?>
		    <script type="text/javascript">
		        jQuery("li.current_page_parent").addClass('current-menu-item');
		    </script>
		<?php } ?>

	</body>

</html> <!-- end of site. what a ride! -->
