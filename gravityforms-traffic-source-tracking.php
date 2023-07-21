<?php
/*
Plugin Name:        Gravity Forms: Initial traffic source tracking
Plugin URI:         http://genero.fi
Description:        A WordPress plugin
Version:            1.1.1
Author:             Genero
Author URI:         http://genero.fi/
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
*/

if (!defined('ABSPATH')) {
    exit;
}

add_filter('gform_entry_meta', function ($entry_meta, $form_id) {
    $entry_meta['utmcsr'] = array(
        'label' => __('Campaign Source', 'plugins'),
        'is_numeric' => false,
        'is_default_column' => true,
        'update_entry_meta_callback' => __NAMESPACE__ . '\\gf_traffic_source_tracking_update_meta',
    );
    $entry_meta['utmcmd'] = array(
        'label' => __('Campaign Medium', 'plugins'),
        'is_numeric' => false,
        'is_default_column' => true,
        'update_entry_meta_callback' => __NAMESPACE__ . '\\gf_traffic_source_tracking_update_meta',
    );
    $entry_meta['utmccn'] = array(
        'label' => __('Campaign Name', 'plugins'),
        'is_numeric' => false,
        'is_default_column' => true,
        'update_entry_meta_callback' => __NAMESPACE__ . '\\gf_traffic_source_tracking_update_meta',
    );
    $entry_meta['utmcct'] = array(
        'label' => __('Campaign Content', 'plugins'),
        'is_numeric' => false,
        'is_default_column' => true,
        'update_entry_meta_callback' => __NAMESPACE__ . '\\gf_traffic_source_tracking_update_meta',
    );
    $entry_meta['utmctr'] = array(
        'label' => __('Campaign Term', 'plugins'),
        'is_numeric' => false,
        'is_default_column' => true,
        'update_entry_meta_callback' => __NAMESPACE__ . '\\gf_traffic_source_tracking_update_meta',
    );

    return $entry_meta;
}, 10, 2);

add_filter('gform_entry_detail_meta_boxes', function ($meta_boxes, $entry, $form) {
    $meta_boxes[ 'gf_traffic_source_tracking' ] = [
        'title'    => 'Initial traffic source info',
        'callback' => __NAMESPACE__ . '\\gf_traffic_source_tracking_metabox',
        'context'  => 'side',
    ];

    return $meta_boxes;
}, 10, 3);

function gf_traffic_source_tracking_get(string $key) {
    $cookie_value = sanitize_text_field($_COOKIE['__utmzz']);
    $cookie_array = explode('|', $cookie_value);

    foreach ($cookie_array as $c) {
        $cookie = explode('=', $c);
        if ($cookie[0] === $key) {
            return $cookie[1] ?? '';
        }
    }
    return '';
}

function gf_traffic_source_tracking_update_meta(string $key) {
    return gf_traffic_source_tracking_get($key);
}

function gf_traffic_source_tracking_metabox($args) {

    $entry = $args['entry'];
    $html = '';

    $cookies = [
        [ 'id' => 'utmcsr', 'label' => __('Campaign Source', 'plugins') ],
        [ 'id' => 'utmcmd', 'label' => __('Campaign Medium', 'plugins') ],
        [ 'id' => 'utmccn', 'label' => __('Campaign Name', 'plugins') ],
        [ 'id' => 'utmcct', 'label' => __('Campaign Content', 'plugins') ],
        [ 'id' => 'utmctr', 'label' => __('Campaign Term', 'plugins') ],
    ];

    foreach ($cookies as $c) {
        $meta_value = gform_get_meta($entry['id'], $c['id']);
        $html .= '<tr><td>' . $c['label'] . '</td><td>' . $meta_value . '</td></tr>';
    }

    echo '<table>' . $html . '</table>';
}
