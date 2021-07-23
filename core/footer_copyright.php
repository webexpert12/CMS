<?php   

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
$siteoptionfootersettings = get_option('SMARTSite_settings_footer_settings');

if(isset($siteoptionfootersettings['center_copyright_content']) && $siteoptionfootersettings['center_copyright_content'] == 'on'){
    $class="text-center";
}else{
    $class="";
}

$footer_settings_copyright_text_color =  isset($siteoptionfootersettings['copyright_text_color']) ? $siteoptionfootersettings['copyright_text_color'] : "#fff";

$footer_settings_copyright_bg_color =  isset($siteoptionfootersettings['copyright_bg_color']) ? $siteoptionfootersettings['copyright_bg_color'] : "#000";

?>

<div class="footer_copyright_smart_settings" style = 'background-color:<?php echo $footer_settings_copyright_bg_color; ?> !important;'>
    <p class="copyright_text <?php echo $class; ?>" style = 'color:<?php echo $footer_settings_copyright_text_color; ?> !important;'>
        <?php echo $siteoptionfootersettings['footer_settings_copyright_text_data']; ?>
    </p>
</div>