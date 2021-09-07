FROM php:8.0.5-fpm
MAINTAINER Tiago Gomes tiagosilvagomes85@gmail.com
WORKDIR /code

# Install and enable XDebug ( not compatible with current version )
# RUN pecl install xdebug-2.6.0 \
#    && docker-php-ext-enable xdebug

# Install pdo mysql driver
RUN docker-php-ext-install pdo pdo_mysql

ADD config/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# mcrypt is deprecated in favor of openssl
ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions gd mcrypt

RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

# Install supervisor
RUN apt-get update \
 && apt-get install -y --no-install-recommends \
    supervisor

ADD config/supervisord.conf /etc/supervisor
ADD worker/* /etc/supervisor/conf.d

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]