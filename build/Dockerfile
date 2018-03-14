FROM php:7-fpm

RUN apt-get update \ 
&& docker-php-ext-install pdo pdo_mysql \
&& pecl install xdebug \
&& docker-php-ext-enable xdebug