FROM php:7.4-cli

RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip

RUN pecl install xdebug-2.8.0 \
    && docker-php-ext-enable xdebug

RUN curl https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer | php -- --quiet

RUN mv /composer.phar /usr/bin/composer

WORKDIR /opt/project

CMD ["php"]
