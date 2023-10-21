# Use an official PHP runtime as a parent image
FROM php:8.2-fpm

# Set environment variables
ENV TZ=Australia/Brisbane

# Set maintainer information
LABEL maintainer="JaeWon Yun jaewon.yun@uqconnect.edu.au"

# Install necessary packages and php packages
RUN apt-get update \
        && apt-get install -y libicu-dev libxml2-dev \
        && docker-php-ext-install mysqli intl dom \
        && pecl install redis \
        && docker-php-ext-enable redis \
        && apt-get update && apt-get install -y libicu-dev \
        && docker-php-ext-configure intl \
        && docker-php-ext-install intl \
        && apt-get update \
        && docker-php-ext-install pdo_mysql

# Copy Composer installer and run it
COPY installer /tmp/composer-setup.php
RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/htdocs

# Copy composer.json and composer.lock files to the WORKDIR
COPY composer.json composer.lock ./

# Install project dependencies
RUN composer install --no-scripts --no-autoloader
RUN composer dump-autoload --optimize && composer run-script post-install-cmd

RUN chmod -R 777 /var/www/htdocs

EXPOSE 9000

CMD ["php-fpm"]
