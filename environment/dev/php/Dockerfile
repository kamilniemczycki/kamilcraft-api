FROM php:8.1-fpm-alpine

ARG XDEBUG_VERSION=3.1.6
ARG INSTALL_XDEBUG=false

ARG COMPOSER_VERSION=2.4.4
ENV COMPOSER_HOME=/application/.composer
ENV COMPOSER_MEMORY_LIMIT=-1

RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    apk --no-cache add $PHPIZE_DEPS \
    && pecl install xdebug-${XDEBUG_VERSION} \
    && docker-php-ext-enable xdebug \
;fi

RUN apk update && apk upgrade \
    && apk add --no-cache pcre-dev $PHPIZE_DEPS \
    icu-dev \
    zip \
    libzip-dev \
    libpng-dev \
    && curl -sS https://getcomposer.org/installer | php -- --version="${COMPOSER_VERSION}" --install-dir=/usr/local/bin --filename=composer \
    && pecl install redis \
    && docker-php-ext-install \
    mysqli \
    pdo \
    pdo_mysql \
    zip \
    gd \
    bcmath \
    && docker-php-ext-configure \
    zip \
    && docker-php-ext-enable \
    redis
