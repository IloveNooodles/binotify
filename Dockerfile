FROM php:8.0-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get -y update
RUN apt-get -y upgrade
RUN apt-get install -y --no-install-recommends mediainfo

WORKDIR /var/www/html

RUN mkdir upload
RUN chmod 777 -R .
RUN chmod 777 -R /tmp

COPY ./index.php .
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf
COPY ./.htaccess .
COPY ./php.ini /usr/local/etc/php/conf.d/init.ini

EXPOSE 80