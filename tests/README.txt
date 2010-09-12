These unit tests require selenium-rc server and phpunit.

Install selenium-rc: (requires java )
http://www.java.com/en/download/index.jsp
http://seleniumhq.org/download/

Note: selenium-rc is really easy to install, it's as easy as unzipping into a
directory and running the following from a command line:

java -jar C:\bin\selenium-server-1.0.3\selenium-server.jar

Install PHPUnit: (best to use PEAR to install)
http://www.phpunit.de/manual/3.5/en/installation.html

-------------------------------------------------------------------------------

1) You will have to make selenium-rc path edits to the following files:

   tests/_all_testsuites.bat
   tests/_current_testsuites.bat

2) You will need to edit the $_url variable in Base_TestCase.php

3) You will need to place the following in your functions.php file:

   include_once TEMPLATEPATH . '/tests/fixtures/functions.php';
