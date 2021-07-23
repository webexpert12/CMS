
<?php 
    $siteoptionDuplicate = get_option('SMARTSite_settings_duplicate');
    $enable_duplicate_posts = $siteoptionDuplicate['duplicate_post_settings']['duplicate_posts'];
    $post_element = $siteoptionDuplicate['duplicate_post_settings']['post_element'];
    $role = $siteoptionDuplicate['duplicate_post_settings']['role'];
    $post_types_dp = $siteoptionDuplicate['duplicate_post_settings']['post_types'];
    $display_links = $siteoptionDuplicate['duplicate_post_settings']['display_links'];
?>

<form id="form_duplicate" method="post">
    <table>
        <tr>
            <th>Enable Duplicate Posts <br><p>When this setting is enabled, you'll be able to duplicate pages and posts for your selections below. </p></th>
            <td>
                <div class="head_main_right">
                    <input type="checkbox" name="duplicate_posts" class="js-switch"                                            
                    <?php 
                        echo !empty($enable_duplicate_posts) ? 'checked' : ""
                    ?>                        
                    data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
                </div>
                <!-- <label>
                    <input type='checkbox' id="duplicate_posts_change" class='enable' name="" value='1'   /><span>Enable Duplicate Posts</span>
                </label> -->
            </td>
        </tr>
    </table>
    <br>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#what_to_copy">What to Copy</a></li>
        <li><a data-toggle="tab" href="#permissions">Permission</a></li>
        <li><a data-toggle="tab" href="#display">Display</a></li>
    </ul>

    <div class="tab-content" >
        <div id="what_to_copy" class="tab-pane fade in active">
            <table>
                <tr valign="top">
                    <th scope="row">Page/Post elements to copy</th>
                    <td>
                        <label><input type="checkbox" <?php echo array_key_exists('p_title',$post_element) ? 'checked' : '' ?> name="post_element[p_title]">Title
                        </label>
                        <label><input type="checkbox" <?php echo array_key_exists('p_date',$post_element) ? 'checked' : '' ?> name="post_element[p_date]">Date</label>
                        <label><input type="checkbox" <?php echo array_key_exists('p_status',$post_element) ? 'checked' : '' ?> name="post_element[p_status]">Status</label>
                        <label><input type="checkbox" <?php echo array_key_exists('p_slug',$post_element) ? 'checked' : '' ?> name="post_element[p_slug]">Slug</label>
                        <label><input type="checkbox" <?php echo array_key_exists('p_excerpt',$post_element) ? 'checked' : '' ?> name="post_element[p_excerpt]">Excerpt</label>
                        <label><input type="checkbox" <?php echo array_key_exists('p_content',$post_element) ? 'checked' : '' ?> name="post_element[p_content]">Content</label>
                        <label><input type="checkbox" <?php echo array_key_exists('p_featuredimage',$post_element) ? 'checked' : '' ?> name="post_element[p_featuredimage]">Featured Image</label>
                        <label><input type="checkbox" <?php echo array_key_exists('p_template',$post_element) ? 'checked' : '' ?> name="post_element[p_template]">Template</label>
                        <label><input type="checkbox" <?php echo array_key_exists('p_format',$post_element) ? 'checked' : '' ?> name="post_element[p_format]">Format</label>
                        <label><input type="checkbox" <?php echo array_key_exists('p_password',$post_element) ? 'checked' : '' ?> name="post_element[p_password]">Password</label>
                        <label><input type="checkbox" <?php echo array_key_exists('p_author',$post_element) ? 'checked' : '' ?> name="post_element[p_author]">Author</label>
                        <label><input type="checkbox" <?php echo array_key_exists('p_children',$post_element) ? 'checked' : '' ?> name="post_element[p_children]">Children</label>
                        <label><input type="checkbox" <?php echo array_key_exists('p_menuorder',$post_element) ? 'checked' : '' ?> name="post_element[p_menuorder]">Menu Order</label>
                    </td>
                </tr>
            </table>
        </div>
        <div id="permissions" class="tab-pane fade">
            <table>
                <tr valign="top">
                <th scope="row">Roles allowed to copy </th>
                    <td>
                    <?php
                        $roles = get_editable_roles();
                        foreach($roles as $key => $val){
                            array_key_exists($key,$role) ? $chk = 'checked' : $chk = '';
                            echo "<label><input type='checkbox' ".$chk." name='role[".$key."]'>".$val['name']."</label>";
                        }
                    ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Enable for these post types</th>
                    <td>
                        <?php 
                            $post_types = get_post_types(array('show_ui' => true),'objects');
                            foreach ($post_types as $post_type_object ) :
                                if ($post_type_object->name == 'attachment') continue;
                                
                                array_key_exists($post_type_object->labels->name,$post_types_dp) ? $chk = 'checked' : $chk = '';

                                echo "<label><input type='checkbox' ".$chk." name='post_types[".$post_type_object->labels->name."]'  >".$post_type_object->labels->name."</label>";
                        
                            endforeach; ?>
                    </td>
                </tr>
            </table>
        </div>
        <div id="display" class="tab-pane fade">
            <table>
                <tr valign="top">
                <th scope="row">Show links in</th>
                    <td>
                        <label><input type='checkbox' <?php echo array_key_exists('post_list',$display_links) ? 'checked' : ''; ?> name='display_links[post_list]'>Post List</label>
                        <label><input type='checkbox' <?php echo array_key_exists('edit_screen',$display_links) ? 'checked' : ''; ?> name='display_links[edit_screen]'>Edit Screen</label>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="duplicate_posts_save"><img id="loader" src="/wp-admin/images/spinner.gif" /><input type="submit" value="Save changes" id="duplicate_posts_save" class="btn btn-success" ></div>
</form>