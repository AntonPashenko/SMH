FROM nginx:latest

COPY ./docker/nginx/conf.d/local.conf /etc/nginx/conf.d/default.conf

COPY ./public /var/www/html/public
