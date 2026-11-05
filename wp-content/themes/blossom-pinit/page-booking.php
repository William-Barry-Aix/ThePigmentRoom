<?php
/**
 * Template for the booking page.
 *
 * This template matches the default page layout but intentionally omits the sidebar.
 *
 * @package Blossom_Pin
 */

get_header(); ?>
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				/**
                 * Comment Template
                 * 
                 * @hooked blossom_pin_comment
                */
                do_action( 'blossom_pin_after_page_content' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
