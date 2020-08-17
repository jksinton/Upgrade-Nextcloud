#!/usr/bin/php
<?php
        include("nextcloud/version.php");
        $updaterUrl = 'https://updates.nextcloud.com/updater_server/';
        $version = $OC_Version;
        $version['installed'] = '';
        $version['updated'] = '';
        $version['updatechannel'] = $OC_Channel;
        $version['edition'] = '';
        $version['build'] = '';
        $version['php_major'] = PHP_MAJOR_VERSION;
        $version['php_minor'] = PHP_MINOR_VERSION;
        $version['php_release'] = PHP_RELEASE_VERSION;
        $versionString = implode('x', $version);
        //fetch xml data from updater
        $url = $updaterUrl . '?version=' . $versionString;
        echo $url;
        # Example update url:
        # https://updates.nextcloud.com/updater_server/?version=18x0x1x3xxxstablexxx7x4x3
?>
