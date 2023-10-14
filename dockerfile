# Menggunakan PHP sebagai base image
FROM php:7.4-apache

# Instal ekstensi PHP yang diperlukan jika ada
RUN docker-php-ext-install mysqli

# Salin seluruh aplikasi ke dalam kontainer
COPY . /var/www/html

# Expose port 80
EXPOSE 80

# Jalankan Apache saat kontainer dimulai
CMD ["apache2-foreground"]
