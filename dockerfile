# Menggunakan PHP Sebagai base image
FROM php:7.4-apache

# Untuk menginstall depedensi mysqli pada php
RUN docker-php-ext-install mysqli

# Memasukkan semua file kedalam container
COPY . /var/www/html


EXPOSE 80

#Jalankan apache saat container dibuka
CMD ["apache2-foreground"]

