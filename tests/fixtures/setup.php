<?php

$custom_metabox = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta',
	'title' => 'My Custom Meta',
	'template' => TEMPLATEPATH . '/tests/fixtures/simple_meta.php',
	'lock' => 'top',
));