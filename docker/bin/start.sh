#!/bin/bash

# Prepare App Source Code
cd /var
git clone "https://x-access-token:$GITHUB_TOKEN@github.com/tucanotours/wda2021.git"

rsync -av /var/wda2021/* /var/www/html --exclude .git --exclude workshop.sql --exclude README.md --exclude .gitignore --exclude Dockerfile --exclude docker
rm -rf /var/wda2021
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html
rm /var/www/html/index.nginx-debian.html

# Credentials
sed -i "s/DB_HOST/$DB_HOST/g" assets/inc/configuracion.php
sed -i "s/DB_NAME/$DB_NAME/g" assets/inc/configuracion.php
sed -i "s/DB_USER/$DB_USER/g" assets/inc/configuracion.php
sed -i "s/DB_PASS/$DB_PASS/g" assets/inc/configuracion.php

sed -i "s/SMTP_HOST/$SMTP_HOST/g" assets/inc/configuracion.php
sed -i "s/SMTP_USER/$SMTP_USER/g" assets/inc/configuracion.php
sed -i "s/SMTP_PASS/$SMTP_PASS/g" assets/inc/configuracion.php
sed -i "s/SMTP_PORT/$SMTP_PORT/g" assets/inc/configuracion.php

# Starts php process in background
php-fpm7.4

# Starts nginx process in background
nginx -g "daemon off;"

