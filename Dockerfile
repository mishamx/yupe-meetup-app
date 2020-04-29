FROM mishamx/php7:latest

ENV API_TOKEN e182383413576177cb2ae1cb4f626889a562ea07

ENV DB_TABLE_PREFIX ''
ENV DB_CHARSET 'utf-8'

RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive \
    && apt-get -y install \
            mysql-client \
    && rm -r /var/lib/apt/lists/*

WORKDIR /var/www/

COPY ./composer.json /var/www/composer.json
COPY ./composer.lock /var/www/composer.lock
RUN composer install --no-progress --ignore-platform-reqs --prefer-dist --profile --optimize-autoloader

COPY . /var/www

