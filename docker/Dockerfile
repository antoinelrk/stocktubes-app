FROM alpine:3.16
LABEL maintainer="AntoineLRK <contact@antoinelrk.com>"
LABEL version="0.1"

WORKDIR /var/www/stocktubes

COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/supervisord.conf /etc/supervisord.conf
COPY ./docker/nginx/vhost.conf /etc/nginx/sites-available/default.conf

RUN apk add --update --no-cache \
tzdata \
nginx \
nano \
nodejs \
npm \
neovim \
supervisor \
php81 \
php81-fpm \
php81-pdo \
php81-iconv \
php81-pdo_mysql \
php81-sodium \
php81-mbstring \
php81-xml \
php81-openssl \
php81-phar \
php81-zip \
php81-curl \
php81-dom \
php81-session \
php81-bcmath \
php81-pecl-redis \
php81-ctype \
php81-tokenizer \
php81-session \
php81-fileinfo \
php81-xmlwriter

RUN php81 -r "copy('http://getcomposer.org/installer', 'composer-setup.php');" && \
php81 composer-setup.php --install-dir=/usr/bin --filename=composer && \
php81 -r "unlink('composer-setup.php');" && \
ln -s /etc/php81/php.ini /etc/php81/conf.d/php.ini

RUN mkdir -p /etc/nginx && \
mkdir -p /etc/nginx/sites-available && \
mkdir -p /etc/nginx/sites-enabled && \
mkdir -p /run/nginx && \
ln -s /etc/nginx/sites-available/default.conf /etc/nginx/sites-enabled/default.conf && \
mkdir -p /var/log/supervisor

RUN sed -i -e "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g" \
-e "s/variables_order = \"GPCS\"/variables_order = \"EGPCS\"/g" \
/etc/php81/php.ini && \
sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" \
-e "s/;catch_workers_output\s*=\s*yes/catch_workers_output = yes/g" \
-e "s/user = nobody/user = nginx/g" \
-e "s/group = nobody/group = nginx/g" \
-e "s/;listen.mode = 0660/listen.mode = 0666/g" \
-e "s/;listen.owner = nobody/listen.owner = nginx/g" \
-e "s/;listen.group = nobody/listen.group = nginx/g" \
-e "s/listen = 127.0.0.1:9000/listen = \/var\/run\/php-fpm.sock/g" \
-e "s/^;clear_env = no$/clear_env = no/" \
/etc/php81/php-fpm.d/www.conf

RUN ln -s /usr/bin/php81 /usr/bin/php

COPY ./composer.json ./composer.json

RUN composer install

VOLUME [ "/var/log/nginx" ]

COPY . .

RUN chown -R nginx:nginx /var/www/stocktubes/

ENV TZ Europe/Paris
EXPOSE 443 80
CMD [ "/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf" ]