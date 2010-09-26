<?php

require_once 'Base_TestCase.php';

class WPAlchemy_Functional_TestCase extends WPAlchemy_Base_TestCase
{
	public $_id = '_custom_meta_metabox_test';
	
	public $_config;

	function setUp()
	{
		parent::setUp();

		$this->_config = array
		(
			'id' => $this->_id,
			'title' => 'My Custom Meta',
			'template' => $this->_path . '/fixtures/simple_meta.php',
		);

		$this->_use_config($this->_config);
	}

	function _do_test()
	{
		$this->assertEquals('1', $this->getEval("this.browserbot.getUserWindow().jQuery('#" . $this->_id . "_metabox').length;"));

		// simple contents text
		$this->assertEquals('Name', $this->getEval("this.browserbot.getUserWindow().jQuery('#" . $this->_id . "_metabox .inside label:eq(0)').text();"));
	}

	### is meta box displayed (existing post/page)

	function test_regular_login_and_post_type()
	{
		$this->_use_regular_login();

		$this->_use_post_type();

		$this->_do_test();
	}

	function test_regular_login_and_page_type()
	{
		$this->_use_regular_login();

		$this->_use_page_type();

		$this->_do_test();
	}

	### is meta box displayed (new post/page)

	function test_regular_login_and_post_type_new()
	{
		$this->_use_regular_login();

		$this->_use_post_type_new();

		$this->_do_test();
	}

	function test_regular_login_and_page_type_new()
	{
		$this->_use_regular_login();

		$this->_use_page_type_new();

		$this->_do_test();
	}
}

?>