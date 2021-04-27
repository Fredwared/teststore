FROM php:7.4-fpm-alpine

# Add Build Dependencies
RUN apk update && apk add --no-cache --virtual  .build-deps  \
    zlib-dev \
    nodejs npm --update \
    libjpeg-turbo-dev \
    libpng-dev \
    libxml2-dev \
    bzip2-dev \
    postgresql-dev \
    zip \
    libzip-dev \
    yarn

# Configure & Install Extension
RUN docker-php-ext-configure \
    opcache --enable-opcache &&\
    docker-php-ext-configure gd --with-jpeg=/usr/include/ && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql &&\
    docker-php-ext-configure zip && \
    docker-php-ext-install \
    opcache \
    pdo_pgsql \
    pgsql \
    pdo \
    sockets \
    json \
    intl \
    gd \
    xml \
    bz2 \
    pcntl \
    bcmath \
    exif

# Add Composer
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="./vendor/bin:$PATH"

RUN npm install -g @vue/cli

WORKDIR /var/www