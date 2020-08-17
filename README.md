# Upgrade Nextcloud
Steps, commands, and scripts for upgrading Nextcloud on Ubuntu

## Prerequesites:
* Ubuntu
* MYSQL
* Apache

## Set your variables:
```nc_path='/var/www/nextcloud'
nc_old="${nc_path}-old"
backup_root='/somewhere/backups'
htuser='www-data'
db_name='your-nextcloud-database-name'
date=`date +%F`
version=`grep VersionString ${nc_path}/version.php | awk -F\' '{print $2}'`
backup_path="${backup_root}/nc_${version}_${date}"
db_backup="${backup_root}/nc_${version}_${date}.sql"
```

## Enable maintenance mode:
```# put server in maintenance mode
cd ${nc_path}
sudo -u ${htuser} php occ maintenance:mode --on
```

## Verify the current version:
```# version
grep VersionString ${nc_path}/version.php | awk -F\' '{print $2}'
```

## Make backups:
```# backup nextcloud server files
mkdir -pv ${backup_path}
cp -prv ${nc_path}/* ${backup_path}
# backup nextcloud database
mysqldump -u root -p ${db_name} > ${db_backup}
gzip ${db_backup}
```

## Stop the web server:
```# stop web server
service apache2 stop
```
## Download the latest release to the www root where Nextcloud is installed:
```cd $nc_path; cd ..
wget `php -f get-update-url.php | xargs curl 2> /dev/null | grep url | awk -F "[<>]" '{print $3}'`
```

## Move the current installation:
```mv ${nc_path} ${nc_old}
```

## Unpack Nextcloud archive:
```unzip nextcloud-*.zip
```
## Restore the configuration file:
```cp -pv ${backup_path}/config/config.php ${nc_path}/config/.
```

## Set the permissions and owner:
```permissions.sh
```

## Restart the web server:
```service apache2 start
```

## Perform the upgrade:
```cd ${nc_path}
sudo -u ${htuser} php occ upgrade
```

## Disable maintenance mode:
```sudo -u ${htuser} php occ maintenance:mode --off
```
