# Use an official PHP runtime as a parent image
FROM php:8.2-fpm

# Set environment variables
ENV TZ=Australia/Brisbane

# Set maintainer information
LABEL maintainer="JaeWon Yun jaewon.yun@uqconnect.edu.au"

COPY php.ini /etc/php/8.2/fpm/php.ini

RUN apt-get update \
        && apt-get install -y zip unzip git \
        && docker-php-ext-install mysqli \
        && pecl install redis \
        && docker-php-ext-enable redis \
        && apt-get update && apt-get install -y libicu-dev \
        && docker-php-ext-configure intl \
        && docker-php-ext-install intl \
        && apt-get update \
        && docker-php-ext-install pdo_mysql


WORKDIR /var/www/htdocs
COPY . /var/www/htdocs
RUN composer update \
        && composer install --no-scripts --no-autoloader

COPY composer-setup.php ./
COPY composer.json composer.lock ./
RUN chmod -R 777 /var/www/htdocs
# Install Composer
RUN php composer-setup.php \
        && php -r "unlink('composer-setup.php');" \
        && mv composer.phar /usr/local/bin/composer

# RUN composer update \
#         && composer install --no-scripts --no-autoloader
RUN composer dump-autoload \
        && composer require codeigniter4/framework \
        && composer require psr/log \
        && composer create-project codeigniter4/appstarter ./project
# && composer run-script post-install-cmd --optimize 

EXPOSE 9000
CMD ["php-fpm"]