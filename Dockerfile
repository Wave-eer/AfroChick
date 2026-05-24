FROM php:8.3-apache


RUN a2enmod rewrite \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf \
    && echo 'DirectoryIndex index.php index.html' >> /etc/apache2/conf-available/docker-php.conf \
    && a2enconf docker-php \
    && docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite


COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
