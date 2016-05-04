<?php
        $mysql_hostname = 'localhost';

        $mysql_username = 'root';

        $mysql_password = 'mydb';

        $mysql_dbname = 'ssc_project';


        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
