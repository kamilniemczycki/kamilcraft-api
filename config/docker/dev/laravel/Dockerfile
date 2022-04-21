FROM php:8.0-fpm

ARG USER_UID
ARG USER_NAME
ENV COMPOSER_HOME=/home/$USER_NAME/.composer

RUN useradd -G www-data,root -u $USER_UID -d /home/$USER_NAME $USER_NAME
RUN mkdir -p /home/$USER_NAME/.composer && \
    chown $USER_NAME:$USER_NAME -R /home/$USER_NAME
RUN set -eux \
    && apt-get update \
    && apt-get upgrade -y \
    && apt-get install git zip unzip dos2unix -y
RUN curl -sS https://getcomposer.org/installer \
    | php -- --version=2.3.5 --install-dir=/usr/local/bin --filename=composer
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN set -eux \
    && apt-get install nodejs -y
RUN npm install --global npm@latest

COPY ./install.sh /usr/local/bin/install
RUN dos2unix /usr/local/bin/install \
    && chmod +x /usr/local/bin/install

USER $USER_UID

EXPOSE 9000
