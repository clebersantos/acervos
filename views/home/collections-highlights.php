<?php
	

	// $api_request    = 'http://afro.culturadigital.br/wp-json/posts/?type=socialdb_collection&filter[s]=afro&filter[orderby]=rand&filter[order]=DESC';

	$api_request    = 'http://afro.culturadigital.br/wp-json/posts/?type=socialdb_collection&filter[s]=a&filter[orderby]=rand&filter[order]=DESC';

	$api_response = wp_remote_get( $api_request );
	$api_data = json_decode( wp_remote_retrieve_body( $api_response ), true );

	?>

	<?php if( !empty($api_data) ) : ?>
		<section class="collections">
				
			<h3 class="section-title">Colleções em destaque</h3>

			<div class="collections-slide">
				<?php foreach ($api_data as $id => $post) :  ?>

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
											<?php echo acervos_time_ago(strtotime($post['date'])); ?>	
										</div>
									</header><!-- .entry-header -->
								</div>
							</a>
						</div>								
					</article>
				<?php endforeach; ?>
			</div>
		</section>		
	<?php endif; ?>	
	<!-- http://afro.culturadigital.br/wp-json/posts/?type=socialdb_collection -->
