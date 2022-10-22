FROM php:8.0-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get -y update
RUN apt-get -y upgrade
RUN apt-get install -y --no-install-recommends mediainfo

WORKDIR /var/www/html

COPY ./index.php .
COPY ./.htaccess .

EXPOSE 80