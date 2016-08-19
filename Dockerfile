FROM php:5.6.24-apache

RUN docker-php-ext-install sockets

COPY src/ /var/www/html/
EXPOSE 80
CMD ["apache2-foreground"]
