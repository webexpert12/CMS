<?php		

$siteoption = get_option('SMARTSite_settings_branding'); 
$body_background = ($siteoption['pk_dashboard_color']) ? $siteoption['pk_dashboard_color'] : '';
$body_color = ($siteoption['pk_dashboard_font_color']) ? $siteoption['pk_dashboard_font_color'] : '';
$sidebar_backgound = ($siteoption['pk_sidebar_backgound']) ? $siteoption['pk_sidebar_backgound'] : '';
$sidebar_font_color = ($siteoption['pk_sidebar_font_color']) ? $siteoption['pk_sidebar_font_color'] : '';
$sidebar_font_hover_color = ($siteoption['pk_sidebar_font_hover_color']) ? $siteoption['pk_sidebar_font_hover_color'] : '';
$sidebar_selected_color = ($siteoption['pk_sidebar_selected_color']) ? $siteoption['pk_sidebar_selected_color'] : '';
$sidebar_selected_bgcolor = ($siteoption['pk_sidebar_selected_bgcolor']) ? $siteoption['pk_sidebar_selected_bgcolor'] : '';

echo '<style type="text/css">
body {  
    background: '.$body_background.' !important;
    color: '.$body_color.' !important;
}

#adminmenu .wp-has-current-submenu .wp-submenu{
    background-color: '.$sidebar_backgound.' !important;
}

#adminmenu, #adminmenuwrap{
    background-color: '.$sidebar_backgound.' !important;
}

#adminmenu .wp-submenu{
    background-color: '.$sidebar_backgound.' !important;
}

#adminmenu li.current a.menu-top{
    color: '.$sidebar_selected_color.' !important;
    background: '.$sidebar_selected_bgcolor.' !important;
}

#adminmenu .current div.wp-menu-image:before{
    color: '.$sidebar_selected_color.' !important;
}

#adminmenu li.menu-top:hover {
    color: '.$sidebar_font_hover_color.' !important;
 }
 
#adminmenu li:hover div.wp-menu-image:before {
    color: '.$sidebar_font_hover_color.' !important;
}

#adminmenu a:hover{
    color: '.$sidebar_font_hover_color.' !important;
}

#adminmenu a {
    color: '.$sidebar_font_color.';
}

#adminmenu div.wp-menu-image:before {
    color: '.$sidebar_font_color.' !important;
}

</style>';


// sidebar_backgound