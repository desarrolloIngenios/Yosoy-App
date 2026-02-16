#!/bin/sh

cd /var/www

# php artisan migrate:fresh --seed
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache

/usr/bin/supervisord -c /etc/supervisord.conf
