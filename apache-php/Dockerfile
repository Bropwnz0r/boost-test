FROM php:7.2-apache
RUN docker-php-ext-install pdo
# Enable apache rewrite
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

#Install spatialite and create symlink for libproj.so.0
RUN apt-get update && apt-get -y install gdal-bin libsqlite3-dev libyaml-dev zip unzip libzip4
RUN ln -s /usr/lib/x86_64-linux-gnu/libproj.so.12 /usr/lib/x86_64-linux-gnu/libproj.so.0

#Install gd library for images
RUN apt-get install libpng-dev libfreetype6-dev libjpeg62-turbo-dev -qy \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \

#yaml extensions
RUN yes | pecl install yaml-2.0.0 && echo "extension=yaml.so" > /usr/local/etc/php/conf.d/ext-yaml.ini

#Copy php ini
COPY php.ini /usr/local/etc/php/php.ini
RUN a2enmod rewrite
RUN service apache2 restart

COPY --from=composer /usr/bin/composer /usr/bin/composer
