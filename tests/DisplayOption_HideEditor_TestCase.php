<?php

require_once 'Base_TestCase.php';

class WPAlchemy_DisplayOption_HideEditor_TestCase extends WPAlchemy_Base_TestCase
{
	function _the_test()
	{
		$this->assertEquals("1", $this->getEval("this.browserbot.getUserWindow().jQuery('#postdiv, #postdivrich').filter(':hidden').length;"));
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

	function test_with_visual_editor_and_post_type()
	{
		// condition
		$this->_set_config();
		$this->_use_visual_editor_login();
		$this->_use_post_type();

		$this->_the_test();
	}

	function test_with_visual_editor_and_page_type()
	{
		// condition
		$this->_set_config();
		$this->_use_visual_editor_login();
		$this->_use_page_type();

		$this->_the_test();
	}

	function test_with_html_editor_and_post_type()
	{
		// condition
		$this->_set_config();
		$this->_use_html_editor_login();
		$this->_use_post_type();

		$this->_the_test();
	}

	function test_with_html_editor_and_page_type()
	{
		// condition
		$this->_set_config();
		$this->_use_html_editor_login();
		$this->_use_page_type();

		$this->_the_test();
	}
}

?>