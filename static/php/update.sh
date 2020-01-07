#!/bin/sh

cd /var/www/html && git clean -df && git checkout -- . && git pull origin master && chown -R www-data.www-data /var/www/html
