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
 * @package Tainacan
 */

get_header();
$options = get_option('socialdb_theme_options');
?>


<!-- TAINACAN: hiddeNs responsaveis em realizar acoes do repositorio -->
<input type="hidden" id="src" name="src" value="<?php echo get_template_directory_uri() ?>">
<input type="hidden" id="repository_main_page" name="repository_main_page" value="true">
<input type="hidden" id="info_messages" name="info_messages" value="<?php
if (isset($_GET['info_messages'])) {
    echo $_GET['info_messages'];
}
?>">
 <!-- PAGINA DO ITEM -->
    <input type="hidden" id="object_page" name="object_page" value="<?php
    if (isset($_GET['item'])) {
        echo trim($_GET['item']);
    }
    ?>">
    <!-- PAGINA DA CATEGORIA -->
    <input type="hidden" id="category_page" name="category_page" value="<?php
    if (isset($_GET['category'])) {
        echo trim($_GET['category']);
    }
    ?>">
    <!-- PAGINA DA PROPRIEDADE -->
    <input type="hidden" id="property_page" name="property_page" value="<?php
    if (isset($_GET['category'])) {
        echo trim($_GET['category']);
    }
    ?>">
    <!-- PAGINA DA TAG -->
    <input type="hidden" id="tag_page" name="tag_page" value="<?php
    if (isset($_GET['tag'])) {
        echo trim($_GET['tag']);
    }
    ?>">
    <!-- PAGINA DA TAXONOMIA -->
    <input type="hidden" id="tax_page" name="object_page" value="<?php
    if (isset($_GET['tax'])) {
        echo trim($_GET['tax']);
    }
    ?>">
<input type="hidden" id="socialdb_fb_api_id" name="socialdb_fb_api_id" value="<?php echo $options['socialdb_fb_api_id']; ?>">
<input type="hidden" id="socialdb_embed_api_id" name="socialdb_embed_api_id" value="<?php echo $options['socialdb_embed_api_id']; ?>">
<input type="hidden" id="collection_id" name="collection_id" value="<?php echo get_option('collection_root_id'); ?>">
<!-- TAINACAN: classe pura jumbotron do bootstrap, so textos que foram alterados -->

<div id="main_part" class="home">
        <div class="row container-fluid">
        <div class="project-info">
        <center>
            <h1> <?php bloginfo('name') ?> </h1>
            <h3> <?php bloginfo('description') ?> </h3>
        </center>
        </div>
        <div id="searchBoxIndex" class="col-md-3 col-sm-12 center">
               <form id="formSearchCollections" role="search">
                   <div class="input-group search-collection search-home">
                       <input type="text" class="form-control" name="search_collections" id="search_collections" onfocus="changeBoxWidth(this)" placeholder="<?php _e('Search Collection', 'tainacan') ?>"/>
                       <span class="input-group-btn">
                           <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                    </div>
               </form>
               <a onclick="showAdvancedSearch('<?php echo get_template_directory_uri() ?>');" href="#" class="col-md-12 adv_search">
                   <span class="white"><?php _e('Advanced search', 'tainacan') ?></span>
               </a>
         </div>
    </div>
</div>
</header>		

<!-- end header -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main container" role="main">

			
			<!-- TAINACAN: esta div (AJAX) recebe html E esta presente tanto na index quanto no single, pois algumas views da administracao sao carregadas aqui -->
			<div id="configuration"></div>
			<input type="hidden" id="max_collection_showed" name="max_collection_showed" value="20">
			<input type="hidden" id="total_collections" name="total_collections" value="">
			<input type="hidden" id="last_index" name="last_index" value="0">

			<div class="home home-sections">
				<section class="highlights how col-md-8">
				
					<?php  dynamic_sidebar('home-destaques'); ?>

				</section>

				<?php $destaques = new WP_Query( array( 'category_name' => 'destaques' )  ); ?>

				<?php if ( $destaques->have_posts() ) : ?>

					<section class="articles col-md-4">
						<h2 class="section-title">Destaques</h2>

						<?php while ( $destaques->have_posts() ) : $destaques->the_post();  ?>
							<article>
								<div class="entry-thumb">
									<a href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail(); ?></a>
								</div>

								<header class="entry-header">
									
									<h3 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></h3></a>
									
									<div class="entry-meta">
										<?php echo acervos_time_ago(get_post_time('G', true)); ?>				
									</div><!-- .entry-meta -->
								
								</header><!-- .entry-header -->

							</article>
						
						<?php endwhile; ?>
				
					</section>

				<?php endif; ?>

				<?php 
					/* Restore original Post Data 
					 * NB: Because we are using new WP_Query we aren't stomping on the 
					 * original $wp_query and it does not need to be reset with 
					 * wp_reset_query(). We just need to set the post data back up with
					 * wp_reset_postdata().
					 */
					wp_reset_postdata();
				?>

				

				<div class="clearfix"></div>


				<?php // coleções em destaque ?>
				<?php include_once( 'views/home/collections-highlights.php'); ?>
						
				<div class="clearfix"></div>

				<!-- vídeos das coleções -->
				<?php include_once( 'views/home/videos.php'); ?>
		
				<div class="clearfix"></div>

				<!-- vídeos das coleções -->
				<?php include_once( 'views/home/images.php'); ?>
				
			</div>

			<?php if ( !have_posts() ) : ?>

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

				<?php //alizee_paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

</body>
<!-- <?php get_sidebar(); ?> -->
<?php get_footer(); ?>