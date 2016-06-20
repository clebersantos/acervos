<?php 

include_once(dirname(__FILE__) . '/../../../' . PARENT_TEMPLATE_NAME . '/controllers/home/home_controller.php');

class HomeChildController extends HomeController {

	public function get_object_content( $post_id ) {

		// $user_model = new UserModel();
        // $object_id = $data['object_id']
        $object_id = $post_id;
        $data['collection_id'] = $post_id;
        $data['object'] = get_post($object_id);
        // $data["username"] = $user_model->get_user($data['object']->post_author)['name'];
        $data['metas'] = get_post_meta($object_id);
        $data['collection_metas'] = get_post_meta($data['collection_id'], 'socialdb_collection_download_control', true);
        $data['collection_metas'] = ($data['collection_metas'] ? $data['collection_metas'] : 'allowed');
        
        $metas = $data['metas'];
        $object = $data['object'];	

       	if ($metas['socialdb_object_dc_type'][0] == 'text') {
			return $metas['socialdb_object_content'][0];
        } else {
            if ($metas['socialdb_object_from'][0] == 'internal') {
            	return $this->get_internal_object_content($metas, $object);
            } else {
                return $this->get_external_object_content($metas, $object);
            }
		}

		return "";
	}

	function get_internal_object_content( $metas, $object ) {
		
		$url = wp_get_attachment_url($metas['socialdb_object_content'][0]);

        switch ($metas['socialdb_object_dc_type'][0]) {
            case 'audio':
                $content = '<audio controls><source src="' . $url . '">' . __('Your browser does not support the audio element.', 'tainacan') . '</audio>';
                break;
            case 'image':

                if (get_the_post_thumbnail($object->ID, 'thumbnail')) {
                    $url_image = wp_get_attachment_url(get_post_thumbnail_id($object->ID));
                    $style_watermark = ($has_watermark ? 'style="background:url(' . $url_watermark . ') no-repeat center; background-size: contain;"' : '');
                    $opacity_watermark = ($has_watermark ? 'opacity: 0.80;' : '');
                    $content = '<center ' . $style_watermark . '>'
                            . '<img style="max-width:480px; ' . $opacity_watermark . '" src="' . $url_image . '" class="img-responsive" />'
                            . '</center>';
                }
                break;
            case 'video':
                $content = '<video width="400" controls><source src="' . $url . '">' . __('Your browser does not support HTML5 video.', 'tainacan') . '</video>';
                break;
            case 'pdf':
                $content = '<embed src="' . $url . '" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">';
                break;
            default:
                $content = '<p style="text-align:center;">' . __('File link:') . ' <a target="_blank" href="' . $url . '">' . __('Click here!', 'tainacan') . '</a></p>';
                break;
        }

        return $content;
	}

	function get_external_object_content( $metas, $object) {

		switch ($metas['socialdb_object_dc_type'][0]) {
            case 'audio':
                $content = '<audio controls><source src="' . $metas['socialdb_object_content'][0] . '">' . __('Your browser does not support the audio element.', 'tainacan') . '</audio>';
                break;
            case 'image':
                $style_watermark = ($has_watermark ? 'style="background:url(' . $url_watermark . ') no-repeat center; background-size: contain;"' : '');
                $opacity_watermark = ($has_watermark ? 'opacity: 0.80;' : '');
                if (get_the_post_thumbnail($object->ID, 'thumbnail')) {
                    $url_image = wp_get_attachment_url(get_post_thumbnail_id($object->ID, 'large'));
                    $content = '<center ' . $style_watermark . '><img style="max-width:480px; ' . $opacity_watermark . '"  src="' . $url_image . '" class="img-responsive" /></center>';
                } else {
                    $content = "<img src='" . $metas['socialdb_object_content'][0] . "' class='img-responsive' />";
                }
                break;
            case 'video':
                if (strpos($metas['socialdb_object_content'][0], 'youtube') !== false) {
                    $step1 = explode('v=', $metas['socialdb_object_content'][0]);
                    $step2 = explode('&', $step1[1]);
                    $video_id = $step2[0];
                    $content = "<iframe  class='embed-responsive-item' src='http://www.youtube.com/embed/" . $video_id . "?html5=1' allowfullscreen frameborder='0'></iframe>";
                } elseif (strpos($metas['socialdb_object_content'][0], 'vimeo') !== false) {
                    $step1 = explode('/', rtrim($metas['socialdb_object_content'][0], '/'));
                    $video_id = end($step1);
                    $content = "<div class=\"embed-responsive embed-responsive-16by9\"><iframe class='embed-responsive-item' src='https://player.vimeo.com/video/" . $video_id . "' frameborder='0'></iframe></div>";
                } else {
                    $content = "<div class=\"embed-responsive embed-responsive-16by9\"><iframe class='embed-responsive-item' src='" . $metas['socialdb_object_content'][0] . "' frameborder='0'></iframe></div>";
                }
                break;
            case 'pdf':
                $content = '<embed src="' . $metas['socialdb_object_content'][0] . '" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">';
                break;
            default:
                $content = '<p>' . __('File link:', 'tainacan') . ' <a target="_blank" href="' . $metas['socialdb_object_content'][0] . '">' . __('Click here!', 'tainacan') . '</a></p>';
                break;
        }

        return $content;
	}

	public function get_collection_permalink( $collection ) {

		return home_url('/collection/') . $collection['collection_name'] . '/?item=' . $collection['object']['post_name'];
	}

	
}


 ?>