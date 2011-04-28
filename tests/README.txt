Setting up your testing environment

-------------------------------------------------------------------------------

These unit tests require selenium-rc server and phpunit.

Install selenium-rc: (requires java )
http://www.java.com/en/download/index.jsp
http://seleniumhq.org/download/

Note: selenium-rc is really easy to install, it's as easy as unzipping into a
directory and running the following from a command line:

java -jar C:\bin\selenium-server-1.0.3\selenium-server.jar

PEAR setup

1. open up a dos prompt (Run as administrator)

2. cd c:\php

3. go-pear (install pear)

4. Install PHPUnit: (best to use PEAR to install) http://www.phpunit.de/manual/3.5/en/installation.html

Install WordPress (locally) 
http://wordpress.org/

-------------------------------------------------------------------------------

1) You need to create two users on the installation of WordPress that will be
   used for testing:

   user: tester-one
   pass: Abcd1234!
   perm: Administrator

   user: tester-two
   pass: Abcd1234!
   perm: Administrator
   note: this user should have the visual editor disabled: 
         Users > Edit > check "Disable the visual editor when writing"
   note: Fold (collapse) the admin menus

2) You will need to place the following at the end of your functions.php file:

   include_once TEMPLATEPATH . '/tests/fixtures/functions.php';

3) Add the following folders to your template folder:

   tests
   WPAlchemy

4) You will need to edit the $_url variable in Base_TestCase.php

5) You will have to make selenium-rc path edits to the following files:

   tests/_all_testsuites.bat
   tests/_current_testsuites.bat

-------------------------------------------------------------------------------

If you are attempting the above and have feedback, please let me know ...