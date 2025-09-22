FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    openssl \
    git \
    unzip \
    libzip-dev \
    zip \
    libpng-dev \
    zlib1g-dev \
    libicu-dev \
    curl \
    libpq-dev \
  && docker-php-ext-install pdo_pgsql


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
  && composer --version

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip gd intl bcmath

# Copy php.ini
COPY php.ini /usr/local/etc/php/

# Catalog
WORKDIR /var/www/src

# Expose port dla PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]