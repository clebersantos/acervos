<?php get_header(); ?>

	<div id="primary">
		<main id="main" class="site-main container" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php if (get_theme_mod('author_bio') != '') : ?>
					<?php get_template_part( 'author-bio' ); ?>
				<?php endif; ?>			

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					// if ( comments_open() || '0' != get_comments_number() ) :
					// 	comments_template();
					// endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>