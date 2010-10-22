<?php

require_once 'Base_TestCase.php';

class WPAlchemy_Mode_Switching_TestCase extends WPAlchemy_Base_TestCase
{
	public $_id = '_custom_meta_mode_switching_test';
	
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

	### 

	// regular login
	// post type
	// saving
	// start/end in array mode
	// switch modes

	function test_1()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'mode' => 'array', // WPALCHEMY_MODE_ARRAY
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertTrue($this->_mb_is_present());

		// save data

		$this->type($this->_id . '[name]', 'test title');

		$this->type($this->_id . '[description]', 'test desc');

		$this->click("publish");

		$this->waitForPageToLoad('30000');

		// check

		$this->_use_post_type();

		$this->assertEquals("test title", $this->getValue($this->_id . '[name]'));

		$this->assertEquals("test desc", $this->getValue($this->_id . '[description]'));

		// switch mode

		$this->_use_config(array_merge($this->_config, array
		(
			'mode' => 'extract', // WPALCHEMY_MODE_EXTRACT
		)));

		// check

		$this->_use_post_type();

		$this->assertEquals("test title", $this->getValue($this->_id . '[name]'));

		$this->assertEquals("test desc", $this->getValue($this->_id . '[description]'));

		// switch mode

		$this->_use_config(array_merge($this->_config, array
		(
			'mode' => 'array', // WPALCHEMY_MODE_ARRAY
		)));

		// check

		$this->_use_post_type();

		$this->assertEquals("test title", $this->getValue($this->_id . '[name]'));

		$this->assertEquals("test desc", $this->getValue($this->_id . '[description]'));

		// cleanup data

		$this->type($this->_id . '[name]', '');

		$this->type($this->_id . '[description]', '');

		$this->click("publish");

		$this->waitForPageToLoad('30000');

		// check

		$this->_use_post_type();

		$this->assertEquals('', $this->getValue($this->_id . '[name]'));

		$this->assertEquals('', $this->getValue($this->_id . '[description]'));
	}

	// regular login
	// post type
	// saving
	// start/end in extract mode
	// switch modes

	function test_2()
	{
		$this->_use_config(array_merge($this->_config, array
		(
			'mode' => 'extract', // WPALCHEMY_MODE_EXTRACT
		)));

		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertTrue($this->_mb_is_present());

		// save data

		$this->type($this->_id . '[name]', 'test title');

		$this->type($this->_id . '[description]', 'test desc');

		$this->click("publish");

		$this->waitForPageToLoad('30000');

		// check

		$this->_use_post_type();

		$this->assertEquals("test title", $this->getValue($this->_id . '[name]'));

		$this->assertEquals("test desc", $this->getValue($this->_id . '[description]'));

		// switch mode

		$this->_use_config(array_merge($this->_config, array
		(
			'mode' => 'array', // WPALCHEMY_MODE_ARRAY
		)));

		// check

		$this->_use_post_type();

		$this->assertEquals("test title", $this->getValue($this->_id . '[name]'));

		$this->assertEquals("test desc", $this->getValue($this->_id . '[description]'));

		// switch mode

		$this->_use_config(array_merge($this->_config, array
		(
			'mode' => 'extract', // WPALCHEMY_MODE_EXTRACT
		)));

		// check

		$this->_use_post_type();

		$this->assertEquals("test title", $this->getValue($this->_id . '[name]'));

		$this->assertEquals("test desc", $this->getValue($this->_id . '[description]'));

		// cleanup data

		$this->type($this->_id . '[name]', '');

		$this->type($this->_id . '[description]', '');

		$this->click("publish");

		$this->waitForPageToLoad('30000');

		// check

		$this->_use_post_type();

		$this->assertEquals('', $this->getValue($this->_id . '[name]'));

		$this->assertEquals('', $this->getValue($this->_id . '[description]'));
	}
}

?>