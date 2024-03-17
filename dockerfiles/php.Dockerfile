FROM php:8.2-fpm-alpine

WORKDIR /var/www/coursesAPI

RUN docker-php-ext-install pdo pdo_mysql