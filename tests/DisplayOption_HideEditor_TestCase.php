<?php

require_once 'Base_TestCase.php';

class WPAlchemy_DisplayOption_HideEditor_TestCase extends WPAlchemy_Base_TestCase
{
	function _assert_is_hidden()
	{
		$this->assertEquals("1", $this->getEval("this.browserbot.getUserWindow().jQuery('#postdiv, #postdivrich').filter(':hidden').length;"));
	}

	function _assert_is_not_hidden()
	{
		$this->assertEquals("0", $this->getEval("this.browserbot.getUserWindow().jQuery('#postdiv, #postdivrich').filter(':hidden').length;"));
	}

	function _set_config()
	{
		$this->_use_config(array
		(
			'id' => '_custom_meta',
			'title' => 'My Custom Meta',
			'template' => $this->_path . '/fixtures/simple_meta.php',
			'hide_editor' => TRUE,
		));
	}

	function test_with_visual_editor_with_post_type_edit()
	{
		// condition
		$this->_set_config();
		$this->_use_visual_editor_login();
		$this->_use_post_type();

		$this->_assert_is_hidden();
	}

	function test_with_visual_editor_with_post_type_new()
	{
		// condition
		$this->_set_config();
		$this->_use_visual_editor_login();
		$this->_use_post_type_new();

		$this->_assert_is_hidden();
	}

	function test_with_visual_editor_with_page_type_edit()
	{
		// condition
		$this->_set_config();
		$this->_use_visual_editor_login();
		$this->_use_page_type();

		$this->_assert_is_hidden();
	}

	function test_with_visual_editor_with_page_type_new()
	{
		// condition
		$this->_set_config();
		$this->_use_visual_editor_login();
		$this->_use_page_type_new();

		$this->_assert_is_hidden();
	}

	function test_with_html_editor_with_post_type_edit()
	{
		// condition
		$this->_set_config();
		$this->_use_html_editor_login();
		$this->_use_post_type();

		$this->_assert_is_hidden();
	}

	function test_with_html_editor_with_post_type_new()
	{
		// condition
		$this->_set_config();
		$this->_use_html_editor_login();
		$this->_use_post_type_new();

		$this->_assert_is_hidden();
	}

	function test_with_html_editor_with_page_type_edit()
	{
		// condition
		$this->_set_config();
		$this->_use_html_editor_login();
		$this->_use_page_type();

		$this->_assert_is_hidden();
	}

	function test_with_html_editor_with_page_type_new()
	{
		// condition
		$this->_set_config();
		$this->_use_html_editor_login();
		$this->_use_page_type_new();

		$this->_assert_is_hidden();
	}

	function _set_config_with_types()
	{
		$this->_use_config(array
		(
			'id' => '_custom_meta',
			'title' => 'My Custom Meta',
			'template' => $this->_path . '/fixtures/simple_meta.php',
			'types' => array('page'),
			'hide_editor' => TRUE,
		));
	}

	function test_with_types_with_visual_editor_with_post_type_edit()
	{
		// condition
		$this->_set_config_with_types();
		$this->_use_visual_editor_login();
		$this->_use_post_type();

		$this->_assert_is_not_hidden();
	}

	function test_with_types_with_visual_editor_with_post_type_new()
	{
		// condition
		$this->_set_config_with_types();
		$this->_use_visual_editor_login();
		$this->_use_post_type_new();

		$this->_assert_is_not_hidden();
	}

	function test_with_types_with_visual_editor_with_page_type_edit()
	{
		// condition
		$this->_set_config_with_types();
		$this->_use_visual_editor_login();
		$this->_use_page_type();

		$this->_assert_is_hidden();
	}

	function test_with_types_with_visual_editor_with_page_type_new()
	{
		// condition
		$this->_set_config_with_types();
		$this->_use_visual_editor_login();
		$this->_use_page_type_new();

		$this->_assert_is_hidden();
	}
}

?>