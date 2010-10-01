<?php

define('_TEMPLATEURL', WP_CONTENT_URL.'/themes/' . basename(TEMPLATEPATH));

include_once TEMPLATEPATH . '/WPAlchemy/MetaBox.php';

// include css to style the custom meta boxes, this should be a global
// stylesheet used by all similar meta boxes
if (is_admin()) wp_enqueue_style('custom_meta_css', _TEMPLATEURL . '/tests/fixtures/meta.css');

$custom_metabox = new WPAlchemy_MetaBox(unserialize(file_get_contents(TEMPLATEPATH . '/tests/fixtures/config_serialized.txt')));

require_once TEMPLATEPATH . '/tests/fixtures/setup.php';
