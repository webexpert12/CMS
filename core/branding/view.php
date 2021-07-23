<?php $siteoptionBranding = get_option('SMARTSite_settings_branding'); ?>
<form id="form_branding" method="post">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#dashboard">Dashboard</a></li>
        <li><a data-toggle="tab" href="#login">Login Screen</a></li>
        <li><a data-toggle="tab" href="#whitelabel">Whitelabel</a></li>
    </ul>

    <div class="tab-content" >
        <div id="dashboard" class="tab-pane fade in active">
            <table>
                <tr valign="top">
                    <th scope="row">Primary Color<br><p>Control the main highlight color throughout the dashboard</p></th>
                    <td>
                    <div class="dashboardcolor">          
                        <label>
                            <input type="text" name="dashboard_color" value="<?php if($siteoptionBranding['pk_dashboard_color'] && ($siteoptionBranding['pk_dashboard_color'] != 'Undefined')) { echo $siteoptionBranding['pk_dashboard_color']; }else{  echo "#f1f1f1"; }   ?>" class="nl-color-picker" >
                        </label>
                    </div>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Primary Font Color<br><p>Control the main font color throughout the dashboard</p></th>
                    <td>
                    <div class="dashboardcolor">          
                        <label>
                            <input type="text" name="dashboard_font_color" value="<?php if($siteoptionBranding['pk_dashboard_font_color'] && ($siteoptionBranding['pk_dashboard_font_color'] != 'Undefined')) { echo $siteoptionBranding['pk_dashboard_font_color']; }else{  echo "#444"; }   ?>" class="nl-color-picker" >
                        </label>
                    </div>
                    </td>
                </tr>
            </table>

            <h4>Sidebar Settings</h4>
            <table>
                <tr valign="top">
                    <th scope="row">Sidebar Background</th>
                    <td>
                    <div class="dashboardcolor">          
                        <label>
                            <input type="text" name="sidebar_backgound" value="<?php if($siteoptionBranding['pk_sidebar_backgound'] && ($siteoptionBranding['pk_sidebar_backgound'] != 'Undefined')) { echo $siteoptionBranding['pk_sidebar_backgound']; }else{  echo "#23282d"; }   ?>" class="nl-color-picker" >
                        </label>
                    </div>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Sidebar Font Color</th>
                    <td>
                    <div class="dashboardcolor">          
                        <label>
                            <input type="text" name="sidebar_font_color" value="<?php if($siteoptionBranding['pk_sidebar_font_color'] && ($siteoptionBranding['pk_sidebar_font_color'] != 'Undefined')) { echo $siteoptionBranding['pk_sidebar_font_color']; }else{  echo "#eee"; }   ?>" class="nl-color-picker" >
                        </label>
                    </div>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Sidebar Font Hover Color</th>
                    <td>
                    <div class="dashboardcolor">          
                        <label>
                            <input type="text" name="sidebar_font_hover_color" value="<?php if($siteoptionBranding['pk_sidebar_font_hover_color'] && ($siteoptionBranding['pk_sidebar_font_hover_color'] != 'Undefined')) { echo $siteoptionBranding['pk_sidebar_font_hover_color']; }else{  echo "#00b9eb"; }   ?>" class="nl-color-picker" >
                        </label>
                    </div>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Sidebar Selected Item Color</th>
                    <td>
                    <div class="dashboardcolor">          
                        <label>
                            <input type="text" name="sidebar_selected_color" value="<?php if($siteoptionBranding['pk_sidebar_selected_color'] && ($siteoptionBranding['pk_sidebar_selected_color'] != 'Undefined')) { echo $siteoptionBranding['pk_sidebar_selected_color']; }else{  echo "#fff"; }   ?>" class="nl-color-picker" >
                        </label>
                    </div>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Sidebar Selected Background Color</th>
                    <td>
                    <div class="dashboardcolor">          
                        <label>
                            <input type="text" name="sidebar_selected_bgcolor" value="<?php if($siteoptionBranding['pk_sidebar_selected_bgcolor'] && ($siteoptionBranding['pk_sidebar_selected_bgcolor'] != 'Undefined')) { echo $siteoptionBranding['pk_sidebar_selected_bgcolor']; }else{  echo "#0073aa"; }   ?>" class="nl-color-picker" >
                        </label>
                    </div>
                    </td>
                </tr>
            </table>

        </div>

        <div id="login" class="tab-pane fade">
            <table>
                <tr valign="top">
                    <th scope="row">Upload Your logo</th>
                    <td>
                        <input name="wp_login_logo" id="wp_login_logo" value="<?php if($siteoptionBranding['pk_wp_login_logo']) { echo $siteoptionBranding['pk_wp_login_logo']; }else{  echo ""; }   ?>" class="wp_login_select regular-text" type="text"> 

                        <input class="button wp_login_select-image" data-textid="wp_login_logo" id="wp_login_logo-select-image" value="Upload" type="button" onclick="open_media_uploader_image('wp_login_logo')">

                        <span data-textid="wp_login_logo" class="wp_essentials_clear-image button" onclick="clear_uploader_image('wp_login_logo')"><?php _e('Remove', 'wpes'); ?></span>
                    </td>
                </tr>
                 
                <tr valign="top">
                    <th scope="row">Login Form Lable Color</th>
                    <td>
                        <label>
                            <input type="text" name="form_label_color" value="<?php if($siteoptionBranding['pk_form_label_color']) { echo $siteoptionBranding['pk_form_label_color']; }else{  echo "#444444"; }   ?>" class="nl-color-picker" >
                        </label>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Login Form Button Color</th>
                    <td>
                        <label>
                            <input type="text" name="form_button_color" value="<?php if($siteoptionBranding['pk_form_button_color']) { echo $siteoptionBranding['pk_form_button_color']; }else{  echo "#007cba"; }   ?>" class="nl-color-picker" >
                        </label>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Login screen background image overlay color</th>
                    <td>
                        <label>
                            <input type="text" name="dashboard_background" value="<?php if($siteoptionBranding['pk_dashboard_background_overlay']) { echo $siteoptionBranding['pk_dashboard_background_overlay']; }else{  echo "#eeeeee"; }   ?>" class="nl-color-picker" >
                        </label>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Login screen background image</th>
                    <td>
                        <input name="wp_image_background" id="wp_image_background" value="<?php if($siteoptionBranding['pk_wp_image_background']) { echo $siteoptionBranding['pk_wp_image_background']; }else{  echo ""; }   ?>" class="wp_login_select regular-text" type="text">
                        
                        <input class="button wp_login_select-image" data-textid="wp_image_background" id="wp_login_background-select-image" value="Upload" type="button" onclick="open_media_uploader_image('wp_image_background')">

                        <span data-textid="wp_image_background" class="wp_essentials_clear-image button" onclick="clear_uploader_image('wp_image_background')"><?php _e('Remove', 'wpes'); ?></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Login screen background full screen</th>
                    <td>
                        <div class="head_main_right">
                            <input type="checkbox" name="background_full_screen" class="js-switch"                                            
                            <?php 
                            echo !empty($siteoptionBranding['pk_background_full_screen']) ? 'checked' : ""
                            ?>                        
                            data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
                        </div>
                    </td>
                </tr>

            </table>
        </div>
    
        <div id="whitelabel" class="tab-pane fade">
        <table>
                <tr valign="top">
                    <th scope="row">Default text<br><p>Control the main signature in the dashboard</p></th>
                    <td>
                        <textarea name="thank_you_text" style="width:100% !important;"><?php if($siteoptionBranding['pk_thank_you_text']) { echo $siteoptionBranding['pk_thank_you_text']; } ?> </textarea>
                    </td>
                </tr>          
            </table>
        </div>
    </div>

    <div class="form_branding_submit">
        <img id="loader" src="/wp-admin/images/spinner.gif" />
        <input type="submit" value="Save changes" id="form_branding_submit" class="btn btn-success">
    </div>
</form>