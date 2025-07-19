FROM php:8.3-fpm

WORKDIR "/application"

RUN apt-get update

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install zip+icu dev libs + mysql dev support
RUN apt-get install libzip-dev zip libicu-dev libpq-dev -y

RUN apt-get update && apt-get install -y nano

# Install PHP extensions zip and intl (intl requires to be configured)
RUN docker-php-ext-install zip && docker-php-ext-configure intl && docker-php-ext-install intl

RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd && docker-php-ext-install pdo_mysql

RUN docker-php-ext-configure mysqli --with-mysqli=mysqlnd && docker-php-ext-install mysqli

RUN pecl install redis && docker-php-ext-enable redis

RUN apt-get update && \
apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
docker-php-ext-install gd



