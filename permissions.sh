#!/bin/bash
nc_path='/var/www/nextcloud'
data_path='/somewhere/data'  # if located in nextcloud /var/www/nextcloud/data
htuser='www-data'
find ${nc_path}/ -type f -print0 | xargs -0 chmod 0640
find ${nc_path}/ -type d -print0 | xargs -0 chmod 0750
chown -R root:${htuser} ${nc_path}/
chown -R ${htuser}:${htuser} ${nc_path}/apps/
chown -R ${htuser}:${htuser} ${nc_path}/config/
chown -R ${htuser}:${htuser} ${data_path}
chown -R ${htuser}:${htuser} ${nc_path}/themes/
chown root:${htuser} ${nc_path}/.htaccess
chown root:${htuser} ${data_path}/.htaccess
chmod 0644 ${nc_path}/.htaccess
chmod 0644 ${data_path}/.htaccess
