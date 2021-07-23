<?php 
	parse_str($_POST['social'], $params_social);
			global $wpdb;
			$array_check = array();
			$table = $wpdb->prefix.'SITE_social';
			$user_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table" );
			if($user_count > 0){
				$wpdb->query('TRUNCATE TABLE '.$table);
				for($i=0; $i <= count($params_social['social']); $i++){
					$social_media =  $params_social['social'][$i];
					$social_media_link =  $params_social['social_link'][$i];
					$data = array('social_media' => $social_media, 'social_media_link' =>$social_media_link);
					$format = array('%s','%s');
					$wpdb->insert($table,$data,$format);
					$my_id = $wpdb->insert_id;
					array_push($array_check,$my_id);
				}
			}else{
				for($i=0; $i <= count($params_social['social']); $i++){
					$social_media =  $params_social['social'][$i];
					$social_media_link =  $params_social['social_link'][$i];
					$data = array('social_media' => $social_media, 'social_media_link' =>$social_media_link);
					$format = array('%s','%s');
					$wpdb->insert($table,$data,$format);
					$my_id = $wpdb->insert_id;
					array_push($array_check,$my_id);
				}	
			}


		echo json_encode("settings saved!!");
		die;
?>