# Use an official PHP runtime as a parent image
FROM php:8.2-fpm

# Set environment variables
ENV TZ=Australia/Brisbane

# Set maintainer information
LABEL maintainer="JaeWon Yun jaewon.yun@uqconnect.edu.au"

# Install necessary packages and php packages
RUN apt-get update \
        && apt-get install -y \
        && docker-php-ext-install mysqli \
        && pecl install redis \
        && docker-php-ext-enable redis \
        && apt-get update && apt-get install -y libicu-dev \
        && docker-php-ext-configure intl \
        && docker-php-ext-install intl \
        && apt-get update \
        && docker-php-ext-install pdo_mysql


WORKDIR /var/www/htdocs

RUN chmod -R 777 /var/www/htdocs

EXPOSE 9000

CMD ["php-fpm"]
