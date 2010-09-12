<?php

require_once 'Base_TestCase.php';

class WPAlchemy_DisplayOption_HideTitle_TestCase extends WPAlchemy_Base_TestCase
{
	function _the_test($context = 'normal')
	{
		if ('side' == $context)
		{
			$this->assertElementNotPresent("css=#_custom_meta_side_metabox .hndle");
			$this->assertElementNotPresent("css=#_custom_meta_side_metabox .handlediv");
		}
		else
		{
			$this->assertElementNotPresent("css=#_custom_meta_metabox .hndle");
			$this->assertElementNotPresent("css=#_custom_meta_metabox .handlediv");
		}
	}

	function _set_config_context_normal()
	{
		$this->_use_config(array
		(
			'id' => '_custom_meta',
			'title' => 'My Custom Meta',
			'template' => $this->_path . '/fixtures/simple_meta.php',
			'hide_title' => TRUE,
		));
	}

	function _set_config_context_side()
	{
		$this->_use_config(array
		(
			'id' => '_custom_meta_side',
			'title' => 'My Custom Meta',
			'template' => $this->_path . '/fixtures/simple_meta.php',
			'context' => 'side',
			'hide_title' => TRUE,
		));
	}

	### context normal
	
	function test_with_visual_editor_and_post_type()
	{
		// conditions
		$this->_set_config_context_normal();
		$this->_use_regular_login();
		$this->_use_post_type();

		$this->_the_test();
		sleep(5);
	}

	function test_with_visual_editor_and_page_type()
	{
		// conditions
		$this->_set_config_context_normal();
		$this->_use_regular_login();
		$this->_use_page_type();

		$this->_the_test();
		sleep(5);
	}

	### context side 

	function test_with_visual_editor_and_post_type_and_context_side()
	{
		// conditions
		$this->_set_config_context_side();
		$this->_use_regular_login();
		$this->_use_post_type();

		$this->_the_test('side');
		sleep(5);
	}

	function test_with_visual_editor_and_page_type_and_context_side()
	{
		// conditions
		$this->_set_config_context_side();
		$this->_use_regular_login();
		$this->_use_page_type();

		$this->_the_test('side');
		sleep(5);
	}
}

?>