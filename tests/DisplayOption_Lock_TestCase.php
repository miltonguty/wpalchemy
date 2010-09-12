<?php

require_once 'Base_TestCase.php';

class WPAlchemy_DisplayOption_Lock_TestCase extends WPAlchemy_Base_TestCase
{
	public $_id = '_custom_meta_lock_test';
	
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
	}

	### lock top
	
	function the_lock_top_test()
	{
		$this->assertGreaterThanOrEqual(1, $this->getEval("this.browserbot.getUserWindow().jQuery('#post-body-content #wpalchemy-content-top:nth-child(3) #" . $this->_id . "_metabox').length;"));
	}

	function the_lock_top_and_context_side_test()
	{
		$this->assertGreaterThanOrEqual(1, $this->getEval("this.browserbot.getUserWindow().jQuery('#side-info-column #wpalchemy-side-top:first-child #" . $this->_id . "_side_metabox').length;"));
	}

	function test_regular_login_and_post_type_and_lock_top()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'lock' => 'top'
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->the_lock_top_test();
	}

	function test_regular_login_and_post_type_and_lock_top_and_context_side()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'lock' => 'top',
			'id' => $this->_id . '_side',
			'context' => 'side',
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->the_lock_top_and_context_side_test();
	}

	function test_regular_login_and_post_type_and_lock_on_top()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'lock_on_top' => TRUE
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->the_lock_top_test();
	}

	function test_regular_login_and_post_type_and_lock_on_top_and_context_side()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'lock_on_top' => TRUE,
			'id' => $this->_id . '_side',
			'context' => 'side',
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->the_lock_top_and_context_side_test();
	}

	### lock bottom

	function the_lock_bottom_test()
	{
		$this->assertGreaterThanOrEqual(1, $this->getEval("this.browserbot.getUserWindow().jQuery('#post-body-content #wpalchemy-content-bottom:last-child #" . $this->_id . "_metabox').length;"));
	}

	function the_lock_bottom_and_context_side_test()
	{
		$this->assertGreaterThanOrEqual(1, $this->getEval("this.browserbot.getUserWindow().jQuery('#side-info-column #wpalchemy-side-bottom:last-child #" . $this->_id . "_side_metabox').length;"));
	}

	function test_regular_login_and_post_type_and_lock_bottom()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'lock' => 'bottom'
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->the_lock_bottom_test();
	}

	function test_regular_login_and_post_type_and_lock_bottom_and_context_side()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'lock' => 'bottom',
			'id' => $this->_id . '_side',
			'context' => 'side',
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->the_lock_bottom_and_context_side_test();
	}

	function test_regular_login_and_post_type_and_lock_on_bottom()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'lock_on_bottom' => TRUE
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->the_lock_bottom_test();
	}

	function test_regular_login_and_post_type_and_lock_on_bottom_and_context_side()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'lock_on_bottom' => TRUE,
			'id' => $this->_id . '_side',
			'context' => 'side',
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->the_lock_bottom_and_context_side_test();
	}

	### lock before_post_title

	function test_regular_login_and_post_type_and_lock_before_post_title()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'lock' => 'before_post_title'
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertGreaterThanOrEqual(1, $this->getEval("this.browserbot.getUserWindow().jQuery('#post-body-content #wpalchemy-content-bpt:first-child #" . $this->_id . "_metabox').length;"));
	}

	### lock after_post_title

	function test_regular_login_and_post_type_and_lock_after_post_title()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'lock' => 'after_post_title'
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertGreaterThanOrEqual(1, $this->getEval("this.browserbot.getUserWindow().jQuery('#post-body-content #wpalchemy-content-apt:nth-child(2) #" . $this->_id . "_metabox').length;"));
	}
}

?>