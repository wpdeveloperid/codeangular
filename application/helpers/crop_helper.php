<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('advanced_crop')){

	function advanced_resize($image_data,$n_w,$n_h,$suffix){
	
		$ci =& get_instance();
		
		$ci->load->library('image_lib');
		
		$message = "";
		$w = $image_data['image_width']; // original image's width
		$h = $image_data['image_height']; // original images's height
		$s_r = $w / $h;
		$n_r = $n_w / $n_h;
		$config['source_image'] = $image_data['full_path'];
		$config['maintain_ratio'] = FALSE;
		$new_path = $config['new_image'] = $image_data['file_path'].$image_data['raw_name'].$suffix.$image_data['file_ext'];
		
		if($n_r!=$s_r){
			if($n_r>$s_r){
				$config['width'] = $w;
				$config['height'] = round($w/$n_r);
				$config['y_axis'] = round(($h - $config['height'])/2);
			} else {
				$config['width'] = round($h * $n_r);
				$config['height'] = $h;
				$config['x_axis'] = round(($w - $config['width'])/2);
			}
			$ci->image_lib->initialize($config);
			if(!$ci->image_lib->crop()){
				$message = "cropping : ".$ci->image_lib->display_errors();
			}
			$ci->image_lib->clear();
			$config['source_image'] = $new_path;
		} else {
			//kalau ratio sama maka belum dicrop, sehingga belum ada file baru
			$config['new_image'] = $new_path;
		}
		
		$config['maintain_ratio'] = FALSE;
		$config['width'] = $n_w;
		$config['height'] = $n_h;
		$ci->image_lib->initialize($config);
		if (!$ci->image_lib->resize()){
			$message .= "resize : ".$ci->image_lib->display_errors();
		}
		$ci->image_lib->clear();
		return $message;
	}
}
