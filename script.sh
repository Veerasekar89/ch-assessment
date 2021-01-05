#!/bin/sh
cd /app && composer install 
cd /app && php spark migrate