FROM php:7.3-fpm-alpine
LABEL maintainer "aoaoaoaoaoaoaoi"

ARG TZ
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer

RUN set -eux && \
  apk add --update-cache --no-cache --virtual=.build-dependencies tzdata && \
  cp /usr/share/zoneinfo/${TZ} /etc/localtime && \
  apk del .build-dependencies && \
  docker-php-ext-install bcmath pdo_mysql && \
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer && \
  composer config -g repos.packagist composer https://packagist.jp && \
  composer global require hirak/prestissimo

RUN apk --no-cache update && \
  apk --no-cache upgrade && \
  apk --no-cache add \
  nodejs-npm

RUN apk add --no-cache libpng libpng-dev && \
  docker-php-ext-install gd && \
  apk del libpng-dev