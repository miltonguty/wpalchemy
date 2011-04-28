<?php

$verification_str = 'd8b32aed3c';

function my_init_action()
{
	global $verification_str;

	echo $verification_str;
}

function my_output_filter_false()
{
	return FALSE;
}

function my_output_filter_true()
{
	return TRUE;
}

function my_output_filter_post_id($post_id)
{
	global $verification_str;
	
	echo $verification_str . '-' . $post_id;

	return TRUE;
}

function my_save_filter($meta, $post_id)
{
	$meta['description'] = 'post_id = ' . $post_id;

	return $meta;
}

function my_save_action($meta, $post_id)
{
	echo md5(serialize($meta) . $post_id);

	exit;
}

function my_head_filter($content)
{
	return $content;
}

function my_head_filter_block($content)
{
	return NULL;
}

function my_head_action()
{
	?><script language="javascript" type="text/javascript"> var wpalchemy_head_action = 'head_action'; </script><?php
}

function my_foot_filter($content)
{
	return $content;
}

function my_foot_filter_block($content)
{
	return NULL;
}

function my_foot_action()
{
	?><script language="javascript" type="text/javascript"> var wpalchemy_foot_action = 'foot_action'; </script><?php
}