FROM api_app:latest
MAINTAINER Tiago Gomes geone85@gmail.com
RUN curl --silent --show-error https://getcomposer.org/installer | php

RUN set -ex && \
    apt-get update -y && \
    apt-get install -y openssl zip unzip git && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
