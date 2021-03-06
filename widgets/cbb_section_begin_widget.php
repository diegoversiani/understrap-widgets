<?php 

class CBB_SectionBegin_Widget extends WP_Widget {

  public function __construct() {
    $widget_ops = array(
      'classname' => 'cbb_section_begin_widget',
      'description' => __( 'A Section Begin widget for CBB Theme. Should always be used before a Section End widget.', 'customizer-building-blocks' ),
      // 'customize_selective_refresh' => true
    );
    
    parent::__construct( 'cbb_section_begin_widget', __( 'CBB Section Begin', 'customizer-building-blocks' ), $widget_ops );



    add_action( 'sidebar_admin_setup', 'cbb_widget_admin_setup' );
  }





  public function widget( $args, $instance ) {

    if ( ! empty( $instance['title_tag'] ) ) {
      $args['before_title'] = '<' . esc_attr( $instance['title_tag'] ) . ' class="widget-title cbb-section-title">';
      $args['after_title'] = '</' . esc_attr( $instance['title_tag'] ) . '>';
    }

    $content_wrapper = ( $instance['content_wrapper'] ? true : false );
    $css_class = ( $instance['css_class'] ? $instance['css_class'] : '' );

    $template = locate_template( CBB_THEME_TEMPLATES_FOLDER . '/cbb_section_begin_template.php' );
    if ( $template == '' ) $template = CBB_DEFAULT_TEMPLATES_FOLDER . '/cbb_section_begin_template.php';
    include ( $template );

  }





  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
    $title_tag = ! empty( $instance['title_tag'] ) ? $instance['title_tag'] : '';
    $background_image_url = ( isset( $instance['background_image_url'] ) ) ? $instance['background_image_url'] : '';
    $content_wrapper = $instance[ 'content_wrapper' ] ? 'true' : 'false';
    $css_class = ! empty( $instance['css_class'] ) ? $instance['css_class'] : '';
    ?>
    
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'customizer-building-blocks' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>

    <p>
    <label><?php _e( 'Title Tags:', 'customizer-building-blocks' ); ?></label>
    <br>
    <select class="widefat" id="<?php echo $this->get_field_id( 'title_tag' ); ?>" name="<?php echo $this->get_field_name( 'title_tag' ); ?>">
      <option value="" <?php echo esc_attr( $title_tag == '' ? 'selected' : '' ); ?>><?php _e( '-- None --', 'customizer-building-blocks' ); ?></option>
      <option value="h1" <?php echo esc_attr( $title_tag == 'h1' ? 'selected' : '' ); ?>><?php _e( 'h1', 'customizer-building-blocks' ); ?></option>
      <option value="h2" <?php echo esc_attr( $title_tag == 'h2' ? 'selected' : '' ); ?>><?php _e( 'h2', 'customizer-building-blocks' ); ?></option>
      <option value="h3" <?php echo esc_attr( $title_tag == 'h3' ? 'selected' : '' ); ?>><?php _e( 'h3', 'customizer-building-blocks' ); ?></option>
      <option value="h4" <?php echo esc_attr( $title_tag == 'h4' ? 'selected' : '' ); ?>><?php _e( 'h4', 'customizer-building-blocks' ); ?></option>
      <option value="h5" <?php echo esc_attr( $title_tag == 'h5' ? 'selected' : '' ); ?>><?php _e( 'h5', 'customizer-building-blocks' ); ?></option>
      <option value="h6" <?php echo esc_attr( $title_tag == 'h6' ? 'selected' : '' ); ?>><?php _e( 'h6', 'customizer-building-blocks' ); ?></option>
      <option value="span" <?php echo esc_attr( $title_tag == 'span' ? 'selected' : '' ); ?>><?php _e( 'span', 'customizer-building-blocks' ); ?></option>
    </select>
    <small><?php _e( 'Apply only for the section title, not the widgets inside it.', 'customizer-building-blocks' ); ?></small>

    <p>
    <label for="<?php echo $this->get_field_id( 'background_image_url' ); ?>"><?php _e( 'Background Image URL:', 'customizer-building-blocks' ); ?></label>
    <input class="widefat background_image_url" id="<?php echo $this->get_field_id( 'background_image_url' ); ?>" name="<?php echo $this->get_field_name( 'background_image_url' ); ?>" value="<?php echo $background_image_url ?>" type="text">
    <button id="<?php echo $this->get_field_id( 'background_image_url' ) . '_select_button'; ?>" class="button" onclick="select_image_button_click('Select Image','Select Image','image','<?php echo $this->get_field_id( 'background_image_url' ) . '_preview'; ?>','<?php echo $this->get_field_id( 'background_image_url' );  ?>');"><?php _e( 'Select or upload image', 'customizer-building-blocks' ); ?></button>
    <button id="<?php echo $this->get_field_id( 'background_image_url' ) . '_clear_button'; ?>" class="button" onclick="clear_image_button_click('<?php echo $this->get_field_id( 'background_image_url' ) . '_preview'; ?>','<?php echo $this->get_field_id( 'background_image_url' );  ?>');"><?php _e( 'Clear selection', 'Clear image selection on widget admin form.', 'customizer-building-blocks' ); ?></button>
    <div id="<?php echo $this->get_field_id( 'background_image_url' ) . '_preview'; ?>" class="preview_placholder">
    <?php 
      if ($background_image_url!='') echo '<img style="max-width: 100%;" src="' . $background_image_url . '">';
    ?>
    </div>
    </p>

    <p>
    <input class="checkbox" type="checkbox" <?php checked( $instance[ 'content_wrapper' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'content_wrapper' ); ?>" name="<?php echo $this->get_field_name( 'content_wrapper' ); ?>" />
    <label for="<?php echo $this->get_field_id( 'content_wrapper' ); ?>"><?php _e( 'Add section content wraper?', 'customizer-building-blocks' ); ?></label>
    </p>

    <p>
    <label for="<?php echo $this->get_field_id( 'css_class' ); ?>"><?php _e( 'Custom CSS Classes:', 'customizer-building-blocks' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'css_class' ); ?>" name="<?php echo $this->get_field_name( 'css_class' ); ?>" type="text" value="<?php echo esc_attr( $css_class ); ?>">
    </p>

    <?php 
  }





  public function update( $new_instance, $old_instance ) {
    $instance = array();



    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
    $title_tag_allowed = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'span');
    $instance['title_tag'] = ( in_array($new_instance['title_tag'], $title_tag_allowed) ) ? $new_instance['title_tag'] : '';



    $instance['background_image_url'] = ( ! empty( $new_instance['background_image_url'] ) ) ? esc_url_raw( $new_instance['background_image_url'] ) : '';


    
    $instance['content_wrapper'] = $new_instance['content_wrapper'];
    $instance['css_class'] = ( ! empty( $new_instance['css_class'] ) ) ? customizer_building_blocks_widgets_sanitize_css_classes( $new_instance['css_class'] ) : '';

    return $instance;
  }
}
