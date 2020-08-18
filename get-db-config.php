#!/usr/bin/php
<?php
    include("nextcloud/config/config.php");
        
    switch ($argv[1]) {
        case "dbuser":
            echo $CONFIG['dbuser'];
            break;
        case "dbpassword":
            echo $CONFIG['dbpassword'];
            break;
    }
?>
