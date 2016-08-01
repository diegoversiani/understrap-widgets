<?php 
/*
 * Template for the output of the Section Begin Widget
 * Override by placing a file called `cbb_section_begin_template.php`
 * in the folder `plugins/customizer-building-blocks/widget-templates` in your active theme
 */

$css_class = 'cbb-section row ' . $css_class;

?> 
<div class="<?php esc_attr_e( $css_class ); ?>">

    <?php if ( ! empty( $instance['title'] ) ) : ?>
      <div class="section-title">
      <?php echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title']; ?>
      </div>
    <?php endif; ?>

    <div class="section-content">