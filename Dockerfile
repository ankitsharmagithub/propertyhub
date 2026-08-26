FROM richarvey/nginx-php-fpm:1.11.0

COPY . /var/www/html

RUN apk update && apk add --no-cache curl nodejs npm

RUN composer install --no-dev --working-dir=/var/www/html

RUN php artisan config:cache
RUN php artisan route:cache

EXPOSE 8080
