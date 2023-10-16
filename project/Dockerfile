FROM ubuntu:20.04

# Set environment variables
ENV PHPVER=8.2
ENV TZ=Australia/Brisbane

# Set maintainer information
LABEL maintainer="JaeWon Yun jaewon.yun@uqconnect.edu.au"

# Install necessary packages
RUN apt-get update && apt-get install -y software-properties-common --no-install-recommends \
    && add-apt-repository ppa:ondrej/php && apt-get update \
    && apt-get install -y nginx apt-utils php${PHPVER}-fpm curl git

# Copy Nginx configuration file
COPY /src/nginx.ini etc/nginx/sites-available/default

# Copy testing html and php pages
COPY /src/index.html /var/www/html/
COPY /src/index.php /var/www/html/

# Expose port 80 for Nginx
EXPOSE 80

# Set working directory to root folder of website
WORKDIR /var/www/html

# Start Nginx and PHP-FPM with entrypoint command
ENTRYPOINT service php${PHPVER}-fpm start && nginx -g "daemon off;"
