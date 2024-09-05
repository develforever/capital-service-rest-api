FROM php:8.1-apache

RUN apt update && apt install -y libpq-dev
RUN pecl install redis-5.3.7 \
	&& pecl install xdebug-3.2.1 \
	&& docker-php-ext-install pdo pdo_pgsql \
	&& docker-php-ext-enable redis xdebug pdo pdo_pgsql
RUN a2enmod rewrite headers