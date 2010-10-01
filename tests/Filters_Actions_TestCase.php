<?php

require_once 'Base_TestCase.php';

class WPAlchemy_Filters_Actions_TestCase extends WPAlchemy_Base_TestCase
{
	public $_id = '_custom_meta_filters_actions_test';

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

		$this->_use_config_file('Filters_Actions_Setup');
	}

	function _mb_is_present()
	{
		return (int)$this->getEval("this.browserbot.getUserWindow().jQuery('#" . $this->_id . "_metabox').length;") ? TRUE : FALSE ;
	}

	function _mb_has_content()
	{
		$text = $this->getEval("this.browserbot.getUserWindow().jQuery('#" . $this->_id . "_metabox .inside label:eq(0)').text();");

		if ('Name' === $text) return TRUE;

		return FALSE;
	}

	function _editor_is_hidden()
	{
		return (int)$this->getEval("this.browserbot.getUserWindow().jQuery('#postdiv, #postdivrich').filter(':hidden').length;") ? TRUE : FALSE ;
	}

	function _mb_cleanup()
	{
		$this->_use_config($this->_config);

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->type($this->_id . '[name]', '');

		$this->type($this->_id . '[description]', '');

		$this->click("publish");

		$this->waitForPageToLoad('30000');

		$this->assertEquals('', $this->getValue($this->_id . '[name]'));

		$this->assertEquals('', $this->getValue($this->_id . '[description]'));
	}

	function test_regular_login_and_post_type_and_init_action()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'init_action' => 'my_init_action',
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertTrue($this->_mb_is_present());

		$this->assertTrue($this->isTextPresent('glob:' . $this->verification_str));
	}

	function test_regular_login_and_post_type_and_output_filter_false()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'output_filter' => 'my_output_filter_false',
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertFalse($this->_mb_is_present());
	}

	function test_regular_login_and_post_type_and_output_filter_true()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'output_filter' => 'my_output_filter_true',
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertTrue($this->_mb_is_present());
	}

	function test_regular_login_and_post_type_and_output_filter_post_id()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'output_filter' => 'my_output_filter_post_id',
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertTrue($this->_mb_is_present());

		$this->assertTrue($this->isTextPresent('glob:' . $this->verification_str . '-1'));
	}

	function test_regular_login_and_post_type_and_save_filter()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'save_filter' => 'my_save_filter',
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertTrue($this->_mb_is_present());

		$this->type($this->_id . '[name]', 'test title');

		$this->click("publish");

		$this->waitForPageToLoad('30000');

		$this->assertEquals("test title", $this->getValue($this->_id . '[name]'));

		$this->assertEquals("post_id = 1", $this->getValue($this->_id . '[description]'));

		$this->_mb_cleanup();
	}

	function test_regular_login_and_post_type_and_save_action()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'save_filter' => 'my_save_action',
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertTrue($this->_mb_is_present());

		$this->type($this->_id . '[name]', 'test title');

		$this->type($this->_id . '[description]', 'test desc');

		$this->click("publish");

		$this->waitForPageToLoad('30000');

		$this->assertTrue($this->isTextPresent('glob:b66210be5884ed4ad566c77ee0fd0941'));
	}

	function test_regular_login_and_post_type_and_head_filter()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'head_filter' => 'my_head_filter',
			'hide_editor' => TRUE,
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertTrue($this->_mb_is_present());

		$this->assertTrue($this->_editor_is_hidden());
	}

	function test_regular_login_and_post_type_and_head_filter_block()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'head_filter' => 'my_head_filter_block',
			'hide_editor' => TRUE,
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertTrue($this->_mb_is_present());

		$this->assertFalse($this->_editor_is_hidden());
	}

	function test_regular_login_and_post_type_and_head_action()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'head_action' => 'my_head_action',
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertEquals('head_action', $this->getEval("this.browserbot.getUserWindow().wpalchemy_head_action"));

		$this->assertTrue($this->_mb_is_present());
	}

	function _mb_has_title()
	{
		return (int)$this->getEval("this.browserbot.getUserWindow().jQuery('.hndle, .handlediv','#" . $this->_id . "_metabox').length;") ? TRUE : FALSE ;
	}

	function test_regular_login_and_post_type_and_foot_filter()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'foot_filter' => 'my_foot_filter',
			'hide_title' => TRUE,
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertTrue($this->_mb_is_present());

		$this->assertFalse($this->_mb_has_title());
	}

	function test_regular_login_and_post_type_and_foot_filter_block()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'foot_filter' => 'my_foot_filter_block',
			'hide_title' => TRUE,
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertTrue($this->_mb_is_present());

		$this->assertTrue($this->_mb_has_title());
	}

	function test_regular_login_and_post_type_and_foot_action()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'foot_action' => 'my_foot_action',
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertEquals('foot_action', $this->getEval("this.browserbot.getUserWindow().wpalchemy_foot_action"));

		sleep(2);

		$this->assertTrue($this->_mb_is_present());
	}
}

?>