FROM php:8.0-fpm

ARG USER_UID
ARG USER_NAME

RUN useradd -G www-data,root -u $USER_UID -d /home/$USER_NAME $USER_NAME
RUN mkdir -p /home/$USER_NAME/.composer && \
    chown -R $USER_NAME:$USER_NAME /home/$USER_NAME

USER $USER_UID

EXPOSE 9000
