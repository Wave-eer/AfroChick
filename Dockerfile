FROM php:8.3-apache

RUN a2enmod rewrite \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf \
    && echo 'DirectoryIndex index.php index.html' >> /etc/apache2/conf-available/docker-php.conf \
    && a2enconf docker-php \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql

COPY docker/entrypoint.sh /usr/local/bin/afrochick-entrypoint.sh
RUN chmod +x /usr/local/bin/afrochick-entrypoint.sh

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/afrochick-entrypoint.sh"]
