:: start the selenium-rc server
:: selenium-rc server will not start twice, running this command multiple times is ok
start java -jar C:\bin\selenium-server-1.0.3\selenium-server.jar

:: wait for 10 seconds
ping 127.0.0.1 -n 3 -w 1000> nul

:: start phpunit tests
cmd /K phpunit --configuration _current_testsuites.xml --verbose