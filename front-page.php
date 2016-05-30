<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Alizee
 */

get_header(); ?>
		
	<div id="primary" class="content-area col-md-12">
		<main id="main" class="site-main" role="main">

		<div class="home-sections">
			<section class="highlights col-md-8">

				<div class="highlight-main">
					<article class="card item-1">
						<div class="entry-thumb">
							<a href=""><img src="http://localhost/wordpress/wp-content/uploads/2015/12/CjPY1lNXAAEXBgG.jpg"></a>
						</div>
						<header class="entry-header">
							<div class="entry-category">
								acervos						
							</div><!-- .entry-category -->
							
							<h1 class="entry-title"><a href="">Tainacan: solução de interoperabilidade para acervos chega ao Rio</a></h1>
							
							<div class="entry-meta">
								2 horas						
							</div><!-- .entry-meta -->
						
						</header><!-- .entry-header -->

					</article>
				</div>

				<div class="highlights-small">
					<article class="card item-2">
						<div class="entry-thumb">
							<a href=""><img src="http://localhost/wordpress/wp-content/uploads/2015/12/CjPY1lNXAAEXBgG.jpg"></a>
						</div>

						<header class="entry-header">
							<div class="entry-category">
								acervos						
							</div><!-- .entry-category -->
							
							<h1 class="entry-title"><a href="">Tainacan: solução de interoperabilidade para acervos chega ao Rio</a></h1>
							
							<div class="entry-meta">
								2 horas						
							</div><!-- .entry-meta -->
						
						</header><!-- .entry-header -->

					</article>

					<article class="card item-3">

						<div class="entry-thumb">
							<a href=""><img src="http://localhost/wordpress/wp-content/uploads/2015/12/CjPY1lNXAAEXBgG.jpg"></a>
						</div>

						<header class="entry-header">
							<div class="entry-category">
								acervos						
							</div><!-- .entry-category -->
							
							<h1 class="entry-title"><a href="">Tainacan: solução de interoperabilidade para acervos chega ao Rio</a></h1>
							
							<div class="entry-meta">
								2 horas						
							</div><!-- .entry-meta -->
						
						</header><!-- .entry-header -->

					</article>
				</div>

				<div class="highlight-collection">
					<article class="card item-4">
						<h3 class="section-title">Coleção em Destaque</h3>

						<div class="entry-thumb">
							<a href=""><img src="http://localhost/wordpress/wp-content/uploads/2015/12/CjPY1lNXAAEXBgG.jpg"></a>
						</div>
						<header class="entry-header">
							<h4 class="entry-title"><a href="">Lorem Ipsum Dolor</a></h4>
						</header><!-- .entry-header -->
					</article>
				</div>
			</section>

			<section class="artigos col-md-4">
				<h2 class="section-title">Destaques</h2>
				<article>
					<div class="entry-thumb">
						<a href=""><img src="http://localhost/wordpress/wp-content/uploads/2015/12/CjPY1lNXAAEXBgG.jpg"></a>
					</div>

					<header class="entry-header">
						
						<h3 class="entry-title"><a href="">Lorem Ipsum Dolor</h3></a>
						
						<div class="entry-meta">
							2 horas						
						</div><!-- .entry-meta -->
					
					</header><!-- .entry-header -->

				</article>

				<article>
					<div class="entry-thumb">
						<a href=""><img src="http://localhost/wordpress/wp-content/uploads/2015/12/CjPY1lNXAAEXBgG.jpg"></a>
					</div>
					
					<header class="entry-header">
						
						<h3 class="entry-title"><a href="">Lorem Ipsum Dolor</h3></a>
						
						<div class="entry-meta">
							2 horas						
						</div><!-- .entry-meta -->
					
					</header><!-- .entry-header -->
				</article>

				<article>
					<div class="entry-thumb">
						<a href=""><img src="http://localhost/wordpress/wp-content/uploads/2015/12/CjPY1lNXAAEXBgG.jpg"></a>
					</div>
					
					<header class="entry-header">
						
						<h3 class="entry-title"><a href="">Lorem Ipsum Dolor</h3></a>
						
						<div class="entry-meta">
							2 horas						
						</div><!-- .entry-meta -->
					
					</header><!-- .entry-header -->
				</article>

				<article>
					<div class="entry-thumb">
						<a href=""><img src="http://localhost/wordpress/wp-content/uploads/2015/12/CjPY1lNXAAEXBgG.jpg"></a>
					</div>
					
					<header class="entry-header">
						
						<h3 class="entry-title"><a href="">Lorem Ipsum Dolor</h3></a>
						
						<div class="entry-meta">
							2 horas						
						</div><!-- .entry-meta -->
					
					</header><!-- .entry-header -->
				</article>

			</section>

			<div class="clearfix"></div>

			<section class="collections"></section>
			<section class="videos"></section>
			<section class="images"></section>

		</div>

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php $c = 0; ?>
			<div class="home-layout">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>
					
				<?php $c++; ?>	
				<?php endwhile; ?>
			</div>

			<?php alizee_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
