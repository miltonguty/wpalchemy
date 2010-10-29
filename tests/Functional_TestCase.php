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

	### is meta box displayed (existing post/page)

	//1
	function test_regular_login_and_post_type()
	{
		$this->_use_regular_login();

		$this->_use_post_type();

		$this->assertTrue($this->_mb_is_present());

		$this->assertTrue($this->_mb_has_content());
	}
	
	//2
	function test_regular_login_and_page_type()
	{
		$this->_use_regular_login();

		$this->_use_page_type();

		$this->assertTrue($this->_mb_is_present());

		$this->assertTrue($this->_mb_has_content());
	}

	### is meta box displayed (new post/page)

	//3
	function test_regular_login_and_post_type_new()
	{
		$this->_use_regular_login();

		$this->_use_post_type_new();

		$this->assertTrue($this->_mb_is_present());

		$this->assertTrue($this->_mb_has_content());
	}

	//4
	function test_regular_login_and_page_type_new()
	{
		$this->_use_regular_login();

		$this->_use_page_type_new();

		$this->assertTrue($this->_mb_is_present());

		$this->assertTrue($this->_mb_has_content());
	}

	//5
	function test_regular_login_and_post_type_and_publish()
	{
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

	//6
	function test_regular_login_and_page_type_and_publish()
	{
		$this->_use_regular_login();

		$this->_use_page_type();

		$this->assertTrue($this->_mb_is_present());

		// save data

		$this->type($this->_id . '[name]', 'test title');

		$this->type($this->_id . '[description]', 'test desc');

		$this->click("publish");

		$this->waitForPageToLoad('30000');

		// check

		$this->_use_page_type();

		$this->assertEquals("test title", $this->getValue($this->_id . '[name]'));

		$this->assertEquals("test desc", $this->getValue($this->_id . '[description]'));

		// cleanup data

		$this->type($this->_id . '[name]', '');

		$this->type($this->_id . '[description]', '');

		$this->click("publish");

		$this->waitForPageToLoad('30000');

		// check

		$this->_use_page_type();

		$this->assertEquals('', $this->getValue($this->_id . '[name]'));

		$this->assertEquals('', $this->getValue($this->_id . '[description]'));
	}

	/**
	 * This checks for an issue where data would not get saved on a second
	 * (or future) attempt.
	 *
	 * regular login, post type, publishing data twice
	 */
	function test_7()
	{
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

		// cleanup data

		$this->type($this->_id . '[name]', '');

		$this->type($this->_id . '[description]', '');

		$this->click("publish");

		$this->waitForPageToLoad('30000');

		// check

		$this->_use_post_type();

		$this->assertEquals('', $this->getValue($this->_id . '[name]'));

		$this->assertEquals('', $this->getValue($this->_id . '[description]'));

		// save data

		$this->type($this->_id . '[name]', 'test title');

		$this->type($this->_id . '[description]', 'test desc');

		$this->click("publish");

		$this->waitForPageToLoad('30000');

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