FROM nginx:latest

#COPY fastcgi.conf /etc/nginx/

RUN apt-get update && apt-get upgrade -y \
    && apt-get install -y --fix-missing --fix-broken \
    && apt-get install -y nginx \
    && echo "include /etc/nginx/fastcgi_params;" > /etc/nginx/fastcgi.conf

COPY fastcgi-php.conf /etc/nginx/snippets/
COPY nginx.ini /etc/nginx/conf.d/default.conf
COPY www.conf /usr/local/etc/php-fpm.d/www.conf
CMD ["nginx", "-g", "daemon off;"]