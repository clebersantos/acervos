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

	<div id="primary" class="content-area ">
		<main id="main" class="site-main container" role="main">

			

			<div class="home home-sections">
				<section class="highlights how col-md-8">
				
					<?php  dynamic_sidebar('home-destaques'); ?>

					
				</section>

				<section class="articles col-md-4">
					<h2 class="section-title">Destaques</h2>
					<article>
						<div class="entry-thumb">
							<a href=""><img src="<?php echo CHILD_DIRECTORY; ?>/images/temp/tainacan_europeana.jpg"></a>
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
							<a href=""><img src="<?php echo CHILD_DIRECTORY; ?>/images/temp/indio.jpg"></a>
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
							<a href=""><img src="<?php echo CHILD_DIRECTORY; ?>/images/temp/tainacan_ufg.jpg"></a>
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
							<a href=""><img src="<?php echo CHILD_DIRECTORY; ?>/images/temp/tainacan.png"></a>
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

				<section class="collections">
					
					<h3 class="section-title">Colleções em destaque</h3>
					
					<?php 

					// $api_request    = 'http://afro.culturadigital.br/wp-json/posts/?type=socialdb_collection&filter[s]=afro&filter[orderby]=rand&filter[order]=DESC';

					$api_request    = 'http://afro.culturadigital.br/wp-json/posts/?type=socialdb_collection&filter[s]=a&filter[orderby]=rand&filter[order]=DESC';

					$api_response = wp_remote_get( $api_request );
					$api_data = json_decode( wp_remote_retrieve_body( $api_response ), true );
				
					?>

					<div class="collections-slide">
						<?php foreach ($api_data as $id => $post) :  ?>
							<?php //var_dump($post['featured_image']); ?>

							<article class="hentry">

								<div class="temp-image" style="padding-bottom: 83.25%;"></div>
								
								<div class="final-content">
									
									<a href="<?php echo $post['link']; ?>" target="_blank">
										
										<?php if( !empty($post['featured_image']['source']) ) : ?>
											<div class="entry-thumb">
										
												<div class="thumb-icon"><i class="fa fa-link"></i></div>
												<img class="thumb" src="<?php echo $post['featured_image']['source']; ?>">

											</div>
											
											<div class="collection__darkener"></div>
											<div class="collection__gradient"></div>
											<div class="thumb-icon"><i class="fa fa-link"></i></div>
										<?php endif; ?>
										
										<div class="post-content no-thumb">
											<header class="entry-header">
												<h3 class="entry-title"><?php echo $post['title']; ?></h3>
												
												<div class="entry-meta">
													<?php echo themeblvd_time_ago(strtotime($post['date'])); ?>	
												</div><!-- .entry-meta -->
												<!-- <div class="entry-content">
													<?php// echo $post['content'];  ?>
												</div> -->
											</header><!-- .entry-header -->
										</div>
									</a>
								</div>								
							</article>
						<?php endforeach; ?>
					</div>
					
					<!-- http://afro.culturadigital.br/wp-json/posts/?type=socialdb_collection -->
				</section>
				<div class="clearfix"></div>
				
				<section class="videos">
					<h3 class="section-title">Vídeos</h3>
					
					<?php 

					$api_request    = 'http://afro.culturadigital.br/wp-json/posts/?type=socialdb_collection&filter[s]=afro&filter[orderby]=date&filter[order]=DESC';
					$api_response = wp_remote_get( $api_request );
					$api_data = json_decode( wp_remote_retrieve_body( $api_response ), true );
				
					?>

					<div class="collections-videos row">
						<?php foreach ($api_data as $id => $post) :  ?>
							<?php //var_dump($post['featured_image']); ?>

							<article class="hentry col-md-3">						
								<?php if( !empty($post['featured_image']['source']) ) : ?>
									<div class="entry-thumb">
										<a href="<?php echo $post['link']; ?>" target="_blank">

											<div class="thumb-icon"><i class="fa fa-link"></i></div>
										
											<img src="<?php echo $post['featured_image']['source']; ?>">
										</a>
									</div>
								<?php endif; ?>

								<div class="post-content no-thumb">
									<header class="entry-header">
										<h3 class="entry-title"><a href="<?php echo $post['link']; ?>" target='_blank'><?php echo $post['title']; ?></h3></a>
										
										<div class="entry-meta">
											<?php echo themeblvd_time_ago(strtotime($post['date'])); ?>	
										</div><!-- .entry-meta -->
										<div class="entry-content">
											<?php// echo $post['content'];  ?>
										</div>
									</header><!-- .entry-header -->
								</div>
							</article>
						<?php endforeach; ?>		

				</section>
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