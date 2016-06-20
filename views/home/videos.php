<?php 

	require_once(dirname(__FILE__) . '../../../controllers/home/home_child_controller.php');
	
	$data = array( 'item_type' => 'video');
	$i = 0;
	$cc = new HomeChildController();
	$collection = $cc->operation('load_item_type', $data );
	$collection = json_decode($collection, true);

	// mostrar apenas 4 posts
	$collection = array_slice( $collection, 0, 4 ); ?>

	<?php if( !empty($collection) ) : ?>

		<section class="collections-videos">

			<h3 class="section-title">Vídeos</h3>

			<?php foreach ( $collection as $id => $post ) : $i++ ?>

				<article class='entry-videos item-<?php echo ($i==1) ? "$i col-md-9" : "$i col-md-3"; ?>'>						
					<div class='post-content no-thumb'>
						<header class="entry-header">
							<div class="entry-content">
								<?php echo $cc->get_object_content( $post['object']['ID'] ); ?>
							</div>
							<h3 class="entry-title"><a href="<?php echo $cc->get_collection_permalink($post); ?>" target='_blank'><?php echo $post['object']['post_title']; ?></a></h3>
							
							<!-- <div class="entry-meta"> -->
								<?php //echo acervos_time_ago(strtotime($post['object']['post_date'])); ?>	
							<!-- </div>.entry-meta -->
						</header><!-- .entry-header -->
					</div>
				</article>

			<?php endforeach; ?>
	</section>

	<?php endif; ?>		