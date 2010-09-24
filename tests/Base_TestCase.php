<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class WPAlchemy_Base_TestCase extends PHPUnit_Extensions_SeleniumTestCase
{
	public $_url = 'http://wpalchemy.dev/testing/';

	public $_setup_file = NULL;

	public $_path;

	function setUp()
	{
		$this->_path = str_replace('\\','/',dirname(__FILE__));
		
		$this->_use_config_file($this->_setup_file);

		$this->setBrowserUrl($this->_url);
	}

	function _use_config($arr)
	{
		$contents = serialize($arr);
		
		$p = str_replace('\\','/',dirname(__FILE__));
		$f = $p . '/fixtures/config_serialized.txt';

		unlink($f);

		$this->assertFileNotExists($f);

		file_put_contents($f, $contents);

		$this->assertFileExists($f);
	}

	function _use_config_file($f = NULL)
	{
		if (is_null($f))
		{
			$f = get_class($this);
			$f = str_replace(array('WPAlchemy_','_TestCase'), array('', '_Setup'), $f);
		}

		$f = preg_replace('/\.php$/', '', $f) . '.php';

		$p = str_replace('\\','/',dirname(__FILE__));

		$f1 = $p . '/fixtures/setup.php';
		$f2 = $p . '/fixtures/' . $f;

		if (file_exists($f2))
		{
			file_put_contents($f1, file_get_contents($f2));

			$this->assertFileEquals($f1, $f2);
		}
	}

	function _use_regular_login()
	{
		$this->_use_visual_editor_login();
	}

	function _use_visual_editor_login()
	{
		$this->_login('tester-one', 'Abcd1234!');
	}

	function _use_html_editor_login()
	{
		$this->_login('tester-two', 'Abcd1234!');
	}

	function _login($u, $p)
	{
		$this->open($this->_url . "wp-login.php?loggedout=true");
		$this->type("user_login", $u);
		$this->type("user_pass", $p);
		$this->click("wp-submit");
		$this->waitForPageToLoad("30000");

		$this->assertTrue($this->isElementPresent("adminmenu"));
	}

	function _use_post_type()
	{
		$this->click("//li[@id='menu-posts']/div[1]/a");

		$this->waitForPageToLoad("30000");

		$this->click("link=Hello world!");

		$this->waitForPageToLoad("30000");

		$this->assertElementPresent("//input[@type='text'][@id='title'][@value='Hello world!']");
	}

	function _use_post_type_new()
	{
		$this->click("//li[@id='menu-posts']/div[1]/a");

		$this->waitForPageToLoad("30000");

		$this->click("css=#wpbody-content .wrap h2 a.button");

		$this->waitForPageToLoad("30000");

		 $this->assertEquals("Add New Post", $this->getText("css=#wpbody-content .wrap h2"));
	}

	function _use_page_type()
	{
		$this->click("//li[@id='menu-pages']/div[1]/a");

		$this->waitForPageToLoad("30000");

		$this->click("link=About");

		$this->waitForPageToLoad("30000");

		$this->assertElementPresent("//input[@type='text'][@id='title'][@value='About']");
	}

	function _use_page_type_new()
	{
		$this->click("//li[@id='menu-pages']/div[1]/a");

		$this->waitForPageToLoad("30000");

		$this->click("css=#wpbody-content .wrap h2 a.button");

		$this->waitForPageToLoad("30000");

		$this->assertEquals("Add New Page", $this->getText("css=#wpbody-content .wrap h2"));
	}
}