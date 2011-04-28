:: start the selenium-rc server
:: selenium-rc server will not start twice, running this command multiple times is ok
start java -jar C:\bin\selenium\selenium-server-standalone-2.0b3.jar

:: wait for 10 seconds
ping 127.0.0.1 -n 3 -w 1000> nul

:: delete old log files
DEL log.xml
DEL log.txt

:: start phpunit tests
phpunit --configuration _all_testsuites.xml --log-junit log.xml --verbose >> log.txt