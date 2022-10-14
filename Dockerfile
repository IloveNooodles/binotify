FROM php:8.0-apache

COPY ./index.php /var/www/html

COPY src/ /var/www/html

EXPOSE 80