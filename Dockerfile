FROM php:8.0-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get -y update
RUN apt-get -y upgrade
RUN apt-get install -y --no-install-recommends mediainfo
RUN useradd binotify

WORKDIR /var/www/html

COPY ./index.php .
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf
COPY ./.htaccess .
COPY ./php.ini /usr/local/etc/php/conf.d/init.ini

USER binotify

EXPOSE 80