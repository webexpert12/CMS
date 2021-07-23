<?php

/** get Nonce value */
$nonce = $_REQUEST['nonce'];

/** get the original post id */

$post_id = (isset($_GET['post']) ? intval($_GET['post']) : intval($_POST['post']));

if(wp_verify_nonce( $nonce, 'pk-duplicate-page-'.$post_id) && current_user_can('edit_posts')) {
// verify Nonce  
    global $wpdb;
    $siteoption = get_option('pk_clone_page_options');
    $post_status = 'draft';

    if (!(isset($_GET['post']) || isset($_POST['post']) || (isset($_REQUEST['action']) && 'pk_duplicate_post_as_draft' == $_REQUEST['action']))) {
        wp_die('No post to duplicate has been supplied!');
    }
    
    $siteoptionDuplicate = get_option('SMARTSite_settings_duplicate');
    $post_element = $siteoptionDuplicate['duplicate_post_settings']['post_element'];

    $returnpage = '';            
    $post = get_post($post_id);
    $current_user = wp_get_current_user();
    $new_post_author = $current_user->ID;

    if (isset($post) && $post != null) {
        /*
        * new post data array
        */
        $args = array(
            'comment_status' => $post->comment_status,
            'ping_status' => $post->ping_status,
            'post_author' => array_key_exists('p_author',$post_element) ? $post->post_author : $new_post_author,
            'post_content' => array_key_exists('p_excerpt',$post_element) ? $post->post_content : '',
            'post_excerpt' => array_key_exists('p_excerpt',$post_element) ? $post->post_excerpt : '',
            'post_name' => array_key_exists('p_slug',$post_element) ? $post->post_name.'--' : str_replace(' ','-',$post->title).'--',
            'post_password' => array_key_exists('p_password',$post_element) ?$post->post_password : '',
            'post_status' => array_key_exists('p_status',$post_element) ? $post_status : 'draft',                
            'post_title' => array_key_exists('p_title',$post_element) ? $post->post_title : 'Untitled',
            'post_type' => $post->post_type,
            'to_ping' => $post->to_ping,
            'post_date' => array_key_exists('p_date',$post_element) ? $post->post_date : date( 'Y-m-d H:i:s', time() ),
            'menu_order' => array_key_exists('p_menuorder',$post_element) ? $post->menu_order : '',
            'post_password' => array_key_exists('p_password',$post_element) ? $post->post_password: "",

        );

        $new_post_id = wp_insert_post($args);
        
        /** duplicate all post taxonomies */

        $taxonomies = get_object_taxonomies($post->post_type);
        if (!empty($taxonomies) && is_array($taxonomies)):
            foreach ($taxonomies as $taxonomy) {
                $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
                wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
            }
        endif;

        /** duplicate all post meta*/

        $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
        if (count($post_meta_infos)!=0) {
            $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
            foreach ($post_meta_infos as $meta_info) {
                
                if($meta_info->meta_key == '_thumbnail_id'){
                    if(!array_key_exists('p_featuredimage',$post_element)){
                        continue;
                    }
                }

                $meta_key = sanitize_text_field($meta_info->meta_key);
                $meta_value = addslashes($meta_info->meta_value);
                $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
            }
            $sql_query.= implode(" UNION ALL ", $sql_query_sel);
            $wpdb->query($sql_query);
        } 

        /** finally, redirecting */
        if ($post->post_type != 'post'):
                $returnpage = '?post_type='.$post->post_type;
                wp_redirect(admin_url('edit.php'.$returnpage));
        else:
            wp_redirect(admin_url('edit.php'));
        endif;
        exit;
    } else {
        wp_die('Error! Post creation failed, could not find original post: '.$post_id);
    }
} else {
    wp_die('Security check issue, Please try again.');
}