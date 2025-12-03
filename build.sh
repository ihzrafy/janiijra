#!/bin/bash

php artisan config:cache
php artisan route:cache
php artisan view:cache

chmod -R 755 storage bootstrap/cache
