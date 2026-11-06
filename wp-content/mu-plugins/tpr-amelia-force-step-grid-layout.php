<?php
/**
 * Plugin Name: TPR Amelia - Force Step Booking Grid Layout
 * Description: Forces Amelia Step Booking to use the grid/list layout (layout=2) on the frontend.
 * Author: The Pigment Room
 * Version: 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Force Amelia step-booking layout to list/grid (2) for both shortcode aliases.
 */
function tpr_force_amelia_step_layout($out, $pairs = [], $atts = [], $shortcode = '')
{
    // Keep editor/admin rendering untouched unless processed via AJAX.
    if (is_admin() && !wp_doing_ajax()) {
        return $out;
    }

    $out['layout'] = '2';

    return $out;
}

add_filter('shortcode_atts_ameliastepbooking', 'tpr_force_amelia_step_layout', 20, 4);
add_filter('shortcode_atts_ameliabooking', 'tpr_force_amelia_step_layout', 20, 4);

/**
 * Hard override: intercept shortcode execution and force layout=2
 * even when page builders pass layout=1 explicitly.
 */
add_filter('pre_do_shortcode_tag', function ($return, $tag, $attr, $m) {
    if (!in_array($tag, ['ameliastepbooking', 'ameliabooking'], true)) {
        return $return;
    }

    if (is_admin() && !wp_doing_ajax()) {
        return $return;
    }

    global $shortcode_tags;

    if (empty($shortcode_tags[$tag]) || !is_callable($shortcode_tags[$tag])) {
        return $return;
    }

    $attr = is_array($attr) ? $attr : [];
    $attr['layout'] = '2';

    return call_user_func($shortcode_tags[$tag], $attr, null, $tag);
}, 20, 4);
