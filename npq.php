<?php

public static function fill_chunck($array, $parts) {
	    $t = 0;
	    $result = array_fill(0, $parts - 1, array());
	    $max = ceil(count($array) / $parts);
	    foreach($array as $v) {
	        count($result[$t]) >= $max and $t ++;
	        $result[$t][] = $v;
	    }
	    return $result;
	}


	public function filter_the_menu($parent_file) {
        //filter admin menu
        $this->filter();
        return $parent_file;
    }

    private function filter(){
    	global $menu, $submenu;

		$user_settings_main = get_user_meta(get_current_user_id(),'caa_main_menu', true);

        foreach ($menu as $id => $item) {
        	if(is_array($user_settings_main)){
                if (in_array($item[2], $user_settings_main)) {
               		unset($menu[$id]);
            	}
        	}

            if (!empty($submenu[$item[2]])) {
                $this->filter_sub_menu($item[2]);
            }
        }
    }

    private function filter_sub_menu($parent) {
	    global $submenu;
		$user_settings_sub = get_user_meta(get_current_user_id(),'caa_sub_menu',true);
	    if(is_array($user_settings_sub)){
		    foreach ($submenu[$parent] as $id => $item) {
			        if (in_array($item[2], $user_settings_sub)) {
			            unset($submenu[$parent][$id]);
			        }
		    	}
		}
    }


    public function redirect_the_user_away( $current_screen ){

	    $not_allowed_pages = $this->get_not_allowed_pages(get_current_user_id());
	    if(is_array($not_allowed_pages)){
			if(isset($_GET['page'])){
				if(in_array($_GET['page'], $not_allowed_pages)){
					wp_die(__('You do not have sufficient permissions to access this page.'),'PKRVTECH_SMARTSite_Settings_class');
					exit;
				}
			}else{
				$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$url = parse_url($url);
				$file_name = basename($_SERVER['SCRIPT_NAME']);
				$query = (isset($url['query']) && $url['query']!='')?'?' . $url['query']:'';
				$slug = $file_name . $query;

				if(in_array($slug, $not_allowed_pages) || (in_array($file_name, $not_allowed_pages) && !in_array($file_name, $this->pages_with_multiple_queries))){
					wp_die(__('You do not have permission to access this page.'),'PKRVTECH_SMARTSite_Settings_class');
					exit;
				}
			}
		}
    }

    public function check_expired_user_login( $user_login, $user = null ){
		if ( !$user ) {
			$user = get_user_by('login', $user_login);
		}
		if ( !$user ) {
			// not logged in - definitely not disabled
			return;
		}
		if(! $this->is_user_limited($user->ID)){
			return;
		}

		$deactivated = get_user_meta( $user->ID, 'caa_deactivated', true );

		if ( $deactivated === 'true' ) {
			$this->logUserOut();
		}

		// Get user meta
		$expiring = get_user_meta( $user->ID, 'caa_user_expiring', true );
		$created = get_user_meta( $user->ID, 'caa_created', true );

		if($expiring == -1){
			return;
		}
		$time_to_expire = strtotime('+'.$expiring.' day', $created );

		if($time_to_expire < time()){
			$this->logUserOut();
		}
    }

    private function logUserOut() {
	    wp_clear_auth_cookie();
	    // Build login URL and then redirect
	    $login_url = site_url( 'wp-login.php', 'login' );
	    $login_url = add_query_arg( 'disabled', '1', $login_url );
	    wp_redirect( $login_url );
	    exit;
    }

    public function user_login_message( $message ) {

		// Show the error message if it seems to be a disabled user
		if ( isset( $_GET['disabled'] ) && $_GET['disabled'] == 1 ) 
			$message =  '<div id="login_error">' . apply_filters( 'ja_disable_users_notice', __( 'Account disabled', 'PKRVTECH_SMARTSite_Settings_class' ) ) . '</div>';

		return $message;
	}

	private function _($index, $saved = false){
		if(isset($_POST[$index]) and $saved!=true){
			echo $_POST[$index];
		}else{
			echo '';
		}
	}

	public static function is_disabled($page,$sub_item = null){
		switch ($page) {
			case 'plugins.php':
				if($sub_item === 'plugin-editor.php'){
					echo ' disabled checked ';
					return;
				}
				break;
			case 'users.php':
				if($sub_item !== 'profile.php'){
					echo ' disabled checked ';
					return;
				} else {
					echo ' disabled ';
					return;
				}
				break;
			default:
				break;
		}

		if(isset($_GET['action'])){
			if(isset($_GET['user_id'])){
				$user_id = intval($_GET['user_id']);
				$user_settings_main = get_user_meta($user_id,'caa_main_menu',true);
				if(isset($page) and $sub_item == null){
					if(is_array($user_settings_main)){
						if(in_array(htmlspecialchars_decode($page), $user_settings_main)){
							echo ' checked ';
						}
					}
				}
				$user_settings_sub = get_user_meta($user_id,'caa_sub_menu',true);
				if(is_array($user_settings_sub)){
					if($sub_item!=null){
						if(in_array(htmlspecialchars_decode($sub_item), $user_settings_sub)){
							echo ' checked ';
						}
					}
				}
			}
		}
	}

	public static function prepare_title( $title ){
		$title = strip_tags($title);
		$title = explode(' ', $title);
		if(sizeof($title) == 1){
			return $title[0];
		}else{
			$prepared_title = '';
			foreach($title as $part){
				if(!is_numeric($part)){
					$prepared_title .= $part.' ';
				}
			}
			return $prepared_title;
		}
	}

	// public function filter_plugins_list($plugins){

	// 	if(!$this->is_user_limited(get_current_user_id())){
	// 		return $plugins;
	// 	}


	// 	if(isset($plugins['PKRVTECH_SMARTSite_Settings_class/PKRVTECH_SMARTSite_Settings_class.php'])){
	// 		unset($plugins['PKRVTECH_SMARTSite_Settings_class/PKRVTECH_SMARTSite_Settings_class.php']);
	// 	}

	// 	return $plugins;

	// }

	public function redirect_to_first_accessible_page( $redirect_to, $request, $user ){

		if(!$user instanceof WP_User){
			return $redirect_to;
		}

		$not_allowed_pages = $this->get_not_allowed_pages($user->ID);

		if (!in_array('profile.php', $not_allowed_pages)) {
			return admin_url('profile.php');
		}


		$all_pages = get_option('_caa_all_menu_slugs', array());

		if(empty($all_pages)){
			return $redirect_to;
		}

		$allowed_pages = array_values(array_diff($all_pages, $not_allowed_pages));


		if(!empty($allowed_pages)){

			$first_page = $allowed_pages[0];
			if ( strpos(strtolower($first_page), '.php') === false ){
				return admin_url('?page=' . $first_page);
			}

			return admin_url($allowed_pages[0]);
		}

		return $redirect_to;
	}

	public function store_admin_menu(){

		if(get_option('_caa_all_menu_slugs') !== false){
			return;
		}

		global $menu;
		$menu_slugs = array();
		foreach( $menu as $key => $item ){
			if(isset($item[4]) && strpos($item[4], 'wp-menu-separator') === 0) continue;
			$menu_slugs[] = $item[2];
		}

		$this->store_menu($menu_slugs);

	}

	private function is_user_limited( $user_id ) {
		return get_user_meta(intval($user_id), 'caa_account',true) === 'true';
	}

	/**
	 * @return array
	 */
	public static function get_disabled_sub_items() {
		$sub_items   = $_POST['sub_items'];
		$sub_items[] = 'users.php';
		$sub_items[] = 'plugin-editor.php';
		$sub_items[] = 'user-new.php';
		$sub_items[] = 'marketplace-user-role';
		$sub_items[] = 'user-edit.php';

		return $sub_items;
	}

	/**
	 * @return array
	 */
	public static function get_main_disabled_items() {
		$main_items   = $_POST['main_items'];

		return $main_items;
	}

	/**
	 * @param $user_id
	 *
	 * @return array
	 */
	private function get_not_allowed_pages($user_id) {
		$user_settings_main = get_user_meta( $user_id, 'caa_main_menu', true );
		$user_settings_sub  = get_user_meta( $user_id, 'caa_sub_menu', true );
		if ( is_array( $user_settings_main ) && is_array( $user_settings_sub ) ) {
			$not_allowed_pages = array_merge( $user_settings_main, $user_settings_sub );
		} else {
			$not_allowed_pages = array();
		}
		return $not_allowed_pages;
	}

	/**
	 * @param array $slugs
	 */
	private function store_menu( $slugs ) {
		update_option('_caa_all_menu_slugs', $slugs);
	}

?>