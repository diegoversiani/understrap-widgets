<?php
/**
 * Plugin Name: Customizer Building Blocks
 * Plugin URI: http://github.com/diegoversiani/customizer-building-blocks
 * Description: Common website blocks as customizable widgets you can add to any widget area of your website.
 * Text Domain: customizer-building-blocks
 * Domain Path: /languages
 * Version: 0.0.1
 * Author: Diego Versiani
 * Author URI: http://diegoversiani.me/
 * License: GPL2
 */


/*------------------------------------*\
  #CONSTANTS
\*------------------------------------*/

if (!defined('CBB_WIDGETS_DIR')) define('CBB_WIDGETS_DIR', plugin_dir_path( __FILE__ ));
if (!defined('CBB_THEME_TEMPLATES_FOLDER')) define('CBB_THEME_TEMPLATES_FOLDER', 'plugins/customizer-building-blocks/widget-templates' );
if (!defined('CBB_DEFAULT_TEMPLATES_FOLDER')) define('CBB_DEFAULT_TEMPLATES_FOLDER',  CBB_WIDGETS_DIR . 'widget-templates/default' );





/*------------------------------------*\
  #SETUP WIDGETS
\*------------------------------------*/

add_action( 'widgets_init', 'cbb_widgets_plugin_init');
function cbb_widgets_plugin_init () {
  require_once( CBB_WIDGETS_DIR . 'widgets/cbb_about_widget.php' );
  require_once( CBB_WIDGETS_DIR . 'widgets/cbb_cta_widget.php' );
  require_once( CBB_WIDGETS_DIR . 'widgets/cbb_featured_widget.php' );
  require_once( CBB_WIDGETS_DIR . 'widgets/cbb_section_begin_widget.php' );
  require_once( CBB_WIDGETS_DIR . 'widgets/cbb_section_end_widget.php' );
  require_once( CBB_WIDGETS_DIR . 'widgets/cbb_social_networks_widget.php' );
  require_once( CBB_WIDGETS_DIR . 'widgets/cbb_text_widget.php' );
  
  register_widget( 'CBB_About_Widget' );
  register_widget( 'CBB_CTA_Widget' );
  register_widget( 'CBB_Featured_Widget' );
  register_widget( 'CBB_SectionBegin_Widget' );
  register_widget( 'CBB_SectionEnd_Widget' );
  register_widget( 'CBB_SocialNetworks_Widget' );
  register_widget( 'CBB_Text_Widget' );

}






/*------------------------------------*\
  #FUNCTIONS
\*------------------------------------*/

if (! function_exists( 'is_customizer_building_blocks_widgets_ativated' )) {
  function is_customizer_building_blocks_widgets_ativated () {
    return true;
  }
}

if (! function_exists( 'customizer_building_blocks_widgets_sanitize_css_classes' )) {
  function customizer_building_blocks_widgets_sanitize_css_classes ( $classes ) {
    $individual_classes = explode(' ', $classes);

    foreach ($individual_classes as $class) {
      $sanitized_classes .= sanitize_html_class( $class ) . ' ';
    }

    return trim( $sanitized_classes );
  }
}
