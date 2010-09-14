<?php

require_once 'Base_TestCase.php';

class WPAlchemy_DisplayOption_View_TestCase extends WPAlchemy_Base_TestCase
{
	public $_id = '_custom_meta_view_test';
	
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

	### view opended
	
	function _do_close_metabox()
	{
		$this->click('css=#' . $this->_id . '_metabox > h3');

		sleep(2);

		// make sure the meta box is toggled in the right state
		if ('0' == $this->getEval("this.browserbot.getUserWindow().jQuery('#" . $this->_id . "_metabox.closed').length;"))
		{
			$this->click('css=#' . $this->_id . '_metabox > h3');

			sleep(2);
		}

		$this->assertEquals('1', $this->getEval("this.browserbot.getUserWindow().jQuery('#" . $this->_id . "_metabox.closed').length;"));
	}

	function test_regular_login_and_post_type_and_view_opened()
	{
		$this->_use_regular_login();

		$this->_use_post_type();

		$this->_do_close_metabox();

		$this->_use_config(array_merge($this->_config, array
		(
			'view' => 'opened'
		)));

		$this->_use_post_type();

		$this->assertEquals('0', $this->getEval("this.browserbot.getUserWindow().jQuery('#" . $this->_id . "_metabox.closed').length;"));

		// now close, confirm it closes
		
		$this->click('css=#' . $this->_id . '_metabox > h3');

		sleep(2);

		$this->assertEquals('1', $this->getEval("this.browserbot.getUserWindow().jQuery('#" . $this->_id . "_metabox.closed').length;"));
	}

	### view always_opened

	function test_regular_login_and_post_type_and_view_always_opened()
	{
		$this->_use_regular_login();

		$this->_use_post_type();

		$this->_do_close_metabox();

		$this->_use_config(array_merge($this->_config, array
		(
			'view' => 'always_opened'
		)));

		$this->_use_post_type();

		sleep(2);

		$this->assertEquals('0', $this->getEval("this.browserbot.getUserWindow().jQuery('#" . $this->_id . "_metabox.closed').length;"));

		// now close, confirm it does NOT close
		
		$this->click('css=#' . $this->_id . '_metabox > h3');

		sleep(2);

		$this->assertEquals('0', $this->getEval("this.browserbot.getUserWindow().jQuery('#" . $this->_id . "_metabox.closed').length;"));
	}

	### view closed
	
	function _do_open_metabox()
	{
		$this->click('css=#' . $this->_id . '_metabox > h3');

		sleep(2);

		// make sure the meta box is toggled in the right state
		if ('1' == $this->getEval("this.browserbot.getUserWindow().jQuery('#" . $this->_id . "_metabox.closed').length;"))
		{
			$this->click('css=#' . $this->_id . '_metabox > h3');

			sleep(2);
		}

		$this->assertEquals('0', $this->getEval("this.browserbot.getUserWindow().jQuery('#" . $this->_id . "_metabox.closed').length;"));
	}

	function test_regular_login_and_post_type_and_view_closed()
	{
		$this->_use_regular_login();

		$this->_use_post_type();

		$this->_do_open_metabox();

		$this->_use_config(array_merge($this->_config, array
		(
			'view' => 'closed'
		)));

		$this->_use_post_type();

		$this->assertEquals('1', $this->getEval("this.browserbot.getUserWindow().jQuery('#" . $this->_id . "_metabox.closed').length;"));

		// now open, confirm it opens
		
		$this->click('css=#' . $this->_id . '_metabox > h3');

		sleep(2);

		$this->assertEquals('0', $this->getEval("this.browserbot.getUserWindow().jQuery('#" . $this->_id . "_metabox.closed').length;"));
	}
}

?>