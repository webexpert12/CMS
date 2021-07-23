<?php   if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
$siteoptionSecurity = get_option('SMARTSite_settings_security'); 
$siteoptionGDPR = get_option('SMARTSite_settings_gdpr');
$siteoptionGutenberg = get_option('SMARTSite_settings_gutenberg');
$siteoptionCustomcode = get_option('SMARTSite_settings_customcode');
$siteoptionfootersettings = get_option('SMARTSite_settings_footer_settings');
 
?>
<div class="wrap">
<div class="settings_page">
    
<div class="container smartsite">
		<div class="layout">   
		  <div class="row">
				<div class="col-lg-2 col-md-12 col-sm-12 smartsidebar">
					<div class="left_col">
				       <div class="logo"><img class="img-fluid" src='<?php echo plugins_url("../inc/img/sitehub-businesscards.png",__FILE__);?>'></div>
				       <nav class="navbar navbar-expand-lg navbar-light my_nav">
				       	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						    <span class="navbar-toggler-icon"></span>
						  </button>
                         
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
						  <ul class="navbar-nav">
						    <li class="nav-item active" id="branding"> 
						      <a class="nav-link" href="#">Branding</a>
						    </li>
						    <li class="nav-item" id="social_media" >
						      <a class="nav-link" href="#">Social Media</a>
						    </li>
						    <li class="nav-item" id="GDRP">
						      <a class="nav-link" href="#">GDRP</a>
						    </li>
						     <li class="nav-item" id="duplicate_posts">
						      <a class="nav-link" href="#">Duplicate Posts</a>
						    </li>
						     <li class="nav-item" id="disable_gutenberg">
						      <a class="nav-link" href="#">Disable Gutenberg</a>
						    </li>
						     <li class="nav-item" id="custom_codes">
						      <a class="nav-link" href="#">Custom Codes</a>
						    </li>	
                            <li class="nav-item" id="footer_settings">
                              <a class="nav-link" href="#">Footer Settings</a>
                            </li>					    
						      <li class="nav-item" id="security">
						      <a class="nav-link" href="#">Security</a>
						    </li>
						      <!-- <li class="nav-item" id="marketplace">
						      <a class="nav-link" href="#">Marketplace</a>
						    </li> -->
						  </ul>
						 </div> 
						</nav>
				    
                </div>
                </div>
                <!-- Custom SMARTSite Branding -->
				<div class="col-lg-10 col-md-12 col-sm-12 smartrightside">
                    <div class="ss-overlay-custom"></div>
                    <div class="updated_notice_custom" style="display: none;"><strong>Settings Saved!</strong></div>
                    <div class="error notice" style="display: none;"></div>
                    <div class="content_block branding" >
				     	<div class="heading">Custom SMARTSite Branding</div>
                        <div class="content">
                            <?php 
                                include_once( SMARTSite_PATH . 'admin/core/branding/view.php' );
                            ?> 
                        </div>
                     </div>
                     <!-- Social Media Settings-->
                     <div class="content_block social_media" style="display:none;" >
				     	 <div class="heading">Social Media Settings</div>
				     	 <div class="content">
                         <p>IMPORTANT NOTE: This tab controls the social networks that display in the header and footer or elsewhere throughtout your site. Add the social site of your choice along with your unique URL. Each netwrok you wish to display must be added here to show up on your site or copy and paste the shortcode below.</p>
                         <br><div><strong>Shortcode</strong>
                         <p>Copy and paste this shortcode into your widget, post or pages.</p>
                         <div class="jirei-post-list">
                            <code>[SMARTSite_SOCIAL]</code>
                        </div>
                         </div>
                         <?php 
                            global $wpdb;   
                            $table = $wpdb->prefix.'SITE_social';
                            $social_media_link= $wpdb->get_results( "SELECT * FROM $table" );
                         ?>
                         <div class="social_setup tab-pane">
                            <table>
                                <tr>
                                    <th>
                                        <h4>Social Media Links</h4>
                                        <p>Social media links use a repeater field and allow one network per field.</p>
                                        <!-- <p>Click the "Add New" to add Additional social media icons.</p> -->
                                    </th>
                                    <td>
                                        <form  id="form_id">
                                                    <div class="block add-newicon">
                                                        <span class="addSocial btn btn-primary"><i class="fa fa-plus"> </i> Add New</span>
                                                    </div>
                                                <div class="optionBox">
                                                    <?php
                                                        if($social_media_link){
                                                            foreach ($social_media_link as $key => $value) {  ?>
                                                            <div class="block">
                                                                <div class="main_block_social">
                                                                    <p>
                                                                        <input class="icon_picker" type="text" name="social[]" value="<?php echo $value->social_media; ?>" />
                                                                        <span class="input-group-addon"><i class="<?php echo $value->social_media; ?>"></i></span>
                                                                    </p>
                                                                    <input type="text" value="<?php echo $value->social_media_link; ?>" name="social_link[]" />         
                                                                </div>
                                                                <span class="remove"><i class="fa fa-times" aria-hidden="true"></i></span>
                                                            </div>
                                                        <?php } }else{ ?>
                                                            <div class="block">
                                                            <div class="main_block_social">
                                                                <div class="social_inner">
                                                                    <input type="text" class="icon_picker" name="social[]" />
                                                                    <span class="input-group-addon"><i class="fas fa-archive"></i></span>
                                                                </div>
                                                                <input type="text" value="#" name="social_link[]" />            
                                                            </div>
                                                        <span class="remove"><i class="fa fa-times" aria-hidden="true"></i></span>
                                                    </div>
                                                        <?php }  ?>
                                                    
                                                   
                                                </div>
                                                
                                        </form>
                                    </td>
                                </tr>
                            </table>
                            <div class="form_setting_submit">
                               <img id="loader" src="/wp-admin/images/spinner.gif" /><input type="submit" value="Save changes" class="btn btn-success" id="form_social_submit">
                            </div>
                            </div>
				     	 </div>
                     </div>
                      <!-- GDPR Settings -->
                     <div class="content_block GDRP" style="display:none;">
				     	 <div class="heading">GDPR Settings</div>
				     	 <div class="content tab-pane">
                           <form id="form_GDPR" method="post">
                            <table>
                                <tr>
                                    <th>
                                        <label>Enable GDPR Notices</label>
                                        <p>When this setting is enabled, you're GDPR notice will be displayed on the front-end of your website.</p>
                                    </th>
                                    <td>
                                        <div class="head_main_right">
                                            <input type="checkbox" name="gdpr_enable" class="js-switch"

                                            <?php 
                                            echo !empty($siteoptionGDPR['pk_enable_gdpr']) ? 'checked' : ""
                                            ?>                        
                                            data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <div class="">GDPR Notices settings</div>
                                        <p>Enter your GDPR text below:</p>
                                    </th>
                                    <td>
                                        <div class="gdpr_test"><textarea class="widefat" style="width:100% !important; height:130px;" name="gdpr_text" required="required"><?php if($siteoptionGDPR['pk_gdpr_content']){ echo stripslashes($siteoptionGDPR['pk_gdpr_content']) ; } ?></textarea></div>
                                    </td>
                                </tr>
                                 <tr>
                                    <th>
                                        <label>Accept Button Text Color </label>
                                    </th>
                                    <td>
                                    <label>
                                        <input type="text" name="btn_text" value="<?php if($siteoptionGDPR['pk_btn_text']) { echo $siteoptionGDPR['pk_btn_text']; }else{  echo "#eeeeee"; }   ?>" class="nl-color-picker" >
                                    </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label>Accept Button Background Color </label>
                                    </th>
                                    <td>
                                    <label>
                                        <input type="text" name="btn_bgcolor" value="<?php if($siteoptionGDPR['pk_btn_bgcolor']) { echo $siteoptionGDPR['pk_btn_bgcolor']; }else{  echo "#eeeeee"; }   ?>" class="nl-color-picker" >
                                    </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label>Notice Text Color </label>
                                    </th>
                                    <td>
                                    <label>
                                        <input type="text" name="notice_textcolor" value="<?php if($siteoptionGDPR['pk_notice_textcolor']) { echo $siteoptionGDPR['pk_notice_textcolor']; }else{  echo "#eeeeee"; }   ?>" class="nl-color-picker" >
                                    </label>
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        <label>Notice Background Color </label>
                                    </th>
                                    <td>
                                    <label>
                                        <input type="text" name="notice_bgcolor" value="<?php if($siteoptionGDPR['pk_notice_bgcolor']) { echo $siteoptionGDPR['pk_notice_bgcolor']; }else{  echo "#eeeeee"; }   ?>" class="nl-color-picker" >
                                    </label>
                                    </td>
                                </tr>

                                

                                <tr>
                                    <th>
                                        <label>Hide this notice for 7 Days after visit</label>
                                    </th>
                                    <td>
                                        <div class="head_main_right">
                                            <input type="checkbox" name="gdpr_cookie" class="js-switch"                                            
                                            <?php 
                                            echo !empty($siteoptionGDPR['pk_gdpr_cookie']) ? 'checked' : ""
                                            ?>                        
                                            data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
                                        </div>
                                    </td>
                                </tr>

                            </table>
                                 
                            <div class="form_gdpr_submit"><img id="loader" src="/wp-admin/images/spinner.gif" /><input type="submit" value="Save changes" id="form_gdpr_submit" class="btn btn-success" ></div>
                           </form>
				     </div>
				</div>
                <!-- Duplicate Posts -->
                <div class="content_block duplicate_posts" style="display:none;" >
                    <div class="heading">Duplicate Post</div>
                    <div class="tab-pane">
                        <?php 
                            include_once( SMARTSite_PATH . 'admin/core/duplicate_post/view.php' );
                        ?>                                       
                    </div>
                </div>
                <!-- Disable Gutenberg -->
                <div class="content_block disable_gutenberg" style="display:none;" >
                    <div class="heading">Disable Gutenberg</div>
                        <div class="content tab-pane">
                        <form id="form_gutenberg" method="post">
                            <table>
                                <tr>
                                <th>
                                    Disable Gutenberg <br><p>Disable the Gutenberg Wordpress Editor.</p>
                                </th>
                                <td>
                                    <div class="head_main_right">
                                        <input type="checkbox" name="disable_gutenberg" class="js-switch"
                                        <?php 
                                            echo !empty($siteoptionGutenberg['pk_disable_gutenberg']) ? 'checked' : ""
                                        ?>                        
                                        data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
                                    </div>
                                </td>
                                </tr>
                            </table>  
                            <div class="disable_gutenburg_submit"><img id="loader" src="/wp-admin/images/spinner.gif" /><input type="submit" name="save" class="btn btn-success" id="disable_gutenburg" value="Save Changes"></div>                                       
                        </form>
                    </div> 
                </div>
                <!--Custom code-->               
                 <div class="content_block custom_codes" style="display:none;" >
                         <div class="heading">Custom Codes</div>
                         <div class="content">
                            <form id="form_custom_code">
                                <div class="custom_css">
                                    <div class="tab-pane">
                                        <table>
                                            <tr>
                                                <th>
                                                    <div class="head_main_left">CSS code</div>
                                                    <p>Enter your CSS code in the field below. DO not include any tags or HTML in the field Custom CSS entered here will override the theme CSS_ In some cases, the important tag may be needed. Don't URL encode image Or svg paths. Contents Of this field Will be auto encoded.</p>
                                                </th>
                                                <td>
                                                    <textarea name="smart_css" class="widefat" style="width:100% !important; height:200px;"><?php echo stripslashes($siteoptionCustomcode['pk_cust_css']); ?></textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                     
                                     <div> 
                                     </div>
                                </div>
                                <div class="main_block tab-pane">
                                    <table>
                                        <tr>
                                             <th>
                                                <div class="head_main_left">Tracking Code</div> 
                                                    <p>Paste your tracking code here. This Will be added into the header template Of your theme. Place code inside <code>&lt;script&gt;</code> tags.</p>    
                                            </th>
                                            <td>
                                                <div class="head_main_right">
                                                    <textarea name="tracking_code" class="widefat" style="width:100% !important; height:150px !important;"><?php echo stripslashes($siteoptionCustomcode['pk_tracking_code']); ?></textarea>
                                                 </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="main_block tab-pane">
                                    <table>
                                        <tr>
                                             <th>
                                            <div class="head_main_left">Space before <code>&lt;/head&gt;</code></div> 
                                            <p>Only accepts javascript code wrapped with tags <code>&lt;script&gt;</code> and HTML markup that is valid inside the &lt;/head&gt; tag.</p>    
                                            </th>
                                            <td>
                                                <div class="head_main_right">
                                                    <textarea name="head_tag" class="widefat" style="width:100% !important; height:150px !important;"><?php echo stripslashes($siteoptionCustomcode['pk_head_tag']); ?></textarea>
                                                 </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="main_block tab-pane">
                                     <table>
                                        <tr>
                                            <th>
                                                <div class="head_main_left">Space after <code>&lt;body&gt;</code></div> 
                                                    <p>Only accepts javascript code wrapped with tags <code>&lt;script&gt;</code> and HTML markup that is valid inside the &lt;body&gt; tag.</p>    
                                            </th>
                                    <td>
                                        <div class="head_main_right">
                                            <textarea name="body_tag" class="widefat" style="width:100% !important; height:150px !important;"><?php echo stripslashes($siteoptionCustomcode['pk_after_body_tag']); ?></textarea>
                                         </div>
                                    </td>
                                </tr>
                            </table>
                                </div>
                                 <div class="main_block tab-pane">
                                    <table>
                                        <tr>
                                             <th>
                                        <div class="head_main_left">Insert Footer Code</div> 
                                            <p>Only accepts javascript code wrapped with tags <code>&lt;script&gt;</code> and HTML markup that is valid inside the &lt;/head&gt; tag.</p> 
                                            <p>This code Will be inserted below the site's footer.php file.</p>   
                                    </th>
                                    <td>
                                        <div class="head_main_right">
                                            <textarea name="footer_tag" class="widefat" style="width:100% !important; height:150px !important;"><?php echo stripslashes($siteoptionCustomcode['pk_footer_tag']); ?></textarea>
                                         </div>
                                    </td>
                                </tr>
                            </table>
                                </div>
                                 <div class="custom_code_submit"><img id="loader" src="/wp-admin/images/spinner.gif" /><input type="submit" name="save" class="btn btn-success" id="custom_code_id" value="Save Changes"></div>
                                </form>     
                         </div>
                </div>
                 <!--Security-->  
                <div class="content_block security" style="display:none;" >
                    <div class="heading">SMARTsite Security Settings</div>
                    <div class="content tab-pane">
                        <div class="main_block"> 
                            <form id="form_security" method="post">
                            <table>
                                <tr>
                                    <th>Remove Default meta data from head
                                    <p>When enabled, this'll remove the default wordpress meta data from the head of your website.</p> 
                                    </th>
                                    <td>
                                        <div class="head_main_right">
                                            <input type="checkbox" name="diable_default_meta" class="js-switch"
                                            
                                            <?php 
                                            echo !empty($siteoptionSecurity['pk_site_meta']) ? 'checked' : ""
                                            ?>
                                            
                                            data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
                                        </div>
                                    </td>
                                </tr>
                            </table>       
                            <div class="form_security_submit">
                                <img id="loader" src="/wp-admin/images/spinner.gif" />
                                <input type="submit" value="Save changes" id="form_security_submit" class="btn btn-success">
                            </div>                          
                            </form>  
                        </div>

                        <div class="main_block"> 
                            <h4>Securiy Audit</h4>
                            <p>Your SMARTSite works together with other security measures such as your hosting package or plugins such as WordFence Security.</p>
                            <p>Click the button below to request a security audit. After sending the request, someone from our team will reach out within 24-48 hours.</p>
                            <div class="form_branding_submit text-left">
                                <img id="sloader" src="/wp-admin/images/spinner.gif" />
                                <input type="button" name="request_audit" id="security_audit" value="Request Audit" class="btn btn-success">
                            </div>
                        </div>
                    </div>
                </div>

                <!--Footer Settings-->  
                <div class="content_block footer_settings" style="display:none;" >
                    <div class="heading">SMARTsite Footer Settings</div>
                         <form id="footer_settings_form">
                         <div class="content tab-pane">
                            <table>
                                <tr>
                                    <th>
                                        Copyright Bar
                                        <p>Turn on to display the copyright bar</p>
                                    </th>
                                    <td>
                                        <div class="head_main_right">
                                            <input type="checkbox" name="show_copyright" class="js-switch"
                                            
                                            <?php 
                                            echo !empty($siteoptionfootersettings['show_copyright']) ? 'checked' : ""
                                            ?>
                                            
                                            data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        Center Copyright Content
                                        <p>Turn on to center the copyright content</p>
                                    </th>
                                    <td>
                                        <div class="head_main_right">
                                            <input type="checkbox" name="center_copyright_content" class="js-switch" 
                                            <?php 
                                            echo !empty($siteoptionfootersettings['center_copyright_content']) ? 'checked' : ""
                                            ?>
                                            data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        Copyright Text Color
                                    </th>
                                    <td>
                                        <input type="text" name="copyright_text_color" value="<?php if($siteoptionfootersettings['copyright_text_color']) { echo $siteoptionfootersettings['copyright_text_color']; }else{  echo "#eeeeee"; }   ?>" class="nl-color-picker" >
                                     </td>
                                </tr>
                                <tr>
                                    <th>
                                        Copyright Background Color
                                    </th>
                                    <td>
                                        <input type="text" name="copyright_bg_color" value="<?php if($siteoptionfootersettings['copyright_bg_color']) { echo $siteoptionfootersettings['copyright_bg_color']; }else{  echo "#eeeeee"; }   ?>" class="nl-color-picker" >
                                     </td>
                                </tr>
                                <tr>
                                    <th>
                                        Copyright Text  
                                        <p>Enter the text displays in the copyright bar. HTML markup can be used.</p>
                                    </th>
                                    <td>
                                        <?php 
                                            
                                            $content = !empty($siteoptionfootersettings['footer_settings_copyright_text_data']) ? $siteoptionfootersettings['footer_settings_copyright_text_data'] : "" ;

                                            $editor_id = 'footer_settings_copyright_text';

                                            $settings = array( 'textarea_name' => 'footer_settings_copyright_text_data' );

                                            wp_editor( $content, $editor_id, $settings );
                                        ?>
                                    </td>
                                </tr>

                            </table>
                            <div class="form_footer_settings_submit"><img id="loader" src="/wp-admin/images/spinner.gif" /><input type="submit" value="Save changes" id="form_footer_settings_submit" class="btn btn-success"></div>
                         </div>
                   </form>
                </div>
                <!-- Market place -->
                
               <div class="content_block marketplace" style="display:none;" >
                 <div class="heading">Site Hub Marketplace</div>
                
                 <div class="content">
                  <p>Are you ready to take your website to the next level? Our SMART Site addons are aimed to attract visitors, impress users, convert leads, and drive sales. Request new services below:
                </p>
                    <div class="inner_market_place row">
                    <?php 
                        include_once( SMARTSite_PATH . 'admin/core/marketplace.php' );
                    ?> 
                    </div>
                 </div>
                </div>
		  </div>
	</div>
</div>
</div>
</div>


 <!-- <div id="req_modal" class="modal fade" role="dialog">
   <div class="modal-overlay-custom"></div>
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4> Service Request</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form class="req_form_email">
               <div class="form-group"><input type="text" class="form-control cname"  name="cname" placeholder="Enter Name"></div>
               <div class="form-group"><input type="email" class="form-control cemail"  name="cemail" placeholder="Enter Email"></div>
               <input type="hidden" name="service_name" class="service_name">
               <input type="hidden" name="parent_service" class="parent_service">
               <button type="submit" class="req_form_email_submit btn btn-success">Submit</button>
            </form>
         </div>
      </div>
   </div>
</div>  -->