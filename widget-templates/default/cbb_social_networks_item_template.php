<?php 
/*
 * Template for the output of the Social Networks Widget Item
 * Override by placing a file called `cbb_social_networks_item_template.php`
 * in the folder `plugins/customizer-building-blocks/widget-templates` in your active theme
 */

$social_network_classes = 'i-' . $social_network_classes;

?>

<li class="cbb-social-networks__list-item"><a href="<?php echo esc_url( $instance[ $social_network_url ] ); ?>" target="_blank"><i class="<?php esc_attr_e( $social_network_classes ) ?>"></i></a></li>
